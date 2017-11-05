<?php


Route::set("RESULT_AJAX", 'result/<action>')
    ->defaults(array(
        'controller' => 'Results_Ajax',
    ));
