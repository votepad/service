<?php

class Model_Response_Judge extends  Model_Response_Abstract
{
    protected $_JUDGE_CREATE_SUCCESS = array(
        'type' => 'judges',
        'code' => '70',
        'message' => 'Представитель жюри успешно создан'
    );

    protected $_JUDGE_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'judges',
        'code' => '72',
        'message' => 'Представитель жюри не существует'
    );

    protected $_JUDGE_EVENT_ERROR = array(
        'type' => 'judges',
        'code' => '73',
        'message' => 'Представитель жюри не относиться к этому мероприятию'
    );

    protected $_JUDGE_UPDATE_SUCCESS = array(
        'type' => 'judges',
        'code' => '74',
        'message' => 'Представитель жюри успешно обновлен'
    );

    protected $_JUDGE_DELETE_SUCCESS = array(
        'type' => 'judges',
        'code' => '75',
        'message' => 'Представитель жюри успешно удален'
    );

    protected $_JUDGE_EXISTED_ERROR = array(
        'type' => 'judges',
        'code' => '76',
        'message' => 'Представитель жюри с таким паролем существует. Пароль недопустим, измените его'
    );

}