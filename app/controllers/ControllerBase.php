<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    public function onConstruct()
    {
        if (!$this->session->get('auth-identity')) {
            return $this->dispatcher->forward([
                "controller" => "auth",
                "action" => "index"
            ]);
        }

        $this->view->setVar('uid', $this->session->get('auth-identity')['id']);
        $this->view->setVar('userName', $this->session->get('auth-identity')['username']);
        $this->view->setVar('userImage', $this->session->get('auth-identity')['image']);

    }

}
