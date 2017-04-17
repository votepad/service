<?php defined('SYSPATH') or die('No direct pattern access.');

Route::set('Judges_panel', 'judge/<id>', array('id' => $DIGIT))
    ->defaults(array(
        'controller' => 'Judges_Index',
        'action'     => 'votingpanel'
    ));

/**
 * Add judges to event
 * Handles JSON object
 * Only XMLHTTP requests
 *
 * @params [Int] id_event - Identify of event
 * @example http://pronwe.ru/judges/add/3
 */
Route::set('SAVE_JUDGE', 'judges/save/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
       'controller' => 'Judges_Ajax',
        'action' => 'save'
    ));

/**
 * Returns the list of judges from event
 *
 * @params [INT] id_event - identify of event
 * @example http://pronwe.ru/judges/get/3
 */
Route::set('GET_JUDGES', 'judges/get/<id_event>', array('id_event' => $DIGIT))
    ->defaults(array(
        'controller' => 'Judges_Ajax',
        'action' => 'get'
    ));
