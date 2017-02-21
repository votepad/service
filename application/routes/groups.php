<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 *
 * Routes for module Groups
 * @author NWE team
 * @author Khaydarov Murod
 *
 *
 * @version 0.0.1
 */

Route::set('ADD_GROUP', 'group/add/<id_event>',
    array(

        'id_event' => $DIGIT

    ))->defaults(array(
        'controller' => 'Groups_Modify',
        'action'     => 'add'
    ));


/**
 * Route to remove group
 *
 * @example http://site.com/group/delete/3
 *
 */
Route::set('REMOVE_GROUP', 'group/delete/<id_group>',
    array(

        'id_group' => $DIGIT

    ))->defaults(array(
        'controller' => 'Groups_Ajax',
        'action'     => 'delete'
    ));

/**
 * Route for changing information about groups
 *
 * @example http://site.com/group/edit/3
 */
Route::set('EDIT_GROUP', 'group/edit/<id_group>',
    array(

        'id_group' => $DIGIT

    ))->defaults(array(
        'controller' => 'Groups_Modify',
        'action'     => 'edit'
    ));