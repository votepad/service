<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 16.03.2016
 * Time: 22:29
 */

class Model_Events extends Model {

    public $event;

    function NewEvent($data)
    {
        $this->event = $data;
    }

    function save()
    {
        $insert = DB::insert('Events', array(
            'title', 'description', 'event_status', 'start_datetime', 'finish_datetime', 'city', 'type', 'photo'
        ))->values($this->event)->execute();

        return $insert;
    }

    public static function EventExist($id)
    {
        $select = DB::select('id')->from('Events')->where('id', '=', $id)->execute()->as_array();
        return count($select) ?: 0;
    }

    public static function delete($id)
    {
        $delete = DB::delete('Events')->where('id', '=', $id)->execute();
        return $delete;
    }

    private static function get($id = null)
    {
        $select = DB::select()->from('Events')->where('id', '=', $id)->execute();
        return Arr::get($select, '0');
    }

    private static function getAll()
    {
        $select = DB::select()->from('Events')->execute()->as_array();
        return $select;
    }

    public function getEvent($id)
    {
        return self::get($id);
    }

    public function getEvents()
    {
        return self::getAll();
    }

    public static function updateEventByFieldName($field, $value, $id)
    {
        $update = DB::update('Events')->set(array(
            $field  => $value
        ))->where('id', '=', $id)->execute();

        return $update;
    }

    public static function EventsType($id_event) {
        $select = DB::select('type')->from('Events')->where('id', '=', $id_event)->limit(1)->execute()->as_array();
        return Arr::get($select, '0')['type'];
    }

    public function getCities()
    {
        $select = DB::select()->from('Cities')->execute()->as_array();
        return $select;
    }
}