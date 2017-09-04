<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{
    /**
     * Initialize the login form
     *
     * @param mixed $entity
     */
    public function initialize($entity = null)
    {

        // Username
        $name = new Text(
            "username",
            [
                "placeholder" => "Username",
                "class"       => "form-control",
            ]
        );
        $name->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $name->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Username is required",
                    ]
                )
            ]
        );
        $this->add($name);

        // Password
        $password = new Password(
            "password",
            [
                "placeholder" => "Password",
                "class"       => "form-control",
            ]
        );
        $password->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $password->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Password is required",
                    ]
                )
            ]
        );
        $this->add($password);

        // CSRF
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(
            [
                'value' => $this->security->getSessionToken(),
                'message' => 'CSRF validation failed'
            ])
        );
        $csrf->clear();
        $this->add($csrf);

    }

}
