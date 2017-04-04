<ul class="jumbotron_nav-list">
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/result'); ?>">
            Результат
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/contests'); ?>">
            Конкурсы
        </a>
    </li>
	<li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/stages'); ?>">
            Этапы
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/scenario/criterias'); ?>">
            Критерии
        </a>
    </li>
</ul>