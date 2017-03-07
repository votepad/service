<?php

class Model_Response_Auth extends Model_Response_Abstract
{

    protected $_RECOVER_ERROR = array(
        'type' => 'recover',
        'code' => '10',
        'message' => 'Problems with session recover'
    );

    protected $_RECOVER_SUCCESS = array(
        'type' => 'recover',
        'code' => '11',
        'message' => 'Success session recover'
    );

    protected $_LOGOUT_SUCCESS = array(
        'type' => 'logout',
        'code' => '12',
        'message' => 'Success logout'
    );

    protected $_INVALID_INPUT_ERROR = array(
        'type' => 'login',
        'code' => '13',
        'message' => 'Invalid input'
    );

    protected $_LOGIN_SUCCESS = array(
        'type' => 'login',
        'code' => '14',
        'message' => 'Success login'
    );

}