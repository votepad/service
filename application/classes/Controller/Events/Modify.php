<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 13.03.2016
 * Time: 13:01
 */

class Controller_Events_Modify extends Controller {

    function action_add()
    {
        $data['title']          = Arr::get($_POST, 'input-event-name');
        $data['description']    = Arr::get($_POST, 'input-event-description');
        $data['event_status']   = Arr::get($_POST, 'input-event-status');
        $data['event_start']    = Arr::get($_POST, 'input-event-start');
        $data['event_finish']   = Arr::get($_POST, 'input-event-end');
        $data['event_city']     = Arr::get($_POST, 'input-event-city');
        $data['event_type']     = Arr::get($_POST, 'input-event-type');

        $model_events = new Model_Events();
        $model_events->NewEvent($data);
        $result = $model_events->save();

        if ($result)
            $this->redirect('/events');

    }

    function action_addParticipant()
    {
        $id_event = $this->request->param('id');

        $k = 0;

        echo Debug::vars($_FILES);
        exit;

        for($i = 0; $i < count($_POST) / 3; $i++)
        {
            $k++;
            $name           = $_POST['participant_name_'. $k];
            $description    = $_POST['participant_description_'. $k];
            $photo          = $_POST['participant_photo_'. $k];

            $model_participant = new Model_Participants($id_event, $name, $description, $photo);

            $model_participant->save();
        }

        $this->redirect('/events/'. $id_event . '/edit' );
    }

    function action_addjudge()
    {
        $id_event = $this->request->param('id');

        $k = 0;
        for($i = 0; $i < count($_POST) /3 ; $i++)
        {
            $k++ ;
            $email      = $_POST['judge_email_' . $k];
            $position   = $_POST['judge_status_' . $k];
            $photo      = $_POST['judge_photo_' . $k];

            $model_judge = new Model_Judge($id_event, 'none', $email, $position, $photo);
            $model_judge->save();
        }

        $this->redirect('/events/'. $id_event . '/edit' );
    }
}