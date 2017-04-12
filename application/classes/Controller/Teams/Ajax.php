<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Teams_Ajax extends Ajax {

    public function action_delete()
    {
        $id_team = $this->request->param('id_team', 0);

        $team = new Model_Team($id_team);

        Methods_Teams::removeParticipants($team->id);
        $team->delete();

        $this->response->body("true");
    }

}