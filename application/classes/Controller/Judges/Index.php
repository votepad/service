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
        $this->template->mainSection = View::factory('judgepanel/panels/panel1');
    }

    
}
