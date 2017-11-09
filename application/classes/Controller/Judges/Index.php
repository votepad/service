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

        $api = Kohana::$config->load('api');

        $token = array_keys(get_object_vars($api))[0];

        $id = $this->session->get('id');

        if (!$id) {
            throw new HTTP_Exception_401;
        }

        $cur_contest = $this->request->query('contest');

        $judge    = new Model_Judge($id);
        $contests = Methods_Contests::getByJudge($judge->id);

        /**
         * If Contests does not exist for judge => error 404
         */
        if (count($contests) == 0) {
            throw new HTTP_Exception_404;
        }

        foreach ($contests as $contestKey => $contest) {

            $contests[$contestKey]->result_coeff = Methods_Results::getResultCoeff($contest);
            $contests[$contestKey]->stages = Methods_Contests::getStages($contest->formula);

            /**
             * Select first contest and first stage if not selected
             */
            if ($cur_contest == NULL ) {
                $this->redirect('/voting?contest=' . $contests[0]->id . '#' . Methods_Methods::getUriByTitle($contests[0]->stages[0]->name));
            }

            if ($contest->id == $cur_contest) {
                $cur_contest = array(
                    'index' => $contestKey,
                    'id'    => $contest->id
                );
            }

        }

        if (empty($cur_contest['id'])) {
            throw new HTTP_Exception_403;
        }

        $stages_hashes = array();

        foreach ($contests[$cur_contest['index']]->stages as $stageKey => $stage) {
            $hash = Methods_Methods::getUriByTitle($stage->name);
            array_push($stages_hashes, $hash);

            $contests[$cur_contest['index']]->stages[$stageKey]->hash       = $hash;
            $contests[$cur_contest['index']]->stages[$stageKey]->members    = Methods_Stages::getMembers($stage->id, $stage->mode);
            $contests[$cur_contest['index']]->stages[$stageKey]->criterions = Methods_Criterions::getCriterions($stage->formula);
            $contests[$cur_contest['index']]->judges                        = count(Methods_Contests::getJudges($cur_contest['id']));
        }

        $event = new Model_Event($judge->event);

        $event->contests      = $contests;
        $event->cur_contest   = $cur_contest;
        $event->stages_hashes = json_encode($stages_hashes);

        $scores = Request::factory('/access_token/' . $token . '/method/getResults?')
            ->query('id_event', $event->id)
            ->query('criterions', true)
            ->query('judges', true)
            ->method(Request::GET)
            ->execute()->body();

        $scores = json_decode($scores, true);
        $scores = $scores['data'];
        $event->scores = $scores;

        $this->template->judge = $judge;
        $this->template->event = $event;
    }

    
}
