<ul class="jumbotron_nav-list">
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/judges'); ?>">
            Члены жюри
        </a>
    </li>
	<li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/participants'); ?>">
            Участники
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/teams'); ?>">
            Команды
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/app/groups'); ?>">
            Группы
        </a>
    </li>
</ul>
