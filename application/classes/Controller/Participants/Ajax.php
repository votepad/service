<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Participants_Ajax extends Ajax
{

    public function action_create() {
        $event = Arr::get($_POST, 'event');
        $name  = Arr::get($_POST, 'name');
        $about = Arr::get($_POST, 'about');

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Methods_Participants::getByEventAndName($event, $name)->id) {
            $response = new Model_Response_Participant('PARTICIPANT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $participant = new Model_Participant();

        $participant->name  = $name;
        $participant->event = $event;
        $participant->about = $about;
        $participant = $participant->save();

        $response = new Model_Response_Participant('PARTICIPANT_CREATE_SUCCESS', 'success', array('participant' => $participant));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update() {
        $id     = Arr::get($_POST, 'id');
        $event  = Arr::get($_POST, 'event');
        $name   = Arr::get($_POST, 'name');
        $about  = Arr::get($_POST, 'about');

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $participant = new Model_Participant($id);

        if (!$participant->id) {
            $response = new Model_Response_Participant('PARTICIPANT_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($participant->event != $event) {
            $response = new Model_Response_Participant('PARTICIPANT_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($participant->name == $name && $participant->about == $about) {
            $response = new Model_Response_Form('NOTHING_CHANGE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($participant->name != $name && Methods_Participants::getByEventAndName($event, $name)->id) {
            $response = new Model_Response_Participant('PARTICIPANT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $participant->name  = $name;
        $participant->about = $about;
        $participant = $participant->update();

        $response = new Model_Response_Participant('PARTICIPANT_UPDATE_SUCCESS', 'success', array('participant' => $participant));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_delete() {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');

        $participant = new Model_Participant($id);

        if (!$participant->id) {
            $response = new Model_Response_Participant('PARTICIPANT_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($participant->event != $event) {
            $response = new Model_Response_Participant('PARTICIPANT_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $participant->delete();

        $response = new Model_Response_Participant('PARTICIPANT_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

}
