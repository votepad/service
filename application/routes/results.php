<?php


Route::set("SAVE_RESULT", 'results/save/<id_event>', array(
        'id_event' => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Results_Modify',
        'action'     => 'save'
    ));
