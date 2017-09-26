<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{

    protected $acl;

    public function onConstruct()
    {
        if (!$this->session->get('auth-identity')) {
            return $this->dispatcher->forward([
                "controller" => "auth",
                "action"     => "index"
            ]);
        }

        $this->view->setVar('uid', $this->session->get('auth-identity')['id']);
        $this->view->setVar('userName', $this->session->get('auth-identity')['username']);
        $this->view->setVar('userImage', $this->session->get('auth-identity')['image']);
        $this->view->setVar('role', $this->session->get('auth-identity')['role']);

        // More information https://olddocs.phalconphp.com/en/3.0.3/api/Phalcon_Acl_Adapter_Memory.html
        $this->acl = new \Phalcon\Acl\Adapter\Memory();
        $this->acl->setDefaultAction(
            \Phalcon\Acl::DENY
        );

        // Register roles
        $roles = [
            'administrator' => new \Phalcon\Acl\Role('administrator'),
            'user'          => new \Phalcon\Acl\Role('user'),
            'guest'         => new \Phalcon\Acl\Role('guest'),
        ];
        foreach ($roles as $role) {
            $this->acl->addRole($role);
        }

        // Public resources - Anyone can see these resources
        $publicResources = [
            'auth'  => ['index', 'login', 'logout', 'requestReset', 'createToken', 'reset'],
        ];

        // Create public resources
        foreach ($publicResources as $resourceName => $actions) {
            $this->acl->addResource(
                new \Phalcon\Acl\Resource($resourceName),
                $actions
            );
        }

        // Private resources - Administrator can access all private resources
        $administratorResources = [
            'index'            => ['index'],
            'clientcontact'    => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'client'           => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'pricetype'        => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'project'          => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'projectstatus'    => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'timeregistration' => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'timetype'         => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm'],
            'user'             => ['index', 'new', 'edit', 'create', 'save', 'delete', 'confirm', 'deleteImage'],
        ];

        // Create private resources
        foreach ($administratorResources as $resourceName => $actions) {
            $this->acl->addResource(
                new \Phalcon\Acl\Resource($resourceName),
                $actions
            );
        }

        // Create user level resources
        $userResources = [
            'index'            => ['index'],
            'clientcontact'    => ['index', 'new', 'edit', 'create', 'save'],
            'client'           => ['index', 'new', 'edit', 'create', 'save'],
            'project'          => ['index', 'new', 'edit', 'create', 'save'],
            'timeregistration' => ['index', 'new', 'edit', 'create', 'save'],
        ];

        // Grant access to public areas to both users and guests
        foreach ($roles as $role){
            foreach ($publicResources as $resource => $actions) {
                $this->acl->allow($role->getName(), $resource, "*");
            }
        }

        // Grant access to private area to role Users
        foreach ($userResources as $resource => $actions) {
            foreach ($actions as $action) {
                $this->acl->allow('user', $resource, $action);
            }
        }

        // Grant access to private area to role Administrators
        foreach ($administratorResources as $resource => $actions) {
            foreach ($actions as $action) {
                $this->acl->allow('administrator', $resource, $action);
            }
        }

    }

    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {

        $controllerName = $dispatcher->getControllerName();
        $actionName     = $dispatcher->getActionName();
        $userRole       = $this->session->get('auth-identity')['role'];

        if(!$userRole) {
            $userRole = 'guest';
        }
        elseif (!$this->acl->isAllowed($userRole, $controllerName, $actionName)) {
            $this->flash->error('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

            $dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index'
            ]);
            return FALSE;
        }

    }

}
