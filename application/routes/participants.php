<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Add participants to event
 * Handles JSON object
 * Only XMLHTTP requests
 *
 * @params [Int] id_event - Identify of event
 * @example http://pronwe.ru/addParticipantsTo/3
 */
Route::set('ADD_PARTICIPANTS', 'participants/add/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
       'controller' => 'Participants_Ajax',
        'action' => 'add'
    ));