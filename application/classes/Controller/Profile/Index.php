<?php


class Controller_Profile_Index extends Dispatch {

    public $template = 'main';

    function action_index()
    {

        $model_user = Model_User::Instance();
        $user       = $model_user->getUserInfo();

        /*
         * Datas
         */
        $this->template->user   = $user;

        /*
         * Page decoration
         */

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('profile/profile')
                                                    ->set( 'assets', $this->assets )
                                                    ->set( 'user', $user );

        array_push( $this->css, 'vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css');
        array_push( $this->js,  'js/demo/demo-xeditable.js');
        array_push( $this->js,  'vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js');

        $this->template->css    = $this->css;
        $this->template->assets = $this->assets;
        $this->template->js     = $this->js;


    }
}