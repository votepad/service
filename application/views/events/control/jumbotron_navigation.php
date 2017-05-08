<?
    $active = Request::$current->action();

    $btns = array(
        'scores' => array(
            'uri' => URL::site('event/' . $id . '/control/scores'),
            'name' => "Результаты"
        ),
        'plan' => array(
            'uri' => URL::site('event/' . $id . '/control/plan'),
            'name' => "План"
        )
    );

    echo View::factory('events/blocks/jumbotron_nav', array('active' => $active, 'btns' => $btns));
?>
