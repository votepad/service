<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @copyright Khaydarov Murod
 * @author Turov Nikolay
 * @version 0.2.0
 */

class Controller_Organizations_Index extends Dispatch
{

    /**
     * @const ACTION_NEW [String]
     */
    const ACTION_NEW = 'new';


    /**
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization = null;


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
             * New organization template
             */
            case self::ACTION_NEW :
                $this->template = 'organizations/new';
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
        $id = $this->request->param('id');

        $this->organization = new Model_Organization($id);

        if (!$this->organization->id && $this->request->action() != self::ACTION_NEW || $this->organization->is_removed) {
            throw new HTTP_Exception_404();
        }

        /**
         * Organization info
         */
        $this->template->organization = $this->organization;

        if ($this->organization->id) {

            /**
            * Header
            */
            $this->template->header = View::factory('globalblocks/header')
                ->set('header_menu', View::factory('organizations/blocks/header_menu', array('id' => $this->organization->id)))
                ->set('auth_modal', View::factory('globalblocks/auth_modal'))
                ->set('organization', $this->organization);


            /**
            * Jumbotron Wrapper
            */
            $this->template->jumbotron_wrapper = View::factory('organizations/blocks/jumbotron_wrapper')
                ->set('organization', $this->organization);


            /**
             * Footer
             */
            $this->template->footer = View::factory('globalblocks/footer');

        }



    }


    /**
     * action_new - open new organization form
     * Doesn't need any variables
     */
    public function action_new()
    {
        if (!$this->isLogged()) {

            throw new HTTP_Exception_403;

        } else {

            $this->template->header = View::factory('globalblocks/header')
                ->set('header_menu', "");
            $this->template->footer = View::factory('globalblocks/footer');

        }
    }



    /**
     * EVENTS submodule
     * action_show - shows events of target organization
     */
    public function action_show()
    {
        /**
        * Jumbotron Navigation
        * - searching events on page
        */
        $this->template->jumbotron_navigation = View::factory('organizations/events/jumbotron_navigation')
            ->set('id', $this->organization->id);

        $this->template->main_section = '';

    }


    /**
     * SETTINGS submodule
     * action_main - main information about target organization
     */
    public function action_main()
    {

        if ($this->organization->owner != $this->user->id) {
            throw new HTTP_Exception_403();
        }

        /**
        * Jumbotron Navigation
        * - show all tabs of SETTINGS submodule - menu with roles
        */
        $this->template->jumbotron_navigation = View::factory('organizations/settings/jumbotron_navigation')
            ->set('id', $this->organization->id);


        /**
         * Main Section
         */
        $this->template->main_section = View::factory('organizations/settings/main')
                ->set('organization', $this->organization);

    }


    /**
     * SETTINGS submodule
     * action_team - shows team of target organization
     */
    public function action_team()
    {

        /**
        * Jumbotron Navigation
        * - show all tabs of SETTINGS submodule - menu with roles
        */
        $this->template->jumbotron_navigation = View::factory('organizations/settings/jumbotron_navigation')
            ->set('id', $this->organization->id);


        /**
         * Main Section
         */
        $this->template->main_section = View::factory('organizations/settings/team')
                ->set('organization', $this->organization);


    }

}
