<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @team ProNWE team
 * @author Khaydarov Murod
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


/**
 * EventMakers Page
 */

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
        'action'     => ''
    ));