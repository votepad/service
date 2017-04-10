<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Participants_Ajax extends Ajax
{
    public function action_save()
    {
        $response = array();

        try {

            $decodedData = json_decode(Arr::get($_POST, 'list'), true);

            foreach($decodedData as $participant) {

                $model = new Model_Participant(Arr::get($participant, 'id'));
                $event = $this->request->param('id_event');

                $model->name  = Arr::get($participant,'name','');
                $model->about = Arr::get($participant,'about','');
                $model->photo = Arr::get($participant,'photo','');

                $status = Arr::get($participant, 'status');

                switch ($status) {
                    case Methods_Participants::UPDATE:
                        $model = $model->update();
                        break;
                    case Methods_Participants::INSERT:
                        $model->event = $event;
                        $model = $model->save();
                        break;
                    case Methods_Participants::DELETE:
                        $model->delete();
                        continue;
                        break;
                }

                $response[] = array(
                    'id'     => $model->id,
                    'photo'  => $model->photo ?: "",
                    'name'   => $model->name,
                    'about'  => $model->about ?: "",
                    'status' => ''
                );


            }

        } catch (Exception $exception) {

            $response = false;

        }

        $this->response->body(@json_encode($response));
    }

    public function action_get()
    {
        $id_event = $this->request->param('id_event');

        $participants = Methods_Participants::getByEvent($id_event);

        $arr = array();

        foreach($participants as $part) {
            $arr[] = array(
                'id'     => $part->id,
                'photo'  => $part->photo ?: "",
                'name'   => $part->name,
                'about'  => $part->about ?: "",
                'status' => ''
            );
        }
        $this->response->body(@json_encode($arr));

    }


}
