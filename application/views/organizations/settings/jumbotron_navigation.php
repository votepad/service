<?
    $active = Request::$current->action();

    $btns = array(
        'main' => array(
            'uri' => URL::site('organization/' . $id . '/settings/main'),
            'name' => "Об организации"
        ),
        'team' => array(
            'uri' => URL::site('organization/' . $id . '/settings/team'),
            'name' => "Сотрудники"
        )
    );

    echo View::factory('organizations/blocks/jumbotron_nav', array('active' => $active, 'btns' => $btns));

?>
