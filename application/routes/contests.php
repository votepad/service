<?php


Route::set("ADD_CONTEST", 'contests/add/<id_event>', array(
        'id_event' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Contests_Modify',
        'action'     => 'add'
    ));

Route::set("DELETE_CONTESTS", "stages/delete/<id_contest>", array(
        'id_contest'  => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Contests_Ajax',
        'action'     => 'delete'
    ));

Route::set('EDIT_CONTESTS', "contests/edit/<id_contest>", array(
        'id_contest' => $DIGIT
    ))
    ->defaults(array(
       'controller' => 'Contests_Modify',
        'action'    => 'edit'
    ));
