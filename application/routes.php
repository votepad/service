<?php defined('SYSPATH') or die('No direct script access.');

/**
* Set the routes. Each route must have a minimum of a name, a URI and a set of
* defaults for the URI.
*/

/**
 * MEDIA FILES
 */

Route::set('media', 'media/<action>(/<path>)', array('path' => '.*?',))
    ->defaults(array(
        'controller' => 'media',
        'action' => 'index',
    ));

/**
 * Default
 */

Route::set('DEFAULT', '(<controller>(/<action>(/<id>)))')
            ->defaults(array(
            'controller' => 'welcome',
            'action'     => 'index',
            ));

Route::set('AUTH', '(<controller>(/<action>))', array('controller' => 'auth|registration'))
    ->defaults(array(
        'controller' => 'auth',
        'action' => 'index',
    ));

?>


