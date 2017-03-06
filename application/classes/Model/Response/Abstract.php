<?php

class Model_Response_Abstract extends Model
{

    public $ERROR_STATUS     = 'error';
    public $SUCCESS_STATUS   = 'success';
    protected $response      = array();

    public function __construct($name, $status, $data = array()) {

        if (!property_exists($this, '_'.$name)) {
            return false;
        }

        $this->response = $this->{'_'.$name};

        $this->response['status'] = $this->{strtoupper($status).'_STATUS'};

        $this->response = array_merge($this->response, $data);

    }

    public function get_response() {

        return $this->response;

    }

}