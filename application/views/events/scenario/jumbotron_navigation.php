<?
    $active = Request::$current->action();

    $btns = array(
        'criterias' => array(
            'uri' => URL::site('event/' . $id . '/scenario/criterias'),
            'name' => "Критерии"
        ),
        'stages' => array(
            'uri' => URL::site('event/' . $id . '/scenario/stages'),
            'name' => "Этапы"
        ),
        'contests' => array(
            'uri' => URL::site('event/' . $id . '/scenario/contests'),
            'name' => "Конкурсы"
        ),
        'result' => array(
            'uri' => URL::site('event/' . $id . '/scenario/result'),
            'name' => "Результат"
        )
    );

    echo View::factory('events/blocks/jumbotron_nav', array('active' => $active, 'btns' => $btns));

?>
