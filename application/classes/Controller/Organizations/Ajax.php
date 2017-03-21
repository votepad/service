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

        $result = Model_User::isUserExist('email', $email);

        if ($result) {
            echo "true";
        } else {
            echo "false";
        }

    }

    /**
     * Receives POST data and checks website
     * @returns [Boolean]
     */
    public function action_checkWebsite()
    {
        $uri = $this->request->param('uri');

        $result = Model_Organization::getByFieldName('uri', $uri);

        if ($result->id) {
            echo "true";
        } else {
            echo "false";
        }

    }

    /**
     * Deletes organization (makes 'is_removed' flag true)
     */
    public function action_delete()
    {
        $id = $this->request->param('id');
        $org = new Model_Organization($id);

        if (!$org->id) {
            throw new HTTP_Exception_404();
        }

        $org->remove();

        $response = new Model_Response_Organization('ORG_REMOVE_SUCCESS', 'success');

        $this->response->body(@json_encode($response->get_response()));

    }

    /**
     * Reestablishes organization
     * @return [Boolean]
     */
    public function action_reestablish()
    {
        $id = $this->request->param('id');

        $org = new Model_Organization($id);

        $org->reestablish();

        $response = new Model_Response_Organization('ORG_REMOVE_SUCCESS', 'success');

        $this->response->body(@json_encode($response->get_response()));

    }

    /**
     * Updates organization fields by Ajax Request
     */
    public function action_update()
    {
        $id_organization = $this->request->param('id');


        $field = Arr::get($_POST, 'field');
        $value = Arr::get($_POST, 'value');

        $organization = Model_Organizations::get($id_organization, 0);
        $organization->$field = $value;
        $organization->save($id_organization);
    }

}
