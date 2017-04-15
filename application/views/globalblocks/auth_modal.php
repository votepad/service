<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/auth.js"></script>

<!-- Authorization Modal -->
<div class="modal valign auth-modal" id="auth_modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content row-col">
            <div class="modal-wrapper">

                <? if ($canLogin) : ?>
                <!-- Logged User SignIn Form -->
                <form class="modal-body" id="user_form_logged" action="<?=URL::site('sign/organizer'); ?>" method="POST">
                    <h4>Продолжить как</h4>
                    <div class="auth_logged col-xs-12">
                        <div class="auth_logged-image">
                            <img class="" src="<?=$assets; ?>img/logo.jpg" alt="">
                        </div>
                        <div class="auth_logged-name text-center"><?=$user->name . ' ' ,  $user->surname; ?></div>
                    </div>
                    <div class="col-xs-12">
                        <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                        <input type="hidden" name="recover" value="1">
                        <button type="submit" id="logout" name="logout" class="btn btn_default col-xs-5">Выйти</button>
                        <button type="button" id="userRecover" name="submit_recover" class="btn btn_primary col-xs-5 col-xs-offset-2">Продолжить</button>
                    </div>
                </form>
                <? endif; ?>

                <!-- NOT Logged User SignIn Form -->
                <form class="modal-body <? if ($canLogin) : ?>displaynone<? endif; ?>" id="user_form_notlogged" action="<?=URL::site('sign/organizer'); ?>" method="POST">
                    <h4>Авторизация</h4>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="email" id="auth_email" name="email" placeholder="Ваш email" required="">
                        <label for="auth_email" class="icon-label">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="password" id="auth_password" name="password" placeholder="Ваш пароль" required="">
                        <label for="auth_password" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12">
                        <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                        <button type="button" id="resetPasword" class="btn btn_text-forgot col-xs-6">Забыли пароль?</button>
                        <button type="button" id="userSignIn" class="btn btn_primary col-xs-5 col-xs-offset-1">Войти</button>
                    </div>
                </form>

                <!-- Forgot Password Form -->
                <form class="modal-body displaynone" id="user_form_forgot" action="<?=URL::site(''); ?>" method="POST">

                    <h4 style="margin-top:0">Востановление пароля</h4>

                    <div class="input-field label-with-icon col-xs-12">
                        <input type="email" id="forget_email" name="email" placeholder="Введите Ваш email" required="">
                        <label for="forget_email" class="icon-label">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </label>
                    </div>

                    <!--<div class="g-recaptcha text-center" data-sitekey="6LelVhcUAAAAAJFftx6Hr90Ff6VWc8-KlT86OJRF"></div>-->

                    <div class="col-xs-12">
                        <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                        <button type="button" id="toUserSignIn" class="btn btn_default col-xs-5">Отмена</button>
                        <button type="button" id="resetPassword" class="btn btn_primary col-xs-6 col-xs-offset-1">Восстановить</button>
                    </div>
                </form>

                <div class="modal-footer text-center">
                    <a id="toJudgeForm" class="underlinehover">
                        Вход для жюри
                    </a>
                </div>
                <div class="modal-header text-center">
                    <a id="toUserForm" class="underlinehover">
                        Вход для пользователя
                    </a>
                </div>

                <!-- Judge SignIn Form -->
                <form class="modal-body" id="judge_form" action="<?=URL::site('sign/judge'); ?>" method="POST">
                    <h4>Вход для жюри</h4>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="text" id="auth_eventnumber" name="eventCode" placeholder="Код мероприятия" required="">
                        <label for="auth_eventnumber" class="icon-label">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="password" id="auth_judgesecret" name="judgeSecret" placeholder="Ваш пароль" required="">
                        <label for="auth_judgesecret" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12">
                        <button type="button" id="judgeSignIn" class="btn btn_primary col-xs-6 col-xs-offset-3">Войти</button>
                    </div>
                    <?=Form::hidden('csrf', Security::token()); ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->

<div class="modal valign registr-modal" id="registr_modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content row-col">
            <div class="modal-wrapper">
                <form class="modal-body clear_fix" id="registr_form" action="<?=URL::site(''); ?>" method="POST">
                    <h4>Регистрация</h4>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="text" id="registr_name" name="name" placeholder="Введите ваш имя" required="">
                        <label for="registr_name" class="icon-label">
                            <i aria-hidden="true" class="fa fa-user"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="email" id="registr_email" name="email" placeholder="Введите ваш email" required="">
                        <label for="registr_email" class="icon-label">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-12">
                        <input type="password" id="registr_password" name="password" placeholder="Придумайте пароль" required="">
                        <label for="registr_password" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12 text-center">
                        <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                        <button type="button" id="registr" class="btn btn_primary">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
