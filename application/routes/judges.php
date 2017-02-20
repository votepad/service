<?php defined('SYSPATH') or die('No direct plan access.');
/**
* Routes for module Events
* @author NWE team
* @copyright Turov Nikolay
* @version 0.3.0
 */

 Route::set('Judges_panel', 'judges')
      ->defaults(array(
          'controller' => 'Judges_Index',
          'action'     => 'votingpanel'
      ));
