<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller_Test
 * @author Votepad team
 * @copyright Turov Nikolai
 * @version 0.0.1
 */

class Controller_Test extends Dispatch {

    public $template = 'test/file';

    public function action_index()
    {
        // path to file
        // example:
        //$this->template->file      = View::factory('emailtemplates/confirm_email');


        $this->template->file      = View::factory('emailtemplates/confirm_email');

    }
}
