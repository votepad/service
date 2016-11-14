<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Events_Ajax
 * @author Pronwe Team
 * @copyright Khaydarov Murod
 */

class Controller_Events_Ajax extends Ajax {

    public function action_checkevent()
    {
        if (Ajax::is_ajax()) {

            $event = $this->request->param('website');

            $info = Model_Events::getByFieldName('page','=', $event);

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