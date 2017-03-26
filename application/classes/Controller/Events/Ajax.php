<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 */

class Controller_Events_Ajax extends Ajax {

    public function action_checkwebsite()
    {
        if (Ajax::is_ajax()) {

            $uri = $this->request->param('website');
            $info = Model_Events::getByFieldName('uri', $uri);

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
