<?php
use Phalcon\Mvc\Controller;
use PhalconTime\Forms\LoginForm;
use PhalconTime\Forms\RequestResetForm;
use PhalconTime\Forms\ResetPasswordForm;
use PhalconTime\Models\User;
use Phalcon\Security;
use Phalcon\Security\Random;
//use Phalcon\Mvc\Url;

class AuthController extends Controller
{

    /**
     * The start action, it shows the login form
     */
    public function indexAction()
    {
        $this->view->setVar('form', new LoginForm(null, ['edit' => false]));
    }

    /**
     * The login action, validates user
     */
    public function loginAction()
    {

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $csrf     = $this->request->getPost('csrf');

        $user = User::findFirstByName($username);

        if($user) {
            if($this->security->checkToken($csrf, $this->security->getSessionToken()) && $this->security->checkHash($password, $user->password)) {
                $this->session->set('auth-identity', [
                    'id' => $user->id,
                    'username' => $user->name,
                    'image' => $user->image
                ]);
                return $this->dispatcher->forward(["controller" => "project", "action" => "index"]);
            }
            else {
                $this->flash->error('User/Password combination incorrect');
                return $this->dispatcher->forward(["controller" => "auth", "action" => "index"]);
            }
        }
        else {
            $this->flash->error('User not found');
            return $this->dispatcher->forward(["controller" => "auth", "action" => "index"]);
        }
    }

    /**
     * The logout action, remove user session
     */
    public function logoutAction()
    {
        $this->session->remove('auth-identity');

        return $this->dispatcher->forward([
            "controller" => "auth",
            "action" => "index"
        ]);
    }

    /**
     * The password forgotten action
     */
    public function requestResetAction()
    {
        $this->view->setVar('form', new RequestResetForm(null, ['edit' => false]));
    }

    /**
     * the create token action
     */
    public function createTokenAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset"]);
        }

        $csrf  = $this->request->getPost('csrf');
        $email = $this->request->getPost("email", "string");
        $user  = User::findFirstByEmail($email);

        if($this->security->checkToken($csrf, $this->security->getSessionToken())) {
            if (!$user) {
                $this->flash->error('User not found');
                return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset" ]);
            }

            $random      = new Random();
            $uuid        = $random->uuid();
            $user->token = $uuid;

            if($user->save()) {

                $headers = "From: ".$this->config->application->domainUri."\n";
                $headers .= "X-Mailer: PHP/" . phpversion() . "\n";
                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-Type: text/html; charset=utf-8\n";
                $headers .= "Content-Transfer-Encoding: 8bit\n";

                $subject = 'Reset password for '.$this->config->application->domainUri;

                $content = $this->view->getRender('emails', 'reset-password', ['token' => $uuid, 'url' => $this->config->application->domainUri]);

                if(mail($email, $subject, $content, $headers)) {
                    $this->flash->success('An e-mail with instruction to reset the password has been send');
                    return $this->dispatcher->forward(["controller" => "auth", "action" => "index" ]);
                }

                $this->flash->error('Could not send e-mail');
                return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset" ]);

            }

        }

        $this->flash->error('Something went wrong');
        return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset" ]);
    }

    /**
     * The password reset action
     */
    public function resetAction($token)
    {

        if($this->request->isPost()) {
            $token   = $this->request->getPost('token');
            $csrf    = $this->request->getPost('csrf'); // is empty

            // @TODO csrf is empty on POST
            //if($this->security->checkToken($csrf, $this->security->getSessionToken())) {
                $user  = User::findFirstByToken($token);

                if (!$user) {
                    $this->flash->error('Token is not valid, request a new token');
                    return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset" ]);
                }

                // @TODO check if form is valid
                $password       = $this->request->getPost("password");
                $user->password = $this->security->hash($password);
                $user->token    = NULL;

                if ($user->save() == false) {
                    foreach ($user->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                    $this->flash->error('Something went wrong, request a new token');

                    return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset"]);
                }
                $this->flash->success('Password changed');

                return $this->dispatcher->forward(["controller" => "auth", "action" => "index" ]);

            //}
        }

        if(!$token) {
            $this->flash->error('Request a reset token first');
            return $this->dispatcher->forward(["controller" => "auth", "action" => "requestreset" ]);
        }
        $this->view->setVar('form', new ResetPasswordForm(null, ['edit' => false, 'usertoken' => $token]));


    }

}
