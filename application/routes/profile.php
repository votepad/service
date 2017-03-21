<?php defined('SYSPATH') or die('No direct pattern access.');
/**
 * @author Votepad Team
 * @copyright Turov Nikolay
 * @version 0.1.0
 */


 /**
 * Profile
 */
Route::set('Profile_MainPage', 'user/<id>(/<action>)', array('id' => $DIGIT, 'action' => 'organizations|events|update'))
    ->defaults(array(
        'controller' => 'Profile',
        'action'     => 'index',
    ))
    ->cache();