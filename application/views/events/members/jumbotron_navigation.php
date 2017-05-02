<?
    $btns = array(
        0 => array(
            'uri' => URL::site('event/' . $event->id . '/members/judges'),
            'name' => "Члены жюри",
            'flag' => URL::site('event/' . $event->id . '/members/judges') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        1 => array(
            'uri' => URL::site('event/' . $event->id . '/members/participants'),
            'name' => "Участники",
            'flag' => URL::site('event/' . $event->id . '/members/participants') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        2 => array(
            'uri' => URL::site('event/' . $event->id . '/members/teams'),
            'name' => "Команды",
            'flag' => URL::site('event/' . $event->id . '/members/teams') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
    );

?>

<ul class="jumbotron__nav-list">

    <? foreach ($btns as $btn) : ?>
    <li class="col-sm-4 jumbotron__nav-item">
        <a class="jumbotron__nav-btn <?=$btn['flag']; ?>" href="<?=$btn['uri']; ?>">
            <?=$btn['name']; ?>
        </a>
    </li>
    <? endforeach; ?>

</ul>
