<?php defined('SYSPATH') or die('No direct pattern access.');

Route::set('CRITERIONS_AJAX', 'criterions/<action>')
    ->defaults(array(
        'controller' => 'Criterions_Ajax',
    ));