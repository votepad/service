<?php
/**
 * @author Pronwe team
 * @copyright Khaydarov Murod
 * @version 0.1.2
 */

/**
 * Class Controller_Organizations_Ajax
 */
class Controller_Organizations_Ajax extends Ajax
{
    /**
     * Receives POST data, checks for email existance.
     * @returns [Boolean]
     */
    public function action_checkEmail()
    {
        $email = $this->request->param('email');

        if (Ajax::is_ajax()) {
            $result = Model_User::isUserExist('email', $email);
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Receives POST data and checks website
     * @returns [Boolean]
     */
    public function action_checkWebsite()
    {
        $website = $this->request->param('website');

        if (Ajax::is_ajax()) {
            $result = Model_Organizations::getByFieldName('website', $website);
        }

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes organization (makes 'is_removed' flag true)
     * @return [Boolean]
     */
    public function action_delete()
    {
        $id_organization = $this->request->param('id');

        if (Ajax::is_ajax()) {
            $result = Model_Organizations::delete_organization($id_organization);
        }

        if ($result){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Reestablishes organization
     * @return [Boolean]
     */
    public function action_reestablish()
    {
        $id_organization = $this->request->param('id');

        if (Ajax::is_ajax()) {
            $result = Model_Organizations::reestablish_organization($id_organization);
        }

        if ($result){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Updates organization fields by Ajax Request
     */
    public function action_update()
    {
        $id_organization = $this->request->param('id');

        if (Ajax::is_ajax()) {

            $field = Arr::get($_POST, 'field');
            $value = Arr::get($_POST, 'value');
            
            $organization = Model_Organizations::get($id_organization, 0);
            $organization->$field = $value;
            $organization->save($id_organization);
        }
        
    }

}