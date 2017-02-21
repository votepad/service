<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 14.03.2016
 * Time: 23:11
 */

class Controller_Events_Ajax extends Ajax {

    public function action_checkwebsite()
    {
        if (Ajax::is_ajax()) {

            $event = $this->request->param('website');
            $info = Model_Events::getByFieldName('page', $event);

            if (!empty($info)) {
                echo "true";
            } else {
                echo "false";
            }

        } else {
            die ('No direct access to this route');
        }
    }

}
