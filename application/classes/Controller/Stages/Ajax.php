<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Stages_Ajax extends Ajax {

    public function action_delete()
    {
        $id = $this->request->param('id_stage', 0);

        $stage = new Model_Stage($id);

        Methods_Stages::removeDependencies($stage->id);
        $stage->delete();

        $this->response->body("true");
    }

}