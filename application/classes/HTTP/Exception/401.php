<?php

class HTTP_Exception_401 extends Kohana_HTTP_Exception_401 {

    function get_response()
    {
        $response = Response::factory();

        $view = View::factory('errors/401');

        $response->body($view->render());

        return $response;
    }
}