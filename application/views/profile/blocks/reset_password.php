<form class="form" id="reset_password_form">

    <!-- Link is INVALID-->
    <div class="form_body alert alert-danger ">
        <h4>Ошибка!</h4>
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="font-size: 20px; position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
        <span>Ссылка устарела. Пожалуйста, сделайте новый запрос пароля.</span>
        <a href="#" target="_blank" data-notify="url"></a>
    </div>


    <!-- Link is VALID -->
    <h3 class="form_heading">Восстановление пароля</h3>
    <div class="form_body">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="input-field">
                    <input type="password" id="reset_password" name="reset_password">
                    <label for="reset_password">Введите новый пароль</label>
                </div>
            </div>
            <div class="col-xs-6 col-md-6">
                <div class="input-field">
                    <input type="password" id="reset_password1">
                    <label for="reset_password1">Повторите пароль</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit clear_fix">
        <button type="submit" class="btn btn_primary pull-right">Восстановить</button>
    </div>

</form>
