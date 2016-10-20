<?php defined('SYSPATH') or die('No direct script access.');
/**
 * User: Murod's Macbook Pro
 * @author Pronwe Team
 * @copyright Khaydarov Murod
 */

class Model_Events extends Model {


    /**
     * Creates new Event
     * @uses Kohana ORM
     * @param $id_organization
     * @param $name
     * @param $page
     * @param $description
     * @param $start_time
     * @param $end_time
     * @param $status
     * @param $city
     * @return Events identificator
     */
    public static function new_event($id_organization, $name, $page, $description,
                        $start_time, $end_time, $status, $city)
    {
        $event = new ORM_Events();

        $event->id_organization     = $id_organization;
        $event->name                = $name;
        $event->event_page          = $page;
        $event->short_description   = $description;
        $event->start_time          = $start_time;
        $event->end_time            = $end_time;
        $event->event_status        = $status;
        $event->event_city          = $city;
        $event->dt_create           = Date::formatted_time('now');

        $event->save();

        return $event->id;
    }

    /**
     * Gets event information
     * @param $id
     * @return ORM_Events object
     * @throws Kohana_Exception
     */
    public static function get($id)
    {

        $event = new ORM_Events();

        $event
            ->where('id', '=', $id)
            ->find();

        if ($event->loaded()) {
            return $event;
        }
    }

    /**
     * Updates field
     * @param $id
     * @param $field
     * @param $value
     */
    public static function updateField($id, $field, $value)
    {
        $target = self::get($id);

        $target->$field = $value;
        $target->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getOrganizationEvents($id)
    {
        $select = DB::select()->from('Events')
                        ->where('id_organization', '=', $id)
                        ->execute()
                        ->as_array();

        return $select;
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function getEventByName($name)
    {
        $event = DB::select()->from('Events')
                            ->where('name', '=', $name)
                            ->limit(1)
                            ->execute()
                            ->as_array();

        return Arr::get($event, '0');
    }
}