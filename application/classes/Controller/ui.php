<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @author NWE team
 * @copyright Turov Nikolay
 */

class Controller_ui extends Dispatch
{

    public $template = 'ui/main';

    public function action_main()
    {
      $this->template->title = "UI";
      $this->template->main_section = View::factory('ui/default');
    }


    public function action_typography()
    {
      $this->template->title = "UI - Typography";
      $this->template->main_section = View::factory('ui/typography');
    }

    public function action_blocks()
    {
      $this->template->title = "UI - Blocks";
      $this->template->main_section = View::factory('ui/blocks');
    }

    public function action_forms()
    {
      $this->template->title = "UI - Forms";
      $this->template->main_section = View::factory('ui/forms');
    }

    public function action_buttons()
    {
      $this->template->title = "UI - Buttons";
      $this->template->main_section = View::factory('ui/buttons');
    }

    public function action_tables()
    {
      $this->template->title = "UI - Tables";
      $this->template->main_section = View::factory('ui/tables');
    }

}
