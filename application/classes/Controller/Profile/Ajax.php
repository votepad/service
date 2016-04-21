<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 14.03.2016
 * Time: 23:11
 */

class Controller_Profile_Ajax extends Ajax {

    public function action_update()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_User::updateUserByFieldName($name, $value, $id);
    }

}