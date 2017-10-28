<?php

/**
 * Class Controller_Judges_Ajax
 */
class Controller_Judges_Ajax extends Ajax {


    public function action_create() {
        $event    = Arr::get($_POST, 'event');
        $name     = Arr::get($_POST, 'name');
        $password = Arr::get($_POST, 'password');

        if (empty($name) || empty($password)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Methods_Judges::getJudge($event, $password)->id) {
            $response = new Model_Response_Judge('JUDGE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $judge = new Model_Judge();

        $judge->name = $name;
        $judge->event = $event;
        $judge->password = $password;
        $judge = $judge->save();

        $response = new Model_Response_Judge('JUDGE_CREATE_SUCCESS', 'success', array('judge' => $judge));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update() {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');
        $name     = Arr::get($_POST, 'name');
        $password = Arr::get($_POST, 'password');

        if (empty($name) || empty($password)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $judge = new Model_Judge($id);

        if (!$judge->id) {
            $response = new Model_Response_Judge('JUDGE_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($judge->event != $event) {
            $response = new Model_Response_Judge('JUDGE_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($judge->name == $name && $judge->password == $password) {
            $response = new Model_Response_Form('NOTHING_CHANGE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($judge->password != $password && Methods_Judges::getJudge($event, $password)->id) {
            $response = new Model_Response_Judge('JUDGE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $judge->name = $name;
        $judge->password = $password;
        $judge = $judge->update();

        $response = new Model_Response_Judge('JUDGE_UPDATE_SUCCESS', 'success', array('judge' => $judge));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_delete() {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');

        $judge = new Model_Judge($id);

        if (!$judge->id) {
            $response = new Model_Response_Judge('JUDGE_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($judge->event != $event) {
            $response = new Model_Response_Judge('JUDGE_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Methods_Contests::removeJudge($judge->id);
        $judge->delete();

        $response = new Model_Response_Judge('JUDGE_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


}