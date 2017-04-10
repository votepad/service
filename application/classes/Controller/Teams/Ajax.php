<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Teams_Ajax extends Ajax {

    public function action_delete()
    {
        $id_event = $this->request->param('id_event');
        $id_team  = $this->request->param('id_team');

        if (!$id_event)
            return;

        Methods_Teams::removeTeam($id_team);
        Methods_Teams::removeParticipantFromTeam($id_team);
        $this->response->body("true");
    }

}