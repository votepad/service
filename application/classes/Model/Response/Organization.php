<?php

class Model_Response_Organization extends  Model_Response_Abstract
{
    protected $_ORG_REMOVE_SUCCESS = array(
        'type' => 'organizations',
        'code' => '40',
        'message' => 'Org is removed'
    );

    protected $_ORG_REESTABLISH_SUCCESS = array(
        'type' => 'organizations',
        'code' => '41',
        'message' => 'Org is reestablished'
    );

    protected $_ORGANIZATION_DOES_NOT_EXIST_ERROR = array(
        'type' => 'organizations',
        'code' => '42',
        'message' => 'Org does not exist'
    );

    protected $_JOIN_REQUEST_SUCCESS = array(
      'type' => 'organizations',
      'code' => '43',
      'message' => 'Success join request'
    );

    protected $_USER_IS_ALREADY_MEMBER_ERROR = array(
        'type' => 'organizations',
        'code' => '44',
        'message' => 'User is already member of organization'
    );

    protected $_USER_IS_NOT_MEMBER_ERROR = array(
        'type' => 'organizations',
        'code' => '45',
        'message' => 'User is not member of organization'
    );

    protected $_ADD_MEMBER_SUCCESS = array(
        'type' => 'organizations',
        'code' => '46',
        'message' => 'Member added'
    );

    protected $_REMOVE_MEMBER_SUCCESS = array(
        'type' => 'organizations',
        'code' => '47',
        'message' => 'Member removed'
    );

    protected $_REJECT_MEMBER_SUCCESS = array(
        'type' => 'organizations',
        'code' => '48',
        'message' => 'Member rejected'
    );



}