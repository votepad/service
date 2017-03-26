<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Events_Modify
 * @author Votepad Team
 * @copyright
 */

class Controller_Events_Modify extends Controller
{

    /**
     * Action for creating new event
     */
    public function action_add()
    {
        if ($this->request->method() == Request::POST) {

            $title              = Arr::get($_POST, 'name', '');
            $uri                = Arr::get($_POST, 'site', '');
            $description        = Arr::get($_POST, 'desc', '');
            $keywords           = Arr::get($_POST, 'keywords', '');
            $start              = Arr::get($_POST, 'start', '');
            $end                = Arr::get($_POST, 'end', '');
            $address            = Arr::get($_POST, 'address', '');
            $id_organization    = Arr::get($_POST, 'id_organization', '');

            $event = new Model_Event();

            $event->title        = $title;
            $event->uri          = $uri;
            $event->description  = $description;
            $event->tags         = $keywords;
            $event->dt_start     = $start;
            $event->dt_end       = $end;
            $event->address      = $address;
            $event->organization = $id_organization;

            $event = $event->save();

            $this->redirect('event/' . $event->id . '/settings');

        } else {
            throw new HTTP_Exception_404();
        }
    }


}
