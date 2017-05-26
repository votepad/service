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

        $result = [];

        foreach ( $cursor as $id => $value ) {

            if (isset($params['contests']) && $params['contests']) {

                $result[] = $this->getMemberContestResult($value);

            } else if (isset($params['stages']) && $params['stages']) {

                $result[] = $this->getMemberStageResult($value);

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
        $members = [];

        $members['id'] = $collectionData['member'];
        $members['total'] = $collectionData['total']['result'];

        return $members;

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
        $member['id'] = $collectionData['member'];

        foreach ($collectionData['total']['contests'] as $key => $value) {
            $member['contest'] = array(
                ['id' => $key,
                'total' => $value]
            );
        }

        return $member;
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

        $member['id'] = $collectionData['member'];

        foreach ($collectionData['total']['stages'] as $key => $value) {

            list($contest, $stage) = explode('-', $key);

            $member['contest'] = array(
                ['id' => $contest,
                'stages' => array([
                    'id' => $stage,
                    'total' => $value
                ])]
            );

        }
        
        return $member;
    }
}