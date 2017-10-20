<?php

class Model_Response_Stage extends  Model_Response_Abstract
{
    protected $_STAGE_CREATE_SUCCESS = array(
        'type' => 'stages',
        'code' => '120',
        'message' => 'Этап успешно создан'
    );

    protected $_STAGE_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'stages',
        'code' => '121',
        'message' => 'Этап не существует'
    );

    protected $_STAGE_EVENT_ERROR = array(
        'type' => 'stages',
        'code' => '122',
        'message' => 'Этап не относиться к этому мероприятию'
    );

    protected $_STAGE_UPDATE_SUCCESS = array(
        'type' => 'stages',
        'code' => '123',
        'message' => 'Информация об этапе успешно обновлена'
    );

    protected $_STAGE_DELETE_SUCCESS = array(
        'type' => 'stages',
        'code' => '124',
        'message' => 'Этап успешно удален'
    );

}