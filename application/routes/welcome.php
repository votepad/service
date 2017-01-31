<?php defined('SYSPATH') or die('No direct pattern access.');
/**
 * @author NWE Team
 * @copyright Turov Nikolay
 */


 /**
 * Welcome page
 */
Route::set('Welcome_Page', '')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();

/**
* Features of votepad
*/
Route::set('Features', 'features')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'features'
    ))
    ->cache();


/**
* TEMP ROUTES for events page
*/
Route::set('Event_point', 'ifmo/point')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'point',
    ))
    ->cache();

Route::set('Event_ifse', 'ifmo/ifse')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'ifse',
    ))
    ->cache();
Route::set('Event_mister2017', 'ifmo/mister2017')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'mister2017',
    ))
    ->cache();
Route::set('Event_pervokursnik', 'ifmo/ya-pervokursnik')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'pervokursnik',
    ))
    ->cache();
Route::set('Event_tnl', 'ifmo/tnl')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'tnl',
    ))
    ->cache();
Route::set('Event_tnl', 'ifmo/miss2016')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'miss2016',
    ))
    ->cache();
