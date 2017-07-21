<?php

class Model_Response_Form extends Model_Response_Abstract
{

    protected $_EMPTY_FIELDS_ERROR = array(
        'type' => 'form',
        'code' => '30',
        'message' => 'Empty fields'
    );

    protected $_EMPTY_FIELD_ERROR = array(
        'type' => 'form',
        'code' => '31',
        'message' => 'Empty field'
    );

    protected $_NOTHING_CHANGE_WARING = array(
        'type' => 'form',
        'code' => '32',
        'message' => 'Ничего не было изменено'
    );


}