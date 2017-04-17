<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contests_Ajax extends Ajax {

    public function action_delete()
    {
        $id = $this->request->param('id_contest', 0);

        $contest = new Model_Contest($id);

        Methods_Contests::removeDependencies($contest->id);
        $contest->delete();

        $this->response->body("true");
    }

}