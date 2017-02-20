<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Default Welcome page
 */

Route::set('Welcome_Page', '')
    ->filter(function(Route $route, $params, Request $request) {
        // code
    })
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();

/**
 * Authentifications
 */

Route::set('AUTH', 'auth(/<action>)')
    ->defaults(array(
        'controller' => 'Auth',
        'action' => 'index',
    ));

Route::set('SINGUP', 'signup(/<action>)')
    ->defaults(array(
        'controller'  => 'SignUp',
        'action'      => 'index',
    ));

Route::set('IMAGE_TRANSPORT', 'transport')
    ->defaults(array(
        'controller' => 'Transport',
        'action'     => 'file_uploader'
    ));



require_once ('routes/judges.php');
require_once ('routes/ui.php');
require_once ('routes/organizations.php');
require_once ('routes/events.php');
require_once ('routes/ajax.php');



?>
