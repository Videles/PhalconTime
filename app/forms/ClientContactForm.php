<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Numericality;

use PhalconTime\Models\Client;

class ClientContactForm extends Form
{
    /**
     * Initialize the client contact form
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

        // Client
        $client = new Select('client_contact_id', Client::find(), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => 'Select a client',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $client->setLabel('Client');
        $client->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a client is required",
                    ]
                )
            ]
        );
        $this->add($client);

        // Firstname
        $firstname = new Text(
            "firstname",
            [
                "placeholder" => "Firstname",
                "class"       => "form-control",
            ]
        );
        $firstname->setLabel("Firstname");
        $firstname->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $firstname->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Firstname is required",
                    ]
                )
            ]
        );
        $this->add($firstname);

        // Addition
        $addition = new Text(
            "addition",
            [
                "placeholder" => "Addition",
                "class"       => "form-control",
            ]
        );
        $addition->setLabel("Addition");
        $addition->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($addition);

        // Lastname
        $lastname = new Text(
            "lastname",
            [
                "placeholder" => "Lastname",
                "class"       => "form-control",
            ]
        );
        $lastname->setLabel("Lastname");
        $lastname->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $lastname->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Lastname is required",
                    ]
                )
            ]
        );
        $this->add($lastname);

        // Phonetic
        $phonetic = new Text(
            "phonetic",
            [
                "placeholder" => "Phonetic",
                "class"       => "form-control",
            ]
        );
        $phonetic->setLabel("Phonetic");
        $phonetic->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($phonetic);

        // Field phone
        $phone = new Text(
            "phone",
            [
                "placeholder" => "Phonenumber",
                "class"       => "form-control",
            ]
        );
        $phone->setLabel("Phonenumber");
        $phone->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $phone->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Phonenumber is required",
                    ]
                ),
                new Regex(
                    [
                       'pattern' => '/^[0-9]+$/',
                       'message' => 'Provide only numbers'
                    ]
               )
            ]
        );
        $this->add($phone);

        // Field fax
        $fax = new Text(
            "fax",
            [
                "placeholder" => "Fax",
                "class"       => "form-control",
            ]
        );
        $fax->setLabel("Fax");
        $fax->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $fax->addValidators(
            [
                new Regex(
                    [
                       'pattern' => '/^[0-9]+$/',
                       'message' => 'Provide only numbers',
                       'allowEmpty' => TRUE
                    ]
               )
            ]
        );
        $this->add($fax);

        // Field mobile
        $mobile = new Text(
            "mobile",
            [
                "placeholder" => "Mobile phonenumber",
                "class"       => "form-control",
            ]
        );
        $mobile->setLabel("Mobile phonenumber");
        $mobile->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $mobile->addValidators(
            [
                new Regex(
                    [
                       'pattern' => '/^[0-9]+$/',
                       'message' => 'Provide only numbers',
                       'allowEmpty' => true
                    ]
               )
            ]
        );
        $this->add($mobile);

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

        // Field note
        $note = new TextArea(
            "note",
            [
                "placeholder" => "Additional information",
                "class"       => "form-control",
                "id"          => "textarea",
            ]
        );
        $note->setLabel("Note");
        $note->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($note);

    }

}
