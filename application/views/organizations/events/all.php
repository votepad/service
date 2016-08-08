<div class="row columns-area">

    <!-- LEFT COLUMN -->
    <div class="left-column" ng-controller="eventsCtrl as event">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <!-- SEARCHING PARAM -->
                    <div class="search-block">
                        <md-input-container class="col-md-7 col-xs-12">
                            <label>Поиск мероприятия</label>
                            <input ng-model="event.search.name">
                        </md-input-container>

                        <md-input-container class="col-md-3 col-xs-6">
                            <label>Сортировать по</label>
                            <md-select ng-model="event.search.sort">
                                <md-option class="md-select-md" ng-repeat="param in event.sortparam" value="{{param.id}}" md-ink-ripple="#64b5f6">
                                    {{param.name}}
                                </md-option>
                            </md-select>
                        </md-input-container>

                        <md-input-container class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                            <label>Тип</label>

                            <md-select ng-model="event.search.type" >
                                <md-option class="md-select-md" ng-repeat="param in event.typeparam" value="{{param.id}}" md-ink-ripple="#64b5f6">
                                    {{param.name}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>

                    <!-- LIST OF EVENTS -->
                    <ul class="text-center">
                        <li class="event-group" ng-repeat="event in events = (event.eventInfo| filter:event.search.name | filter: {type: event.search.type} | orderBy: event.search.sort)">
                            <div class="event-wrapper">
                                <div class="event-shot">
                                    <div class="event-image" style="background: url(../../assets/img/{{event.logo}}) no-repeat;"></div>
                                    <a class="event-link" href="#/{{event.link}}">
                                        <div class="event-preview">
                                            <h2>{{event.name}}</h2>
                                            <p>{{event.shortdescription}}</p>
                                            <span>{{event.startdata | date:"d MMMM 'в' HH:mm "}}</span>
                                            <small>{{event.type | eventType}}</small>
                                        </div>
                                    </a>
                                    <div class="event-result" style="display: {{event.rating | eventRating }}">
                                        <md-button ng-href="#/{{event.link}}/rating" aria-label="Rating" data-toggle="tooltip" data-placement="top" title="Рейтинг">
                                            <md-icon md-svg-icon="../../assets/img/icons/rating.svg"></md-icon>
                                        </md-button>
                                    </div>
                                </div>
                                <div class="event-footer">
                                    <ul class="event-footer-left">
                                        <li>
                                            <md-menu-bar>
                                                <md-menu>
                                                    <button class="md-button" aria-label="Settings" ng-click="$mdOpenMenu()">
                                                        <md-icon md-svg-icon="../../assets/img/icons/cog.svg"></md-icon>
                                                    </button>
                                                    <md-menu-content class="md-menu-sm" width="1">
                                                        <md-menu-item>
                                                            <md-button ng-href="#/{{event.link}}/edit">
                                                                <md-icon md-svg-icon="../../assets/img/icons/edit.svg"></md-icon>
                                                                Редактировать
                                                            </md-button>
                                                        </md-menu-item>
                                                        <md-menu-item>
                                                            <md-button ng-href="#" aria-label="DeleteEvent">
                                                                <md-icon md-svg-icon="../../assets/img/icons/trash-o.svg" style="color: #f47f7f"></md-icon>
                                                                Удалить
                                                            </md-button>
                                                        </md-menu-item>
                                                    </md-menu-content>
                                                </md-menu>
                                            </md-menu-bar>
                                        </li>
                                        <li>
                                            <md-menu-bar>
                                                <md-menu ng-controller="ShareCtrl as share">
                                                    <button class="md-button" aria-label="Share" ng-click="$mdOpenMenu()">
                                                        <md-icon md-svg-icon="../../assets/img/icons/share2.svg"></md-icon>
                                                    </button>
                                                    <md-menu-content class="md-menu-sm" width="1">
                                                        <md-menu-item ng-repeat="item in share.array" class="{{item.class}}">
                                                            <md-button ng-href="" socialshare
                                                                       socialshare-provider="{{item.id}}"
                                                                       socialshare-text="{{event.name}}"
                                                                       socialshare-description="{{event.shortdescription}}"
                                                                       socialshare-hashtags="{{event.hashtags}}"
                                                                       socialshare-url="#/{{event.link}}"
                                                                       socialshare-media="http://pronwe.ru/assets/img/{{event.logo}}">
                                                                <md-icon md-svg-icon="{{item.icon}}"></md-icon>
                                                                {{item.name}}
                                                            </md-button>
                                                        </md-menu-item>
                                                    </md-menu-content>
                                                </md-menu>
                                            </md-menu-bar>
                                        </li>
                                        <li>
                                            <button class="md-button" ng-href="#/{{event.link}}/feedback" aria-label="Feedback" data-toggle="tooltip" data-placement="bottom" title="Связаться с организатором">
                                                <md-icon md-svg-icon="../../assets/img/icons/feedback.svg"></md-icon>
                                            </button>
                                        </li>
                                    </ul>
                                    <ul class="event-footer-right">
                                        <li class="fav">
                                            <md-button ng-href="" aria-label="Likes" md-ink-ripple="#f47f7f">
                                                <md-icon md-svg-icon="../../assets/img/icons/fav.svg"></md-icon>
                                                <span>{{event.likes}}</span>
                                                </md-buttn>
                                        </li>
                                        <li class="views">
                                            <div class="div-views" aria-label="Views" data-toggle="tooltip" data-placement="bottom" title="Просмотров">
                                                <img src="../../assets/img/icons/eye.svg">
                                                <span>{{event.views}}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center">
                        {{ events.length | countEvent }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="right-column">
        <div class="panel panel-default">
            <div class="panel-heading">Быстрый старт</div>
            <div class="panel-body">
                <md-button ng-href="new-event.html" class="md-btn md-btn-md" md-ink-ripple="#64b5f6" aria-label="newEvent">
                    <md-icon class="quick-start-icon" md-svg-icon="../../assets/img/icons/add.svg"></md-icon>
                    Создать мероприятие
                </md-button>
                <md-button ng-href="orgpage-settings-team.html" class="md-btn md-btn-md" md-ink-ripple="#64b5f6" aria-label="newUser">
                    <md-icon class="quick-start-icon" md-svg-icon="../../assets/img/icons/sendmail.svg"></md-icon>
                    Пригласить организатора
                </md-button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Календарь мероприятий</div>
            <div class="panel-body">
                в разработке ...
            </div>
            <div class="panel-footer">

            </div>
        </div>

        <div class="panel panel-default" ng-controller="logCtrl as logs">
            <div class="panel-heading">Последние активности</div>
            <div class="panel-body">
                <ul>
                    <li class="log-activites no-li" ng-repeat="log in logs.logInfo | orderBy: '-date' | limitTo: 3" style="border-left: 3px solid {{log.type | getTypeofLog}};">
                        <small>{{log.date | date:"d MMMM"}}</small>
                        <p>
                            {{log.iduser | userName}} {{log.type | getLogAction}}
                            <md-button ng-href="#/{{log.idevent | eventLink}}" aria-label="logs" class="md-btn md-btn-xs" md-ink-ripple="#64b5f6">
                                {{log.idevent | eventName}}
                            </md-button>
                        </p>
                    </li>
                </ul>
                <md-button ng-href="orgpage-settings-logs.html" class="md-btn md-btn-xs" aria-label="logsHistory" md-ink-ripple="#64b5f6" style="color: #bbb">
                    Посмотреть всю историю
                </md-button>
            </div>
            <div class="panel-footer">
                <ul>
                    <li class="logs-description no-li inline" ng-repeat="item in logs.logDesc">
                        <span class="inline" style="background-color: {{item.color}}"></span>
                        <p class="inline">{{item.name}}</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default" ng-controller="teamCtrl as team">
            <div class="panel-heading">
                Организаторы
                <a href="orgpage-settings-team.html" class="pull-right">
                    <md-icon class="panel-top-right-link-icon" md-svg-icon="../../assets/img/icons/edit.svg"></md-icon>
                </a>
            </div>
            <div class="panel-body">
                <ul>
                    <li class="person-in-team no-li" ng-repeat="person in team.teamInfo">
                        <img class="inline" src="../../assets/img/user/{{person.avatar}}">
                        <p class="inline">{{person.name}}</p>
                        <small>{{person.position}}</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>