<?php

class Model_Response_Contest extends  Model_Response_Abstract
{
    protected $_CONTEST_CREATE_SUCCESS = array(
        'type' => 'contest',
        'code' => '130',
        'message' => 'Конкурс успешно создан'
    );

    protected $_CONTEST_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'contest',
        'code' => '131',
        'message' => 'Конкурс не существует'
    );

    protected $_CONTEST_EVENT_ERROR = array(
        'type' => 'contest',
        'code' => '132',
        'message' => 'Конкурс не относиться к этому мероприятию'
    );

    protected $_CONTEST_UPDATE_SUCCESS = array(
        'type' => 'contest',
        'code' => '133',
        'message' => 'Информация о конкурсе успешно обновлена'
    );

    protected $_CONTEST_DELETE_SUCCESS = array(
        'type' => 'contest',
        'code' => '134',
        'message' => 'Конкурс успешно удален'
    );

}