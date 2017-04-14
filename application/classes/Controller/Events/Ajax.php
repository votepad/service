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

        $this->redis->sRem('votepad.events:' . $eventId . ':assistants.requests', $userId);


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

        $info = Model_Event::getByFieldName('uri', $uri);

        if (empty($info)) {
            echo "false";
        } else {
            echo "true";
        }

    }

}
