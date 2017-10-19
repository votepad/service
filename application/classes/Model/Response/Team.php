<?php

class Model_Response_Team extends  Model_Response_Abstract
{
    protected $_TEAM_CREATE_SUCCESS = array(
        'type' => 'team',
        'code' => '90',
        'message' => 'Команда успешно создана'
    );

    protected $_TEAM_EXISTED_ERROR = array(
        'type' => 'team',
        'code' => '91',
        'message' => 'Команда с таким именем уже существует'
    );

    protected $_TEAM_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'team',
        'code' => '92',
        'message' => 'Команда не существует'
    );

    protected $_TEAM_EVENT_ERROR = array(
        'type' => 'team',
        'code' => '93',
        'message' => 'Команда не относиться к этому мероприятию'
    );

    protected $_TEAM_UPDATE_SUCCESS = array(
        'type' => 'team',
        'code' => '94',
        'message' => 'Информация о команде успешно обновлена'
    );

    protected $_TEAM_DELETE_SUCCESS = array(
        'type' => 'team',
        'code' => '95',
        'message' => 'Команда успешно удалена'
    );

}