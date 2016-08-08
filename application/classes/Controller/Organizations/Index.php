<?php
/**
 * Class Organizations_Index
 * @author Pronwe team
 * @copyright Khaydarov Murod
 */

class Controller_Organizations_Index extends Dispatch
{
    public $template = 'org/main';

    public function before()
    {
        if ($this->request->action() == 'new')
            $this->template = 'org/new_logged';

        parent::before();
    }

    /** New organization form */
    public function action_new()
    {

    }

    /** Shows organization */
    public function action_show()
    {
        
    }

    /** Shows list of organizations */
    public function action_showAll()
    {

    }
}