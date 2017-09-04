<?php defined('SYSPATH') or die('No direct pattern access.');
/**
 * @author Votepad Team
 * @copyright Turov Nikolay
 */

/**
* Features of votepad
*/
Route::set('Features', 'features')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'features'
    ))
    ->cache();
