<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Results_Modify extends Dispatch
{

    public function before() {
        $this->auto_render=false;
        parent::before();
        $this->checkCsrf();
    }

    public function action_save()
    {


        $event = $this->request->param('id_event', 0);

        $result = new Model_Result(Arr::get($_POST, 'result_id'));

        $result->formula = Arr::get($_POST, 'formula', $result->formula);

        if ($result->id) {
            $result->update();
        } else {
            $result->event = $event;
            $result->save();
        }

        $this->redirect($this->request->referrer());

    }


}