<?
    $active = Request::$current->action();

    $btns = array(
        'info' => array(
            'uri' => URL::site('event/' . $id . '/settings/info'),
            'name' => "О мероприятии"
        ),
        'assistants' => array(
            'uri' => URL::site('event/' . $id . '/settings/assistants'),
            'name' => "Помощники"
        )
    );

    echo View::factory('events/blocks/jumbotron_nav', array('active' => $active, 'btns' => $btns));
?>
