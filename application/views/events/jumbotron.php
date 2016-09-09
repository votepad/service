<div class="event-block" style="height:340px;">
    <div class="event-background" style="background-image: url(<?=$assets; ?>img/temp/bg3.jpg);">
        <div class="event-background-black"></div>
        <header>
            <div class="left-nav pull-left">
                <ul class="no-li">
                    <li class="inline">
                        <a href="#" class="header-link">VotePad</a>
                    </li>
                    <li class="inline">
                        <a href="<?=URL::site('organization/' . $organization->id); ?>" class="header-link"><?=$organization->name; ?></a>
                    </li>
                    <li class="inline">
                        <div class="dropdown">
                            <button class="dropdown-toggle drop-orgs" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-ellipsis-v header-link" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">ifmo</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="//pronwe/organization/new"><i class="fa fa-plus" aria-hidden="true"></i>Добавить организацию</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="right-nav pull-right">
                <ul class="no-li">
                    <li class="inline">
                        <a href="" class="header-link" style="display:none">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Другие мероприятия
                        </a>
                    </li>
                    <li class="inline" style="margin-right: 20px;">
                        <div class="dropdown">
                            <button class="dropdown-toggle header-link" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?=$user->lastname. ' ' . $user->name; ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Персональные настройки</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?=URL::site(''); ?>">Выйти из системы</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <div class="event-name">
            <h1><?=$event['name']; ?></h1>
        </div>
        <div class="event-date">
            <div class="start-date" data-toggle="tooltip" data-placement="top" title="Начнётся в 12:00">
                <div class="weekday">Сб</div>
                <div class="day">17</div>
                <div class="month">сентября</div>
            </div>
            <div class="event-pad">
                <i class="fa fa-2x fa-angle-double-right" aria-hidden="true"></i>
            </div>
            <div class="end-date" data-toggle="tooltip" data-placement="top" title="Завершится в 17:00">
                <div class="weekday">Вс</div>
                <div class="day">18</div>
                <div class="month">сентября</div>
            </div>
        </div>
        <div class="event-feedback">
            <button class="md-btn md-btn-lg md-btn-labeled md-btn-primary" data-toggle="modal" data-target="#edit_main_event_info">
                <span class="md-btn-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> изменить главную информацию
            </button>
        </div>
    </div>
    <div class="event-nav-block" style="display:block">
        <div class="event-nav">
            <a href="<?=URL::site(); ?>" class="md-btn active">
                О мероприятии
                <div class="active-tab"></div>
            </a>
            <a href="<?=URL::site(); ?>" class="md-btn">
                Участники и жюри
                <div class="active-tab"></div>
            </a>
            <a href="<?=URL::site(); ?>" class="md-btn">
                Конкурсы
                <div class="active-tab"></div>
            </a>
            <a href="<?=URL::site(); ?>" class="md-btn">
                Логика оценивания
                <div class="active-tab"></div>
            </a>
            <a href="<?=URL::site(); ?>" class="md-btn">
                Публикация
                <div class="active-tab"></div>
            </a>
        </div>
    </div>
</div>