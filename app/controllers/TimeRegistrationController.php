<?php
use PhalconTime\Forms\TimeRegistrationForm;
use PhalconTime\Models\TimeRegistration;
use PhalconTime\Models\Project;

class TimeRegistrationController extends ControllerBase
{

    /**
     * The start action, it shows the "index" view
     */
    public function indexAction()
    {
        $timeregistration = TimeRegistration::find();

        $this->view->timeregistration = $timeregistration;
    }

    /**
     * Shows the view to create a "new" time registration
     */
    public function newAction($project_id)
    {
        if($project_id) {
            $this->tag->setDefault("project_id", $project_id);

            $project = Project::findById($project_id);
            if($project->delivered) {
                $this->flash->error('This project is already delivered. Unable to book time.');
                return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
            }

            $registeredTime = TimeRegistration::findByProjectId($project_id);
            $this->view->setVar('registeredTime', $registeredTime);
        }
        $this->view->setVar('form', new TimeRegistrationForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing time registration
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $timeregistration = TimeRegistration::findFirstById($id);
            if (!$timeregistration) {
                $this->flash->error('Time registration not found');
                return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
            }

            $project = Project::findById($timeregistration->project_id);
            if($project->delivered) {
                $this->flash->error('This project is already delivered. Unable to book time.');
                return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
            }

            $this->view->setVar('form', new TimeRegistrationForm($timeregistration, ['edit' => true]));
        }
    }

    /**
     * Creates a time registration based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        $form               = new TimeRegistrationForm;
        $timeregistration   = new TimeRegistration;
        $data               = $this->request->getPost();

        $project = Project::findById($data['project_id']);
        if($project->delivered) {
            $this->flash->error('This project is already delivered. Unable to book time.');
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        if (!$form->isValid($data, $timeregistration)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "new" ]);
        }

        $timeregistration->user_id = $this->session->get('auth-identity')['id'];

        if ($timeregistration->save() == false) {
            foreach ($timeregistration->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Time registration created");

        return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
    }

    /**
     * Updates a time registration based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        $id                 = $this->request->getPost("id", "int");
        $timeregistration   = TimeRegistration::findFirstById($id);

        if (!$timeregistration) {
            $this->flash->error("Time registration not found");
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        $project = Project::findById($timeregistration->project_id);
        if($project->delivered) {
            $this->flash->error('This project is already delivered. Unable to book time.');
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        $form = new TimeRegistrationForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $timeregistration)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "edit" , "params" => $id]);
        }

        $timeregistration->user_id = $this->session->get('auth-identity')['id'];

        if ($timeregistration->save() == false) {
            foreach ($timeregistration->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Time registration updated');

        return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
    }

    /**
     * Deletes an existing time registration
     */
    public function deleteAction($id)
    {
        $timeregistration = TimeRegistration::findFirstById($id);

        if (!$timeregistration) {
            $this->flash->error("Time registration not found");

            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }
        if (!$timeregistration->delete()) {
            foreach ($timeregistration->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        $this->flash->success("Time registration deleted");
        return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Time registration not found");

            return $this->dispatcher->forward(["controller" => "timeregistration", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
