<?php
namespace PhalconTime\Controllers\Component;

use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\View;
use PhalconTime\Models\User;

/**
 * @property View $view
 */
class UserFragment extends Component
{
    public function userList()
    {
        $user  = new User();
        $users = $user->find();

        return $this->view->getRender('fragment', 'user-fragment', ['users' => $users]);

    }
}
