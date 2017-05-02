<ul class="jumbotron__nav-list">
    <li class="col-sm-3 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/criterias'); ?>">
            Критерии
        </a>
    </li>
    <li class="col-sm-3 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/stages'); ?>">
            Этапы
        </a>
    </li>
    <li class="col-sm-3 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/contests'); ?>">
            Конкурсы
        </a>
    </li>
    <li class="col-sm-3 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/result'); ?>">
            Результат
        </a>
    </li>
</ul>