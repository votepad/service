<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Events_Modify
 * @author
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

            $event_name         = Arr::get($_POST, 'event_name', '');
            $event_site         = Arr::get($_POST, 'event_site', '');
            $event_description  = Arr::get($_POST, 'event_desc', '');
            $event_keywords     = Arr::get($_POST, 'event_keywords', '');
            $event_start        = Arr::get($_POST, 'datestart', '');
            $event_end          = Arr::get($_POST, 'dateend', '');
            $event_address      = Arr::get($_POST, 'address', '');
            $id_organization = Arr::get($_POST, 'id_organization', '');

            $event = new Model_Events();

            $event->name              = $event_name;
            $event->page              = $event_site;
            $event->short_description = $event_description;
            $event->full_description  = '';
            $event->keywords          = $event_keywords;
            $event->start_time        = $event_start;
            $event->end_time          = $event_end;
            $event->address           = $event_address;

            $result = $event->save();

            $event->addToOrganization($id_organization, $event->id);

            $this->request->redirect('event/' . $event->name);

        } else {

            throw new HTTP_Exception_404();
        }
    }

    public function action_addFullDescription()
    {
        if ($this->request->method() == Request::POST && Ajax::is_ajax()) {

            $full_description = Arr::get($_POST, 'text');
            $id_event = Arr::get($_POST, 'id');
        }
    }

}