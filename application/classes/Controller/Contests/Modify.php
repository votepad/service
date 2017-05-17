<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contests_Modify extends Dispatch {

    public function before() {

        $this->auto_render = false;
        parent::before();
        $this->checkCsrf();

    }

    /**
     * Add stage to Event
     */
    public function action_add()
    {

        $id_event = $this->request->param('id_event');

        /** @var $referrer - URL to redirect */
        $referrer = $this->request->referrer();

        $contest = new Model_Contest();
        $contest->name         = Arr::get($_POST, 'name');
        $contest->description  = Arr::get($_POST, 'description');
        $contest->mode         = Arr::get($_POST, 'new_mode');
        $contest->formula      = Arr::get($_POST, 'formula');
        $contest->event        = $id_event;
        $contest = $contest->save();
        Methods_Contests::saveJudges($contest->id, Arr::get($_POST, 'judges', array()));

        $this->redirect($referrer);

    }

    /**
     * Change contest information
     */
    public function action_edit()
    {

        $id     = $this->request->param('id_contest');
        $judges = Arr::get($_POST, 'judges');

        $contest = new Model_Contest($id);

        if (!$contest->id) {
            throw new HTTP_Exception_404();
        }

        $contest->name        = Arr::get($_POST, 'name', $contest->name);
        $contest->description = Arr::get($_POST, 'description', $contest->description);
        $contest->mode        = Arr::get($_POST, 'edit_mode');
        $contest->formula     = Arr::get($_POST, 'formula', $contest->formula);
        $contest->update();

        Methods_Contests::updateJudges($contest->id, $judges);

        $this->redirect($this->request->referrer());

    }

}
