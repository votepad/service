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

/** Authentification */
Route::set('AUTH', 'sign/<mode>(/<additional>)', array('additional' => 'logout|reset'))
    ->filter(function ($route, $params, $request) {

        $params['controller'] = 'Auth';
        $params['action']     = 'Action';
        $params['mode'] = ucfirst($params['mode']);

        $params['controller'] = $params['controller'] . '_' . $params['mode'];
        $params['action']     = 'auth';

        // log out action
        if (!empty($params['additional'])) {
            $params['action'] = $params['additional'];
        }

        return $params;

    });

/**
 * Route for signing up
 */
Route::set('SINGUP', 'signup(/<action>)', array('action' => 'check'))
    ->defaults(array(
        'controller'  => 'SignUp',
        'action'      => 'index',
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



Route::set('EMAIL_CONFIRMATION', 'confirm/<hash>')
    ->defaults(array(
        'controller' => 'SignUp',
        'action'     => 'confirmEmail'
    ));

Route::set('RESET_PASSWORD_LINK', 'reset/<hash>')
    ->defaults(array(
        'controller' => 'Auth_Organizer',
        'action'     => 'resetPassword'
    ));


require_once ('routes/welcome.php');
require_once ('routes/profile.php');
require_once ('routes/ui.php');
require_once ('routes/organizations.php');
require_once ('routes/events.php');
require_once ('routes/participants.php');
require_once ('routes/judges.php');
require_once ('routes/teams.php');
require_once ('routes/groups.php');
require_once ('routes/criterions.php');
require_once ('routes/ajax.php');
require_once ('routes/judges.php');
require_once ('routes/stages.php');
require_once ('routes/contests.php');
require_once ('routes/results.php');

// Route::set('Default', '<controller>(/<action>(/<id>))')
//     ->defaults(array(
//         'controller' => 'Welcome',
//         'action'     => 'Index',
//     ));

Route::set('TEST', 'test')
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'index'
    ));


?>
