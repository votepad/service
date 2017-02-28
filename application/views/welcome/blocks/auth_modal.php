<!-- Authorization Modal -->

<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>

<div class="modal valign auth-modal" id="auth_modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content row-col">
            <div class="modal-wrapper">
                <form class="modal-body" id="user_modal" action="<?=URL::site('sign/organizer'); ?>" method="POST">
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
                </form>
                <div class="modal-footer text-center">
                    <a id="toJudgeModal" class="underlinehover">
                        Вход для жюри
                    </a>
                </div>
                <div class="modal-header text-center">
                    <a id="toUserModal" class="underlinehover">
                        Вход для организатора
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
