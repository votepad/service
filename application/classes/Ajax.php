<?php

/**
 * Class Ajax
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */
class Ajax extends Controller {

    public static function _is_ajax()
    {
        if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return 1;
        return 0;
    }
}