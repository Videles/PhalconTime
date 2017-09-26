<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\File as FileValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

use PhalconTime\Models\UserRole;

class UserForm extends Form
{
    /**
     * Initialize the project status form
     *
     * @param mixed $entity
     * @param array $options
     */
    public function initialize($entity = null, $options = [])
    {

        if (isset($options['edit']) && $options['edit'] === TRUE) {
            $id = new Hidden(
                "id", [
                    "class" => "hidden",
                ]
            );
            $this->add($id);
        }

        // Name
        $name = new Text(
            "name",
            [
                "placeholder" => "Name",
                "class"       => "form-control",
            ]
        );
        $name->setLabel("Name");
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
                        "message" => "Name is required",
                    ]
                )
            ]
        );
        $this->add($name);


        // Email
        $email = new Text(
            "email",
            [
                "placeholder" => "E-mailaddress",
                "class"       => "form-control",
            ]
        );
        $email->setLabel("E-mail");
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
                        "message" => "E-mailaddress is required",
                    ]
                ),
                new Email(
                    [
                        'message' => 'E-mailaddress is not valid'
                    ]
                )
            ]
        );
        $this->add($email);

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

        // File
        $file = new File(
            "image",
            [
                "placeholder" => ""
            ]
        );
        $file->setLabel("Profile picture");
        $file->addValidators(
            [
                new FileValidator(
                    [
                        'allowEmpty' => true
                    ]
                )
            ]
        );
        $this->add($file);

        // Role
        $roleId = new Select('role_id', UserRole::find(), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => 'Select a role',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $roleId->setLabel('Role');
        $roleId->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a role is required",
                    ]
                )
            ]
        );
        $this->add($roleId);

        // Active
        $active = new Check(
            "active",
            [
                "value" => 1,
                "checked" => "checked"
            ]
        );
        $active->setLabel("Active");
        $active->setFilters(
            [
                "striptags",
                "int",
            ]
        );
        $this->add($active);

    }

}
