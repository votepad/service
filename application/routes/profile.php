<?php defined('SYSPATH') or die('No direct pattern access.');

Route::set('PROFIlE_CONFIRM', 'user/confirm/<hash>')
    ->defaults(array(
        'controller' => 'Profiles_Index',
        'action'     => 'confirm',
    ));

Route::set('PROFIlE', 'user/<id>(/<action>)', array(
        'id' => $DIGIT,
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Profiles_Index',
        'action'     => 'index',
    ))
    ->cache();

Route::set('PROFILE_AJAX', 'user/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Profiles_Ajax',
    ))
    ->cache();