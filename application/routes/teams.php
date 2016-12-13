<?php


/**
 * Route for team creation
 * data needs to be send via POST
 *
 * @example http://pronwe.ru/teams/add/3
 *
 * @params [INT] id_event - Event identity
 *
 */
Route::set("ADD_TEAM", 'teams/add/<id_event>', array(
        'id_event' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Teams_Modify',
        'action'     => 'add'
    ));

/**
 * Route to delete a team
 * Only XMLHTTP request
 *
 * @example http://pronwe.ru/teams/delete/3/10
 *
 * @params [INT] id_event - event identity
 * @params [INT] id_team - team identity
 */
Route::set("DELETE_TEAM", "teams/delete/<id_event>/<id_team>", array(
        'id_event' => $DIGIT,
        'id_team'  => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Teams_Ajax',
        'action'     => 'delete'
    ));
