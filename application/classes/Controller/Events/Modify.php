<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Events_Modify
 * @author Votepad Team
 * @copyright
 */

class Controller_Events_Modify extends Dispatch
{

    public function before() {

        $this->auto_render = false;

        parent::before();

    }

    /**
     * Action for creating new event
     */
    public function action_add()
    {

        if ($this->request->method() != Request::POST) {

            throw new HTTP_Exception_403();

        }

        $name              = Arr::get($_POST, 'name', '');
        $uri                = Arr::get($_POST, 'site', '');
        $description        = Arr::get($_POST, 'desc', '');
        $keywords           = Arr::get($_POST, 'keywords', '');
        $start              = Arr::get($_POST, 'start', '');
        $end                = Arr::get($_POST, 'end', '');
        $address            = Arr::get($_POST, 'address', '');
        $id_organization    = Arr::get($_POST, 'id_organization', '');

        $event = new Model_Event();

        $event->name         = $name;
        $event->creator      = $this->user->id;
        $event->uri          = $uri;
        $event->description  = $description;
        $event->tags         = json_encode($keywords);
        $event->dt_start     = $start;
        $event->dt_end       = $end;
        $event->address      = $address;
        $event->organization = $id_organization;

        $event = $event->save();

        $event->addAssistant($this->user->id);

        $this->redirect('event/' . $event->id . '/settings');

    }

    public function action_update() {

        if ($this->request->method() != Request::POST) {

            throw new HTTP_Exception_403();

        }

        $id = $this->request->param('id');

        $name               = Arr::get($_POST, 'name', '');
        $uri                = Arr::get($_POST, 'site', '');
        $description        = Arr::get($_POST, 'desc', '');
        $keywords           = Arr::get($_POST, 'keywords', '');
        $start              = Arr::get($_POST, 'start', '');
        $end                = Arr::get($_POST, 'end', '');
        $address            = Arr::get($_POST, 'address', '');

        $event = new Model_Event($id);

        $event->name         = $name;
        $event->uri          = $uri;
        $event->description  = $description;
        $event->tags         = json_encode($keywords);
        $event->dt_start     = $start;
        $event->dt_end       = $end;
        $event->address      = $address;

        $event = $event->update();

        $this->redirect('event/' . $event->id . '/settings/info');

    }

    public function action_assistant_request() {

        $id    = $this->request->param('id');
        $event = new Model_Event($id);
        $org   = new Model_Organization($event->organization);

        if ($this->request->url() != $event->getInviteLink()) {
            throw new HTTP_Exception_403();
        };

        if (empty($this->user)) {
            echo 'Authorization required';
            exit;
        }

        if (!$event->isAssistant($this->user->id) && !$org->isMember($this->user->id)) {
            $this->redis->sAdd('votepad.orgs:' . $event->organization . ':events:' . $event->id . ':assistants.requests', $this->user->id);
        }

        if ($org->isMember($this->user->id)) {
            $event->addAssistant($this->user->id);
        }

       $this->redirect('/event/' . $event->id);

    }

}
