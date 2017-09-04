<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;

class TimeTypeForm extends Form
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

    }

}
