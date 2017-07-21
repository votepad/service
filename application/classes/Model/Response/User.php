<?php

class Model_Response_User extends  Model_Response_Abstract
{
    protected $_USER_PHONE_ERROR = array(
        'type' => 'user',
        'code' => '30',
        'message' => 'Не правильно указан номер телефона'
    );

    protected $_USER_UPDATE_SUCCESS = array(
        'type' => 'user',
        'code' => '31',
        'message' => 'Информация успешно обновлена!'
    );

    protected $_USER_UPDATE_EMAIL_CHANGE_SUCCESS = array(
        'type' => 'user',
        'code' => '31',
        'message' => 'Информация успешно обновлена! На указанную почту было отправлено письмо с сылкой для подтверждения эл.почты'
    );

    protected $_USER_SAME_PASSWORDS_ERROR = array (
        'type' => 'login',
        'code' => '32',
        'message' => 'Старый и новый пароль совпадают'
    );

    protected $_USER_PASSWORD_ERROR = array (
        'type' => 'login',
        'code' => '32',
        'message' => 'Не правильно введен старый пароль'
    );

    protected $_USER_PASSWORDS_ARE_NOT_EQUAL_ERROR = array (
        'type' => 'login',
        'code' => '32',
        'message' => 'Новые пароли не совпадают'
    );

    protected $_USER_PASSWORD_CHANGE_SUCCESS = array (
        'type' => 'login',
        'code' => '33',
        'message' => 'Пароль успешно изменен'
    );

    protected $_USER_EXISTED_ERROR = array (
        'type' => 'login',
        'code' => '34',
        'message' => 'Пользователь с такой эл.почтой существует'
    );

    protected $_USER_CREATE_SUCCESS = array (
        'type' => 'signup',
        'code' => '35',
        'message' => 'Пользователь успешно зарегестрирован'
    );
}