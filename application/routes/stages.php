<?php

Route::set("STAGE_AJAX", 'stage/<action>')
    ->defaults(array(
        'controller' => 'Stages_Ajax'
    ));
