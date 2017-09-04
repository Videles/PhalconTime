<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Numericality;

class ClientForm extends Form
{
    /**
     * Initialize the client form
     *
     * @param mixed $entity
     * @param array $options
     */
    public function initialize($entity = null, $options = [])
    {

        if (isset($options['edit']) && $options['edit'] === TRUE) {
            $id = new Hidden(
                "id", [
                    "class"       => "hidden",
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
                       'message' => 'Provide only numbers'
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

        // Street
        $street = new Text(
            "street",
            [
                "placeholder" => "Street",
                "class"       => "form-control",
            ]
        );
        $street->setLabel("Street");
        $street->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($street);

        // Number
        $number = new Text(
            "number",
            [
                "placeholder" => "Number",
                "class"       => "form-control",
            ]
        );
        $number->setLabel("Number");
        $number->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $number->addValidators(
            [
                new Regex(
                    [
                       'pattern' => '/^[0-9]+$/',
                       'message' => 'ProvideOnlyNumbers',
                       'allowEmpty' => true
                    ]
               )
            ]
        );
        $this->add($number);

        // Number addition
        $number_addition = new Text(
            "number_addition",
            [
                "placeholder" => "NumberAddition",
                "class"       => "form-control",
            ]
        );
        $number_addition->setLabel("NumberAddition");
        $number_addition->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($number_addition);

        // Zipcode
        $zipcode = new Text(
            "zipcode",
            [
                "placeholder" => "Zipcode",
                "class"       => "form-control",
            ]
        );
        $zipcode->setLabel("Zipcode");
        $zipcode->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($zipcode);

        // City
        $city = new Text(
            "city",
            [
                "placeholder" => "City",
                "class"       => "form-control",
            ]
        );
        $city->setLabel("City");
        $city->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($city);

        // Field coc
        $coc = new Text(
            "coc",
            [
                "placeholder" => "Chamber of Commerce number",
                "class"       => "form-control",
            ]
        );
        $coc->setLabel("COC");
        $coc->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $coc->addValidators(
            [
                new Regex(
                    [
                       'pattern' => '/^[0-9]+$/',
                       'message' => 'Provide only numbers'
                    ]
               )
            ]
        );
        $this->add($coc);

        // Field vat
        $vat = new Text(
            "vat",
            [
                "placeholder" => "VAT number",
                "class"       => "form-control",
            ]
        );
        $vat->setLabel("VAT");
        $vat->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $vat->addValidators(
            [
                new Regex(
                    [
                       'pattern' => '/^[0-9]+$/',
                       'message' => 'Provide only numbers'
                    ]
               )
            ]
        );
        $this->add($vat);

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

        // Latitude
        $latitude = new Text(
            "latitude",
            [
                "placeholder" => "Latitude",
                "class"       => "form-control",
            ]
        );
        $latitude->setLabel("Latitude");
        $latitude->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($latitude);

        // Longitude
        $longitude = new Text(
            "longitude",
            [
                "placeholder" => "Longitude",
                "class"       => "form-control",
            ]
        );
        $longitude->setLabel("Longitude");
        $longitude->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($longitude);

    }

}
