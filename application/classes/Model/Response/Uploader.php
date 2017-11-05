<?php

class Model_Response_Uploader extends Model_Response_Abstract
{
    protected $_UPLOADER_NO_USER_ERROR = array (
        'type' => 'upload',
        'code' => '40',
        'message' => 'Доступ запещен'
    );

    protected $_UPLOADER_NO_TYPE_ERROR = array (
        'type' => 'upload',
        'code' => '41',
        'message' => 'Утерян формат файла'
    );

    protected $_UPLOADER_WRONG_TYPE_ERROR = array (
        'type' => 'upload',
        'code' => '42',
        'message' => 'Формат файла не поддерживается'
    );

    protected $_UPLOADER_FILE_SIZE_ERROR = array (
        'type' => 'upload',
        'code' => '43',
        'message' => 'Загружаемый файл слишком большой. Размер не должен быть более 2 Мб'
    );

    protected $_UPLOADER_FILE_NOT_TRANSFERRED_ERROR = array (
        'type' => 'upload',
        'code' => '44',
        'message' => 'Файл не был загружен'
    );

    protected $_UPLOADER_FILE_EMPTY_ERROR = array (
        'type' => 'upload',
        'code' => '45',
        'message' => 'Загружаемый файл пустой'
    );

    protected $_UPLOADER_FILE_DAMAGED_ERROR = array (
        'type' => 'upload',
        'code' => '46',
        'message' => 'Загружаемый файл поврежден'
    );

    protected $_UPLOADER_FILE_ERROR = array (
        'type' => 'upload',
        'code' => '47',
        'message' => 'Произошла ошибка во время загрзки'
    );

    protected $_UPLOADER_FILE_SUCCESS = array (
        'type' => 'upload',
        'code' => '48',
        'message' => 'Файл успешно загружен'
    );



}