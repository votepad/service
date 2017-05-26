<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 */

class Controller_Events_Ajax extends Ajax {


    private $event = null;

    public function action_assistant() {

        $method  = $this->request->param('method');
        $eventId = $this->request->param('id');
        $userId  = $this->request->param('userId');

        $user = new Model_User($userId);
        $event  = new Model_Event($eventId);

        $this->redis->sRem('votepad.orgs:' . $event->organization . ':events:' . $event->id . ':assistants.requests', $user->id);

        if (!$user->id) {

            $response = new Model_Response_Auth('USER_DOES_NOT_EXIST_ERROR', 'error');

            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        if (!$event->id) {

            $response = new Model_Response_Event('EVENT_DOES_NOT_EXIST_ERROR', 'error');

            $this->response->body(@json_encode($response->get_response()));
            return;

        }


        switch($method) {
            case 'add': $this->add_assistant($event, $user); break;
            case 'remove': $this->remove_assistant($event, $user); break;
            case 'reject': $this->reject_assistant(); break;
        }


    }

    private function add_assistant($event, $user) {

        if ($event->isAssistant($user->id)) {

            $response = new Model_Response_Event('USER_IS_ALREADY_ASSISTANT_ERROR', 'error');

            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        $event->addAssistant($user->id);

        $response = new Model_Response_Event('ADD_ASSISTANT_SUCCESS', 'success');

        $this->response->body(@json_encode($response->get_response()));
        return;

    }

    private function remove_assistant($event, $user) {

        if ($event->isCreator($user->id)) {

            $response = new Model_Response_Event('USER_IS_CREATOR_ERROR', 'error');

            $this->response->body(@json_encode($response->get_response()));
            return;

        }

//        if (!$event->isAssistant($user->id)) {
//
//            $response = new Model_Response_Event('USER_IS_NOT_ASSISTANT_ERROR', 'error');
//
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//
//        }

        $event->removeAssistant($user->id);

        $response = new Model_Response_Event('REMOVE_ASSISTANT_SUCCESS', 'success');

        $this->response->body(@json_encode($response->get_response()));
        return;

    }

    private function reject_assistant() {

        $response = new Model_Response_Event('REJECT_ASSISTANT_SUCCESS', 'success');

        $this->response->body(@json_encode($response->get_response()));
        return;

    }

    public function action_checkwebsite()
    {
        $uri = $this->request->param('website');

        $result = Model_Event::getByFieldName('uri', $uri);

        if (Arr::get($result,'id')) {
            echo "true";
        } else {
            echo "false";
        }

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
