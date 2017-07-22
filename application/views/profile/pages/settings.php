<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Настройки
</div>

<form class="block" id="profile">

    <div class="block__wrapper">

        <div class="form-group">
            <input id="userName" name="name" type="text" class="form-group__input" value="<?= $user->name; ?>" maxlength="20">
            <label for="userName" class="form-group__label">
                Ваше имя
            </label>
        </div>

        <div class="form-group">
            <input id="userEmail" name="email" type="email" class="form-group__input" value="<?= $user->email; ?>" maxlength="65">
            <label for="userEmail" class="form-group__label">
                Эл. почта
            </label>
            <div class="mt-5">
                <? if (empty($user->isConfirmed)) : ?>
                    <span class="label label--warning mr-10">не подтверждена</span>
                    <a onclick="profile.confirmEmail();" class="btn btn--sm btn--default m-0">Отправить повтороное письмо</a>
                <? else: ?>
                    <span class="label label--brand">подтверждена</span>
                <? endif; ?>
            </div>
        </div>

        <div class="form-group">
            <input placeholder="+79817771234" id="userPhone" name="phone" type="tel" class="form-group__input" value="<?= $user->phone; ?>" maxlength="12">
            <label for="userPhone" class="form-group__label">
                Телефон
            </label>
        </div>

        <div class="form-group">
            <div class="form-group__label form-group__label--active">Кому в интернете видна моя страница</div>
            <div class="fl_l mr-15">
                <input id="userPrivate_0" name="private" type="radio" class="radio" <?= $user->private == 0 ? 'checked' : ''; ?> value="0">
                <label for="userPrivate_0" class="radio-label">
                    Всем
                </label>
            </div>
            <div class="fl_l">
                <input id="userPrivate_1" name="private" type="radio" class="radio" <?= $user->private == 1 ? 'checked' : ''; ?> value="1">
                <label for="userPrivate_1" class="radio-label">
                    Только мне
                </label>
            </div>
        </div>

    </div>

    <div class="pl-20 mb-10">
        <input type="hidden" name="csrf" value="<?= Security::token(); ?>">
        <button type="submit" class="btn btn--lg btn--brand">Сохранить изменения</button>
        <button type="button" data-toggle="modal" data-area="changePasswordModal" class="btn btn--lg btn--brand-2">Изменить пароль</button>
    </div>

</form>

<!-- Change Password Modal -->
<form class="modal" id="changePasswordModal" tabindex="-1">
    <div class="modal__content modal__content--small">
        <div class="modal__wrapper">
            <div class="modal__header bb-0 text-center">
                <a role="button" data-close="modal" class="fl_r"><i class="fa fa-times" aria-hidden="true"></i></a>
                <span class="text-bold">Изменить пароль</span>
            </div>
            <div class="modal__body">
                <div class="form-group form-group--with-icon">
                    <input id="changePasswordOld" type="password" name="oldPassword" placeholder="Введите старый пароль" required="" class="form-group__input" maxlength="18">
                    <label for="changePasswordOld" class="form-group__label-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="form-group form-group--with-icon">
                    <input id="changePasswordNew" type="password" name="newPassword" placeholder="Введите новый пароль" required="" autocomplete="off" class="form-group__input" maxlength="18">
                    <label for="changePasswordNew" class="form-group__label-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="form-group form-group--with-icon">
                    <input id="changePasswordNew1" type="password" name="newPassword1" placeholder="Повторите новый пароль" required="" autocomplete="off" class="form-group__input" maxlength="18">
                    <label for="changePasswordNew1" class="form-group__label-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </label>
                </div>
                <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                <button type="submit" class="btn btn--brand fl_r m-0">Изменить</button>
            </div>
        </div>
    </div>
</form>


<div class="block">
    <div class="t-lh-50px pl-25 text-bold">
        Связанные аккаунты
    </div>
    <div class="pl-20 pb-10">
        <div class="social-links">
            <div class="social-links__item social-links__item--fb" data-social="fb">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <span class="social-links__title">Facebook</span>
                <div class="social-links__delete" data-id="" data-type="1">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
            <div class="social-links__item social-links__item--vk" data-social="vk">
                <i class="fa fa-vk" aria-hidden="true"></i>
                <span class="social-links__title">ВКонтакте</span>
                <div class="social-links__delete" data-id="" data-type="2">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
            <div class="social-links__item social-links__item--tw" data-social="tw">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <span class="social-links__title">Twitter</span>
                <div class="social-links__delete" data-id="" data-type="3">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
            <div class="social-links__item social-links__item--goggle" data-social="google">
                <i class="fa fa-google" aria-hidden="true"></i>
                <span class="social-links__title">Google</span>
                <div class="social-links__delete" data-id="" data-type="4">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>