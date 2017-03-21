<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 27.02.2016
 * Time: 1:13
 */

class HTTP_Exception_400 extends Kohana_HTTP_Exception_400 {

    function get_response()
    {
        $response = Response::factory();

        $view = View::factory('errors/400');

        $response->body($view->render());

        return $response;
    }
}