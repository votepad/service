<?
    $btns = array(
        0 => array(
            'uri' => URL::site('event/' . $event->id . '/settings/info'),
            'name' => "О мероприятии",
            'flag' => URL::site('event/' . $event->id . '/settings/info') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        1 => array(
            'uri' => URL::site('event/' . $event->id . '/settings/assistants'),
            'name' => "Помощники",
            'flag' => URL::site('event/' . $event->id . '/settings/assistants') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        )
    );
?>

<ul class="jumbotron__nav-list">

    <? foreach ($btns as $btn) : ?>
        <li class="col-sm-6 jumbotron__nav-item">
            <a class="jumbotron__nav-btn <?=$btn['flag']; ?>" href="<?=$btn['uri']; ?>">
                <?=$btn['name']; ?>
            </a>
        </li>
    <? endforeach; ?>

</ul>
