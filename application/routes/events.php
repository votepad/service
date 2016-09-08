<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */

Route::set('ALL_EVENTS', 'events/all')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'showAll'
    ));

Route::set('NEW_EVENT', '<organization>/event/new')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'New'
    ));

Route::set('ADD_EVENT', 'event/add')
    ->defaults(array(
        'controller' => 'Events_Modify',
        'action'     => 'add'
    ));

Route::set('SHOW_EVENT', 'events/<eventname>(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'show'
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

/*Route::set('EVENTS', 'events(/<id>(/<action>))')
    ->filter(function($route, $params, $request){

        $id = Arr::get($params, 'id');
        if ( !Model_Events::EventExist($id) || !isset($id))
            return false;

    })
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'index',
    ));*/