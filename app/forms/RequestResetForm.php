<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;

class RequestResetForm extends Form
{
    /**
     * Initialize the forgot password form
     *
     * @param mixed $entity
     */
    public function initialize($entity = null)
    {

        // Email
        $email = new Text(
            "email",
            [
                "placeholder" => "Email",
                "class"       => "form-control",
            ]
        );
        $email->setLabel("Email");
        $email->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $email->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "E-mail is required",
                    ]
                ),
                new Email(
                    [
                        "message" => "E-mail is not valid"
                    ]
                )
            ]
        );
        $this->add($email);

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
