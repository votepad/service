<?php

class Model_Response_Participant extends  Model_Response_Abstract
{
    protected $_PARTICIPANT_CREATE_SUCCESS = array(
        'type' => 'participant',
        'code' => '80',
        'message' => 'Участник успешно создан'
    );

    protected $_PARTICIPANT_EXISTED_ERROR = array(
        'type' => 'participant',
        'code' => '81',
        'message' => 'Участник с таким именем уже существует'
    );

    protected $_PARTICIPANT_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'participant',
        'code' => '82',
        'message' => 'Участник не существует'
    );

    protected $_PARTICIPANT_EVENT_ERROR = array(
        'type' => 'participant',
        'code' => '83',
        'message' => 'Участник не относиться к этому мероприятию'
    );

    protected $_PARTICIPANT_UPDATE_SUCCESS = array(
        'type' => 'participant',
        'code' => '84',
        'message' => 'Участник успешно обновлен'
    );

    protected $_PARTICIPANT_DELETE_SUCCESS = array(
        'type' => 'participant',
        'code' => '85',
        'message' => 'Участник успешно удален'
    );

}