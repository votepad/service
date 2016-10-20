<?php
/**
 * @author Pronwe team
 * @copyright Khaydarov Murod
 */

/**
 * Class Controller_Organizations_Ajax
 */
class Controller_Organizations_Ajax extends Ajax
{
    /**
     * Deletes organization (makes 'is_removed' flag true)
     * @return bool
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
     * @return bool
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