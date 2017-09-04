<?php
use PhalconTime\Forms\ClientContactForm;
use PhalconTime\Models\ClientContact;

class ClientContactController extends ControllerBase
{

    /**
     * The start action, it shows the "search" view
     */
     public function indexAction()
     {
         $clientContacts = ClientContact::find();

         $this->view->clientContacts = $clientContacts;
     }

    /**
     * Shows the view to create a "new" client contact
     */
    public function newAction()
    {
        $this->view->setVar('form', new ClientContactForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing client contact
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $clientContact = ClientContact::findFirstById($id);
            if (!$clientContact) {
                $this->flash->error('Client contact not found');
                return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
            }

            $this->view->setVar('form', new ClientContactForm($clientContact, ['edit' => true]));
        }
    }

    /**
     * Creates a client based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
        }

        $form           = new ClientContactForm;
        $clientContact  = new ClientContact;
        $data           = $this->request->getPost();

        if (!$form->isValid($data, $clientContact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "new" ]);
        }

        if ($clientContact->save() == false) {
            foreach ($clientContact->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Client contact created");

        return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
    }

    /**
     * Updates a client based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if(!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
        }

        $id             = $this->request->getPost("id", "int");
        $clientContact  = ClientContact::findFirstById($id);

        if (!$clientContact) {
            $this->flash->error("Client contact not found");
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
        }

        $form = new ClientContactForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $clientContact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "edit" , "params" => $id]);
        }
        if ($clientContact->save() == false) {
            foreach ($clientContact->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Client contact updated');

        return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
    }

    /**
     * Deletes an existing client
     */
    public function deleteAction($id)
    {
        $clientContact = ClientContact::findFirstById($id);

        if (!$clientContact) {
            $this->flash->error("Client contact not found");

            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
        }
        if (!$clientContact->delete()) {
            foreach ($clientContact->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
        }

        $this->flash->success("Client contact deleted");
        return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Client contact not found");

            return $this->dispatcher->forward(["controller" => "clientcontact", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
