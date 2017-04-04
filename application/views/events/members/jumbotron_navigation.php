<ul class="jumbotron_nav-list">
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/members/judges'); ?>">
            Члены жюри
        </a>
    </li>
	<li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/members/participants'); ?>">
            Участники
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/members/teams'); ?>">
            Команды
        </a>
    </li>
    <li class="col-sm-3 jumbotron_nav-item">
        <a class="jumbotron_nav-btn" href="<?=URL::site('event/' . $event->id . '/members/groups'); ?>">
            Группы
        </a>
    </li>
</ul>
