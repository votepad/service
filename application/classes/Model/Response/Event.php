<?php

class Model_Response_Event extends  Model_Response_Abstract
{
    protected $_EVENT_REMOVE_SUCCESS = array(
        'type' => 'events',
        'code' => '50',
        'message' => 'Org is removed'
    );

    protected $_EVENT_REESTABLISH_SUCCESS = array(
        'type' => 'events',
        'code' => '51',
        'message' => 'Org is reestablished'
    );

    protected $_EVENT_DOES_NOT_EXIST_ERROR = array(
        'type' => 'events',
        'code' => '52',
        'message' => 'Org does not exist'
    );

    protected $_USER_IS_ALREADY_ASSISTANT_ERROR = array(
        'type' => 'events',
        'code' => '53',
        'message' => 'User is already assistant of event'
    );

    protected $_ACCESS_DENIED_ERROR = array(
        'type' => 'events',
        'code' => '54',
        'message' => 'Access denied'
    );

    protected $_USER_IS_NOT_ASSISTANT_ERROR = array(
        'type' => 'events',
        'code' => '55',
        'message' => 'User is not assistant of event'
    );

    protected $_ADD_ASSISTANT_SUCCESS = array(
        'type' => 'events',
        'code' => '56',
        'message' => 'Assistant added'
    );

    protected $_REMOVE_ASSISTANT_SUCCESS = array(
        'type' => 'events',
        'code' => '57',
        'message' => 'Assistant removed'
    );

    protected $_REJECT_ASSISTANT_SUCCESS = array(
        'type' => 'events',
        'code' => '58',
        'message' => 'Assistant rejected'
    );

    protected $_USER_IS_CREATOR_ERROR = array(
        'type' => 'events',
        'code' => '59',
        'message' => 'User is creator of this event'
    );


}