<?php


class Controller_Judges_Settings_Modify extends Controller {

    public function action_blockParticipants()
    {
        $id_event   = Arr::get($_POST, 'id_event');
        $stage      = Arr::get($_POST, 'stage');
        $score      = Arr::get($_POST, 'score');
        $id         = Arr::get($_POST, 'id');

        for($i = 0; $i < count($id); $i++)
        {
            Model_Participants::block($id[$i], $stage, $id_event);
        }

        $this->redirect('events/'. $id_event. '/eventmaker');
    }

    public function action_addExtraScore()
    {
        $id_event   = Arr::get($_POST, 'id_event');
        $stage      = Arr::get($_POST, 'stage');
        $score      = Arr::get($_POST, 'score');
        $id         = Arr::get($_POST, 'id');

        for($i = 0; $i < count($id); $i++)
        {
            /**
             * @params score, when id_judge equals to 0 -> admin
             */

            Model_Score::set($id_event, $id[$i], $stage, '0', $score);
        }

        $this->redirect('events/'. $id_event. '/eventmaker');
    }
            
}