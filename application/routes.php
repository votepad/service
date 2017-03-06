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
Route::set('AUTH', 'sign/<mode>(/<additional>)')
    ->filter(function ($route, $params, $request) {

        $params['controller'] = 'Auth';
        $params['action']     = 'Action';
        $params['mode'] = ucfirst($params['mode']);

        $params['controller'] = $params['controller'] . '_' . $params['mode'];
        $params['action']     = 'auth';

        // log out action
        if (!empty($params['additional'])) {
            $params['action'] = 'logout';
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
Route::set('IMAGE_TRANSPORT', 'transport')
    ->defaults(array(
        'controller' => 'Transport',
        'action'     => 'file_uploader'
    ));

require_once ('routes/welcome.php');
require_once ('routes/profile.php');
require_once ('routes/ui.php');
require_once ('routes/organizations.php');
require_once ('routes/events.php');
require_once ('routes/participants.php');
require_once ('routes/teams.php');
require_once ('routes/groups.php');
require_once ('routes/ajax.php');

// Route::set('Default', '<controller>(/<action>(/<id>))')
//     ->defaults(array(
//         'controller' => 'Welcome',
//         'action'     => 'Index',
//     ));
?>
