<?php defined('SYSPATH') or die('No direct script access.');
/**
 * User: Murod's Macbook Pro
 * @author Pronwe Team
 * @copyright Khaydarov Murod
 */

class Model_Events extends Model
{


    /**
     * @var $id [INT] - Events identifier
     */
    public $id;

    /**
     * @var $name [String] - Events Name
     */
    public $name;

    /**
     * @var $page [String] - Events Landing page
     */
    public $page;

    /**
     * @var $short_description [Text] - About event
     */
    public $short_description;

    /**
     * @var $full_description [Text] - For landing page
     */
    public $full_description;

    /**
     * @var $start_time [Date] - Beggining time
     */
    public $start_time;

    /**
     * @var $end_time [Date] - The time of finish
     */
    public $end_time;

    /**
     * @var $status [Bool] - Status - Published or not
     */
    public $status;

    /**
     * @var $city [String]
     */
    public $address;


    /**
     * Saves or Updates event
     *
     * @param null $id
     * @return mixed
     */
    public function save($id = null)
    {
        $event = new ORM_Events();

        if (isset($id)) {
            $event->where('id', '=', $id)
                ->find();

        } else {

            $event->dt_created = Date::formatted_time('now');

        }

        $event->name              = $event->name ?: $this->name;
        $event->page              = $event->page ?: $this->page;
        $event->short_description = $event->short_description ?: $this->short_description;
        $event->full_description  = $event->full_description ?: $this->full_description;
        $event->keywords          = $event->keywords ?: $this->keywords;
        $event->start_time        = $event->start_time ?: $this->start_time;
        $event->end_time          = $event->end_time ?: $this->end_time;
        $event->address           = $event->address ?: $this->address;
        $event->save();

        $this->id = $event->id;

        return $this;
    }

    /**
     * Gets event information
     * @param $id
     * @return Model_Events object
     */
    public static function get($id)
    {

        $event = new ORM_Events();

        $event
            ->where('id', '=', $id)
            ->find();

        if ($event->loaded()) {

            $result = new Model_Events();

            $result->id                 = $event->id;
            $result->name               = $event->name;
            $result->short_description  = $event->short_description;
            $result->full_description   = $event->full_description;
            $result->keywords           = $event->keywords;
            $result->address            = $event->address;
            $result->start_time         = $event->start_time;
            $result->end_time           = $event->end_time;

            return $result;
        } else {
            return false;
        }
    }


    /**
     * @public
     *
     * For simple requests, like to get basic information.
     *
     * @param $field
     * @param $value
     */
    public static function getByFieldName($field, $value)
    {
        $event = new ORM_Events();

        $event->where($field, '=', $value)
                ->find();

        if ($event->loaded())
        {
            $result = new Model_Events();

            $result->id                 = $event->id;
            $result->name               = $event->name;
            $result->page               = $event->page;
            $result->short_description  = $event->short_description;
            $result->keywords           = $event->keywords;
            $result->address            = $event->address;
            $result->start_time         = $event->start_time;
            $result->end_time           = $event->end_time;

            return $result;
        } else {
            return false;
        }
    }


    /**
     * @public
     *
     * connect event and organization
     *
     * @param $id_organization
     * @param $id_event
     * @return bool|object
     * @throws Kohana_Exception
     */
    public function addToOrganization($id_organization, $id_event) {

        $insert = DB::insert('Organization_Events', array('id_organization', 'id_event'))
                        ->values(array($id_organization, $id_event))
                        ->execute();

        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }
}
