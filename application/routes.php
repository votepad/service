<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Default Welcome page
 */

Route::set('Welcome_Page', '')
    ->filter(function(Route $route, $params, Request $request) {
        // code
    })
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();

/**
 * Authentifications
 */

Route::set('AUTH', 'auth(/<action>)')
    ->defaults(array(
        'controller' => 'Auth',
        'action' => 'index',
    ));

Route::set('SINGUP', 'signup(/<action>)')
    ->defaults(array(
        'controller'  => 'SignUp',
        'action'      => 'index',
    ));


/**
 * Profile
 */
Route::set('PROFILE', 'profile(/<subaction>)')
    ->defaults(array(
        'controller' => 'Profile_Index',
        'action'     => 'index',
    ));



Route::set('Judge-Modify', '<action>')
    ->defaults(array(
        'controller' => 'Judges_Settings_Modify',
        'action'     => '',
    ));

Route::set('Judge-panels', 'event/<id>/judge/<action>')
    ->defaults(array(
        'controller' => 'Judges_Panels_Index',
        'action'     => 'panel1',
    ));


require_once ('routes/organizations.php');
require_once ('routes/ajax.php');
require_once ('routes/events.php');

?>
