<?php

Class Methods_Api extends Model
{
    public function getAllEvents($params)
    {
        $sort = Arr::get($params, 'sort', '');
        $sorting_field = Arr::get($params, 'sorting_field');
        $sorting_type = Arr::get($params, 'sorting_type');
        $count = Arr::get($params, 'count');

        $selection = Dao_Events::select();

        if ($sort) {
            $selection = $selection->order_by($sorting_field ?: 'id', $sorting_type ?: 'ASC');
        }

        if ($count) {
            $selection = $selection->limit($count);
        }

        $selection = $selection->execute();
        return $selection;
    }

    public function getResults($params)
    {
        $mongo = Dispatch::MongoConnection();

        $collectionString = 'event' . $params['id_event'];
        $collection = $mongo->votepad->$collectionString;

        $cursor = $collection->find();

        $result = array();

        foreach ( $cursor as $id => $value ) {

            $memberId = $value['member'];
            if (isset($params['contests']) && $params['contests']) {

                $result[$memberId]['overall'] = $this->getMemberContestResult($value);

            } else if (isset($params['stages']) && $params['stages']) {

                $result[$memberId]['overall'] = $this->getMemberStageResult($value);

            } else if (isset($params['criterions']) && $params['criterions']) {

                $result[$memberId]['overall'] = $this->getMemberCriterionsResult($value);

            } else {

                $result[$memberId]['overall'] = $this->getMemberTotal($value);

            }

            if (isset($params['judges']) && $params['judges']) {

                if (isset($params['contests']) && $params['contests']) {

                    $result[$memberId]['judges'] = $this->getMemberContestResultByJudges($value);

                } else if (isset($params['stages']) && $params['stages']) {

                    $result[$memberId]['judges'] = $this->getMemberStageResultByJudges($value);

                } else if (isset($params['criterions']) && $params['criterions']) {

                    $result[$memberId]['judges'] = $this->getMemberCriterionsResultByJudges($value);

                } else {

                    $result[$memberId]['judges'] = $this->getMemberTotalByJudges($value);

                }

            }


        }

        return $result;
    }

    /**
     * @param $collectionData
     * @return array [
     *                  'memberId' => $id,
     *                  'total' => $total'
     *              ]
     */
    public function getMemberTotal($collectionData)
    {

        return $collectionData['total']['result'];

    }

    public function getMemberTotalByJudges($collectionData)
    {

        $judges = array();
        foreach ($collectionData['scores'] as $judgeData) {

            $judges[$judgeData['judge']]['total'] = $judgeData['result'];

        }

        return $judges;

    }

    /**
     * @param $collectionData
     * @return array [
     *                  'memberId' => $id,
     *                  'contests' => [
     *                                  0 => [
     *                                      'id' -> contest id,
     *                                      'total' -> score
     *                                  ]
     *                                  .......
     *                              ]
     *               ]
     */
    public function getMemberContestResult($collectionData)
    {
        $member = [];

        foreach ($collectionData['total']['contests'] as $key => $value) {
            $member[$key] = $value;
        }

        return $member;
    }

    public function getMemberContestResultByJudges($collectionData)
    {
        $judges = array();
        foreach ($collectionData['scores'] as $judgeData) {

            $judges[$judgeData['judge']]['total'] = $judgeData['result'];

            foreach ($judgeData['contests'] as $id => $score) {
                $judges[$judgeData['judge']][$id] = $score;
            }

        }

        return $judges;

    }

    /**
     * @param $collectionData
     * @return array [
     *                  'memberId' => $id,
     *                  'contests' => [
     *                           0 => [
     *                               'id' -> contest id,
     *                                'stages' => [
     *                                      0 => [
     *                                          'id' -> stage id
     *                                          'total' -> score
     *                                      ]
     *                                 ]
     *                          ]
     *                      .......
     *                 ]
     *              ]
     *
     */
    public function getMemberStageResult($collectionData)
    {

        $member = [];
        foreach ($collectionData['total']['stages'] as $key => $value) {

            list($contest, $stage) = explode('-', $key);

            if (empty($member[$contest])) {
                $member[$contest] = array(
                        $stage => $value
                );
            } else {
                $member[$contest][$stage] = $value;
            }

        }

        foreach ($collectionData['total']['contests'] as $key => $value) {

            $member[$key]['total'] = $value;

        }

        $member['total'] = $collectionData['total']['result'];

        return $member;
    }

    public function getMemberStageResultByJudges($collectionData)
    {
        $judges = array();
        foreach ($collectionData['scores'] as $judgeData) {

            $judges[$judgeData['judge']]['total'] = $judgeData['result'];

            foreach ($judgeData['stages'] as $key => $score) {

                list($contest, $stage) = explode('-', $key);

                if (empty( $judges[$judgeData['judge']][$contest])) {
                    $judges[$judgeData['judge']][$contest] = array($stage => $score);
                } else {
                    $judges[$judgeData['judge']][$contest][$stage] = $score;
                }

            }

            foreach ($judgeData['contests'] as $id => $score) {
                $judges[$judgeData['judge']][$id]['total'] = $score;
            }



        }

        return $judges;
    }

    public function getMemberCriterionsResult($collectionData)
    {

        $member = [];
        foreach ($collectionData['total']['criterions'] as $key => $value) {

            list($contest, $stage, $criterion) = explode('-', $key);

            if (empty($member[$contest])) {
                $member[$contest] = array(
                    $stage => array(
                        $criterion => $value
                    )
                );
            } else {

                if (empty($member[$contest][$stage])) {
                    $member[$contest][$stage] = array($criterion => $value);
                } else {
                    $member[$contest][$stage][$criterion] = $value;
                }

            }

        }

        foreach ($collectionData['total']['stages'] as $key => $value) {

            list($contest, $stage) = explode('-', $key);

            $member[$contest][$stage]['total'] = $value;

        }

        foreach ($collectionData['total']['contests'] as $key => $value) {

            $member[$key]['total'] = $value;

        }

        $member['total'] = $collectionData['total']['result'];

        return $member;
    }

    public function getMemberCriterionsResultByJudges($collectionData)
    {
        $judges = array();

        foreach ($collectionData['scores'] as $judgeData) {

            foreach ($judgeData['criterions'] as $key => $score) {

                list($contest, $stage, $criterion) = explode('-', $key);

                if (empty($judges[$judgeData['judge']][$contest])) {
                    $judges[$judgeData['judge']][$contest] = array(
                        $stage => array(
                            $criterion => $score
                        )
                    );
                } else {
                    if (empty($judges[$judgeData['judge']][$contest][$stage])) {
                        $judges[$judgeData['judge']][$contest][$stage] = array($criterion => $score);
                    } else {
                        $judges[$judgeData['judge']][$contest][$stage][$criterion] = $score;
                    }

                }

            }

            foreach ($judgeData['stages'] as $key => $score) {

                list($contest, $stage) = explode('-', $key);

                $judges[$judgeData['judge']][$contest][$stage]['total'] = $score;

            }

            foreach ($judgeData['contests'] as $id => $score) {
                $judges[$judgeData['judge']][$id]['total'] = $score;
            }

            $judges[$judgeData['judge']]['total'] = $judgeData['result'];

        }

        return $judges;
    }

}