<ul class="jumbotron_nav-list">
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/result'); ?>">
            Результат
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/contests'); ?>">
            Конкурсы
        </a>
    </li>
	<li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/stages'); ?>">
            Этапы
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/criterias'); ?>">
            Критерии
        </a>
    </li>
</ul>