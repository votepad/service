<?php defined('SYSPATH') or die('No direct pattern access.');


Route::set('Judges_panel', 'voting')
    ->defaults(array(
        'controller' => 'Judges_Index',
        'action'     => 'votingpanel'
    ));


/**
 * Judges Ajax Actions
 */
Route::set('JUDGES_AJAX', 'judge/<action>')
    ->defaults(array(
       'controller' => 'Judges_Ajax',
    ));