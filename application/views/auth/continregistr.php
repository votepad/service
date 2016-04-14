
      <section>
         <div class="content-wrapper">
            <h3>Продолжение регистрации
               <small>Заполнте информацию о себе.</small>
            </h3>

            <div class="panel panel-default">
               <div class="panel-heading">Заполните основную информацию о себе</div>
               <div class="panel-body">
                  <form method="post" action="<?=URL::site('signup/save'); ?>" class="form-horizontal" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Фамилия</label>
                              <div class="col-sm-10">
                                 <input name="surname" type="text" class="form-control" placeholder="Ивонов" maxlength="20" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Имя</label>
                              <div class="col-sm-10">
                                 <input name="name" type="text" class="form-control" placeholder="Иван" maxlength="20" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Отчество</label>
                              <div class="col-sm-10">
                                 <input name="lastname" type="text" class="form-control" placeholder="Ивонович" maxlength="20" required>
                              </div>
                           </div>
                        </div>
                        
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Телефон</label>
                              <div class="col-sm-10">
                                 <input type="text" name="number" data-parsley-type="number" class="form-control" placeholder="+79991234567" maxlength="12" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Пол</label>
                              <div class="col-sm-10">
                                 <label class="radio-inline c-radio">
                                    <input name="sex" type="radio" value="1" checked="">
                                       <span class="fa fa-circle"></span>Мужской
                                 </label>
                                 <label class="radio-inline c-radio">
                                    <input name="sex" type="radio" value="2">
                                       <span class="fa fa-circle"></span>Женский
                                 </label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Город</label>
                              <div class="col-sm-10">
                                 <select name="city" class="form-control" required>
                                    <option></option>
                                    <? for($i = 0; $i < count($cities); $i++) : ?>
                                       <option value="<?=$cities[$i]['id']; ?>"><?=$cities[$i]['name']; ?></option>
                                    <? endfor;  ?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-6 btn_area">
                                 <label for="update-photo" class="btn btn-primary" style="width: 100%">
                                    <input type="file" id="update-photo" name="avatar" style="display: none;">Выберите фотографию
                                 </label>
                              </div>
                              <div class="col-md-6 btn_area">
                                 <button type="submit" class="btn btn-primary" style="width: 100%">Готово</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>