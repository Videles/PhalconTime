<?php
use PhalconTime\Forms\ClientForm;
use PhalconTime\Models\Client;

class ClientController extends ControllerBase
{

    /**
     * The start action, it shows the overview
     */
    public function indexAction()
    {
        $clients = Client::find();

        $this->view->clients = $clients;
    }

    /**
     * Shows the view to create a "new" client
     */
    public function newAction()
    {
        $this->view->setVar('form', new ClientForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing client
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $client = Client::findFirstById($id);
            if (!$client) {
                $this->flash->error('Client not found');
                return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
            }

            $this->view->setVar('form', new ClientForm($client, ['edit' => true]));
        }
    }

    /**
     * Creates a client based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
        }

        $form   = new ClientForm;
        $client = new Client;
        $data   = $this->request->getPost();

        if (!$form->isValid($data, $client)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "client", "action" => "new" ]);
        }

        if ($client->save() == false) {
            foreach ($client->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "client", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Client created");

        return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
    }

    /**
     * Updates a client based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
        }

        $id        = $this->request->getPost("id", "int");
        $client    = Client::findFirstById($id);

        if (!$client) {
            $this->flash->error("Client not found");
            return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
        }

        $form = new ClientForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $client)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "client", "action" => "edit" , "params" => $id]);
        }
        if ($client->save() == false) {
            foreach ($client->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "client", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Client updated');

        return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
    }

    /**
     * Deletes an existing client
     */
    public function deleteAction($id)
    {
        $client = Client::findFirstById($id);

        if (!$client) {
            $this->flash->error("Client not found");

            return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
        }
        if (!$client->delete()) {
            foreach ($client->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
        }

        $this->flash->success("Client deleted");
        return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Client not found");

            return $this->dispatcher->forward(["controller" => "client", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
