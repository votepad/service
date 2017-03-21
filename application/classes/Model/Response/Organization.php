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

}