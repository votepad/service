<?php defined('SYSPATH') or die('No direct script access.');

$DIGIT  = '\d+';
$STRING = '\w+';

/**
 * Welcome page
 */
/*Route::set('Welcome_Page', '')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();*/

/**
 * Route for authentification
 *
 * @property String $action - login|logout
 */
Route::set('AUTH', 'auth(/<action>)')
    ->defaults(array(
        'controller' => 'Auth',
        'action' => 'index',
    ));

/**
 * Route for signing up
 */
Route::set('SINGUP', 'signup(/<action>)')
    ->defaults(array(
        'controller'  => 'SignUp',
        'action'      => 'index',
    ));

/**
 * Route for file (image) uploading
 * Only for XMLHTTP requests
 */
Route::set('IMAGE_TRANSPORT', 'transport')
    ->defaults(array(
        'controller' => 'Transport',
        'action'     => 'file_uploader'
    ));

require_once ('routes/welcome.php');
require_once ('routes/ui.php');
require_once ('routes/organizations.php');
require_once ('routes/events.php');
require_once ('routes/participants.php');
require_once ('routes/teams.php');
require_once ('routes/ajax.php');

?>
