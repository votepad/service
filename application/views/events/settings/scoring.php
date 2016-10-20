<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$title; ?></title>

    <link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/select2/dist/css/select2.css">

    <link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/cropper/dist/cropper.css">
    <link rel="stylesheet" type="text/css" href="<?=$assets;?>css/upload.css">
    <link rel="stylesheet" type="text/css" href="<?=$assets;?>css/app.css">
    <link rel="stylesheet" type="text/css" href="<?=$assets;?>css/event.css">

    <script type="text/javascript" src="<?=$assets;?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/jquery-validation/dist/jquery.validate.js"></script>

    <script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-popover.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>

    <script type="text/javascript" src="<?=$assets;?>vendor/select2/dist/js/select2.full.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/select2/dist/js/i18n/ru.js"></script>

    <script type="text/javascript" src="<?=$assets;?>vendor/cropper/dist/cropper.js"></script>
    <script type="text/javascript" src="<?=$assets;?>js/upload.js"></script>

    <script type="text/javascript" src="<?=$assets;?>vendor/sortable/Sortable.js"></script>
    <script type="text/javascript" src="<?=$assets;?>vendor/sortable/jquery.binding.js"></script>

    <script type="text/javascript" src="<?=$assets;?>js/events/event-edit-main-info.js"></script>
    <script type="text/javascript" src="<?=$assets;?>js/events/event-scoring.js"></script>
</head>
<body>


<div class="wrapper">


    <div class="content-wrapper">
        <!-- EVENT INFO -->
        <?=$event_jumbo; ?>


        <!-- SECTION START -->
        <div class="columns-area clearfix">

          <!-- LEFT COLUMN -->
          <div class="left-column">
            <div class="panel panel-default block">
              <div class="panel-heading">
                Конкурс №1.
                <strong class="inline">НАЗВ.КОНКУРСА</strong>
              </div>
              <div class="panel-body" id="competition_1">
                <div class="form-group">
                  <label>Жюри оценивает:</label>
                  <span>участников и группы</span>
                </div>
                <div class="form-group">
                  <label>Балл за конкурс, полученный участником</label>
                  <div class="input-group">
                    <span class="input-group-addon">=</span>
                    <ul id="competition_participant_1" class="form-control" disabled>
                      <li class="inline item" value="0.3">0.3</li>
                    </ul>
                    <div class="clear"><i class="fa fa-trash"></i></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Балл за конкурс, полученный группой</label>
                  <div class="input-group">
                    <span class="input-group-addon">=</span>
                    <ul id="competition_group_1" class="form-control" disabled></ul>
                    <div class="clear"><i class="fa fa-trash"></i></div>
                  </div>
                </div>
                <ul class="no-li form-group stages">
                  <li>
                    <div class="panel panel-default panel-sm">
                      <div class="panel-heading">
                        <span>Этап №1.</span>
                        <strong>НАЗВ.ЭТАПА</strong>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label>Жюри оценивает:</label>
                          <span>участников</span>
                          <br>
                          <label>Всего критериев:</label>
                          <span>3</span>
                        </div>
                        <div class="form-group">
                          <label>Балл за этап, полученный участником</label>
                          <div class="input-group">
                            <span class="input-group-addon">=</span>
                            <ul id="stage_participant_1_1" class="form-control" disabled></ul>
                            <div class="clear"><i class="fa fa-trash"></i></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Балл за этап, полученный группой</label>
                          <div class="input-group">
                            <span class="input-group-addon">=</span>
                            <ul id="stage_group_1_1" class="form-control" disabled></ul>
                            <div class="clear"><i class="fa fa-trash"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="panel panel-default panel-sm">
                      <div class="panel-heading">
                        <span>Этап №2.</span>
                        <strong>НАЗВ.ЭТАПА</strong>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label>Жюри оценивает:</label>
                          <span>группы</span>
                          <br>
                          <label>Всего критериев:</label>
                          <span>5</span>
                        </div>
                        <div class="form-group">
                          <label>Балл за этап, полученный участником</label>
                          <div class="input-group">
                            <span class="input-group-addon">=</span>
                            <ul id="stage_participant_1_2" class="form-control" disabled></ul>
                            <div class="clear"><i class="fa fa-trash"></i></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Балл за этап, полученный группой</label>
                          <div class="input-group">
                            <span class="input-group-addon">=</span>
                            <ul id="stage_group_1_2" class="form-control" disabled></ul>
                            <div class="clear"><i class="fa fa-trash"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>


          <!-- RIGHT COLUMN -->
          <div class="right-column">
            <div class="panel panel-default block">
              <div class="panel-heading" data-toggle="collapse" aria-expanded="true">
                Создание формулы
              </div>
              <div class="panel-body" id="creating_formulas">
                <div class="form-group">
                  <button id="edit_formulas" type="button" class="md-btn md-btn-sm md-btn-primary">Редактировать</button>
                </div>
                <div class="form-group">
                  <small>Перетащите элемент в нужную формулу, чтобы получилась формула.</small>
                </div>
                <div class="form-group">
                  <label>Коэффициенты</label>
                  <div class="elements_area clearfix">
                    <button class="inline item" id="add_number"><i class="fa fa-plus"></i></button>
                    <ul class="no-li inline" id="numbers_list">
                      <li class="inline item" value="0.3">0.3</li>
                      <li class="inline item" value="0.5">0.5</li>
                    </ul>
                  </div>
                </div>
                <div class="form-group">
                  <label>Математические символы</label>
                  <div class="elements_area clearfix">
                    <ul class="no-li" id="math_list">
                      <li class="inline item" value="+">+</li>
                      <li class="inline item" value="-">-</li>
                      <li class="inline item" value="*">*</li>
                      <li class="inline item" value="/">/</li>
                      <li class="inline item" value="¬">¬</li>
                      <li class="inline item" value="(">(</li>
                      <li class="inline item" value=")">)</li>
                    </ul>
                  </div>
                </div>
                <div class="form-group">
                  <label>Этапы</label>
                  <div class="elements_area clearfix">
                    <ul class="no-li inline" id="stages">
                      <li class="inline item" value="stage1">Балл за этап №1</li>
                      <li class="inline item" value="stage2">Балл за этап №2</li>
                    </ul>
                  </div>
                </div>
                <div class="form-group">
                  <label>Критерии</label>
                  <div class="elements_area clearfix">
                    <ul class="no-li inline" id="criterions">
                      <li class="inline item" value="criterion1">Балл по критерию №1</li>
                      <li class="inline item" value="criterion2">Балл по критерию №2</li>
                      <li class="inline item" value="criterion3">Балл по критерию №3</li>
                      <li class="inline item" value="criterion4">Балл по критерию №4</li>
                      <li class="inline item" value="criterion5">Балл по критерию №5</li>
                    </ul>
                  </div>
                </div>
                <div class="form-group">
                  <label>Участники</label>
                  <div class="elements_area clearfix">
                    <ul class="no-li inline" id="participants">
                      <li class="inline item" value="partscore">Балл, полученный учстником</li>
                    </ul>
                  </div>
                </div>
                <div class="form-group">
                  <label>Группы</label>
                  <div class="elements_area clearfix">
                    <ul class="no-li inline" id="groups">
                      <li class="inline item" value="groupscore">Балл, полученный группой</li>
                      <li class="inline item" value="grouppart">Количество участников в группе</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Modal EDIT MAIN EVENT INFO -->
          <div class="modal fade" id="edit_main_event_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Изменение основной информации о мероприяии</h4>
                </div>
                <form method="POST" id="event_main_info" class="form-horizontal">
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="eventname" class="control-label">Название мероприятия</label>
                        <div class="input-area">
                          <input type="text" id="eventname" name="eventname" class="form-control input-sm" value="Мисс ИТМО">
                          <label id="eventname-error" class="error-input" for="eventname" style="display: none;"></label>
                        </div>
                      </div>
                      <div class="form-group">
                          <label for="eventsite" class="control-label">Страница мероприятия</label>
                          <div class="input-area">
                            <div class="input-group">
                              <span class="input-group-addon">ifmo.votepad.ru/events/</span>
                              <input type="text" id="eventsite" name="eventsite" class="form-control" disabled="" value="miss-itmo">
                            </div>
                            <label id="eventsite-error" class="error-input" for="eventsite" style="display:none"></label>
                            <span class="help-block">По этому адресу будет доступена страница мероприятия.</span>
                          </div>
                        </div>
                      <div class="form-group">
                        <label for="eventshortdesc" class="control-label">Краткое описание</label>
                        <div class="input-area">
                          <textarea type="text" id="eventshortdesc" name="eventshortdesc" class="form-control input-sm" maxlength="170" rows=2>Мероприятие проходит ежегодно, где 11 девушек соревнуются за титул "Мисс университета ИТМО".</textarea>
                          <label id="eventshortdesc-error" class="error-input" for="eventshortdesc" style="display:none"></label>
                          <span class="help-block">Краткое описание будет доступно в лентах новостей, а также на страницы организации. <br>Осталось <span id="shortdesc_max_length">170</span> символов.</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="eventdata" class="control-label">Дата и время</label>
                        <div class="input-area">
                          <div class="date-input">
                            <input type="datetime-local" id="eventstart" name="eventstart" class="form-control input-sm" value="2016-09-17T12:00">
                            —
                            <input type="datetime-local" id="eventend" name="eventend" class="form-control input-sm" value="2016-09-18T17:00">
                          </div>
                          <label id="eventstart-error" class="error-input" for="eventstart" style="display: none;"></label>
                          <label id="eventend-error" class="error-input" for="eventend" style="display: none;"></label>
                          <span class="help-block">Выберите дату начала и завершения мероприятия.</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="eventstatus" class="control-label">Стаус мероприятия</label>
                        <div class="input-area">
                          <select id="eventstatus" name="eventstatus" class="form-control input-sm">
                            <option value=""></option>

                          </select>
                          <label id="eventstatus-error" class="error-input" for="eventstatus" style="display: none;"></label>
                          <span class="help-block">Выберите статус мероприятия, он нужен для поиска мероприятия в системе.</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="eventcity" class="control-label">Город</label>
                        <div class="input-area">
                          <select id="eventcity" name="eventcity" class="form-control input-sm">
                            <option value=""></option>

                          </select>
                          <label id="eventcity-error" class="error-input" for="eventcity" style="display: none;"></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <div class="input-area">
                          <input type="email" id="email" name="email" class="form-control input-sm" value="turov96@ya.ru">
                          <label id="email-error" class="error-input" for="email" style="display: none;"></label>
                          <span class="help-block">Email для обратной связи.</span>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="md-btn md-btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" id="save_event_main_info" class="md-btn md-btn-success">Сохранить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <!-- SECTION END -->

        <footer></footer>
    </div>
</body>
</html>
