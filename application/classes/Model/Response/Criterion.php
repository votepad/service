<?php

class Model_Response_Criterion extends  Model_Response_Abstract
{
    protected $_CRITERION_CREATE_SUCCESS = array(
        'type' => 'criterions',
        'code' => '110',
        'message' => 'Критерий успешно создан'
    );

    protected $_CRITERION_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'criterions',
        'code' => '111',
        'message' => 'Критерий не существует'
    );

    protected $_CRITERION_EVENT_ERROR = array(
        'type' => 'criterions',
        'code' => '112',
        'message' => 'Критерий не относиться к этому мероприятию'
    );

    protected $_CRITERION_UPDATE_SUCCESS = array(
        'type' => 'criterions',
        'code' => '113',
        'message' => 'Информация о критерии успешно обновлена'
    );

    protected $_CRITERION_DELETE_SUCCESS = array(
        'type' => 'criterions',
        'code' => '114',
        'message' => 'Критерий успешно удален'
    );

    protected $_CRITERION_MIN_LARGE_MAX_SUCCESS = array(
        'type' => 'criterions',
        'code' => '114',
        'message' => 'Минимальный балл не может быть больше максимального'
    );

}