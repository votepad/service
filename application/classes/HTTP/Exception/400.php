<?php

class HTTP_Exception_400 extends Kohana_HTTP_Exception_400 {

    const BAD_REQUEST_ERROR = array(
        'status'  => 'error',
        'type'    => 'ajax',
        'code'    => '999',
        'message' => 'Ссылка не действительна'
    );


    function get_response()
    {
        $response = Response::factory();

        if (Ajax::is_ajax()) {

            $response->body( @json_encode(self::BAD_REQUEST_ERROR));

        } else{

            $view = View::factory('errors/400');
            $response->body($view->render());

        }

        return $response;
    }

}