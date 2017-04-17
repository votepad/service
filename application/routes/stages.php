<?php


Route::set("ADD_STAGE", 'stages/add/<id_event>', array(
        'id_event' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Stages_Modify',
        'action'     => 'add'
    ));

Route::set("DELETE_STAGE", "stages/delete/<id_stage>", array(
        'id_stage'  => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Stages_Ajax',
        'action'     => 'delete'
    ));

Route::set('EDIT_STAGE', "stages/edit/<id_event>", array(
        'id_event' => $DIGIT
    ))
    ->defaults(array(
       'controller' => 'Stages_Modify',
        'action'    => 'edit'
    ));
