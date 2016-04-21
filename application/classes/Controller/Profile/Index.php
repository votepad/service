<?php


class Controller_Profile_Index extends Dispatch {

    public $template = 'main';

    function action_index()
    {
        parent::isLogged();
        /*
         * Page decoration
         */

        $model_user = Model_User::Instance();
        $cities = $model_user->getCities();

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('profile/profile')
                                                ->bind('cities', $cities);

        /*
         * Meta datas
         */
        $this->template->title          = 'Профиль пользователя';
        $this->template->description    = 'Профиль пользователя';
        $this->template->keywords       = 'SEO';

        /*
         * Styles AND JS
         */

        array_push( $this->css, 'vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css');
        array_push( $this->js,  'vendor/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js');
        array_push( $this->css, 'vendor/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css');
        array_push( $this->js,  'vendor/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js');
        array_push( $this->js,  'vendor/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js');
        array_push( $this->js,  'js/profile.js');
        array_push( $this->js,  'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js,  'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js,  'js/app.js');
        

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;
        
    }
}