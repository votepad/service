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

}