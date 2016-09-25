<div class="columns-area clearfix">
    <div class="left-column" style="width: 70%">
        <div class="panel panel-default block">
            <div class="panel-body">
                <div class="row">
                    <!-- SEARCHING PARAM -->
                    <div class="form-group search-block">
                        <div class="col-md-7 col-xs-12">
                            <label class="control-label">Поиск мероприятия</label>
                            <input name="event_name" type="text" class="form-control input-sm">
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <label class="control-label">Сортировать по</label>
                            <select class="form-control input-sm" name="event_sort">
                                <option></option>
                                <option>Название мероприятия</option>
                                <option>Дата начала мероприятия</option>
                            </select>
                        </div>

                        <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                            <label class="control-label">Тип</label>
                            <select class="form-control input-sm" name="event_type">
                                <option></option>
                                <option>Черновик</option>
                                <option>Виден всем</option>
                                <option>Виден команде</option>
                            </select>
                        </div>
                    </div>

                    <!-- LIST OF EVENTS -->
                    <ul id="events_list" class="text-center">
                        <? for($i = 0; $i < count($events); $i++) : ?>
                        <li class="event-group">
                            <div class="event-wrapper">
                                <div class="event-shot">
                                    <div class="event-image" style="background: url(<?=$assets; ?>img/bg2.jpg) no-repeat;"></div>
                                    <a class="event-link" href="<?=URL::site('events/' . $events[$i]['name']); ?>">
                                        <div class="event-preview">
                                            <h2 class="event_name_search"><?=$events[$i]['name']; ?></h2>
                                            <p><?=$events[$i]['short_description']; ?></p>
                                            <span class="event_time_search"><?=$events[$i]['start_time']; ?></span>
                                            <small class="event_type_search">черновик</small>
                                        </div>
                                    </a>
                                    <div class="event-result" style="display: block">
                                        <a href="#/tnl/rating" data-toggle="tooltip" data-placement="top" title="Рейтинг">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="event-footer">
                                    <ul class="event-footer-left">
                                        <li class="li">
                                            <div class="">
                                                <button data-toggle="dropdown" class="md-btn item">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li class="vk">
                                                        <a href="#">
                                                            <i class="fa fa-vk" aria-hidden="true"></i>
                                                            <span>Вконтакте</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="facebook">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                                            <span>Facebook</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="twitter">
                                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                                            <span>Twitter</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="li">
                                            <button type="button" class="md-btn item" data-toggle="tooltip" data-placement="bottom" title="Связаться с организатором" onclick="open_feedback_form(email)">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    <ul class="event-footer-right">
                                        <li class="fav">
                                            <button type="button" class="md-btn">
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                                <span>165</span>
                                            </button>
                                        </li>
                                        <li class="views">
                                            <div class="div-views md-btn" data-toggle="tooltip" data-placement="bottom" title="Просмотров">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <span>215</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <? endfor; ?>
                    </ul>
                    <div id="count_events" class="text-center"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="right-column">
        <div class="panel panel-default block">
            <div class="panel-heading">Быстрый старт</div>
            <div class="panel-body">
                <a href="<?=URL::site($organization->website . '/event/new'); ?>" class="md-btn md-btn-md quick-start">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Создать мероприятие
                </a>
                <a href="<?=URL::site($organization->website . '/settings/team'); ?>" class="md-btn md-btn-md quick-start">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    Пригласить организатора
                </a>
            </div>
        </div>

        <div class="panel panel-default block">
            <div class="panel-heading">Календарь мероприятий</div>
            <div class="panel-body">
                в разработке ...
            </div>
            <div class="panel-footer">

            </div>
        </div>

        <div class="panel panel-default block">
            <div class="panel-heading">Последние активности</div>
            <div class="panel-body">
                <ul>
                    <li class="log-activites no-li" style="border-left: 3px solid blue">
                        <small>7 мая</small>
                        <p>
                            Иван Иванов создал(а) новое мероприятие
                            <a href="#/tnl"  class="md-btn md-btn-xs">
                                Федеральный конкурс Ты нужен людям
                            </a>
                        </p>
                    </li>
                    <li class="log-activites no-li" style="border-left: 3px solid red">
                        <small>1 мая</small>
                        <p>
                            Иван Иванов изменил(а) мероприятие
                            <a href="#/missitmo"  class="md-btn md-btn-xs">
                                Мисс ИТМО
                            </a>
                        </p>
                    </li>
                </ul>
                <a href="orgpage-settings-logs.html" class="md-btn md-btn-xs" style="color: #bbb">
                    Посмотреть всю историю
                </a>
            </div>
            <div class="panel-footer">
                <ul>
                    <li class="logs-description no-li inline">
                        <span class="inline" style="background-color: blue"></span>
                        <p class="inline">Новое мероприятие</p>
                    </li>
                    <li class="logs-description no-li inline">
                        <span class="inline" style="background-color: red"></span>
                        <p class="inline">Измененное мероприятие</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default block">
            <div class="panel-heading">
                Организаторы
                <a href="orgpage-settings-team.html" class="pull-right">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                </a>
            </div>
            <div class="panel-body">
                <ul>
                    <li class="person-in-team no-li">
                        <img class="inline" src="<?=$assets; ?>img/user/02.jpg">
                        <div class="inline">
                            <p>Иван ИвановИван ИвановИван ИвановИван ИвановИван Иванов</p>
                            <small>основатель организацииИван ИвановИван Иванов</small>
                        </div>
                    </li>
                    <li class="person-in-team no-li">
                        <img class="inline" src="<?=$assets; ?>img/user/01.jpg">
                        <div class="inline">
                            <p>Екатерина Иванова</p>
                            <small>модератор</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="../../../assets/vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-all.js"></script>
