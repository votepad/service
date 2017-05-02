<ul class="jumbotron__nav-list">
    <li class="col-sm-4 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/members/judges'); ?>">
            Члены жюри
        </a>
    </li>
	<li class="col-sm-4 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/members/participants'); ?>">
            Участники
        </a>
    </li>
    <li class="col-sm-4 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/members/teams'); ?>">
            Команды
        </a>
    </li>
    <!--<li class="col-sm-3 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/members/groups'); ?>">
            Группы
        </a>
    </li>-->
</ul>
