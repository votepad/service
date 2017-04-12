<?php

/**
 * Class Controller_Judges_Ajax
 */
class Controller_Judges_Ajax extends Ajax {

    public function action_save()
    {
        $response = array();

        try {

            $decodedData = json_decode(Arr::get($_POST, 'list'), true);

            foreach($decodedData as $judge) {

                $model = new Model_Judge(Arr::get($judge, 'id'));
                $event = $this->request->param('id_event');

                $model->name     = Arr::get($judge,'name','');
                $model->password = Arr::get($judge,'password','');

                $status = Arr::get($judge, 'status');

                switch ($status) {
                    case Methods_Judges::UPDATE:
                        $model = $model->update();
                        break;
                    case Methods_Judges::INSERT:
                        $model->event = $event;
                        $model = $model->save();
                        break;
                    case Methods_Judges::DELETE:
                        $model->delete();
                        break;
                }


                if ($status != Methods_Judges::DELETE) {
                    $response[] = array(
                        'id' => $model->id,
                        'name' => $model->name,
                        'password' => $model->password,
                        'status' => ''
                    );
                }


            }

        } catch (Exception $exception) {

            $response = false;

        }

        usort($response, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        $this->response->body(@json_encode($response));
    }

    public function action_get()
    {
        $id_event = $this->request->param('id_event');

        $judges = Methods_Judges::getByEvent($id_event);

        $arr = array();

        foreach($judges as $judge) {
            $arr[] = array(
                'id'     => $judge->id,
                'name'   => $judge->name,
                'password'  => $judge->password ?: "",
                'status' => ''
            );
        }
        $this->response->body(@json_encode($arr));

    }



}