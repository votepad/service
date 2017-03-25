<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 *
 * Routes for module Events
 * @author NWE team
 * @author Khaydarov Murod
 *
 * @copyright Turov Nikolay
 *
 * @version 0.2.3
 */


/**
 * Route for event creation
 *
 * @property String $organizationpage - organization local website (without nwe.ru afterfix)
 */
Route::set('NEW_EVENT', 'organization/<id>/event/new',
    array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'new'
    ));


/**
 * This route checks website existance. Responces only for XMLHTTP requests
 *
 * @example http://pronwe.ru/events/check/ifmo.ru - returns JSON encoded Boolean responce.
 * @return [Boolean]
 */
Route::set('CHECK_EVENT_WEBSITE', 'events/check/<website>',
    array(
        'website' => $STRING
    ))
    ->defaults(array(
      'controller' => 'Events_Ajax',
      'action'     => 'checkwebsite'
    ));

/**
 * Route works with Database.
 * Validates POST data and inserts.
 * Hasn't properties
 */
Route::set('ADD_EVENT', 'event/add')
    ->defaults(array(
        'controller' => 'Events_Modify',
        'action'     => 'add'
    ));

/**
 * Route for event main page.
 *
 * @property String $organizationpage - organization website (without nwe.ru)
 * @property String $eventpage - events website (without nwe.ru)
 * @property String $action - action in controller
 *
 * @example http://pronwe.ru/ifmo/miss
 */
Route::set('EVENTPAGE_MAIN', 'event/<id>(/<action>)',
    array(
        'id' => $DIGIT,
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'landing'
    ));

/**
 * Route for backoffice
 *
 * @property String $action - controller action
 * @property [Function] $callback - this callback defines is route allowed to the section or not
 *
 * @example http://votepad.ru/event/<id>/<action>
 */
$callback = function(Route $route, $params, Request $request){

    $allowedAction = array(
        'settings', 'assistants',
        'control',
        'criterias', 'stages', 'contests', 'results',
        'judges', 'participants', 'teams', 'groups'
    );

    if (!in_array($params['action'])) {
        return false;
    }
};

Route::set('EVENT_MANAGEMENT', 'event/<id>/(/<action>)',
    array(
        'id' => $DIGIT,
        'action' => $STRING
    ))
    ->filter($callback)
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'ControlMain'
    ));
