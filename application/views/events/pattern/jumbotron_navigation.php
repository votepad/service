<ul class="jumbotron_nav-list">
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/results'); ?>">
            Результат
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/contests'); ?>">
            Конкурсы
        </a>
    </li>
	<li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/stages'); ?>">
            Этапы
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/criterias'); ?>">
            Критерии
        </a>
    </li>
</ul>