<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Forms\Element\Numeric;

use PhalconTime\Models\Client;
use PhalconTime\Models\ClientContact;
use PhalconTime\Models\PriceType;
use PhalconTime\Models\ProjectStatus;

class ProjectForm extends Form
{
    /**
     * Initialize the project form
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

        // Project status
        $projectStatus = new Select('project_status_id', ProjectStatus::find(), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => 'Select project status',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $projectStatus->setLabel('Status');
        $projectStatus->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a project status is required",
                    ]
                )
            ]
        );
        $this->add($projectStatus);

        // Client
        $client = new Select('client_id', Client::find(), [
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

        // Client contact
        $clientContact = new Select('client_contact_id', ClientContact::find(["columns" => "id, CONCAT(firstname, ' ', addition, ' ', lastname) as fullname"]), [
            'using'      => ['id', 'fullname'],
            'useEmpty'   => true,
            'emptyText'  => 'Select a client contact',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $clientContact->setLabel('Client contact');
        $clientContact->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a client contact is required",
                    ]
                )
            ]
        );
        $this->add($clientContact);

        // Client purchase numer
        $clientPurchaseNumber = new Text(
            "client_purchase_number",
            [
                "placeholder" => "Purchase number",
                "class"       => "form-control",
            ]
        );
        $clientPurchaseNumber->setLabel("Purchase number");
        $clientPurchaseNumber->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($clientPurchaseNumber);

        // Project status
        $priceType = new Select('price_type_id', PriceType::find(), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => 'Select price type',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $priceType->setLabel('Price type');
        $priceType->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a price type is required",
                    ]
                )
            ]
        );
        $this->add($priceType);

        // Price type value
        $priceTypeValue = new Numeric(
            "price_type_value",
            [
                "placeholder" => "0.01 (ex VAT amount)",
                "class"       => "form-control",
                "min"         => "0.01",
                "step"        => "0.01",
                //"pattern"     => "\d*", // if integer only
            ]
        );
        $priceTypeValue->setLabel("Price type value");
        $priceTypeValue->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $priceTypeValue->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Price type value is required",
                    ]
                )
            ]
        );
        $this->add($priceTypeValue);

        // Estimated time
        $estimatedTime = new Numeric(
            "estimated_time",
            [
                "placeholder" => "0.25 (per 15 minutes)",
                "class"       => "form-control",
                "min"         => "0.25",
                "step"        => "0.25",
                //"pattern"     => "\d*", // if integer only
            ]
        );
        $estimatedTime->setLabel("Estimated time");
        $estimatedTime->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($estimatedTime);

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

        // Field description
        $note = new TextArea(
            "note",
            [
                "placeholder" => "Description",
                "class"       => "form-control",
                "id"          => "textarea",
            ]
        );
        $note->setLabel("Description");
        $note->setFilters(
            [
                "string",
            ]
        );
        $this->add($note);

        // Delivery date
        $deliveryDate = new Date(
            "delivery_date",
            [
                "class" => "form-control",
            ]
        );
        $deliveryDate->setLabel("Delivery date");
        $deliveryDate->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($deliveryDate);

        // Delivered
        $delivered = new Check(
            "delivered",
            [
                "value" => 1,
            ]
        );
        $delivered->setLabel("Delivered (Yes/No)");
        $delivered->setFilters(
            [
                "striptags",
                "int",
            ]
        );
        $this->add($delivered);

        // Delivered date
        $deliveredDate = new Date(
            "delivered_date",
            [
                "class" => "form-control",
            ]
        );
        $deliveredDate->setLabel("Delivered date");
        $deliveredDate->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($deliveredDate);

    }

}
