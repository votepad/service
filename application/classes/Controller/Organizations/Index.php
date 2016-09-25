<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @author Pronwe team
 * @copyright Khaydarov Murod
 */

class Controller_Organizations_Index extends Dispatch
{

    /**
     * @const ACTION_NEW [String]
     */
    const ACTION_NEW = 'new';

    /**
     * @const ACTION_SHOW [String]
     */
    const ACTION_SHOW = 'show';

    /**
     * @const ACTION_SHOW_ALL [String]
     */
    const ACTION_SHOW_ALL = 'showAll';

    /**
     * @var $id_organization [Int]
     */
    protected $id_organization = null;

    /**
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization    = null;

    /**
     * Function that calls before main action
     *
     * - Defines main template of actions
     * - Gets organization info
     * - Caches organization render
     */
    public function before()
    {
        switch ($this->request->action()) {
            /**
             * Two types of creating orgs: Logged and Not logged
             */
            case self::ACTION_NEW :

                if (parent::isLogged()) {
                    $this->template = 'organizations/new_logged';
                } else {
                    $this->template = 'organizations/new_not_logged';
                }
                break;

            /**
             * default template
             */
            default :
                $this->template = 'organizations/main';
                break;
        }

        parent::before();

        /**
         * @var $id - organization identificator
         */
        $this->template->id = $this->id_organization = $this->request->param('id');

        $this->organization = Model_Organizations::get($this->id_organization, 1);

        if (!$this->organization && $this->request->action() != self::ACTION_NEW) {
            echo 'Организация была удалена!';
            exit;
        }

        /**
         * Organization info
         */
        $this->template->organization = $this->organization;

        /**
         * Jumbotron
         */
        $this->template->jumbotron = View::factory('organizations/blocks/jumbotron')
            ->set('organization', $this->organization);

        /**
         * Navigation
         */
        $this->template->navigation = View::factory('organizations/blocks/navigation')
            ->set('id', $this->id_organization);
    }

    /**
     * New organization form
     * Doesn't need any variables
     */
    public function action_new() { }

    /**
     * Shows organization
     */
    public function action_show()
    {
        /**
         * Show all events
         * @uses Controller_Events method ShowAll
         */

        $params = array(
            'id_organization' => $this->id_organization,
        );

        $response = Request::factory('events/all')
            ->method(Request::POST)
            ->post($params)
            ->execute();

        $this->template->main_section = $response->body();

    }

    /**
     * Shows list of organizations
     * Will be used as internal request for another modules
     */
    public function action_showAll()
    {

    }

    /**
     * Organization balance interface
     */
    public function action_balance()
    {
        $this->template->main_section = View::factory('organizations/settings/balance')
            ->set('id', $this->id_organization);
    }

    /**
     * Organization activities
     */
    public function action_logs()
    {
        $this->template->main_section = View::factory('organizations/settings/logs')
            ->set('id', $this->id_organization);
    }

    /**
     * Organizations team
     */
    public function action_team()
    {
        /**
         * Getting team
         */
        $team = Model_Organizations::get_team($this->id_organization);
        
        $this->template->main_section = View::factory('organizations/settings/team')
            ->set('id', $this->id_organization)
            ->set('team', $team);
    }

    /**
     * Main information about target organization
     */
    public function action_main()
    {
        if ($this->organization !== null)
        {
            $creator = Model_Organizations::get_creator($this->organization->user_created);
        }

        $this->template->main_section = View::factory('organizations/settings/main')
                ->set('id', $this->id_organization)
                ->set('organization', $this->organization)
                ->set('creator', $creator);
    }

}