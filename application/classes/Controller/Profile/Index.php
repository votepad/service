<?php


class Controller_Profile_Index extends Dispatch {

    public $template = 'main';

    function action_index()
    {
        parent::isLogged();
        /*
         * Page decoration
         */

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('profile/profile');

        /*
         * Meta datas
         */
        $this->template->title  ='Профиль пользователя';
        $this->template->description    = 'Профиль пользователя';
        $this->template->keywords       = 'SEO';

        /*
         * Styles AND JS
         */

        array_push( $this->css, 'vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css');
        array_push( $this->js,  'js/demo/demo-xeditable.js');
        array_push( $this->js,  'vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;


    }
}