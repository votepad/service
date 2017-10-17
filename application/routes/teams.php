<?php

Route::set("TEAM_AJAX", "team/<action>")
    ->defaults(array(
        'controller' => 'Teams_Ajax',
    ));