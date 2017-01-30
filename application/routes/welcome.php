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

Route::set('Features', 'features')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'features'
    ))
    ->cache();
