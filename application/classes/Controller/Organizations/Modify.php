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

            $name           = Arr::get($_POST, 'org_name', '');
            $description    = Arr::get($_POST, 'org_description', '');
            $uri            = Arr::get($_POST, 'org_site');
            $website        = Arr::get($_POST, 'official_org_site', '');




            $organization = new Model_Organization();

            $organization->name         = $name;
            $organization->description  = $description;
            $organization->uri          = $uri;
            $organization->website      = $website;
            $organization->owner        = $this->user->id;

            $organization->save();


            $this->redirect('organization/' . $organization->id);

        } else {

            /**
             * All other Requests we ignore and send 403.
             */
            throw new HTTP_Exception_403();
        }
    }

    public function action_update()
    {

        /** @var $id_organization */
        $id = $this->request->param('id');

        $org = new Model_Organization($id);

        if ($org->owner != $this->user->id) {
            throw new HTTP_Exception_403();
        }

        /** POST params */
        $name           = Arr::get($_POST, 'org_name', $org->name);
        $description    = Arr::get($_POST, 'org_description', $org->description);
        $website        = Arr::get($_POST, 'official_org_site', $org->website);
        $uri            = Arr::get($_POST, 'org_site', $org->uri);

        $org->name          = $name;
        $org->description   = $description;
        $org->website       = $website;
        $org->uri           = $uri;

        $org->update();

        $this->redirect('organization/' . $id . '/settings/main');

    }

}
