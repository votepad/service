<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 16.03.2016
 * Time: 21:42
 */
class Ajax extends Controller {

    public static function is_ajax()
    {
        if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;

        return false;
    }
}