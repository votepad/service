<ul class="jumbotron__nav-list">
    <li class="col-sm-6 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/settings/info'); ?>">
            О мероприятии
        </a>
    </li>
    <li class="col-sm-6 jumbotron__nav-item">
        <a class="jumbotron__nav-btn" href="<?=URL::site('event/' . $event->id . '/settings/assistants'); ?>">
            Помощники
        </a>
    </li>
</ul>
