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
        if (parent::_is_ajax($this->request->method()))
        {
            $fields  = Arr::get($_POST, 'name');
            $value  = Arr::get($_POST, 'value');
            $pk     = Arr::get($_POST, 'pk');

            Model_User::updateUserByFieldName($fields, $value, $pk);
            return 1;
        }
    }

}