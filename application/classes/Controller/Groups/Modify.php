<?php

class Controller_Groups_Modify extends Dispatch {

    public function before()
    {
        $this->auto_render = false;
        $this->checkCsrf();

        parent::before();
    }

    public function action_add()
    {
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $id_event = Arr::get($_POST, 'id_event');
        $mode = Arr::get($_POST, 'mode') && Arr::get($_POST, 'participants') ? 'participants' : 'teams';

        /** Create a group */
        $newGroup = new Model_Groups();

        $newGroup->name = $name;
        $newGroup->description = $description;
        $newGroup->id_event = $id_event;
        $newGroup->mode = $mode;

        $id_group = $newGroup->save()->id;

        switch ($mode) {

            case 'participants':
                $this->addMembers( $id_group, Arr::get($_POST, 'participants') );
                break;
            case 'teams':
                $this->addMembers( $id_group, Arr::get($_POST, 'teams') );
                break;

        }

        $this->redirect( $this->request->referrer() );

    }

    private function addMembers($id_group, $members) {

        foreach ($members as $member) {
            Methods_Groups::addGroupMembers($id_group, $member);
        }

    }

}