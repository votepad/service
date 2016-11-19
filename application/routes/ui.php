<?php defined('SYSPATH') or die('No direct plan access.');
/**
 * @author NWE Team
 * @copyright Turov Nikolay
 */

 Route::set('Template', 'ui')
     ->defaults(array(
         'controller' => 'ui',
         'action'     => 'main'
     ));


 Route::set('Typography', 'ui/typography')
     ->defaults(array(
         'controller' => 'ui',
         'action'     => 'typography'
     ));

 Route::set('Block', 'ui/blocks')
     ->defaults(array(
         'controller' => 'ui',
         'action'     => 'blocks'
     ));

 Route::set('Form', 'ui/forms')
     ->defaults(array(
         'controller' => 'ui',
         'action'     => 'forms'
     ));

Route::set('Buttons', 'ui/buttons')
   ->defaults(array(
       'controller' => 'ui',
       'action'     => 'buttons'
   ));

Route::set('Tables', 'ui/tables')
  ->defaults(array(
      'controller' => 'ui',
      'action'     => 'tables'
  ));
