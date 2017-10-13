<!-- Authorization Modal -->
<div class="modal" id="auth_modal" tabindex="-1">
    <div class="modal__content width- width-sm-360 fl_n">

        <? if ($canLogin) : ?>
            <!-- Logged User SignIn Form -->
            <form class="modal__wrapper" id="signinLogged">
                <div class="modal__header bb-0 text-center">
                    <a role="button" data-close="modal" class="fl_r"><i class="fa fa-times" aria-hidden="true"></i></a>
                    <span class="text-bold">Продолжить как</span>
                </div>
                <div class="modal__body">
                    <div class="valign">
                        <img class="brad-5px thumb64" src="<?= URL::site('uploads/profiles/avatar/m_' . $user->avatar); ?>" alt="">
                        <div class="text-bold ml-15">
                            <?= $user->name; ?>
                        </div>
                    </div>
                    <div class="form-group form-group--with-icon mt-15">
                        <input id="auth_continue_password" type="password" name="password" placeholder="Ваш пароль" class="form-group__input">
                        <label for="auth_continue_password" class="form-group__label-icon">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </label>
                    </div>
                    <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                    <input id="recover" type="hidden" name="recover" value="1">
                    <button type="button" onclick="auth.logout()" class="btn btn--default fl_l m-0">Выйти</button>
                    <button id="recoverSubmit" type="submit" class="btn btn--brand fl_r m-0">Продолжить</button>
                </div>
            </form>
        <? endif; ?>

        <!-- NOT Logged User SignIn Form -->
        <form class="modal__wrapper <?= $canLogin ? 'hide' : ''; ?>" id="signin">
            <div class="modal__header bb-0 text-center">
                <a role="button" data-close="modal" class="fl_r"><i class="fa fa-times" aria-hidden="true"></i></a>
                <span class="text-bold">Авторизация</span>
            </div>
            <div class="modal__body">
                <div class="form-group form-group--with-icon">
                    <input id="auth_email" type="email" name="email" placeholder="Ваш email" required="" class="form-group__input">
                    <label for="auth_email" class="form-group__label-icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="form-group form-group--with-icon">
                    <input id="auth_password" type="password" name="password" placeholder="Ваш пароль" required="" class="form-group__input">
                    <label for="auth_password" class="form-group__label-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </label>
                </div>
                <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                <button type="button" onclick="auth.toForget();" class="btn fl_l m-0">Забыли пароль?</button>
                <button type="submit" class="btn btn--brand col-xs-4 fl_r m-0">Войти</button>
            </div>
            <a role="button" onclick="auth.toJudge();" class="modal__footer display-block text-center bg-light-blue">
                Вход для жюри
            </a>
        </form>

        <!-- Forget Password Form -->
        <form class="modal__wrapper hide" id="forget">
            <div class="modal__header bb-0 text-center">
                <a role="button" data-close="modal" class="fl_r"><i class="fa fa-times" aria-hidden="true"></i></a>
                <span class="text-bold">Востановление пароля</span>
            </div>
            <div class="modal__body" >
                <div class="form-group form-group--with-icon">
                    <input id="forget_email" type="email" name="email" placeholder="Введите Ваш email" required="" class="form-group__input">
                    <label for="forget_email" class="form-group__label-icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </label>
                </div>

                <div class="form-group overflow--hidden">
                    <div class="g-recaptcha " data-sitekey="6LelVhcUAAAAAJFftx6Hr90Ff6VWc8-KlT86OJRF"></div>
                </div>

                <div class="mt-15">
                    <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                    <button type="button" onclick="auth.toSignIn();" class="btn btn--default m-0 fl_l">Отмена</button>
                    <button type="submit" id="resetPassword" class="btn btn--brand m-0 fl_r">Восстановить</button>
                </div>
            </div>
            <a role="button" onclick="auth.toJudge();" class="modal__footer display-block text-center bg-light-blue">
                Вход для жюри
            </a>
        </form>

        <!-- Judge SignIn Form -->
        <form class="modal__wrapper hide" id="judge">
            <div class="modal__header bb-0 text-center">
                <a role="button" data-close="modal" class="fl_r"><i class="fa fa-times" aria-hidden="true"></i></a>
                <span class="text-bold">Вход для жюри</span>
            </div>
            <div class="modal__body">
                <div class="form-group form-group--with-icon">
                    <input id="auth_eventnumber" type="text" name="eventCode" placeholder="Код мероприятия" required="" class="form-group__input">
                    <label for="auth_eventnumber" class="form-group__label-icon">
                        <i class="fa fa-key" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="form-group form-group--with-icon">
                    <input id="auth_judgesecret" type="password" name="password" placeholder="Ваш пароль" required="" class="form-group__input">
                    <label for="auth_judgesecret" class="form-group__label-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </label>
                </div>
                <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                <button type="submit" class="btn btn--brand m-0 col-xs-4 fl_r">Войти</button>
            </div>
            <a role="button" onclick="auth.toSignIn();" class="modal__footer display-block bg-light-blue text-center">
                Вход для пользователя
            </a>
        </form>

    </div>
</div>

<!-- Registration Modal -->
<div class="modal registr-modal" id="registr_modal" tabindex="-1">
    <div class="modal__content modal__content--small">
        <form class="modal__wrapper" id="registr">
            <div class="modal__header bb-0 text-center">
                <a role="button" data-close="modal" class="fl_r"><i class="fa fa-times" aria-hidden="true"></i></a>
                <span class="text-bold">Регистрация</span>
            </div>
            <div class="modal__body clear-fix" id="registr_form" action="<?=URL::site(''); ?>" method="POST">
                <div class="form-group form-group--with-icon">
                    <input id="registr_name" type="text" name="name" placeholder="Введите Ваше имя" required="" class="form-group__input" maxlength="20">
                    <label for="registr_name" class="form-group__label-icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="form-group form-group--with-icon">
                    <input id="registr_email" type="email" name="email" placeholder="Введите Ваш email" required="" class="form-group__input" maxlength="65">
                    <label for="registr_email" class="form-group__label-icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="form-group form-group--with-icon">
                    <input id="registr_password" type="password" name="password" placeholder="Придумайте пароль" required="" class="form-group__input" maxlength="18">
                    <label for="registr_password" class="form-group__label-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </label>
                </div>

                <div class="form-group">
                    <input id="registr_rools" type="checkbox" class="checkbox" required>
                    <label for="registr_rools" class="checkbox-label">
                        Даю согласие <a href="#rools" class="link">на обработку персональных данных</a>
                    </label>
                </div>

                <div class="col-xs-12 text-center">
                    <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                    <button type="submit" class="btn btn--brand m-0">Зарегистрироваться</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/auth.js"></script>
<script type="text/javascript" >
    auth.init();
</script>