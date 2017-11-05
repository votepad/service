<?php

class Model_Response_Result extends  Model_Response_Abstract
{
    protected $_RESULT_CREATE_SUCCESS = array(
        'type' => 'result',
        'code' => '140',
        'message' => 'Формула подсчета успешно создана'
    );

    protected $_RESULT_EVENT_ERROR = array(
        'type' => 'result',
        'code' => '141',
        'message' => 'Результат не относиться к этому мероприятию'
    );

    protected $_RESULT_UPDATE_SUCCESS = array(
        'type' => 'result',
        'code' => '142',
        'message' => 'Формула подсчета результата успешно обновлена'
    );

    protected $_RESULT_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'result',
        'code' => '143',
        'message' => 'Не возможно опубликовать. Формула результата не создана'
    );

    protected $_RESULT_PUBLISH_SUCCESS = array(
        'type' => 'result',
        'code' => '144',
        'message' => 'Финальный результат успешно опубликован'
    );

    protected $_RESULT_UN_PUBLISH_SUCCESS = array(
        'type' => 'result',
        'code' => '145',
        'message' => 'Финальный результаты успешно снят с публикации'
    );

    protected $_RESULT_PUBLISH_ERROR = array(
        'type' => 'result',
        'code' => '146',
        'message' => 'Финальный результаты не опубликован. Обновите страницу'
    );

}