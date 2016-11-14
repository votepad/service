<?php

/**
 * Class Controller_Events_Index
 * @author Khaydarov Murod
 */

class Controller_Events_Index extends Dispatch
{

    /**
     * @const ACTION_NEW [String] - for creating a new event
     */
    const ACTION_NEW        = 'New';

    /**
     * @const ACTION_SHOW_ALL [String] - Show all action
     */
    const ACTION_SHOW_ALL   = 'showAll';

    /**
     * @const ACTION_SHOW [String] - action that shows an event
     */
    const ACTION_SHOW       = 'show';

    /**
     * @const ACTION_CHARACTERS [String] - for Judge, Participant, Group, Team creation
     */
    const ACTION_CHARACTERS = 'characters';

    /**
     * @const ACTION_CONTEST [String] - contest handler
     */
    const ACTION_CONTESTS   = 'contests';

    /**
     * @const ACTION_SCORING [String] - Scoring system
     */
    const ACTION_SCORTING   = 'scoring';

    /**
     * @const ACTION_PUBLISH [String] - Publication
     */
    const ACTION_PUBLISH    = 'publish';

    /**
     * Before action
     */
    public function before()
    {
        switch ($this->request->action()) {

            /**
             * Creating a new event
             */
            case self::ACTION_NEW :
                $this->template = 'events/new';
                break;

            /**
             *
             */
            case self::ACTION_SHOW_ALL :
                $this->template = 'events/all';
                break;

            /**
             * Event information and summernote redactor
             */
            case self::ACTION_SHOW :
                $this->template = 'events/settings/about';
                break;

            /**
             * Creating contests and stages
             */
            case self::ACTION_CONTESTS :
                $this->template = 'events/settings/contests';
                break;

            /**
             * Creating characters of events
             */
            case self::ACTION_CHARACTERS :
                $this->template = 'events/settings/characters';
                break;

            /**
             * Event publishment
             */
            case self::ACTION_PUBLISH :
                $this->template = 'events/settings/publish';
                break;

            /**
             * Scoring system
             */
            case self::ACTION_SCORTING :
                $this->template = 'events/settings/scoring';
                break;
            /**
             * Default template for this controller
             */
            default :
                $this->template = 'main';
                break;
        }

        parent::before();
    }

    public function action_new()
    {
        $param = $this->request->param('organization');

        $organization = Model_Organizations::getByFieldName('website', $param);
        $team         = Model_Organizations::team($organization->id);

        $this->template->organization = $organization;
        $this->template->team         = $team;
    }

    public function action_show()
    {
    }

    public function action_characters()
    {

    }

    public function action_contests()
    {

    }

    public function action_scoring()
    {

    }

    public function action_publish()
    {

    }

    public function action_showAll()
    {
    }
}
