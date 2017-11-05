<?php

class Model_Response_Stage extends  Model_Response_Abstract
{
    protected $_STAGE_CREATE_SUCCESS = array(
        'type' => 'stage',
        'code' => '120',
        'message' => 'Этап успешно создан'
    );

    protected $_STAGE_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'stage',
        'code' => '121',
        'message' => 'Этап не существует'
    );

    protected $_STAGE_EVENT_ERROR = array(
        'type' => 'stage',
        'code' => '122',
        'message' => 'Этап не относиться к этому мероприятию'
    );

    protected $_STAGE_UPDATE_SUCCESS = array(
        'type' => 'stage',
        'code' => '123',
        'message' => 'Информация об этапе успешно обновлена'
    );

    protected $_STAGE_DELETE_SUCCESS = array(
        'type' => 'stage',
        'code' => '124',
        'message' => 'Этап успешно удален'
    );

    protected $_STAGE_PUBLISH_SUCCESS = array(
        'type' => 'stage',
        'code' => '125',
        'message' => 'Результаты этапа успешно опубликованы'
    );

    protected $_STAGE_UN_PUBLISH_SUCCESS = array(
        'type' => 'stage',
        'code' => '126',
        'message' => 'Результаты этапа успешно сняты с публикации'
    );

    protected $_STAGE_PUBLISH_ERROR = array(
        'type' => 'stage',
        'code' => '127',
        'message' => 'Результаты не опубликованы. Обновите страницу'
    );

}