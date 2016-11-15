<?php defined('SYSPATH') or die('No direct plan access.');
/**
* Routes for module Events
* @author NWE team
* @copyright Turov Nikolay
* @version 0.2.0
 */


Route::set('ALL_EVENTS', 'events/all')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'showAll'
    ));

Route::set('NEW_EVENT', '<organizationpage>/event/new')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'New'
    ));

Route::set('ADD_EVENT', 'event/add')
    ->defaults(array(
        'controller' => 'Events_Modify',
        'action'     => 'add'
    ));

Route::set('CONTROL_MAIN', '<organizationpage>/<eventpage>/control(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'ControlMain'
    ));

Route::set('MANAGE_MAIN', '<organizationpage>/<eventpage>/settings(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'ManageMain'
    ));

Route::set('PLAN_MAIN', '<organizationpage>/<eventpage>/plan(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'PlanMain'
    ));

Route::set('CHARACTERS_MAIN', '<organizationpage>/<eventpage>/characters(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'CharactersMain'
    ));

Route::set('EVENTPAGE_MAIN', '<organizationpage>/<eventpage>(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'EventPage'
    ));

Route::set('ADD_FULLDEplanION', 'addfulldeplanion')
    ->defaults(array(
        'controller' => 'Events_Modify',
        'action'     => 'addFullDeplanion'
    ));
