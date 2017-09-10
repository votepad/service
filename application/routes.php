<?php defined('SYSPATH') or die('No direct script access.');

$DIGIT  = '\d+';
$STRING = '\w+';


/** Welcome page */
Route::set('Welcome_Page', '')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();

Route::set('API', 'access_token/<token>/method/<method_name>')
    ->defaults(array(
        'controller' => 'Api',
        'action' => 'Dispatcher'
    ));

/**
 * Route for file (image) uploading
 * Only for XMLHTTP requests
 */
Route::set('IMAGE_TRANSPORT', 'transport/<type>')
    ->defaults(array(
        'controller' => 'Transport',
        'action'     => 'upload'
    ));


require_once ('routes/welcome.php');
require_once ('routes/auth.php');
require_once ('routes/users.php');
require_once ('routes/organizations.php');
require_once ('routes/events.php');
require_once ('routes/participants.php');
require_once ('routes/judges.php');
require_once ('routes/teams.php');
require_once ('routes/criterions.php');
require_once ('routes/ajax.php');
require_once ('routes/judges.php');
require_once ('routes/stages.php');
require_once ('routes/contests.php');
require_once ('routes/results.php');

?>
