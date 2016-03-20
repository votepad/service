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
}