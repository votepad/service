<section>
   <div class="content-wrapper">
      <h3>Редактирование информации о мероприятии ИМЯ</h3>
      <!-- EDIT MAIN EVENT INFO -->
      <div class="panel-group">
         <div class="panel panel-default">
            <div class="panel-heading panel-title" style="font-size: 1.2em"><a data-toggle="collapse" data-parent="#accordion" href="#eventinfo" aria-expanded="true" aria-controls="eventinfo" id="main-info">Основная информация о мероприятии</a></div>
            <div id="eventinfo" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse">
               <div class="panel-body">
                  <form id="event-info" class="form-horizontal" method="">
                     <div class="form-group">
                        <label for="input-event-name" class="mylabel col-md-2 control-label">Название мероприятия</label>
                        <div class="col-md-10">
                           <input name="input-event-name" type="text" data-validation="length" data-validation-length="5-30" data-validation-error-msg="Название мероприятия должно быть от 5 до 30 символов" class="form-control">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="input-event-description" class="mylabel col-md-2 control-label">Описание мероприятия</label>
                        <div class="col-md-10">
                           <textarea id="input-event-description" name="input-event-description" type="text" data-validation="length" data-validation-length="50-1000" data-validation-error-msg="Расскажите о Вашем мероприятие, чтобы все могли узанть о нём (не менее 50 символов)" class="form-control" rows=7 style="resize: none;"></textarea>
                           <div class="text-right"><span id="pres-max-length">1000</span> символов осталось</div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="input-event-status" class="mylabel col-md-2 control-label">Статус мероприятия</label>
                        <div class="col-md-10">

                           <select name="input-event-status" data-validation="length" data-validation-length="min1" data-validation-error-msg="Выберите статус мероприятия, он нужен для поиска мероприятия в системе" class="form-control">
                              <option value=""></option>
                              <option value="IN">Международное мероприятие</option>
                              <option value="FE">Всероссийское мероприятие</option>
                              <option value="RE">Региональное мероприятие</option>
                              <option value="CI">Городское мероприятие</option>
                              <option value="UN">Университетское мероприятие</option>
                              <option value="SC">Школьное мероприятие</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="input-event-organization" class="mylabel col-md-2 control-label">Выберите организацию</label>
                        <div class="col-md-10">
                           <select name="input-event-organization" data-validation="length" data-validation-length="min1" data-validation-error-msg="Выберите организацию или организации" multiple class="chosen-select form-control">
                              <option value="Университет ИТМО">Университет ИТМО</option>
                              <option value="Профком ИТМО">Профком ИТМО</option>
                              <option value="Совет обучающихся университета ИТМО">Совет обучающихся университета ИТМО</option>
                              <!-- и так далее, делаем запрос из бд,, где располагаются организации  -->
                           </select>
                           <span class="pronwe_comment help-block m-b-none">* Можно выбрать более одной организации для этого удерживайте Ctrl и выбирайте. Если вашей организации нет в списке, свяжитесь с нами support@pronwe.ru</span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="input-event-start" class="mylabel col-md-2 control-label">Дата начала мероприятия</label>
                        <div class="col-md-4">
                           <input name="input-event-start" type="text" data-validation="date" data-validation-format="dd.mm.yyyy" data-validation-help="дд.мм.гггг" data-validation-error-msg="Введите в формате дд.мм.гггг" class="has-help-txt form-control">
                        </div>
                        <label for="input-event-end" class="mylabel col-md-2 control-label">Окачание мероприятия</label>
                        <div class="col-md-4">
                           <input name="input-event-end" type="text" data-validation="date" data-validation-format="dd.mm.yyyy" data-validation-help="дд.мм.гггг" data-validation-error-msg="Введите в формате дд.мм.гггг" class="has-help-txt form-control">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="input-event-city" class="mylabel col-md-2 control-label">Город</label>
                        <div class="col-md-10 ">
                           <select name="input-event-city" data-validation="length" data-validation-length="min1" data-validation-error-msg="Выберите город" class="chosen-select form-control">
                              <option value=""></option>
                              <option value="SPb">Санкт-Петербург</option>
                              <option value="Moscow">Москва</option>
                              <!-- и так далее, делаем запрос из бд,, где располагаются города РФ  -->
                           </select>
                        </div>
                     </div>
                     <div class="form-group btn_area">
                        <label for="input-event-type" class="mylabel col-md-2 control-label">Тип мероприятия</label>
                        <div class="col-md-10">
                           <select id="1" name="input-event-type" data-validation="length" data-validation-length="min1" data-validation-error-msg="Выберите тип" class="form-control">
                              <!-- для value: XYZ == этап(X) участник(Y) критерии(Z) -->
                              <option value=""></option>
                              <option value="11N">На каждом этапе один участник оценивается по нескольким критериям, затем следует второй участник и т.д.</option>
                              <option value="1N1">На каждом этапе несколько участников оцениваются по 1 критерию, затем следующий этап.</option>
                           </select>
                           <span class="pronwe_comment help-block m-b-none">*Вы можете предложить свой тип мероприятия, отправив подробное описание типа на support@pronwe.ru.</span>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-5 btn_area">
                        <button type="button" id="update-photo" class="btn btn-primary">Выберите фотографию</button>
                     </div>
                     <div class="col-md-4 col-sm-5 col-sm-offset-2 col-md-offset-4" style="margin-top: 1em">
                        <input type="submit" class="btn btn-primary" value="Сохранить" id="main-info-save" disabled>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- EDIT ADDITIONAL EVENT INFO -->
      <div class="panel-group">
         <div class="panel panel-default">
            <div class="panel-heading panel-title" style="font-size: 1.2em"><a data-toggle="collapse" data-parent="#accordion" href="#moreeventinfo" aria-expanded="true" aria-controls="moreeventinfo" id="extra-info">Редактирование информации, касающююся участников, жюри и этапов мероприятия</a></div>
            <div id="moreeventinfo" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in">
               <div class="panel-body">
                  <div role="tabpanel">
                     <!-- Nav tabs-->
                     <ul role="tablist" class="nav nav-tabs text-center">
                        <li role="presentation" class="col-md-4 nav-tabs-li active"><a href="#participant" aria-controls="participant" role="tab" data-toggle="tab">Участники</a>
                        </li>
                        <li role="presentation" class="col-md-4 nav-tabs-li"><a href="#judge" aria-controls="judge" role="tab" data-toggle="tab">Жюри</a>
                        </li>
                        <li role="presentation" class="col-md-4 nav-tabs-li"><a href="#stage" aria-controls="stage" role="tab" data-toggle="tab">Этапы</a>
                        </li>
                     </ul>
                     <!-- Tab panes-->
                     <div class="tab-content">
                        <div id="participant" role="tabpanel" class="tab-pane active">
                           <form id="participant-info" name="participant-info" role="form" class="form-horizontal" action="" method="">
                              <!-- START PARTICIPANT -->
                              <div style="position: relative;">
                                 <h4 class="text-center">Радактирование участников мероприятия</h4>
                                 <fieldset>
                                    <ul class="participant-list">
                                       <!-- participant -->
                                    </ul>
                                    <div class="col-md-8 btn_area">
                                       <div class="input-group">
                                          <input id="name-participant" type="text" placeholder="ФИО участника" class="form-control">
                                          <div class="input-group-btn">
                                             <input type="button" id="add-participant-btn" class="btn btn-primary" value="Добавить">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-md-offset-1">
                                       <div class="btn_area">
                                          <input type="submit" class="btn btn-primary btn-submit-participant" value="Сохранить" disabled>
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <!-- END PARTICIPANT -->
                           </form>
                        </div>
                        <div id="judge" role="tabpanel" class="tab-pane">
                           <form id="judge-info" name="judge-info" role="form" class="form-horizontal" action="" method="">
                              <!-- START JUDGE -->
                              <div style="position: relative;">
                                 <h4 class="text-center">Радактирование жюри мероприятия</h4>
                                 <fieldset style="position:relative;">
                                    <ul class="judge-list">
                                       <!-- judge -->
                                    </ul>
                                    <div class="col-md-8 btn_area">
                                       <div class="input-group">
                                          <input id="name-judge" type="text" placeholder="ФИО жюри" class="form-control">
                                          <div class="input-group-btn">
                                             <button type="button" id="add-judge-btn" class="btn btn-primary">Добавить</button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-md-offset-1">
                                       <div class="btn_area">
                                          <button type="submit" class="btn btn-primary btn-submit-judge" disabled>Сохранить</button>
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <!-- END JUDGE -->
                           </form>
                        </div>
                        <div id="stage" role="tabpanel" class="tab-pane">
                           <form id="stage-info" name="stage-info" role="form" class="form-horizontal" action="" method="">
                              <!-- START STAGE -->
                              <div style="position: relative;">
                                 <h4 class="text-center">Радактирование этапов и критериев мероприятия</h4>
                                 <fieldset style="position:relative;">
                                    <ul class="stage-list">
                                       <!-- stage -->
                                    </ul>
                                    <div class="col-md-8 btn_area">
                                       <div class="input-group">
                                          <input id="name-stage" type="text" placeholder="Название этапа" class="form-control">
                                          <div class="input-group-btn">
                                             <button type="button" id="add-stage-btn" class="btn btn-primary">Добавить</button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-md-offset-1">
                                       <div class="btn_area">
                                          <button type="submit" class="btn btn-primary btn-submit-stage" disabled>Сохранить</button>
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <!-- END STAGE -->
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>