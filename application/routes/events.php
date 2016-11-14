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

Route::set('NEW_EVENT', '<organization>/event/new', array('organization' => '(.*)'))
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'New'
    ));

Route::set('ADD_EVENT', 'event/add')
    ->defaults(array(
        'controller' => 'Events_Modify',
        'action'     => 'add'
    ));

Route::set('SHOW_EVENT', 'events/<eventname>(/<action>)', array('eventname' => '!check'))
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'show'
    ));

Route::set('ADD_FULLDESCRIPTION', 'addfulldescription')
    ->defaults(array(
        'controller' => 'Events_Modify',
        'action'     => 'addFullDescription'
    ));

Route::set('CHECK_EVENT', 'events/check/<website>', array('website' => '[^/,;?]++'))
     ->filter(function(Route $route, $params, Request $request){

     })
     ->defaults(array(
         'controller' => 'Events_Ajax',
         'action'     => 'checkevent'
     ));