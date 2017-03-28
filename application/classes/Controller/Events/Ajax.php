<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 */

class Controller_Events_Ajax extends Ajax {


    private $event = null;

    public function action_assistants() {

        $method = $this->request->param('method');

        $eventId = $this->request->param('id');
        $userId  = $this->request->param('uid');

        $this->event = new Model_Event($eventId);

        switch ($method) {
            case 'add':
                $this->addAssistant($userId);
                break;
            case 'remove':
                $this->removeAssistant($userId);
                break;
            case 'reject':
                $this->rejectAssistant($userId);
                break;
        }

    }

    private function addAssistant($id) {

        $this->event->addAssistant($id);

    }

    private function removeAssistant($id) {

        $this->event->removeAssistant($id);

    }

    private function rejectAssistant() {

    }


    public function action_checkwebsite()
    {
        if (Ajax::is_ajax()) {

            $uri = $this->request->param('website');
            $info = Model_Event::getByFieldName('uri', $uri);

            if (!empty($info)) {
                echo "true";
            } else {
                echo "false";
            }

        } else {
            die ('No direct access to this route');
        }
    }

}
