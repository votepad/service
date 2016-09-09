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
     * @var $organization
     */
    protected $organization;

    /**
     * @var $event_name
     */
    protected $event_name;

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
             * This method allows to work with this controller as a module
             * another module can get an information about event by making a internal request
             * @return rendered HTML
             */
            case self::ACTION_SHOW_ALL :

                if (parent::isLogged())
                    $this->template = 'events/all';
                else
                    $this->template = 'events/all_not_logged';

                break;

            /**
             * Event information and summernote redactor
             */
            case self::ACTION_SHOW :

                $this->template = 'events/about';
                break;

            /**
             * Creating contests and stages
             */
            case self::ACTION_CONTESTS :

                $this->template = 'events/contests';
                break;

            /**
             * Creating characters of events
             */
            case self::ACTION_CHARACTERS :

                $this->template = 'events/characters';
                break;

            /**
             * Event publishment
             */
            case self::ACTION_PUBLISH :

                $this->template = 'events/publish';
                break;

            /**
             * Scoring system
             */
            case self::ACTION_SCORTING :

                $this->template = 'events/scoring';
                break;
            /**
             * Default template for this controller
             */
            default :
                $this->template = 'main';
                break;
        }

        parent::before();

        $this->organization = $this->request->param('organization');

        $this->event_name   = $this->request->param('eventname');

        
        /**
         * Getting information about event
         */

        $event = Model_Events::getEventByName($this->event_name);

        /**
         * Getting information about organization
         */

        $organization = Model_Organizations::get($event['id_organization']);

        /**
         * Getting information about user
         */

        /**
         * Connecting jumbotron
         */
        $this->template->event_jumbo = View::factory('events/jumbotron')
                                                ->set('organization', $organization)
                                                ->set('event', $event);


    }

    public function action_new()
    {
        $this->template->organization = $this->organization;
    }

    public function action_show()
    {

    }

    public function action_showAll()
    {
        $post_data = $this->request->post();

        $id_organization = Arr::get($post_data, 'id_organization');
        $organization = Model_Organizations::get($id_organization);

        $this->template->organization = $organization;

        /**
         * Getting all events of organization with id - $id_organization
         */

        $events = Model_Events::getOrganizationEvents($id_organization);
        $this->template->events = $events;
        
    }
}