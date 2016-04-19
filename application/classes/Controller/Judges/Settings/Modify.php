<?php


class Controller_Judges_Settings_Modify extends Controller {

    public function action_blockParticipants()
    {
        $stage  = Arr::get($_POST, 'stage');
        $score  = Arr::get($_POST, 'score');
        $id     = Arr::get($_POST, 'id');

        for($i = 0; $i < count($id); $i++)
        {
            Model_Participants::block($id[$i], $stage);
        }
        exit;
    }

}