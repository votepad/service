<?php

/**
 * Class Controller_Organizations_Modify
 * @author Pronwe team
 * @copyright Khaydarov Murod
 */

class Controller_Organizations_Modify extends Dispatch
{
    public function before()
    {
        $this->auto_render = false;
        parent::before();
    }

    public function action_add()
    {
        $name       = Arr::get($_POST, 'org_name', '');
        $website    = Arr::get($_POST, 'org_site', '');
        $phone      = Arr::get($_POST, 'org_phone', '');

        $user       = Model_User::getCurrentUser();
        $user_id    = $user->id;

        $organization = Model_Organizations::new_organization($name, $website, $user_id, $phone);

        $this->redirect('organization/' . $organization->id);
    }
    
}