<?php
use PhalconTime\Forms\PriceTypeForm;
use PhalconTime\Models\PriceType;

class PriceTypeController extends ControllerBase
{

    /**
     * The start action, it shows the "search" view
     */
    public function indexAction()
    {
        $pricetype = PriceType::find();

        $this->view->pricetype = $pricetype;
    }

    /**
     * Shows the view to create a "new" price type
     */
    public function newAction()
    {
        $this->view->setVar('form', new PriceTypeForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing price type
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $pricetype = PriceType::findFirstById($id);
            if (!$pricetype) {
                $this->flash->error('Price type not found');
                return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
            }

            $this->view->setVar('form', new PriceTypeForm($pricetype, ['edit' => true]));
        }
    }

    /**
     * Creates a price type based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
        }

        $form       = new PriceTypeForm;
        $pricetype  = new PriceType;
        $data       = $this->request->getPost();

        if (!$form->isValid($data, $pricetype)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "new" ]);
        }

        if ($pricetype->save() == false) {
            foreach ($pricetype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Price type created");

        return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
    }

    /**
     * Updates a price type based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
        }

        $id         = $this->request->getPost("id", "int");
        $pricetype  = PriceType::findFirstById($id);

        if (!$pricetype) {
            $this->flash->error("Price type not found");
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
        }

        $form = new PriceTypeForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $pricetype)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "edit" , "params" => $id]);
        }
        if ($pricetype->save() == false) {
            foreach ($pricetype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Price type updated');

        return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
    }

    /**
     * Deletes an existing price type
     */
    public function deleteAction($id)
    {
        $pricetype = PriceType::findFirstById($id);

        if (!$pricetype) {
            $this->flash->error("Price type not found");

            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
        }
        if (!$pricetype->delete()) {
            foreach ($pricetype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
        }

        $this->flash->success("Price type deleted");
        return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Price type not found");

            return $this->dispatcher->forward(["controller" => "pricetype", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
