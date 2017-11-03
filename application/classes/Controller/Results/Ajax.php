<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Results_Ajax extends Ajax
{

    public function action_update()
    {
        $id      = Arr::get($_POST, 'id');
        $event   = Arr::get($_POST, 'event');
        $type    = Arr::get($_POST, 'type');
        $formula = Arr::get($_POST, 'formula', '[]');

        $result = new Model_Result($id);

        if ($result->id && $result->event != $event) {
            $response = new Model_Response_Result('RESULT_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $result->event   = $event;
        $result->mode    = $type;
        $result->formula = $formula;

        if ($formula !== '[]') {
            $formula = Methods_Contests::getJSONbyFormula($result->formula);
        }

        if (!$result->id) {
            $result = $result->save();
            $response = new Model_Response_Result('RESULT_CREATE_SUCCESS', 'success', array('formula' => $formula, 'id' => $result->id));
        } else {
            $result->update();
            $response = new Model_Response_Result('RESULT_UPDATE_SUCCESS', 'success', array('formula' => $formula));
        }

        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_publish()
    {
        $event   = Arr::get($_POST, 'event');
        $publish = Arr::get($_POST, 'publish');
        $result  = Arr::get($_POST, 'result');

        $result = new Model_Result($result);

        if (!$result->id) {
            $response = new Model_Response_Result('RESULT_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($result->event != $event) {
            $response = new Model_Response_Result('RESULT_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $publish_results = $this->redis->sMembers(getenv('REDIS_EVENTS') . $event . ':publish:results');
        $is_publish = in_array($result->id, $publish_results) ? "true" : "false";

        if ($is_publish == $publish) {
            switch ($publish) {
                case "true":
                    $this->redis->sRem(getenv('REDIS_EVENTS') . $event . ':publish:results', $result->id);
                    $response = new Model_Response_Result('RESULT_UN_PUBLISH_SUCCESS', 'success');
                    break;
                case "false":
                    $this->redis->sAdd(getenv('REDIS_EVENTS') . $event . ':publish:results', $result->id);
                    $response = new Model_Response_Result('RESULT_PUBLISH_SUCCESS', 'success');
                    break;
            }
        } else {
            $response = new Model_Response_Result('RESULT_PUBLISH_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }

}