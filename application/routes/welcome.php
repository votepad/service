<?php defined('SYSPATH') or die('No direct pattern access.');

/**
* Agreement of votepad
*/
Route::set('AGREEMENT_USERS', 'agreement')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'agreement'
    ));