<?php

/**
 * Class Controller_Judges_Index
 */
class Controller_Judges_Index extends Dispatch {
    public $template = 'judgepanel/main';

    /**
     * Function that calls before main action
     */
    public function before()
    {
        parent::before();
    }


     /**
     * action_votingpanel - panel for judges where they are scoring
     */
    public function action_votingpanel()
    {

        $id = $this->request->param('id');
        $judge = new Model_Judge($id);

        $event = new Model_Event($judge->event);

        $contests = Methods_Contests::getByJudge($judge->id);

        foreach ($contests as $key => $contest) {
            $contests[$key]->stages = Methods_Contests::getStages($contest->formula);

            foreach ($contest->stages as $key2 => $stage) {
                $contests[$key]->stages[$key2]->members = Methods_Stages::getMembers($stage->id, $stage->mode);
                $contests[$key]->stages[$key2]->criterions = Methods_Stages::getCriterions($stage->formula);
            }

        }

        $event->contests = $contests;


        $this->template->judge = $judge;
        $this->template->event = $event;
        $this->template->mainSection = View::factory('judgepanel/panels/panel1')
            ->set('event', $event)
            ->set('judge', $judge);

    }

    
}
