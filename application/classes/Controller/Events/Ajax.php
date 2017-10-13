<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Controller_Events_Ajax
 *
 * @copyright Votepad Team
 * @version 0.2.0
 */

class Controller_Events_Ajax extends Ajax {

    /**
     * Create New Event
     */
    public function action_create() {
        $name        = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $tags        = Arr::get($_POST, 'tags');
        $start       = Arr::get($_POST, 'start');
        $end         = Arr::get($_POST, 'end');
        $address     = Arr::get($_POST, 'address');

        $event = new Model_Event();

        $event->name         = $name;
        $event->type         = 0;   // draft
        $event->creator      = $this->user->id;
        $event->description  = $description;
        $event->tags         = $tags;
        $event->dt_start     = $start;
        $event->dt_end       = $end;
        $event->address      = $address;

        $event = $event->save();

        $event->addAssistant($this->user->id);

        $response = new Model_Response_Event('EVENT_CREATE_SUCCESS', 'success', array('id' => $event->id));
        $this->response->body(@json_encode($response->get_response()));
    }


    /**
     * Assistant actions
     * - based on method
     */
    public function action_assistant() {

        $method  = Arr::get($_POST,'method');
        $eventId = Arr::get($_POST,'event');
        $userId  = Arr::get($_POST,'id');

        $user = new Model_User($userId);

        if (!$user->id) {
            $response = new Model_Response_User('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $event  = new Model_Event($eventId);

        if (!$event->id) {
            $response = new Model_Response_Event('EVENT_DOES_NOT_EXIST_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $this->redis->sRem(getenv('REDIS_EVENTS') . $event->id . ':assistants.requests', $user->id);

        switch($method) {
            case 'add': $this->add_assistant($event, $user); break;
            case 'remove': $this->remove_assistant($event, $user); break;
            case 'reject': $this->reject_assistant(); break;
        }


    }


    /**
     * Add assistant
     * @param $event - [Model_Event]
     * @param $user - [Model_User]
     */
    private function add_assistant($event, $user) {

        if ($event->isAssistant($user->id)) {
            $response = new Model_Response_Event('USER_IS_ALREADY_ASSISTANT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $event->addAssistant($user->id);

        $response = new Model_Response_Event('ADD_ASSISTANT_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


    /**
     * Reject assistant
     */
    private function reject_assistant() {

        $response = new Model_Response_Event('REJECT_ASSISTANT_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * Remove assistant
     * @param $event - [Model_Event]
     * @param $user - [Model_User]
     */
    private function remove_assistant($event, $user) {

        if ($event->isCreator($user->id)) {
            $response = new Model_Response_Event('USER_IS_CREATOR_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $event->removeAssistant($user->id);

        $response = new Model_Response_Event('REMOVE_ASSISTANT_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }



    public function action_result()
    {
        $method  = $this->request->param('method');
        $contest = Arr::get($_POST, 'contest');
        $stage   = Arr::get($_POST, 'stage');
        $event   = Arr::get($_POST, 'event');
        $organization   = Arr::get($_POST, 'organization');
        $unique = $contest . '-' . $stage;

        switch ($method) {
            case 'publish': $this->publish_result($unique, $event, $organization); break;
            case 'unpublish': $this->unpublish_result($unique, $event, $organization); break;
        }

    }

    private function publish_result($unique, $event, $organization)
    {
        $this->redis->sAdd('votepad.orgs:' . $organization . ':events:' . $event . ':result.publish', $unique);

        $response = new Model_Response_Event('PUBLISH_RESULTS_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    private function unpublish_result($unique, $event, $organization)
    {
        $this->redis->sRem('votepad.orgs:' . $organization . ':events:' . $event . ':result.publish', $unique);

        $response = new Model_Response_Event('UNPUBLISH_RESULTS_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

}
