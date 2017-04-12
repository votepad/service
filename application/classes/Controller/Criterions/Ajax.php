<?php

/**
 * Class Controller_Criterions_Ajax
 */
class Controller_Criterions_Ajax extends Ajax {

    public function action_save()
    {
        $response = array();
        try {

            $decodedData = json_decode(Arr::get($_POST, 'list'), true);

            foreach($decodedData as $criteria) {

                $model              = new Model_Criterion(Arr::get($criteria, 'id'));
                $event              = $this->request->param('id_event');
                $model->name        = Arr::get($criteria,'name','');
                $model->description = Arr::get($criteria,'description','');
                $model->min_score   = Arr::get($criteria,'min_score','0');
                $model->max_score   = Arr::get($criteria,'max_score','1');
                $status             = Arr::get($criteria, 'status');

                switch ($status) {
                    case Methods_Criterions::UPDATE:
                        $model = $model->update();
                        break;
                    case Methods_Criterions::INSERT:
                        $model->event = $event;
                        $model = $model->save();
                        break;
                    case Methods_Criterions::DELETE:
                        $model->delete();
                        break;
                }

                if ($status != Methods_Criterions::DELETE) {
                    $response[] = array(
                        'id'            => $model->id,
                        'name'          => $model->name,
                        'description'   => $model->description,
                        'min_score'     => $model->min_score,
                        'max_score'     => $model->max_score,
                        'status'        => ''
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
        $criterias = Methods_Criterions::getByEvent($id_event);
        $arr = array();
        foreach($criterias as $criteria) {
            $arr[] = array(
                'id'            => $criteria->id,
                'name'          => $criteria->name,
                'description'   => $criteria->description,
                'min_score'     => $criteria->min_score,
                'max_score'     => $criteria->max_score,
                'status'        => ''
            );
        }

        $this->response->body(@json_encode($arr));
    }
}