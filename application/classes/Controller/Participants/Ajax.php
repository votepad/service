<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Participants_Ajax extends Ajax
{
    public function before()
    {
        $this->auto_render = false;
        parent::before();
    }

    public function action_add()
    {
        $response = "false";

        try {

            $decodedData = json_decode(Arr::get($_POST, 'list'), true);
            $id_event    = $this->request->param('id_event');

            foreach($decodedData as $participant) {

                $model_participants = new Model_Participants();

                $model_participants->name  = $participant['name'];
                $model_participants->about = $participant['description'];
                $model_participants->photo = $participant['avatar'];
                $model_participants->email = $participant['email'];

                /**
                 * Different action depending on status
                 */
                if ($participant['status'] == 'insert') {

                    $id = $model_participants->save();

                    Methods_Participants::setParticipantEventEntry($id_event, $id);

                } else if ($participant['status'] == 'update') {

                    $participant = Methods_Participants::getParticipantByFieldName('email', $participant['email']);
                    $id = $participant['id'];

                    $model_participants->save($id);

                }
            }

        } catch (Exception $exception) {

            // do some stuff
            $response = "true";

        }

        echo $response;
    }

}