<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Routes for module Events
 * @copyright Votepad Team
 */


/**
 * Route for event creation
 */
Route::set('NEW_EVENT', 'event/new')
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'event_new'
    ));


/**
 * Route for event lanfing page.
 *
 * @property String $action - action in controller
 * @property [Function] $actioncallback - this callback defines is route allowed to the section or not
 * @example http://votepad.ru/event/<id>(/<action>)
 */
$actioncallback = function(Route $route, $params, Request $request){

    $allowedRoutes = array(
        'landing',
        'results'
    );

    if (!in_array($params['action'], $allowedRoutes)) {
        return false;
    }
};

Route::set('EVENT_ACTION', 'event/<id>(/<action>)',
    array(
        'id'     => $DIGIT,
        'action' => $STRING
    ))
    ->filter($actioncallback)
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'landing'
    ));

/**
 * Route for Back Office
 *
 * @property String $action - controller action
 * @property [Function] $sectioncallback - this callback defines is route allowed to the section or not
 *
 * @example http://votepad.ru/event/<id>/<section>(/<action>)
 */
$sectioncallback = function(Route $route, $params, Request $request){

    $allowedRoutes = array(
        'settings' => array(
            'info', 'assistants'
        ),
        'scenario' => array(
            'criterions', 'stages', 'contests', 'result'
        ),
        'members' => array(
            'judges', 'participants', 'teams'
        ),
        'control' => array(
            'scores'/*, 'plan'*/
        )
    );

    if (!isset($params['section']) || !in_array($params['action'], $allowedRoutes[$params['section']])) {
        return false;
    }

};
Route::set('EVENT_SECTION_ACTION', 'event/<id>/<section>/<action>',
    array(
        'id' => $DIGIT,
    ))
    ->filter($sectioncallback)
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'ControlMain'
    ));

/**
 * Router for inviting assistant to event
 */
Route::set('INVITE_ASSISTANT', 'event/<id>/invite/<hash>', array(
        'id' => $DIGIT,
        'hash' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Events_Index',
        'action'     => 'invite_assistant'
    ));


Route::set('PUBLISH_EVENT', 'event/result/<method>',
    array(
        'method' => 'publish|unpublish'
    ))
    ->defaults(array(
        'controller' => 'Events_Ajax',
        'action'     => 'result'
    ));

/**
 * Route for Event Ajax actions
 */
Route::set('EVENT_AJAX', 'event/<action>',
    array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Events_Ajax'
    ));
