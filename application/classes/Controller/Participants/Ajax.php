<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Participants_Ajax extends Ajax
{
    public function before()
    {

        /** For XMLHHTP */
        if (!parent::is_ajax()) {
            throw new HTTP_Exception_404();
        }

        $this->auto_render = false;
        parent::before();
    }

    public function action_add()
    {
        $response = "true";

        try {

            $decodedData = json_decode(Arr::get($_POST, 'list'), true);

            $id_event    = $this->request->param('id_event');

            foreach($decodedData as $participant) {

                $model_participants = new Model_Participants();

                $model_participants->name  = Arr::get($participant,'name','');
                $model_participants->about = Arr::get($participant,'about','');
                $model_participants->photo = Arr::get($participant,'photo','');

                /**
                 * Different action depending on status
                 */
                if ($participant['status'] == Methods_Participants::INSERT) {

                    $id = $model_participants->save();

                    Methods_Participants::setParticipantEventEntry($id_event, $id);

                } else if ($participant['status'] == Methods_Participants::UPDATE) {

                    $participant = Methods_Participants::getParticipantByFieldName('id', $participant['id']);
                    $id = $participant['id'];

                    $model_participants->save($id);

                } else if ($participant['status'] == Methods_Participants::DELETE) {

                    $id = $participant['id'];
                    Methods_Participants::removeParticipant($id);
                    Methods_Teams::removeParticipantFromTeam(null, $id);

                }
            }

        } catch (Exception $exception) {

            // do some stuff
            $response = "false";

        }

        echo $response;
    }

    public function action_get()
    {
        $response = "true";

        $id_event = $this->request->param('id_event');

        $participants = Methods_Participants::getParticipantsFromEvent($id_event);

        foreach($participants as $part) {
            $arr[] = array(
                'id' => $part->id,
                'photo' => $part->photo ?: "",
                'name' => $part->name,
                'about' => $part->about ?: "",
                'status' => ''
            );
        }
        $this->response->body(@json_encode($arr));

    }


}
