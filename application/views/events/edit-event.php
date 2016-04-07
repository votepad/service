<section>
   <div class="content-wrapper">
      <h3>Редактирование информации о мероприятии "<a  data-name="title" data-type="text" class="editable" data-pk="<?=$event['id']; ?>"><?=$event['title']; ?></a>"</h3>
      <!-- EDIT MAIN EVENT INFO -->
      <div class="panel-group">
         <div class="panel panel-default">
            <div class="panel-heading panel-title" style="font-size: 1.2em"><a data-toggle="collapse" data-parent="#accordion" href="#eventinfo" aria-expanded="true" aria-controls="eventinfo" id="main-info">Основная информация о мероприятии</a></div>
            <div id="eventinfo" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse">
               <div class="panel-body">
                  <div class="col-md-8">
                     <div class="form-horizontal">
                        <div class="form-group">
                           <label for="input-event-description" class="col-md-4 control-label">Описание</label>
                           <div class="col-md-8">
                              <a data-name="description" data-type="textarea" class="editable control-size" data-pk="<?=$event['id']; ?>"><?=$event['description']; ?></a>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="input-event-status" class="col-md-4 control-label">Статус мероприятия</label>
                           <div class="col-md-8">
                              <a id="input-event-status"><?=$event['event_status'] ;?></a>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="input-event-organization" class="col-md-4 control-label">Мероприятие организуют</label>
                           <div class="col-md-8">
                              <a id="input-event-organization" data-type="select2"></a>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="input-event-start" class="col-md-4 control-label">Мероприятие начнется</label>
                           <div class="col-md-8">
                              <a data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat=" D MMM YYYY в HH:mm" class="editable" data-combodate='{"minYear": "2016", "maxYear": "2026"}'><?=$event['start_datetime']; ?></a>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="input-event-end" class="col-md-4 control-label">Мероприятие завершится</label>
                           <div class="col-md-8">
                              <a id="input-event-end" data-type="combodate" data-template="D MMM YYYY в HH:mm" data-format="D MMM YYYY в HH:mm" data-viewformat=" D MMM YYYY в HH:mm" class="editable" data-combodate='{"minYear": "2016", "maxYear": "2026"}'><?=$event['finish_datetime']; ?></a>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="input-event-city" class="mylabel col-md-4 control-label">Мероприятие пройдет в</label>
                           <div class="col-md-8">
                              <a id="input-event-city"><?=$event['city']; ?></a>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="input-event-type" class="mylabel col-md-4 control-label">Тип мероприятия</label>
                           <div class="col-md-8">
                              <a id="input-event-type"><?=$event['type']; ?></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 text-center">
                     <form id="image-upload" method="POST">
                        <div class="">
                            <img id="image" src="<?=$assets; ?>img/user/no-user.png" alt="Avatar" class="pronwe_boxShadow pronwe_border-1px logo-preview">
                        </div>
                        <div class="btn_area">
                            <input id="choose-image" type="file" tabindex="-1" onchange="readURL(this)" class="logo-input">
                            <label for="choose-image" class="btn btn-default fileinput-button">
                                <span class="fa fa-folder-open"></span>
                                <span class="buttonText">Обновить фото</span>
                            </label>
                        </div>
                     </form>
                  </div>
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
                        <!-- START PARTICIPANT -->
                        <div id="participant" role="tabpanel" class="tab-pane active">
                           <div style="position: relative;">
                              <h4 class="text-center">Радактирование участников мероприятия</h4>
                              <fieldset>
                                 <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th class="text-center">Фото</th>
                                          <th class="text-center">ФИО участника</th>
                                          <th class="text-center">Описание участника</th>
                                          <th class="text-center">Удаление</th>
                                       </tr>
                                    </thead>
                                    <tbody class="added_participants">
                                       <!-- ADDED PARTICIPANT -->
                                       <? for($i = 0; $i < count($participants); $i++): ?>
                                          <tr>
                                             <td style="width: 5%">
                                                <div class="media">
                                                   <img src="<?=URL::base().'uploads/' . $participants[$i]['photo']; ?>" class="img-responsive img-circle">
                                                </div>
                                             </td>
                                             <td style="width: 40%">
                                                <a class="editable-part" data-name="name" data-type="text" data-pk="<?=$participants[$i]['id']; ?>" ><?=$participants[$i]['name']; ?></a>
                                             </td>
                                             <td style="width: 50%">
                                                <a class="editable-part control-size" data-name="description" data-type="textarea" data-pk="<?=$participants[$i]['id']; ?>"><?=$participants[$i]['description']; ?></a>
                                             </td>
                                             <td class="text-center">
                                                <a href='#'>
                                                   <em class="fa fa-remove icon-remove"></em>
                                                </a>
                                             </td>
                                          </tr>
                                       <? endfor; ?>
                                    </tbody>
                                 </table>
                                       
                                 <form action="<?=URL::site('events/addparticipants/'. $event['id']); ?>" method="post" id="participant-info" role="form" class="form-horizontal" enctype="multipart/form-data">
                                    <ul class="participant-list">
                                    <!-- NEW PARTICIPANTS -->
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
                                          <button type="submit" id="save_participants" class="btn btn-primary btn-submit-participant" disabled>Сохранить</button>
                                       </div>
                                    </div>
                                 </form>
                              </fieldset>
                           </div>
                        </div>
                        
                        <!-- START JUDGE -->
                        <div id="judge" role="tabpanel" class="tab-pane">
                           <div style="position: relative;">
                              <h4 class="text-center">Радактирование жюри мероприятия</h4>
                              <fieldset>
                                 <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th class="text-center">Фото</th>
                                          <th class="text-center">ФИО жюри</th>
                                          <th class="text-center">Емайл жюри</th>
                                          <th class="text-center">Описание жюри</th>
                                          <th class="text-center">Удаление</th>
                                       </tr>
                                    </thead>
                                    <tbody class="added_judges">
                                       <!-- ADDED JUDGE -->
                                       <? for($i = 0; $i < count($judges); $i++): ?>
                                          <tr>
                                             <td style="width: 5%">
                                                <div class="media">
                                                   <img src="<?=URL::base().'uploads/' . $judges[$i]['photo']; ?>" class="img-responsive img-circle">
                                                </div>
                                             </td>
                                             <td style="width: 30%">
                                                <a class="editable-judge" data-name="name" data-type="text" data-pk="<?=$judges[$i]['id']; ?>"><?=$judges[$i]['name']; ?></a>
                                             </td>
                                             <td style="width: 30%">
                                                <a class="editable-judge" data-name="email" data-type="email" data-pk="<?=$judges[$i]['id']; ?>"><?=$judges[$i]['email']; ?></a>
                                             </td>
                                             <td style="width: 30%">
                                                <a class="editable-judge" data-name="position" data-type="text" data-pk="<?=$judges[$i]['id']; ?>"><?=$judges[$i]['position']; ?></a>
                                             </td>
                                             <td class="text-center">
                                                <a href='#'>
                                                   <em class="fa fa-remove icon-remove"></em>
                                                </a>
                                             </td>
                                          </tr>
                                       <? endfor; ?>
                                    </tbody>
                                 </table>
                                 <form action="<?=URL::site('events/addjudge/' . $event['id'] ); ?>" method="POST" id="judge-info" role="form" class="form-horizontal" enctype="multipart/form-data">
                                    <ul class="judge-list">
                                       <!-- NEW JUDGES -->
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
                                 </form>
                              </fieldset>
                           </div>
                        </div>

                        <!-- START STAGE -->
                        <div id="stage" role="tabpanel" class="tab-pane">
                           <div style="position: relative;">
                              <h4 class="text-center">Радактирование этапов и критериев мероприятия</h4>
                              <fieldset>
                                 <table class="table table-bordered table-hover">
                                    <thead>
                                       <tr>
                                          <th class="text-center" rowspan="2">Название этапа</th>
                                          <th class="text-center" rowspan="2">Описание этапа</th>
                                          <th class="text-center" rowspan="2">Удалить</th>
                                          <th class="text-center" colspan="3">Критерии</th>
                                       </tr>
                                       <tr>
                                          <th class="text-center">Критерии</th>
                                          <th class="text-center">Max балл</th>
                                          <th class="text-center">Удалить</th>
                                       </tr>
                                    </thead>
                                    <tbody class="stage-list1">
                                       <!-- ADDED STAGE -->
                                       <? for($i = 0; $i < count($stages); $i++) : ?>
                                          <?php $criterias = Model_Stages::getCriteriasByStageId($stages[$i]['id']); ?>
                                          <tr>
                                             <td style="width: 25%" rowspan="<?=$stages[$i]['allcriterions']; ?>">
                                                <a class="editable-stage" data-name="name" data-type="text" data-pk="<?=$stages[$i]['id']; ?>"><?=$stages[$i]['name']; ?></a>
                                             </td>
                                             <td style="width: 30%" rowspan="<?=$stages[$i]['allcriterions']; ?>">
                                                <a class="editable-stage" data-name="description" data-type="textarea" data-pk="<?=$stages[$i]['id']; ?>"><?=$stages[$i]['description']; ?></a>
                                             </td>
                                             <td class="text-center" style="width: 5%" rowspan="<?=$stages[$i]['allcriterions']; ?>">
                                                <a href='#'>
                                                   <em class="fa fa-remove icon-remove"></em>
                                                </a>
                                             </td>
                                          </tr>
                                          <? for($j = 0; $j < count($criterias); $j++) : ?>
                                             <tr>
                                                <td style="width: 35%" >
                                                   <a class="editable-criterion" data-name="name" data-type="text" data-pk="<?=$criterias[$j]['id']; ?>"><?=$criterias[$j]['name']; ?></a>
                                                
                                                </td>
                                                <td class="text-center" style="width: 5%">
                                                   <a class="editable-criterion" data-name="maxscore" data-type="number" data-pk="<?=$criterias[$j]['id']; ?>"><?=$criterias[$j]['maxscore']; ?></a>
                                                </td>
                                                <td class="text-center" style="width: 5%">
                                                <a href='#'>
                                                   <em class="fa fa-remove icon-remove"></em>
                                                </a>
                                             </td>
                                             </tr>
                                          <? endfor; ?>
                                       <? endfor; ?>
                                    </tbody>
                                 </table>
                              
                                 <form id="stage-info" name="stage-info" role="form" class="form-horizontal" action="<?=URL::site('events/addStage/' . $event['id'] ); ?>" method="POST" enctype="multipart/form-data">
                                    <fieldset style="position:relative;">
                                       <ul class="stage-list">
                                          <!-- NEW STAGE -->
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
                                 </form>
                              </div>
                           </fieldset>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>