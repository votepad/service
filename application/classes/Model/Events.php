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
            'title', 'description', 'event_status', 'start_time', 'finish_time', 'city', 'type'
        ))->values($this->event)->execute();

        return $insert;
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
}