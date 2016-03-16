<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 13.03.2016
 * Time: 13:01
 */

class Controller_Events_Modify extends Controller {

    function action_add()
    {
        $data['title']          = Arr::get($_POST, 'input-event-name');
        $data['description']    = Arr::get($_POST, 'input-event-description');
        $data['event_status']   = Arr::get($_POST, 'input-event-status');
        //$data['organizations']  = Arr::get($_POST, 'input-event-organization');
        $data['event_start']    = Arr::get($_POST, 'input-event-start');
        $data['event_finish']   = Arr::get($_POST, 'input-event-end');
        $data['event_city']     = Arr::get($_POST, 'input-event-city');
        $data['event_type']     = Arr::get($_POST, 'input-event-type');

        $model_events = new Model_Events();
        $model_events->NewEvent($data);
        $result = $model_events->save();

        if ($result)
            $this->redirect('/events');

    }
}