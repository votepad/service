<section>
   <div class="content-wrapper">
      <h3>Создание нового мероприятия</h3>

      <div class="panel panel-default">
         <div class="panel-heading" style="font-size: 1.2em">Заполните всю информацию, касающуюся мероприятия. Все поля обязательны для заполнения.</div>
         <div class="panel-body">
            <form role="form" class="form-horizontal" action="<?=URL::site('Events_Modify/add'); ?>" method="POST" enctype="multipart/form-data">
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
                     <span class="pronwe_comment help-block m-b-none">* Можно выбрать более одной организации. Если вашей организации нет в списке, свяжитесь с нами support@pronwe.ru</span>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-start" class="mylabel col-md-2 control-label">Дата начала мероприятия</label>
                  <div class="col-md-2">
                     <input name="input-event-start"  type="text" data-validation="date" data-validation-format="dd.mm.yyyy" data-validation-help="дд.мм.гггг" data-validation-error-msg="Введите в формате дд.мм.гггг" class="has-help-txt form-control">
                  </div>
                  <label for="input-event-start-time" class="mylabel col-md-2 control-label">Время начала мероприятия</label>
                  <div class="col-md-2">
                     <input name="input-event-start-time"  type="text" data-validation="time" data-validation-help="ЧЧ:ММ" data-validation-error-msg="Введите в формате ЧЧ:ММ" class="has-help-txt form-control">
                  </div>
                  <label for="input-event-end" class="mylabel col-md-2 control-label">Дата окачания мероприятия</label>
                  <div class="col-md-2">
                     <input name="input-event-end"  type="text" data-validation="date" data-validation-format="dd.mm.yyyy" data-validation-help="дд.мм.гггг" data-validation-error-msg="Введите в формате дд.мм.гггг" class="has-help-txt form-control">
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-city" class="mylabel col-md-2 control-label">Город</label>
                  <div class="col-md-10">
                     <select name="input-event-city" data-validation="length" data-validation-length="min1" data-validation-error-msg="Выберите город" class="chosen-select form-control">
                           <option value=""></option>
                           <option value="SPb">Санкт-Петербург</option>
                           <option value="Moscow">Москва</option>
                           <!-- и так далее, делаем запрос из бд,, где располагаются города РФ  -->
                        </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-type" class="mylabel col-md-2 control-label">Тип мероприятия</label>
                  <div class="col-md-10">
                     <select id="1" name="input-event-type" data-validation="length" data-validation-length="min1" data-validation-error-msg="Выберите тип" class="form-control">
                        <!-- для value: XYZ == этап(X) участник(Y) критерии(Z) -->
                           <option value=""></option>
                           <option value="11N">Оценивание участников по нескольким критериям на каждом этапе</option>
                           <option value="1N1">Оценивание участников по одному критерию на каждом этапе</option>
                        </select>
                        <span class="pronwe_comment help-block m-b-none">*Вы можете предложить свой тип мероприятия, отправив подробное описание типа на support@pronwe.ru.</span>
                  </div>
               </div>
               <label for="update-photo" class="btn btn-primary col-md-3 col-md-offset-1 col-sm-5 col-xs-12 btn_area1">
                  Выберите фотографию
                  <input id="update-photo" type="file" name="input-event-photo" style="display: none;">
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