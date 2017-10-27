<?php


Route::set("RESULT_AJAX", 'result/update')
    ->defaults(array(
        'controller' => 'Results_Ajax',
        'action'     => 'update'
    ));
