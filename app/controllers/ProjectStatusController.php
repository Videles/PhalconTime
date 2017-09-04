<?php
use PhalconTime\Forms\ProjectStatusForm;
use PhalconTime\Models\ProjectStatus;

class ProjectStatusController extends ControllerBase
{

    /**
     * The start action, it shows the "search" view
     */
    public function indexAction()
    {
        $projectstatus = ProjectStatus::find();

        $this->view->projectstatus = $projectstatus;
    }

    /**
     * Shows the view to create a "new" project status
     */
    public function newAction()
    {
        $this->view->setVar('form', new ProjectStatusForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing project status
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $projectstatus = ProjectStatus::findFirstById($id);
            if (!$projectstatus) {
                $this->flash->error('Project status not found');
                return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
            }

            $this->view->setVar('form', new ProjectStatusForm($projectstatus, ['edit' => true]));
        }
    }

    /**
     * Creates a project status based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
        }

        $form           = new ProjectStatusForm;
        $projectstatus  = new ProjectStatus;
        $data           = $this->request->getPost();

        if (!$form->isValid($data, $projectstatus)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "new" ]);
        }

        if ($projectstatus->save() == false) {
            foreach ($projectstatus->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Project status created");

        return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
    }

    /**
     * Updates a project status based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
        }

        $id             = $this->request->getPost("id", "int");
        $projectstatus  = ProjectStatus::findFirstById($id);

        if (!$projectstatus) {
            $this->flash->error("Project status not found");
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
        }

        $form = new ProjectStatusForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $projectstatus)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "edit" , "params" => $id]);
        }
        if ($projectstatus->save() == false) {
            foreach ($projectstatus->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Project status updated');

        return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
    }

    /**
     * Deletes an existing project status
     */
    public function deleteAction($id)
    {
        $projectstatus = ProjectStatus::findFirstById($id);

        if (!$projectstatus) {
            $this->flash->error("Project status not found");

            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
        }
        if (!$projectstatus->delete()) {
            foreach ($projectstatus->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
        }

        $this->flash->success("Project status deleted");
        return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Project status not found");

            return $this->dispatcher->forward(["controller" => "projectstatus", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
