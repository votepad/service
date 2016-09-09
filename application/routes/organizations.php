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
