<div class="user-info block">
    <div class="block_body text-center">

        <? if ( $isLogged && $isProfileOwner ) :?>

            <a id="profile_info-edit" class="user-info__edit-btn">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>

        <? endif; ?>

        <div class="user-info__avatar">
            <img src="/uploads/profiles/avatar/<?=$profile->avatar; ?>">
        </div>

        <div class="user-info__description row">
            <h1 class="user-info__description-name"><?= $profile->name; ?></h1>
            <h3 class="user-info__description-email"><a href="mailto:<?= $profile->email; ?>"><?= $profile->email ?></a></h3>
            <h3 class="user-info__description-phone"><a href="tel:<?= $profile->phone; ?>"><?= $profile->phone ?></a></h3>
        </div>

    </div>
</div>


<? if ( $isLogged && $isProfileOwner ) :?>
    <!-- Modal - Update User Info -->
    <form action="/user/<?= $profile->id ?>/update" method="POST" class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title">Изменение персональной информации</h4>
                </div>
                <div class="modal-body clear_fix">
                    <div class="row">
                        <div class="text-center col-xs-12 col-md-auto fl_l">
                            <div class="edit-user-info__avatar">
                                <a class="edit-user-info__avatar-edit">
                                    <i class="fa fa-2x fa-camera" aria-hidden="true"></i>
                                </a>
                                <img src="/uploads/profiles/avatar/<?=$profile->avatar; ?>" id="user-avatar">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-auto edit-user-info__fio">
                            <div class="input-field col-xs-12 col-md-5">
                                <input type="text" id="name" name="name" value="<?= $profile->name ?>" required>
                                <label for="name" class="">Имя</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Контакты</h4>
                            <div class="input-field edit-user-info__input">
                                <input type="email" id="email" name="email" value="<?= $profile->email ?>" required>
                                <label for="email" class="">Эл.почта</label>
                            </div>

                            <div class="input-field edit-user-info__input">
                                <input type="tel" id="phone" name="phone" value="<?= $profile->phone ?>" placeholder="+7">
                                <label for="phone" class="">Телефон</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Изменить пароль</h4>
                            <div class="input-field">
                                <input type="password" id="oldpassword" name="oldpassword">
                                <label for="oldpassword" class="">Введите старый пароль</label>
                            </div>

                            <div class="input-field">
                                <input type="password" id="newpassword" name="newpassword">
                                <label for="newpassword" class="">Введите новый пароль</label>
                            </div>

                            <div class="input-field">
                                <input type="password" id="newpassword2" name="newpassword2">
                                <label for="newpassword2" class="">Повторите новый пароль</label>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="text" name="avatar" value="<?=$profile->avatar; ?>" id="input-avatar" hidden>

                <div class="modal-footer clear_fix">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn_default col-xs-12 col-md-auto" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn_primary pull-right col-xs-12 col-md-auto">Сохранить изменения</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
<? endif; ?>