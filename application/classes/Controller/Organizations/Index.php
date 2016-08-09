<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @author Pronwe team
 * @copyright Khaydarov Murod
 */

class Controller_Organizations_Index extends Dispatch
{
    public function before()
    {
        switch ($this->request->action()) {
            case 'new' : $this->template = 'organizations/new_logged';    break;
            default    : $this->template = 'organizations/main';          break;
        }

        parent::before();
    }

    /** New organization form */
    public function action_new()
    {

    }

    /** Shows organization */
    public function action_show()
    {
        $this->template->main_section = View::factory('organizations/events/all');
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
        $this->template->main_section = View::factory('organizations/settings/balance');
    }

    public function action_logs()
    {
        $this->template->main_section = View::factory('organizations/settings/logs');
    }

    public function action_team()
    {
        $this->template->main_section = View::factory('organizations/settings/team');
    }

    public function action_main()
    {
        $this->template->main_section = View::factory('organizations/settings/main');
    }

}