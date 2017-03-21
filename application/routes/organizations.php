<?php
/**
 * @author Khaydarov Murod
 * @author Khaydarov Murod <murod.haydarov@gmail.com>
 *
 * @copyright Khaydarov Murod
 *
 * All routes for organization events.
 */

/**
 * Route for organization creation
 * Works with all requests
 */
Route::set('NEW_ORGANIZATION', 'organization/new')
    ->defaults(array(
        'controller' => 'Organizations_Index',
        'action'     => 'new'
    ));

/**
 * Route for form execution. Saves data
 * Inserts to database
 */
Route::set('ADD_ORGANIZATION', 'organization/add')
    ->defaults(array(
        'controller' => 'Organizations_Modify',
        'action'     => 'add'
    ));

/**
 * Route for making organization removed (flag = 1)
 * Only XMLHTTP requests
 *
 * @property int $id - organization identifier
 */
Route::set('DELETE_ORGANIZATION', 'organization/<id>/delete', array('id' => $DIGIT))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'delete'
    ));
/**
 * Recover organization.
 * only XMLHTTP requests
 *
 * @property int $id - organization identifier
 */
Route::set('REESTABLISH_ORGANIZATION', 'organization/<id>/reestablish',
    array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'reestablish'
    ));

/**
 * Main route of organization
 *
 * @property int $id - organization identifier
 */
Route::set('SHOW_ORGANIZATION', 'organization(/<id>)',
    array(
        'id' => $DIGIT
    ))
    ->defaults(array(
       'controller'  => 'Organizations_Index',
        'action'     => 'show'
    ));

/**
 * Route for organizaion management
 * Only admin has access to this page
 *
 * @property $id - organization identifier
 * @property $action - settings section
 */
Route::set('ORGANIZATIONS_SETTINGS', 'organization/<id>/settings/<action>',
    array(
        'id' => $DIGIT,
        'action' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Organizations_Index',
        'action'     => 'main'
    ));

/**
 * Route for form execution.
 * Updates information about organization
 *
 * @property int $id - organization identifier
 */
Route::set('UPDATE_ORGANIZATION', 'organization/<id>/update',
    array(
        'id' => $DIGIT,
    ))
    ->defaults(array(
        'controller' => 'Organizations_Modify',
        'action'     => 'update'
    ));

/**
 * Route for management
 * only for XMLHTTP requests
 * updates any fields with ajax
 *
 * @property $id - organization identifier
 * @returns Boolean json encoded response
 */
Route::set('UPDATE_ORGANIZATION_FIELDS', 'organization/<id>/update_with_ajax',
    array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'update'
    ));

/**
 * Route for inspection
 * only for XMLHTTP requests
 * checks email existance
 *
 * @property $email - organization identifier
 * @example http://pronwe.ru/organization/checkemail/test@test.ru
 *
 * @returns Boolean json encoded response
 */
Route::set('CHECK_ORGANIZATION_EMAIL', 'organization/checkemail/<email>',
    array(
        'email' => '[^/,;?]++'
    ))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'checkEmail'
    ));

/**
 * Route for inspection
 * only for XMLHTTP requests
 * checks website existance
 *
 * @property $website - organization identifier (use without nwe.ru afterfix)
 * @example http://pronwe.ru/organization/checkwebsite/ifmo
 *
 * @returns Boolean json encoded response
 */
Route::set('CHECK_ORGANIZATION_WEBSITE', 'organization/checkwebsite/<uri>',
    array(
        'uri' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'checkWebsite'
    ));

Route::set('JOIN_TO_ORGANIZATION', 'organization/<id>/join', array('id' => $DIGIT, 'hash' => $STRING))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'join'
    ));

Route::set('MEMBERS_ACTIONS', 'organization/<id>/member/<method>/<userid>', array('id' => $DIGIT, 'userid' => $DIGIT, 'method' => 'add|remove|reject'))
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'member'
    ));