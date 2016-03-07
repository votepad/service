<?php defined('SYSPATH') or die('No direct script access.');

/**
* Set the routes. Each route must have a minimum of a name, a URI and a set of
* defaults for the URI.
*/

Route::set('WELCOME', '')
    ->defaults(array(
        'controller' => 'auth',
        'action'     => 'index',
    ));

Route::set('AUTH', 'auth(/<action>)')
    ->defaults(array(
        'controller' => 'Auth',
        'action' => 'index',
    ));


Route::set('PROFILE', 'profile(/<subaction>)')
    ->defaults(array(
        'controller' => 'Profile_Index',
        'action' => 'index',
    ));
?>


