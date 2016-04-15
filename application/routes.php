<?php defined('SYSPATH') or die('No direct script access.');


/**
 * Testing Routes
 */

Route::set('AjaxForEvents', 'deleteEvent')
    ->defaults(array(
        'controller' => 'Events_Ajax',
        'action'     => 'deleteEvent'
    ));

Route::set('AjaxForSubstances', 'updateEventsSubstance(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Ajax',
        'action'     => 'index'
    ));


/**
* Set the routes. Each route must have a minimum of a name, a URI and a set of
* defaults for the URI.
*/

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

/**
 * Events
 */

Route::set('MYEVENTS', 'events/my')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'myevents'
    ));

Route::set('ALLEVENTS', 'events/all')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'all'
    ));

Route::set('NEWEVENT', 'events/new')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'New'
    ));



/**
 * Add substances
 */
Route::set('ADDPARTICIPANTS', 'events/addparticipants/<id>')
    ->defaults(array(
        'controller'  => 'Events_Modify',
        'action'      => 'addParticipant'
    ));

Route::set('ADDJUDGE', 'events/addjudge/<id>')
    ->defaults(array(
        'controller'  => 'Judges_Modify',
        'action'      => 'addjudge'
    ));

Route::set('ADDSTAGE', 'events/addStage/<id>')
    ->defaults(array(
        'controller'  => 'Events_Modify',
        'action'      => 'addStage'
    ));


ROUTE::set('EVENTMAKER', 'events/<id>/eventmaker')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'eventmaker',
    ));


/**
 * Judges
 */

Route::set('Judge-Settings', 'event/<id>/<action>')
    ->defaults(array(
        'controller' => 'Judges_Settings_Index',
        'action'     => 'panel1'
    ));

Route::set('Judge-panel', 'event/<id>/judge/<action>')
    ->defaults(array(
        'controller' => 'Judges_Panels_Index',
        'action'     => 'panel2',
    ));


/**
 * Default Route
 */

Route::set('EVENTS', 'events(/<id>(/<action>))')
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




