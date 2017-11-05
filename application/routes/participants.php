<?php defined('SYSPATH') or die('No direct pattern access.');


Route::set('PARTICIPANT_AJAX', 'participant/<action>')
    ->defaults(array(
       'controller' => 'Participants_Ajax',
    ));