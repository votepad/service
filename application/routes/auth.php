<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @team Votepad team
 * @author Turov Nikolay
 */

/**
 * Authentication
 */
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
Route::set('SINGUP', 'signup')
    ->defaults(array(
        'controller'  => 'SignUp',
        'action'      => 'index',
    ));

/**
 * Confirm email
 */
Route::set('CONFIRM_EMAIL', 'confirm/<mode>/<hash>')
    ->filter(function ($route, $params, $request) {

        $params['controller'] = 'Auth';
        $params['action']     = 'confirm';
        $params['mode'] = ucfirst($params['mode']);

        $params['controller'] = $params['controller'] . '_' . $params['mode'];

        return $params;

    });


/**
 * Reset Password for Organizer
 */
Route::set('RESET_PASSWORD_LINK', 'reset/<hash>')
    ->defaults(array(
        'controller' => 'Users_Index',
        'action'     => 'reset',
    ));