<?php
/**
 * @author Pronwe Team
 * @copyright Khaydarov Murod
 */

Route::set('NEW_ORGANIZATION', 'organization/new')
    ->defaults(array(
        'controller' => 'Organizations_Index',
        'action'     => 'new'
    ));

Route::set('ADD_ORGANIZATION', 'organization/add')
    ->defaults(array(
        'controller' => 'Organizations_Modify',
        'action'     => 'add'
    ));

Route::set('DELETE_ORGANIZATION', 'organization/<id>/delete')
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'delete'
    ));

Route::set('REESTABLISH_ORGANIZATION', 'organization/<id>/reestablish')
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'reestablish'
    ));

Route::set('SHOW_ORGANIZATION', 'organization(/<id>)')
    ->defaults(array(
       'controller'  => 'Organizations_Index',
        'action'     => 'show'
    ));

Route::set('SHOW_ALL_ORGANIZATIONS', 'organizations')
    ->defaults(array(
        'controller' => 'Organizations_Index',
        'action'     => 'showAll'
    ));

Route::set('ORGANIZATIONS_SETTINGS', 'organization/<id>/settings/<action>')
    ->defaults(array(
        'controller' => 'Organizations_Index',
        'action'     => 'main'
    ));


Route::set('UPDATE_ORGANIZATION', 'organization/<id>/update')
    ->defaults(array(
        'controller' => 'Organizations_Modify',
        'action'     => 'update'
    ));

Route::set('UPDATE_ORGANIZATION_FIELDS', 'organization/<id>/update_with_ajax')
    ->defaults(array(
        'controller' => 'Organizations_Ajax',
        'action'     => 'update'
    ));