<section>
   <div class="content-wrapper">
      <h3>Создание нового мероприятия</h3>

      <div class="panel panel-default">
         <div class="panel-heading" style="font-size: 1.2em">Заполните всю информацию, касающуюся мероприятия. Все поля обязательны для заполнения.</div>
         <div class="panel-body">
            <form role="form" class="form-horizontal" action="<?=URL::site('Events_Modify/add'); ?>" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="input-event-name" class="col-md-3 control-label">Название мероприятия</label>
                  <div class="col-md-9">
                     <input id="input-event-name" name="input-event-name" type="text" data-validation="length" data-validation-length="5-100" data-validation-error-msg="Название мероприятия должно быть от 5 до 100 символов" class="form-control" >
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-description" class="col-md-3 control-label">Описание мероприятия</label>
                  <div class="col-md-9">
                     <textarea id="input-event-description" name="input-event-description" type="text" data-validation="length" data-validation-length="50-1000" data-validation-error-msg="Расскажите о Вашем мероприятие, чтобы все могли узанть о нём (не менее 50 символов)" class="form-control" rows=7 style="resize: none;"></textarea>
                     <div class="text-right"><span id="pres-max-length">1000</span> символов осталось</div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-status" class="col-md-3 control-label">Статус мероприятия</label>
                  <div class="col-md-9">
                     <select id="input-event-status" name="input-event-status" data-validation="required" data-validation-error-msg="Выберите статус мероприятия, он нужен для поиска мероприятия в системе" class="form-control" >
                        <option value=""></option>
                        <?php for($i = 1; $i <= count($status); $i++): ?>
                           <option value="<?=$i; ?>"><?=$status->get($i); ?></option>
                        <?php endfor; ?>
                     </select>
                  </div>
               </div>
               <!--<div class="form-group">
                  <label for="input-event-organization" class="col-md-3 control-label">Выберите организацию</label>
                  <div class="col-md-9">
                     <select name="input-event-organization" data-validation="required" data-validation-error-msg="Выберите организацию или организации" multiple class="form-control chosen-select" required>
                        <option value="Университет ИТМО">Университет ИТМО</option>
                        <option value="Профком ИТМО">Профком ИТМО</option>
                        <option value="Совет обучающихся университета ИТМО">Совет обучающихся университета ИТМО</option>
                        <!- и так далее, делаем запрос из бд,, где располагаются организации
                     </select>
                     <span class="pronwe_comment help-block m-b-none">* Можно выбрать более одной организации. Если вашей организации нет в списке, свяжитесь с нами support@pronwe.ru</span>
                  </div>
               </div>-->
               <div class="form-group">
                  <label for="input-event-start" class="col-md-3 control-label">Дата начала мероприятия</label>
                  <div class="col-md-9">
                     <input id="input-event-start" name="input-event-start" type="text" class="form-control" required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-end" class="col-md-3 control-label">Дата окачания мероприятия</label>
                  <div class="col-md-9">
                     <input id="input-event-end" name="input-event-end" type="text" class="form-control" required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-city" class="col-md-3 control-label">Город</label>
                  <div class="col-md-9">
                     <select id="input-event-city" name="input-event-city" data-validation="required" data-validation-error-msg="Выберите город" class="form-control">
                        <option value=""></option>
                        <? for($i = 0; $i < count($cities); $i++) : ?>
                           <option value="<?=$cities[$i]['id']; ?>"><?=$cities[$i]['name']; ?></option>
                        <? endfor;  ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-type" class="col-md-3 control-label">Тип мероприятия</label>
                  <div class="col-md-9">
                     <select id="input-event-type" name="input-event-type" data-validation="required" data-validation-error-msg="Выберите тип" class="form-control" >
                        <!-- для value: XYZ == этап(X) участник(Y) критерии(Z) -->
                        <option value=""></option>
                        <?php for($i = 1; $i <= count($types); $i++): ?>
                           <option value="<?=$i; ?>"><?=$types->get($i); ?></option>
                        <?php endfor; ?>
                     </select>
                     <span class="pronwe_comment help-block m-b-none">*Вы можете предложить свой тип мероприятия, отправив подробное описание типа на support@pronwe.ru.</span>
                  </div>
               </div>
               <label for="update-photo" class="btn btn-primary col-md-3 col-md-offset-1 col-sm-5 col-xs-12 btn_area1" >
                  Выберите фотографию
                  <input id="update-photo" type="file" name="input-event-photo" style="display: none;" required>
               </label>
               <label for="submit-form" class="btn btn-primary col-md-3 col-md-offset-4 col-sm-5 col-sm-offset-2 col-xs-12 btn_area1">
                  Создать мероприятие
                  <input id="submit-form" type="submit" style="display: none;">
               </label>
            </form>
         </div>
      </div>
   </div>
</section>