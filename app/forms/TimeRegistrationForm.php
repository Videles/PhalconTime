<?php

namespace PhalconTime\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Numeric;

use PhalconTime\Forms\Elements\Time;

use PhalconTime\Models\Project;
use PhalconTime\Models\TimeType;


class TimeregistrationForm extends Form
{
    /**
     * Initialize the time registration form
     *
     * @param mixed $entity
     * @param array $options
     */
    public function initialize($entity = null, $options = [])
    {

        if(isset($options['edit']) && $options['edit'] === TRUE) {
            $id = new Hidden(
                "id", [
                    "class" => "hidden",
                ]
            );
            $this->add($id);
        }

        // Project
        $project = new Select('project_id', Project::findByDelivered(0), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => 'Select project',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $project->setLabel('Project');
        $project->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a project is required",
                    ]
                )
            ]
        );
        $this->add($project);

        // Time type
        $timeType = new Select('time_type_id', TimeType::find(), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => 'Select time type',
            'emptyValue' => '',
            'class'      => 'form-control',
        ]);
        $timeType->setLabel('Time type');
        $timeType->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Selecting a time type is required",
                    ]
                )
            ]
        );
        $this->add($timeType);


        // Start time
        $startTime = new Time(
            "start_time",
            [
                "class" => "form-control",
                "step"  => "60"
            ]
        );
        $startTime->setLabel("Start time");
        $startTime->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($startTime);


        // End time
        $endTime = new Time(
            "end_time",
            [
                "class" => "form-control",
                "step"  => "60"
            ]
        );
        $endTime->setLabel("End time");
        $endTime->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($endTime);


        // Total time
        $totalTime = new Time(
            "total_time",
            [
                "placeholder"   => "00:01 (not required if using start/end date/time)",
                "class"         => "form-control",
                "step"          => "60"
            ]
        );
        $totalTime->setLabel("Total time");
        $totalTime->setFilters(
            [
                "striptags",
                "string",
            ]
        );
        $this->add($totalTime);

        // Field description
        $description = new TextArea(
            "description",
            [
                "placeholder" => "Description",
                "class"       => "form-control",
                "id"          => "textarea",
            ]
        );
        $description->setLabel("Description");
        $timeType->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Description is required",
                    ]
                )
            ]
        );
        $description->setFilters(
            [
                "string",
            ]
        );
        $this->add($description);

    }

}
