<?php

class Controller_Judges_Modify extends Controller {

    function action_addjudge()
    {
        $id_event = $this->request->param('id');

        $k = 0;

        for($i = 0; $i < count($_POST) / 3 ; $i++)
        {
            $k++ ;
            $name       = $_POST['judgename_' . $k];
            $email      = $_POST['judge_email_' . $k];
            $position   = $_POST['judge_status_' . $k];
            $photo      = $_FILES['judge_photo_' . $k]['name'] ?: 'no-user.png';

            $model_judge = new Model_Judge($id_event, $name, $email, $position, $photo);
            $model_judge->save();

            if ($photo != 'no-user.php') {
                $model_uploader = new Model_Uploader($_FILES['judge_photo_' . $k], 'judge_photo', $k);
                $model_uploader->upload();
            }
        }

        $this->redirect('/events/'. $id_event . '/edit' );
    }
}