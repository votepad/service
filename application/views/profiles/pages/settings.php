<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Настройки
</div>

<form class="block" id="profile">

    <div class="block__wrapper p-20">

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
                <? if (empty($user->is_confirmed)) : ?>
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
        <button type="submit" class="ui-btn ui-btn--1 ui-btn--margin">
            Сохранить изменения
        </button>
        <button type="button" data-toggle="collapse" data-area="changePassword" data-opened="false"
                class="ui-btn ui-btn--2 ui-btn--margin collapse__btn" data-textopened="Отмена изменения пароля" data-textclosed="Изменить пароль"
                onclick="document.getElementById('changePassword').reset();">

        </button>
    </div>

</form>

<!-- Change Password Modal -->
<form class="collapse" id="changePassword">
    <div class="block">
        <div class="block__heading pb-15 bb-1 text-bold">
            Изменить пароль
        </div>
        <div class="block__wrapper p-20">
            <div class="form-group">
                <input id="changePasswordOld" name="oldPassword" type="password" class="form-group__input" maxlength="18" required="">
                <label for="changePasswordOld" class="form-group__label">
                    Введите старый пароль
                </label>
            </div>
            <div class="form-group">
                <input id="changePasswordNew" name="newPassword" type="password" class="form-group__input" maxlength="18" required="" autocomplete="off" >
                <label for="changePasswordNew" class="form-group__label">
                    Введите новый пароль
                </label>
            </div>
            <div class="form-group">
                <input id="changePasswordNew1" name="newPassword1" type="password" class="form-group__input" maxlength="18" required="" autocomplete="off" >
                <label for="changePasswordNew1" class="form-group__label">
                    Повторите новый пароль
                </label>
            </div>

            <input type="hidden" name="csrf" value="<?= Security::token(); ?>">
            <button type="submit" class="ui-btn ui-btn--1 ui-btn--margin">
                Измененить пароль
            </button>
        </div>
    </div>
</form>