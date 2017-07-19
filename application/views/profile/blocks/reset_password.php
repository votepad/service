<? if (!empty(Cookie::get('reset_link'))): ?>
<form class="modal valign" id="reset_password_form" tabindex="-1" action="" method="POST">
    <div class="modal-dialog modal-sm" style="margin: 120px auto;">
        <div class="modal-content row-col">
            <div class="modal-wrapper">
                <div class="modal-body clear-fix">
                    <h4 class="text-center" style="font-size:1.3em;margin-bottom:1em">Восстановление пароля</h4>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="password" id="reset_password" name="reset_password" placeholder="Введите новый пароль">
                        <label for="reset_password" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="password" id="reset_password1" name="reset_password_repeat" placeholder="Повторите пароль">
                        <label for="reset_password1" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12">
                        <button type="button" id="cancelReset" class="btn btn_default pull-left">Отмена</button>
                        <button type="submit" class="btn btn_primary pull-right">Восстановить</button>
                    </div>
                    <?= Form::hidden('csrf', Security::token()) ?>
                </div>
            </div>
        </div>
    </div>
</form>
<? endif;?>
