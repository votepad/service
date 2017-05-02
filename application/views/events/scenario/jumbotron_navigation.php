<?
    $btns = array(
        0 => array(
            'uri' => URL::site('event/' . $event->id . '/scenario/criterias'),
            'name' => "Критерии",
            'flag' => URL::site('event/' . $event->id . '/scenario/criterias') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        1 => array(
            'uri' => URL::site('event/' . $event->id . '/scenario/stages'),
            'name' => "Этапы",
            'flag' => URL::site('event/' . $event->id . '/scenario/stages') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        2 => array(
            'uri' => URL::site('event/' . $event->id . '/scenario/contests'),
            'name' => "Конкурсы",
            'flag' => URL::site('event/' . $event->id . '/scenario/contests') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        3 => array(
            'uri' => URL::site('event/' . $event->id . '/scenario/result'),
            'name' => "Результат",
            'flag' => URL::site('event/' . $event->id . '/scenario/result') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        )
    );
?>

<ul class="jumbotron__nav-list">

    <? foreach ($btns as $btn) : ?>
        <li class="col-sm-3 jumbotron__nav-item">
            <a class="jumbotron__nav-btn <?=$btn['flag']; ?>" href="<?=$btn['uri']; ?>">
                <?=$btn['name']; ?>
            </a>
        </li>
    <? endforeach; ?>

</ul>
