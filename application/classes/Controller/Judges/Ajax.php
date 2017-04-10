<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 16.04.2016
 * Time: 13:13
 */

class Controller_Judges_Ajax extends Ajax {

    public function action_setScore()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $id_event       = Arr::get($_POST, 'id_event');
        $id_stage       = Arr::get($_POST, 'id_stage');
        $id_criteria    = Arr::get($_POST, 'id_criteria');
        $id_participant = Arr::get($_POST, 'id_participant');
        $id_judge       = Arr::get($_POST, 'id_judge');
        $score          = Arr::get($_POST, 'score');

        Model_Score::set($id_event, $id_participant, $id_stage, $id_criteria, $id_judge, $score);

        return true;
    }

    public function action_getCriteriaScore()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $id_participant = Arr::get($_POST, 'id_participant');
        $id_stage       = Arr::get($_POST, 'id_stage');
        $id_judge       = Arr::get($_POST, 'id_judge');

        $result = Model_Score::getCriteriasWithScores($id_judge, $id_stage, $id_participant);

        for($i = 0; $i < count($result); $i++)
        {
            $criteria = Model_Stages::getCriteria($result[$i]['id_criteria']);

            $ans[$i]['name'] = $criteria['name'];
            $ans[$i]['score'] = $result[$i]['score'];
        }
        echo json_encode($ans);
    }

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
                        continue;
                        break;
                }

                $response[] = array(
                    'id'     => $model->id,
                    'name'   => $model->name,
                    'about'  => $model->password,
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

        $judges = Methods_Judges::getByEvent($id_event);

        $arr = array();

        foreach($judges as $judge) {
            $arr[] = array(
                'id'     => $judge->id,
                'photo'  => $judge->photo ?: "",
                'name'   => $judge->name,
                'about'  => $judge->about ?: "",
                'status' => ''
            );
        }
        $this->response->body(@json_encode($arr));

    }



}