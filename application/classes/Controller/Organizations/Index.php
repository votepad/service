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

        /** @var $id - organization identificator */
        $this->template->id = $this->id_organization = $this->request->param('id');

        /** @var $organization_cached
         * getting information about organization from cache
         */
        $organization_cached = $this->_cache->get('organization_' . $this->id_organization);

        if (isset($organization_cached)) {
            $this->organization = $organization_cached;
        } else {
            $this->organization = Model_Organizations::get($this->id_organization);
            $this->_cache->set('organization_' . $this->id_organization, $this->organization);
        }

        /**
         * Organization info
         */
        $this->template->organization = $this->organization;
    }

    /** New organization form */
    public function action_new()
    {

    }

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

    /** Shows list of organizations */
    public function action_showAll()
    {

    }

    /**
     * Organizations Settings
     */
    public function action_balance()
    {
        $this->template->main_section = View::factory('organizations/settings/balance')
            ->set('id', $this->id_organization);
    }

    public function action_logs()
    {
        $this->template->main_section = View::factory('organizations/settings/logs')
            ->set('id', $this->id_organization);
    }

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
     * @todo
     * Перепроверить кэширование в Kohana. Сейчас использует файловый драйвер
     * Возможно нужно будет перейти на memcacheimp
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