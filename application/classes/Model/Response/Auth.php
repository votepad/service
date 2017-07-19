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
        'message' => 'Не правильно введена эл.почта или пароль'
    );

    protected $_INVALID_EVENT_CODE_ERROR = array(
        'type' => 'login',
        'code' => '13',
        'message' => 'Не правильно введен код мероприятия'
    );

    protected $_INVALID_JUDGE_SECRET_ERROR = array(
        'type' => 'login',
        'code' => '13',
        'message' => 'Не правильно введен пароль'
    );

    protected $_LOGIN_SUCCESS = array(
        'type' => 'login',
        'code' => '14',
        'message' => 'Success login'
    );

    protected $_AUTHORIZATION_REQUIRED_ERROR = array(
        'type' => 'login',
        'code' => '15',
        'message' => 'Authorization required'
    );

    protected $_USER_DOES_NOT_EXIST_ERROR = array (
        'type' => 'login',
        'code' => '16',
        'message' => 'User does not exists'
    );

    protected $_PASSWORDS_ARE_NOT_EQUAL_ERROR = array (
        'type' => 'login',
        'code' => '17',
        'message' => 'Passwords should be equal'
    );

    protected $_PASSWORD_CHANGE_SUCCESS = array (
        'type' => 'login',
        'code' => '18',
        'message' => 'Password was changed'
    );

}