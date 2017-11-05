<?php

Route::set("CONTEST_AJAX", 'contest/<action>')
    ->defaults(array(
        'controller' => 'Contests_Ajax',
    ));