<?php
namespace PhalconTime\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class Project extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $client_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $client_contact_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $client_purchase_number;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $project_status_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $price_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $price_type_value;

    /**
     *
     * @var double
     * @Column(type="double", nullable=true)
     */
    protected $estimated_time;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $description;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $delivery_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $delivered;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $delivered_date;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $modified;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field client_id
     *
     * @param integer $client_id
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * Method to set the value of field client_contact_id
     *
     * @param integer $client_contact_id
     * @return $this
     */
    public function setClientContactId($client_contact_id)
    {
        $this->client_contact_id = $client_contact_id;

        return $this;
    }

    /**
     * Method to set the value of field client_purchase_number
     *
     * @param string $client_purchase_number
     * @return $this
     */
    public function setClientPurchaseNumber($client_purchase_number)
    {
        $this->client_purchase_number = $client_purchase_number;

        return $this;
    }

    /**
     * Method to set the value of field project_status_id
     *
     * @param integer $project_status_id
     * @return $this
     */
    public function setProjectStatusId($project_status_id)
    {
        $this->project_status_id = $project_status_id;

        return $this;
    }

    /**
     * Method to set the value of field price_type_id
     *
     * @param integer $price_type_id
     * @return $this
     */
    public function setPriceTypeId($price_type_id)
    {
        $this->price_type_id = $price_type_id;

        return $this;
    }

    /**
     * Method to set the value of field price_type_value
     *
     * @param integer $price_type_value
     * @return $this
     */
    public function setPriceTypeValue($price_type_value)
    {
        $this->price_type_value = $price_type_value;

        return $this;
    }

    /**
     * Method to set the value of field estimated_time
     *
     * @param double $estimated_time
     * @return $this
     */
    public function setEstimatedTime($estimated_time)
    {
        $this->estimated_time = $estimated_time;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field delivery_date
     *
     * @param string $delivery_date
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    /**
     * Method to set the value of field delivered
     *
     * @param integer $delivered
     * @return $this
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;

        return $this;
    }

    /**
     * Method to set the value of field delivered_date
     *
     * @param string $delivered_date
     * @return $this
     */
    public function setDeliveredDate($delivered_date)
    {
        $this->delivered_date = $delivered_date;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field modified
     *
     * @param string $modified
     * @return $this
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field client_id
     *
     * @return integer
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Returns the value of field client_contact_id
     *
     * @return integer
     */
    public function getClientContactId()
    {
        return $this->client_contact_id;
    }

    /**
     * Returns the value of field client_purchase_number
     *
     * @return string
     */
    public function getClientPurchaseNumber()
    {
        return $this->client_purchase_number;
    }

    /**
     * Returns the value of field project_status_id
     *
     * @return integer
     */
    public function getProjectStatusId()
    {
        return $this->project_status_id;
    }

    /**
     * Returns the value of field price_type_id
     *
     * @return integer
     */
    public function getPriceTypeId()
    {
        return $this->price_type_id;
    }

    /**
     * Returns the value of field price_type_value
     *
     * @return integer
     */
    public function getPriceTypeValue()
    {
        return $this->price_type_value;
    }

    /**
     * Returns the value of field estimated_time
     *
     * @return double
     */
    public function getEstimatedTime()
    {
        return $this->estimated_time;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field delivery_date
     *
     * @return string
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * Returns the value of field delivered
     *
     * @return integer
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Returns the value of field delivered_date
     *
     * @return string
     */
    public function getDeliveredDate()
    {
        return $this->delivered_date;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field modified
     *
     * @return string
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {

        $this->belongsTo('client_id', __NAMESPACE__ . '\Client', 'id', [
            'alias' => 'client'
        ]);

        $this->belongsTo('client_contact_id', __NAMESPACE__ . '\ClientContact', 'id', [
            'alias' => 'clientContact'
        ]);

        $this->belongsTo('project_status_id', __NAMESPACE__ . '\ProjectStatus', 'id', [
            'alias' => 'ProjectStatus'
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\TimeRegistration', 'project_id', [
            'alias' => 'TimeRegistration',
            'foreignKey' => [
                'message' => 'Cannot delete project because of related registered time'
            ]
        ]);

        $this->addBehavior(new Timestampable([
            'beforeValidationOnCreate' => [
                'field' => 'created_at',
                'format' => 'Y-m-d H:i:s'
            ]
        ]));

        $this->addBehavior(new Timestampable([
            'beforeValidationOnUpdate' => [
                'field' => 'modified',
                'format' => 'Y-m-d H:i:s'
            ]
        ]));
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            "name",
            new Uniqueness(
                [
                    "message" => "The name must be unique",
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'project';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Project[]|Project
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Project
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
