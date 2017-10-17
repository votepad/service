<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Teams_Ajax extends Ajax {


    public function action_create() {
        $event       = Arr::get($_POST, 'event');
        $name        = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Methods_Teams::getByEventAndName($event, $name)->id) {
            $response = new Model_Response_Team('TEAM_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $team = new Model_Team();

        $team->name  = $name;
        $team->event = $event;
        $team->description = $description;
        $team = $team->save();

        $response = new Model_Response_Team('TEAM_CREATE_SUCCESS', 'success', array('team' => $team));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update() {
        $id           = Arr::get($_POST, 'id');
        $event        = Arr::get($_POST, 'event');
        $name         = Arr::get($_POST, 'name');
        $description  = Arr::get($_POST, 'description');

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $team = new Model_Team($id);

        if (!$team->id) {
            $response = new Model_Response_Team('TEAM_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($team->event != $event) {
            $response = new Model_Response_Team('TEAM_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($team->name == $name && $team->description == $description) {
            $response = new Model_Response_Form('NOTHING_CHANGE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($team->name != $name && Methods_Teams::getByEventAndName($event, $name)->id) {
            $response = new Model_Response_Team('TEAM_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $team->name = $name;
        $team->description = $description;
        $team = $team->update();

        $response = new Model_Response_Team('TEAM_UPDATE_SUCCESS', 'success', array('team' => $team));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_delete() {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');

        $team = new Model_Team($id);

        if (!$team->id) {
            $response = new Model_Response_Team('TEAM_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($team->event != $event) {
            $response = new Model_Response_Team('TEAM_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $team->delete();

        $response = new Model_Response_Team('TEAM_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

}