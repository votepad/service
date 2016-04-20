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
        $data['title']                = Arr::get($_POST, 'input-event-name');
        $data['description']          = Arr::get($_POST, 'input-event-description');
        $data['event_status']         = Arr::get($_POST, 'input-event-status');
        $data['event_start-date']     = Arr::get($_POST, 'input-event-start');
        $data['event_finish-date']    = Arr::get($_POST, 'input-event-end');
        $data['event_city']           = Arr::get($_POST, 'input-event-city');
        $data['event_type']           = Arr::get($_POST, 'input-event-type');
        $data['photo']                = $_FILES['input-event-photo']['name'];

        Model_Uploader::fileTransport($_FILES, 'input-event-photo');

        $model_events = new Model_Events();
        $model_events->NewEvent($data);
        $result = $model_events->save();

        if ($result)
            $this->redirect('/events/my');

    }

    function action_addParticipant()
    {
        $id_event = $this->request->param('id');

        $k = 0;
        for($i = 0; $i < count($_POST) / 2; $i++)
        {
            $k++;
            $name           = $_POST['participant_name_'. $k];
            $description    = $_POST['participant_description_'. $k];
            $photo          = $_FILES['participant_photo_'. $k]['name'] ?: 'no-user.png';

            $model_participant = new Model_Participants($id_event, $name, $description, $photo);

            $model_participant->save();

            if ($photo != 'no-user.png') {
                $model_uploader = new Model_Uploader($_FILES['participant_photo_' . $k], 'participant_photo', $k);
                $model_uploader->upload();
            }
        }

        $this->redirect('/events/'. $id_event . '/edit' );
    }

    function action_addStage()
    {
        $id_event = $this->request->param('id');

        $stageNameIndex         = 1;
        $stageDescriptionIndex  = 1;

        foreach($_POST as $item => $value)
        {
            if ($item == 'stage_name_' . $stageNameIndex) {
                $stageName[] = $value;
                $stageNameIndex++;
            }

            if ($item == 'stage_description_' . $stageDescriptionIndex) {
                $stageDescription[] = $value;
                $stageDescriptionIndex ++ ;
            }
        }

        $criteriaNameIndex  = 1;
        $criteriaScoreIndex = 1;

        for($i = 1; $i < $stageNameIndex; $i++)
        {

            $model_stages = new Model_Stages();
            $id_stage = $model_stages->insertStages($stageName[$i - 1], $stageDescription[$i - 1], $id_event);
            $model_stages->block($id_stage);
            
            foreach($_POST as $item => $value)
            {
                $str1 = 'criterion-name_'. $i . '_' . $criteriaNameIndex ;
                $str2 = 'criterion-maxscore_'. $i . '_' . $criteriaScoreIndex;

                if ($item == $str1)
                {
                    $criteriaName[$i]['name'][] = $value;
                    $criteriaNameIndex ++;
                }

                if ($item == $str2)
                {
                    $criteriaScore[$i]['score'][] = $value;
                    $criteriaScoreIndex ++;
                }
            }

            for($j = 1; $j < $criteriaNameIndex; $j++)
                $model_stages->insertCriteria($criteriaName[$i]['name'][$j - 1], $criteriaScore[$i]['score'][$j - 1], $id_stage);

            $criteriaNameIndex  = 1;
            $criteriaScoreIndex = 1;
        }

        $this->redirect('/events/'. $id_event . '/edit' );
    }
}