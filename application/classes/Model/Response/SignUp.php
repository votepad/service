<?php

class Model_Response_SignUp extends Model_Response_Abstract
{
    protected $_USER_EXISTS_ERROR = array(
        'type' => 'signup',
        'code' => '20',
        'message' => 'Пользователь с такой эл.почтой существует, попробуйте восстановить пароль'
    );

    protected $_SIGN_UP_SUCCESS = array(
        'type' => 'signup',
        'code' => '21',
        'message' => 'Польователь успешно зарегестрирован'
    );

}