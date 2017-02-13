<?php

/**
 *
 * Class Controller_Groups_Ajax
 */
class Controller_Groups_Ajax extends Ajax {

    public function action_delete()
    {
        /** @var  $id_group - group identity */
        $id_group = $this->request->param('id_group');
    }

}