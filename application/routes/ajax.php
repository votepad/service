<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */

Route::set('GetCriterias', 'getCriteasWithScores')
    ->defaults(array(
        'controller' => 'Judges_Ajax',
        'action'     => 'getCriteriaScore',
    ));

Route::set('ExtraScores', 'addExtraScore')
    ->defaults(array(
        'controller' => 'Judges_Settings_Modify',
        'action'     => 'addExtraScore',
    ));

Route::set('AjaxForEvents', 'deleteEvent')
    ->defaults(array(
        'controller' => 'Events_Ajax',
        'action'     => 'deleteEvent'
    ));

Route::set('AjaxForSubstances', 'updateEventsSubstance(/<action>)')
    ->defaults(array(
        'controller' => 'Events_Ajax',
        'action'     => 'index'
    ));

Route::set('AjaxSetScore', 'setScore')
    ->defaults(array(
        'controller' => 'Judges_Ajax',
        'action'     => 'setScore'
    ));

Route::set('AjaxBlockStages', 'block(/<action>)')
    ->defaults(array(
        'controller' => 'Judges_Settings_Ajax',
        'action'    => 'block',
    ));

Route::set('HideParticipants', 'hide')
    ->defaults(array(
        'controller' => 'Judges_Settings_Ajax',
        'action'     => 'getBlockedParticipants'
    ));