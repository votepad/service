<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Save criterias to event
 * Handles JSON object
 * Only XMLHTTP requests
 *
 * @params [Int] id_event - Identify of event
 * @example http://votepad.ru/criterias/save/3
 */
Route::set('SAVE_CRITERIONS', 'criterias/save/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
        'controller' => 'Criterions_Ajax',
        'action' => 'save'
    ));

/**
 * Returns the list of criterias from event
 *
 * @params [INT] id_event - identify of event
 * @example http://votepad.ru/criterias/get/3
 */
Route::set('GET_CRITERIONS', 'criterias/get/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
        'controller' => 'Criterions_Ajax',
        'action' => 'get'
    ));
