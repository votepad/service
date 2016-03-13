<section>
   <div class="content-wrapper">
      <h3>Создание нового мероприятия</h3>

      <div class="panel panel-default">
         <div class="panel-heading" style="font-size: 1.2em">Заполните всю информацию, касающуюся мероприятия. Все поля обязательны для заполнения.</div>
         <div class="panel-body">
            <form role="form" class="form-horizontal">
               <div class="form-group">
                  <label for="input-event-name" class="mylabel col-md-2 control-label">Название мероприятия</label>
                  <div class="col-md-10">
                     <input id="input-event-name" name="input-event-name" placeholder="Введите название мероприятия" type="text" class="form-control" maxlength="100">
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-description" class="mylabel col-md-2 control-label">Описание мероприятия</label>
                  <div class="col-md-10">
                     <textarea id="input-event-description" name="input-event-description" placeholder="Расскажите о чем Ваше мероприятие, не более 1000 символов" type="text" class="form-control" style="height: 10em;" maxlength="1000"></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-status" class="mylabel col-md-2 control-label">Статус мероприятия</label>
                  <div class="col-md-10">
                     <select id="input-event-status" name="input-event-status" class="form-control">
                        <option value="IN">Международное мероприятие</option>
                        <option value="FE">Всероссийское мероприятие</option>
                        <option value="RE">Региональное мероприятие</option>
                        <option value="CI">Городское мероприятие</option>
                        <option value="UN">Университетское мероприятие</option>
                        <option value="SC">Школьное мероприятие</option>
                     </select>
                     <span class="pronwe_comment help-block m-b-none">*Статус мероприятия нужен для поиска мероприятия в системе.</span>
                  </div>
               </div>
               <div class="form-group">
                  <label for="input-event-organization" class="mylabel col-md-2 control-label">Выберите организацию</label>
                  <div class="col-md-10">
                     <select id="input-event-organization" name="input-event-organization" multiple class="chosen-select form-control" data-placeholder="Начните вводить организацию">
                        <option>Университет ИТМО</option>
                        <option>Профком ИТМО</option>
                        <option>Совет обучающихся университета ИТМО</option>
                        <!-- и так далее, делаем запрос из бд,, где располагаются организации  -->
                     </select>
                     <span class="pronwe_comment help-block m-b-none">*Можно выбрать более одной организации. Если вашей организации нет в списке, свяжитесь с нами support@pronwe.ru</span>
                  </div>
               </div>
               <div class="col-md-12 btn_area">
                  <div class="form-group" style="display:inline-block;">
                     <label for="input-event-start" class="mylabel col-md-5 control-label">Начало мероприятия</label>
                     <div class="col-md-7">
                        <input id="input-event-start" type="datetime-local" name="input-event-start" class="form-control">
                     </div>
                  </div>
                  <div class="form-group" style="display:inline-block;">
                     <label for="input-event-end" class="mylabel col-md-5 control-label">Конец мероприятия</label>
                     <div class="col-md-7">
                        <input id="input-event-end" type="datetime-local" name="input-event-end" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="col-md-12 btn_area">
                  <div class="form-group">
                     <label for="input-event-city" class="mylabel col-md-2 control-label">Город</label>
                     <div class="col-md-10">
                        <select id="input-event-city" name="input-event-city" class="chosen-select form-control" data-placeholder="Выберите город">
                           <option value=""></option>
                           <option value="SPb">Санкт-Петербург</option>
                           <option value="Moscow">Москва</option>
                           <!-- и так далее, делаем запрос из бд,, где располагаются города РФ  -->
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group btn_area">
                  <label for="input-event-type" class="mylabel col-md-2 control-label">Тип мероприятия</label>
                  <div class="col-md-10">
                     <select id="input-event-type" name="input-event-type" class="form-control">
                        <!-- для value: XYZ == этап(X) участник(Y) критерии(Z) -->
                        <option value="11N">На каждом этапе один участник оценивается по нескольким критериям, затем следует второй участник и т.д.</option>
                        <option value="1N1">На каждом этапе несколько участников оцениваются по 1 критерию, затем следующий этап.</option>
                     </select>
                     <span class="pronwe_comment help-block m-b-none">*Вы можете предложить свой тип мероприятия, отправив подробное описание типа на support@pronwe.ru.</span>
                  </div>
                  <div class="col-md-6 col-md-offset-4" style="padding-top: 20px; float:right;">
                     <button type="button" id="update-photo" class="btn" style="background-color: #BDBDBD; ">Выберите фотографию</button>
                  </div>
               </div>
               <div class="col-md-4 col-md-offset-8" >
                  <button id="submit" type="button" class="btn btn-primary">Создать</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>

<script type="text/javascript">
   $('.chosen-select').chosen();
   $(".chosen-select").chosen({no_results_text: "Ууупс! Если Вашей организации нет, свяжитесь с нами support@pronwe.ru"});
   $(".chosen-select").chosen({disable_search_threshold: 10});
</script>
