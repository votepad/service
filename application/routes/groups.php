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
 * @example http://pronwe.local/group/delete/3
 *
 */
Route::set('REMOVE_GROUP', 'group/delete/<id_group>',
    array(

        'id_group' => $DIGIT

    ))->defaults(array(
        'controller' => 'Groups_Ajax',
        'action'     => 'delete'
    ));