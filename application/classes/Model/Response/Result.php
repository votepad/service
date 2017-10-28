<?php

class Model_Response_Result extends  Model_Response_Abstract
{
    protected $_RESULT_CREATE_SUCCESS = array(
        'type' => 'contest',
        'code' => '140',
        'message' => 'Формула подсчета успешно создана'
    );

    protected $_RESULT_EVENT_ERROR = array(
        'type' => 'contest',
        'code' => '141',
        'message' => 'Результат не относиться к этому мероприятию'
    );

    protected $_RESULT_UPDATE_SUCCESS = array(
        'type' => 'contest',
        'code' => '142',
        'message' => 'Формула подсчета результата успешно обновлена'
    );
}