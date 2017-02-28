<!-- Authorization Modal -->
<?php

    $isLogged = Dispatch::isLogged();
    $hadLogged = Dispatch::hadLogged();
    $canLogin = false;

    if ($isLogged || (!$isLogged && $hadLogged))
        $canLogin = true;

?>

<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>

<div class="modal valign auth-modal" id="auth_modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content row-col">
            <div class="modal-wrapper">
                <form class="modal-body" id="user_modal" action="<?=URL::site('sign/organizer'); ?>" method="POST">

                    <? if ($canLogin) : ?>
                    <h4>Продолжить как</h4>
                    <div class="auth_logged col-xs-12">
                        <div class="auth_logged-image">
                            <img class="" src="<?=$assets; ?>img/logo.jpg" alt="">
                        </div>
                        <div class="auth_logged-name text-center">Nikolay Turov</div>
                    </div>
                    <div class="col-xs-12">
                        <button type="sumbit" class="btn btn_primary col-xs-5">Продолжить</button>
                        <button type="button" id="logout" class="btn btn_default col-xs-5 col-xs-offset-2">Выйти</button>
                    </div>
                    <? else : ?>
                    <h4>Авторизация</h4>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="email" id="auth_email" name="email" placeholder="Ваш email" required="">
                        <label for="auth_email" class="icon-label">
                            <i aria-hidden="true" class="fa fa-user"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="password" id="auth_password" name="password" placeholder="Ваш пароль" required="">
                        <label for="auth_password" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12">
                        <button type="button" id="userSignIn" class="btn btn_primary col-xs-6 col-xs-offset-3">Войти</button>
                    </div>
                    <? endif; ?>
                </form>
                <div class="modal-footer text-center">
                    <a id="toJudgeModal" class="underlinehover">
                        Вход для жюри
                    </a>
                </div>
                <div class="modal-header text-center">
                    <a id="toUserModal" class="underlinehover">
                        Вход для пользователя
                    </a>
                </div>
                <form class="modal-body" id="judge_modal" action="<?=URL::site('sign/judge'); ?>" method="POST">
                    <h4>Вход для жюри</h4>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="text" id="auth_eventnumber" name="eventNumber" placeholder="Код мероприятия" required="">
                        <label for="auth_eventnumber" class="icon-label">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="password" id="auth_judgesecret" name="judgesecret" placeholder="Ваш пароль" required="">
                        <label for="auth_judgesecret" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12">
                        <button type="button" id="judgeSignIn" class="btn btn_primary col-xs-6 col-xs-offset-3">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<? if (! $canLogin) : ?>

<!-- Registration Modal -->

<div class="modal valign registr-modal" id="registr_modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content row-col">
            <div class="modal-wrapper">
                <form class="modal-body" id="user_modal" action="<?=URL::site('/signup'); ?>" method="POST">

                    <h4>Регистрация</h4>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="email" id="registr_email" name="email" placeholder="Введите ваш email" required="">
                        <label for="registr_email" class="icon-label">
                            <i aria-hidden="true" class="fa fa-user"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="password" id="registr_password" name="password" placeholder="Придумайте пароль" required="">
                        <label for="registr_password" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="input-field label-with-icon col-xs-10 col-xs-offset-1">
                        <input type="password" id="registr_password2" name="password2" placeholder="Повторите пароль" required="">
                        <label for="registr_password2" class="icon-label">
                            <i aria-hidden="true" class="fa fa-lock"></i>
                        </label>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button type="submit" id="registr" class="btn btn_primary">Зарегистрироваться</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<? endif; ?>
