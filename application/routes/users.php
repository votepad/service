<?php defined('SYSPATH') or die('No direct pattern access.');

Route::set('USER', 'user/<id>(/<action>)', array(
        'id' => $DIGIT,
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Users_Index',
        'action'     => 'index',
    ));

Route::set('USERS_AJAX', 'user/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Users_Ajax',
    ));