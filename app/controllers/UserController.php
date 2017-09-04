<?php
use PhalconTime\Forms\UserForm;
use PhalconTime\Models\User;
use Phalcon\Security\Random;

class UserController extends ControllerBase
{

    /**
     * The start action, it shows the "search" view
     */
    public function indexAction()
    {
        $users = User::find();

        $this->view->users = $users;
    }

    /**
     * Shows the view to create a "new" user
     */
    public function newAction()
    {
        $this->view->setVar('form', new UserForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing user
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $user = User::findFirstById($id);
            if (!$user) {
                $this->flash->error('User not found');
                return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
            }

            $user->setPassword('');
            $this->view->setVar('id', $id);
            $this->view->setVar('form', new UserForm($user, ['edit' => true]));
        }
    }

    /**
     * Creates a user based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }

        $form   = new UserForm;
        $user   = new User;
        $data   = $this->request->getPost();

        if (!$form->isValid($data, $user)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "user", "action" => "new" ]);
        }

        $password       = $this->request->getPost("password");
        $user->password = $this->security->hash($password);

        if($this->request->getPost("image") !== '') {
            if($this->request->hasFiles()) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    if($file->getName() != '') {
                        if ($this->extensionCheck($file->getRealType())) {
                            $random      = new Random();
                            $uuid        = $random->uuid();
                            $user->image = $uuid.'_'.$file->getName();

                            $file->moveTo('img/uploads/'.$uuid.'_'.$file->getName());
                        }
                        else {
                            $this->flash->error('This typ of file is not supported');

                            return $this->dispatcher->forward(["controller" => "user", "action" => "new" ]);
                        }
                    }
                    //there is no image uploading
                }
            }
        }

        if ($user->save() == false) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "user", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("User created");

        return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
    }

    /**
     * Updates a user based on the data entered in the "edit" action
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }

        $id     = $this->request->getPost("id", "int");
        $user   = User::findFirstById($id);

        if (!$user) {
            $this->flash->error("User not found");
            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }
        $currentPassword = $user->getPassword();

        $form = new UserForm;
        $this->view->setVar('form', $form);

        if($this->request->getPost("password") !== '') {
            $data = $this->request->getPost();

            // @TODO on edit screen validation doesn't work
            // if (!$form->isValid($data, $user)) {
            //     foreach ($form->getMessages() as $message) {
            //         $this->flash->error($message);
            //     }
            //     return $this->dispatcher->forward(["controller" => "user", "action" => "edit" , "params" => $id]);
            // }

            $password       = $this->request->getPost("password");
            $user->password = $this->security->hash($password);
        }
        else {
            $user->password = $currentPassword;
        }

        if($this->request->getPost("image") !== '') {
            if($this->request->hasFiles()) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    if($file->getName() != '') {
                        if ($this->extensionCheck($file->getRealType())) {
                            $random      = new Random();
                            $uuid        = $random->uuid();
                            $user->image = $uuid.'_'.$file->getName();

                            $file->moveTo('img/uploads/'.$uuid.'_'.$file->getName());
                        }
                        else {
                            $this->flash->error('This typ of file is not supported');

                            return $this->dispatcher->forward(["controller" => "user", "action" => "edit" , "params" => $id]);
                        }
                    }
                    //there is no image uploading
                }
            }
        }

        if ($user->save() == false) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "user", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('User updated');

        return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
    }

    /**
     * Deletes an existing user
     */
    public function deleteAction($id)
    {
        $user = User::findFirstById($id);

        if (!$user) {
            $this->flash->error("User not found");

            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }
        if (!$user->delete()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }

        $this->flash->success("User deleted");
        return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
    }

    /**
     * Delete only the image
     */
    public function deleteImageAction($id)
    {
        $user   = User::findFirstById($id);

        if (!$user) {
            $this->flash->error("User not found");
            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }

        $user->image = NULL;

        $form = new UserForm;
        $this->view->setVar('form', $form);

        if ($user->save() == false) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "user", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Image removed');

        return $this->dispatcher->forward(["controller" => "user", "action" => "edit" ]);

    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("User not found");

            return $this->dispatcher->forward(["controller" => "user", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }

    /**
     * Attempt to determine the real file type of a file.
     *
     * @param  string $extension Extension (eg 'jpg')
     * @return boolean
     *
     * @TODO move to form object, https://docs.phalconphp.com/en/3.0.0/api/Phalcon_Validation_Validator_File.html
     */
    private function extensionCheck($extension)
    {
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/png',
            'image/bmp',
            'image/jpeg'
        ];

        return in_array($extension, $allowedTypes);
    }


}
