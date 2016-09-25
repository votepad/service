<div class="columns-area">
    <div class="left-column" style="width:100% ; padding-right: 0;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <!-- SEARCHING PARAM -->
                    <div class="form-group search-block">
                        <div class="col-md-9 col-xs-6">
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
</div>
<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-all.js"></script>
