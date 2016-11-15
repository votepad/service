<?php

/**
 * Class Controller_Organizations_Modify
 * @author Pronwe team
 * @copyright Khaydarov Murod
 * @version 0.1.1
 */

class Controller_Organizations_Modify extends Dispatch
{

    /** Disable rendering HTML */
    public function before()
    {
        $this->auto_render = false;
        parent::before();
    }

    /**
     * @private
     *
     * Works only with POST requests
     *
     * @throws HTTP_Exception_404
     */
    public function action_add()
    {

        if ($this->request->method() == Request::POST) {

            $name = Arr::get($_POST, 'org_name', '');
            $website = Arr::get($_POST, 'org_site');
            $official = Arr::get($_POST, 'official_org_site', '');
            $phone = Arr::get($_POST, 'org_phone', '');

            if (self::isLogged()) {

                $user = new Model_PrivillegedUser();
                $user_id = $user->id_user;


            } else {

                $user = Arr::get($_POST, 'org_user', '');
                $email = Arr::get($_POST, 'email', '');
                $password = Arr::get($_POST, 'password', '');

                $user_info = explode(' ', $user);

                $newUser = new Model_PrivillegedUser();

                $newUser->lastname  = $user_info[0];
                $newUser->name      = $user_info[1];
                $newUser->surname   = $user_info[2];
                $newUser->email     = $email;
                $newUser->password  = $password;
                $newUser->phone     = $phone;
                $newUser->done      = 1;
                $newUser->id_role   = 1;

                $newUser->save();

            }

            $organization = new Model_Organizations();
            $organization->name = $name;
            $organization->website = $website;
            $organization->officialSite = $official;

            $organization->save();

            if (isset($user_id)) {
                Model_Organizations::addUsersOrganization($user_id, $organization->id);
            } else {
                Model_Organizations::addUsersOrganization($newUser->id_user, $organization->id);
            }

            /**
             * Authentificating user
             * Internal request for authentification
             * Sending request
             */
            Request::factory('auth/signin')
                ->method(Request::POST)
                ->post(array(
                    'email'    => $newUser->email,
                    'password' => $newUser->password
                ))
                ->execute();

            $this->redirect('organization/' . $organization->id);
            
        } else {

            /**
             * All other Requests we ignore and send 404.
             */
            throw new HTTP_Exception_404();
        }
    }

    public function action_update()
    {

        /** @var $id_organization */
        $id_organization = $this->request->param('id');

        /** POST params */
        $name           = Arr::get($_POST, 'org_name', '');
        $officialSite   = Arr::get($_POST, 'official_org_site', '');

        if (self::isLogged()) {

            $user       = new Model_PrivillegedUser();
            $user_id    = $user->id_user;

        } else {
            return;
        }

        $fields = array(
            'name'         => $name,
            'officialSite' => $officialSite,
            'is_removed'   => 0
        );

        $organization = Model_Organizations::get($id_organization, 0);

        foreach ($fields as $key => $value) {
            $organization->$key = $value;
        }

        $organization->save($id_organization);

        $this->redirect('organization/' . $id_organization . '/settings/main');

    }

}
