<?php
namespace PhalconTime\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use DateTime;

class TimeRegistration extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $project_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $time_type_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $start_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $end_time;

    /**
     *
     * @var double
     * @Column(type="double", nullable=true)
     */
    protected $total_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $description;

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
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field project_id
     *
     * @param integer $project_id
     * @return $this
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;

        return $this;
    }

    /**
     * Method to set the value of field time_type_id
     *
     * @param integer $time_type_id
     * @return $this
     */
    public function setTimeTypeId($time_type_id)
    {
        $this->time_type_id = $time_type_id;

        return $this;
    }

    /**
     * Method to set the value of field start_time
     *
     * @param string $start_time
     * @return $this
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * Method to set the value of field end_time
     *
     * @param string $end_time
     * @return $this
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;

        return $this;
    }

    /**
     * Method to set the value of field total_time
     *
     * @param double $total_time
     * @return $this
     */
    public function setTotalTime($total_time)
    {
        $this->total_time = $total_time;

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
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field project_id
     *
     * @return integer
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Returns the value of field time_type_id
     *
     * @return integer
     */
    public function getTimeTypeId()
    {
        return $this->time_type_id;
    }

    /**
     * Returns the value of field start_time
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Returns the value of field end_time
     *
     * @return string
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * Returns the value of field total_time
     *
     * @return double
     */
    public function getTotalTime()
    {
        return $this->total_time;
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

        $this->belongsTo('time_type_id', __NAMESPACE__ . '\TimeType', 'id', [
            'alias' => 'TimeType'
        ]);

        $this->belongsTo('user_id', __NAMESPACE__ . '\User', 'id', [
            'alias' => 'User'
        ]);

        $this->belongsTo('project_id', __NAMESPACE__ . '\Project', 'id', [
            'alias' => 'Project'
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
     * Returns total time calculated expired between start and end time
     *
     * @return string
     */
    public function beforeSave()
    {
        if($this->start_time && $this->end_time) {

            $start  = new DateTime($this->start_time);
            $end    = new DateTime($this->end_time);
            $interval = $start->diff($end);

            $this->total_time = $interval->format("%H:%I");

        }
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'time_registration';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TimeRegistration[]|TimeRegistration
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TimeRegistration
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
