<?php

/**
 * Class Controller_Judges_Index
 */
class Controller_Judges_Index extends Dispatch {

    public $template = 'voting-panel/main';

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

        $id = $this->session->get('j_id');
        $judge = new Model_Judge($id);

        $event = new Model_Event($judge->event);

        $contests    = Methods_Contests::getByJudge($judge->id);
        $contestsIds = Methods_Contests::getByJudge($judge->id, true);

        /**
         * TODO проверка контеста открыт ли он (если ни один из контестов не открыт, то $openedContest = null)
         */
        $openedContest = $contests[0];// null;

        if ($openedContest != null) {

            /**
             * Get Info by opened contest
             */
            $openedContest->stages = Methods_Contests::getStages($openedContest->formula);

            foreach ($openedContest->stages as $stageKey => $stage) {
                $openedContest->stages[$stageKey]->members = Methods_Stages::getMembers($stage->id, $stage->mode);
                $openedContest->stages[$stageKey]->criterions = Methods_Stages::getCriterions($stage->formula);
            }

        }

        $event->contestsIds = $contestsIds;
        $event->openedContest = $openedContest;

        $this->template->judge = $judge;
        $this->template->event = $event;

    }

    
}
