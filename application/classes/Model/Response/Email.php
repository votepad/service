<?php

class Model_Response_Email extends Model_Response_Abstract
{
    protected $_EMAIL_SEND_ERROR = array (
        'type' => 'email',
        'code' => '60',
        'message' => 'Ошибка при отправке письма'
    );

    protected $_EMAIL_SEND_SUCCESS = array (
        'type' => 'email',
        'code' => '61',
        'message' => 'Письмо успешно отправлено'
    );

    protected $_EMAIL_FORMAT_ERROR = array (
        'type' => 'email',
        'code' => '62',
        'message' => 'Не правильно указан формат эл.почты'
    );

}