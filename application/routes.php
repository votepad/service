<?php defined('SYSPATH') or die('No direct script access.');



require_once ('ajax_routes.php');
require_once ('events_routes.php');

/**
* Set the routes. Each route must have a minimum of a name, a URI and a set of
* defaults for the URI.
*/

/**
 * Default Welcome page
 */

Route::set('Welcome_Page', '')
    ->filter(function(Route $route, $params, Request $request) {
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

/**
 * Default Route
 */

Route::set('EVENTS', 'events(/<id>(/<action>))')
    ->filter(function($route, $params, $request){

        $id = Arr::get($params, 'id');
        if ( !Model_Events::EventExist($id) || !isset($id))
            return false;

    })
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'index',
    ));

Route::set('Default', '<controller>(/<action>(/<id>))')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'Index',
    ));
?>



