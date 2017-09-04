<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\File as FileValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class ResetPasswordForm extends Form
{
    /**
     * Initialize the reset password form
     *
     * @param mixed $entity
     * @param array $options
     */
    public function initialize($entity = null, $options = [])
    {

        $token = new Hidden(
            "token", [
                "class" => "hidden",
                "value" => $options["usertoken"]
            ]
        );
        $this->add($token);

        // Password
        $password = new Password(
            "password",
            [
                "placeholder" => "Password",
                "class"       => "form-control",
            ]
        );
        $password->setLabel("Password");
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
                ),
                new StringLength(
                    [
                        'min' => 8,
                        'messageMinimum' => 'Password is too short. Minimum 8 characters'
                    ]
                ),
                new Confirmation(
                    [
                        'message' => 'Password doesn\'t match confirmation',
                        'with' => 'passwordRepeat'
                    ]
                )
            ]
        );
        $this->add($password);

        // Password repeat
        $passwordRepeat = new Password(
            "passwordRepeat",
            [
                "placeholder" => "Password repeat",
                "class"       => "form-control",
            ]
        );
        $passwordRepeat->setLabel("Password repeat");
        $passwordRepeat->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $passwordRepeat->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Password repeat is required",
                    ]
                )
            ]
        );
        $this->add($passwordRepeat);

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
