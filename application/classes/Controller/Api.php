<?php

class Controller_Api extends Controller
{
    /**
     * @var $token - access_token
     */
    private $token;

    /**
     * @var $method - method
     */
    private $method;

    /**
     * @var $params - request params
     */
    private $params;

    public $responseData = array();

    public function action_Dispatcher() {

        $api_access = Kohana::$config->load('api');

        $this->token = $this->request->param('token');
        $this->method =  $this->request->param('method_name');
        $this->params = $_GET;

        if (!$this->token || !$this->method ) {
            die('Access denied');
        }

        if ($api_access[$this->token]
            && in_array($this->method, $api_access[$this->token]['methods'])
            && $this->availableMethods[$this->method]) {

            $this->callApiMethod($this->method, $this->params ?: $this->availableMethods[$this->method]['default_params']);

        } else {

            die('Access denied');
        }

        $this->response->body(@json_encode($this->responseData));
    }

    private function callApiMethod($method, $params) {

        $responseData['success'] = 0;

        $apiMethod = new Methods_Api();
        $reflectionClass = new ReflectionClass($apiMethod);

        if ($reflectionClass->hasMethod($method)) {

            $reflectionMethod = new ReflectionMethod($apiMethod, $method);
            $response = $reflectionMethod->invoke($apiMethod, $params);

            $responseData['success'] = 1;
            $responseData['data'] = $response;

        } else {

            // do nothing

        }

        $this->responseData = $responseData;

    }

    private $availableMethods = array(
        'getAllEvents' => array(
            'default_params' => array(
                'sort' => '1',
                'sorting_field' => 'id',
                'sorting_type' => 'DESC'
            )
        )
    );
}