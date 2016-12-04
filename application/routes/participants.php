<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Add participants to event
 * Handles JSON object
 * Only XMLHTTP requests
 *
 * @params [Int] id_event - Identify of event
 * @example http://pronwe.ru/participants/add/3
 */
Route::set('ADD_PARTICIPANTS', 'participants/add/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
       'controller' => 'Participants_Ajax',
        'action' => 'add'
    ));

/**
 * Returns the list of participants from event
 *
 * @params [INT] id_event - identify of event
 * @example http://pronwe.ru/participants/get/3
 */
Route::set('GET_PARTICIPANTS', 'participants/get/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
        'controller' => 'Participants_Ajax',
        'action' => 'get'
    ));