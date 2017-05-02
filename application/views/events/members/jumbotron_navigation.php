<?
    $active = Request::$current->action();

    $btns = array(
        'judges' => array(
            'uri' => URL::site('event/' . $id . '/members/judges'),
            'name' => "Члены жюри"
        ),
        'participants' => array(
            'uri' => URL::site('event/' . $id . '/members/participants'),
            'name' => "Участники"
        ),
        'teams' => array(
            'uri' => URL::site('event/' . $id . '/members/teams'),
            'name' => "Команды"
        ),
    );

    echo View::factory('events/blocks/jumbotron_nav', array('active' => $active, 'btns' => $btns));

?>
