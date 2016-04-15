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


Route::set('PROFILE', 'profile(/<subaction>)')
    ->defaults(array(
        'controller' => 'Profile_Index',
        'action'     => 'index',
    ));

Route::set('ADDPARTICIPANTS', 'events/addparticipants/<id>')
    ->defaults(array(
        'controller'  => 'Events_Modify',
        'action'      => 'addParticipant'
    ));

Route::set('ADDJUDGE', 'events/addjudge/<id>')
    ->defaults(array(
        'controller'  => 'Events_Modify',
        'action'      => 'addjudge'
    ));

Route::set('ADDSTAGE', 'events/addStage/<id>')
    ->defaults(array(
        'controller'  => 'Events_Modify',
        'action'      => 'addStage'
    ));

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

ROUTE::set('EVENTMAKER', 'events/<id>/eventmaker')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'eventmaker',
    ));

Route::set('Settings-1', 'events/<id>/judgepanelsetting1')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'judgepanelsetting1'
    ));

Route::set('Settings-2', 'events/<id>/judgepanelsetting2')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'judgepanelsetting2'
    ));

Route::set('Judge-panel-1', 'event/start/judgepanel1')
    ->defaults(array(
        'controller' => 'Judges_Index',
        'action'     => 'judgepanel1',
    ));

Route::set('Judge-panel-2', 'event/start/judgepanel2')
    ->defaults(array(
        'controller' => 'Judges_Index',
        'action'     => 'judgepanel2',
    ));

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




