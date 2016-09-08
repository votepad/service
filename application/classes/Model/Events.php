<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 16.03.2016
 * Time: 22:29
 */

class Model_Events extends Model {

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

    public static function get_organization_events($id)
    {
        $select = DB::select()->from('Events')
                        ->where('id_organization', '=', $id)
                        ->execute()
                        ->as_array();

        return $select;
    }
}