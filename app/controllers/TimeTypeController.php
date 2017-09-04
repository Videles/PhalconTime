<?php
use PhalconTime\Forms\TimeTypeForm;
use PhalconTime\Models\TimeType;

class TimeTypeController extends ControllerBase
{

    /**
     * The start action, it shows the "search" view
     */
    public function indexAction()
    {
        $timetype = TimeType::find();

        $this->view->timetype = $timetype;
    }

    /**
     * Shows the view to create a "new" time type
     */
    public function newAction()
    {
        $this->view->setVar('form', new TimeTypeForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing time type
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $timetype = TimeType::findFirstById($id);
            if (!$timetype) {
                $this->flash->error('Time type not found');
                return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
            }

            $this->view->setVar('form', new TimeTypeForm($timetype, ['edit' => true]));
        }
    }

    /**
     * Creates a time type based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
        }

        $form       = new TimeTypeForm;
        $timetype   = new TimeType;
        $data       = $this->request->getPost();

        if (!$form->isValid($data, $timetype)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "new" ]);
        }

        if ($timetype->save() == false) {
            foreach ($timetype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Time type created");

        return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
    }

    /**
     * Updates a time type based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
        }

        $id         = $this->request->getPost("id", "int");
        $timetype   = TimeType::findFirstById($id);

        if (!$timetype) {
            $this->flash->error("Time type not found");
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
        }

        $form = new TimeTypeForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $timetype)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "edit" , "params" => $id]);
        }
        if ($timetype->save() == false) {
            foreach ($timetype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Time type updated');

        return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
    }

    /**
     * Deletes an existing time type
     */
    public function deleteAction($id)
    {
        $timetype = TimeType::findFirstById($id);

        if (!$timetype) {
            $this->flash->error("Time type not found");

            return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
        }
        if (!$timetype->delete()) {
            foreach ($timetype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
        }

        $this->flash->success("Time type deleted");
        return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Time type not found");

            return $this->dispatcher->forward(["controller" => "timetype", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
