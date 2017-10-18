<?php defined('SYSPATH') or die('No direct pattern access.');

Route::set('CRITERIONS_AJAX', 'criterion/<action>')
    ->defaults(array(
        'controller' => 'Criterions_Ajax',
    ));