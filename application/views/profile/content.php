<!-- =============== PAGE STYLE ===============-->
<link rel="stylesheet" href="<?=$assets; ?>static/css/profile.css?v=<?= filemtime("assets/static/css/profile.css") ?>">

<div class="jumbotron block jumbotron_profile">
    <div class="jumbotron_wrapper parallax-container">

        <div class="parallax jumbotron_cover">
            <img id="user-cover-uploaded" src="<?=$assets; ?>img/welcome/bg1.jpg">
        </div>

        <? if ($isLogged && $user->id) :?>
        <div class="jumbotron_wrapper_edit">
            <a id="user-cover-edit" role="button" class="jumbotron_wrapper_edit-btn">
                    <i class="fa fa-camera jumbotron_wrapper_edit-icon" aria-hidden="true"></i>
                <span class="jumbotron_wrapper_edit-text">Обновить фото шапки</span>
            </a>
        </div>
        <? endif; ?>
    </div>
</div>

<section>

    <div class="profile_info block">
        <div class="block_body text-center">

            <? if ( $isLogged && $isProfileOwner ) :?>

                <a id="profile_info-edit" class="profile_info-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>

            <? endif; ?>

            <div class="profile_info-avatar">
                <img src="<?=$assets; ?>img/logo.jpg" alt="User Avatar">
            </div>

            <div class="profile_info-description row">
                <h1 class="profile_info-description-name"><?= $profile->name ?> <?= $profile->lastname ?> <?= $profile->surname ?></h1>
                <h3 class="profile_info-description-email"><a href="mailto:<?= $profile->email; ?>"><?= $profile->email ?></a></h3>
                <h3 class="profile_info-description-phone"><a href="tel:<?= $profile->phone; ?>"><?= $profile->phone ?></a></h3>
            </div>

        </div>
    </div>

    <?= View::factory('profile/blocks/reset_password') ?>


    <div class="profile_statistic block clear_fix">
        <a href="/profile/events#archive" class="profile_statistic-item valign">
            <span class="center">
                Организовал <span class="profile_statistic-item-num">50</span> мероприятий
            </span>
        </a>
        <a href="profile/events#next" class="profile_statistic-item valign">
            <span class="center">
                Предстоит провести <span class="profile_statistic-item-num">5</span> меропрятий
            </span>
        </a>
    </div>

    <div class="profile_orgs block">
        <div class="">
            Информация об организациях (придумать вид)
        </div>
    </div>

    <div class="profile_events block">
        <div class="">
            Информация о мероприятиях (придумать вид)
        </div>
    </div>

    <? if ( $isLogged && $isProfileOwner ) :?>
        <!-- Modal - Update User Info -->
        <form action="<?= $profile->id ?>/update" method="POST" class="modal fade" id="edituser_modal" tabindex="-1" role="dialog" >
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
                            <div class="col-xs-12 col-md-auto edituser_modal-avatarwrapper">
                                <div class="edituser_modal-avatar">
                                    <a class="edituser_modal-avatar-edit">
                                        <i class="fa fa-2x fa-camera" aria-hidden="true"></i>
                                    </a>
                                    <img src="<?=$assets; ?>img/logo.jpg" alt="User Avatar">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-auto edituser_modal-name">
                                <div class="input-field col-xs-12">
                                    <input type="text" id="edituser_surname" name="surname" value="<?= $profile->surname ?>" required>
                                    <label for="edituser_surname" class="active">Фамилия</label>
                                </div>
                                <div class="input-field col-xs-12 col-md-5">
                                    <input type="text" id="edituser_name" name="name" value="<?= $profile->name ?>" required>
                                    <label for="edituser_name" class="active">Имя</label>
                                </div>
                                <div class="input-field col-xs-12 col-md-6 col-md-offset-1">
                                    <input type="text" id="edituser_lastname" name="lastname" value="<?= $profile->lastname ?>">
                                    <label for="edituser_lastname" class="active">Отчество</label>
                                </div>

                            </div>
                        </div>
                        <div class="row edituser_modal-block">
                            <div class="col-xs-12">
                                <h4>Контакты</h4>
                                <div class="input-field">
                                    <input type="email" id="edituser_email" name="email" value="<?= $profile->email ?>" required>
                                    <label for="edituser_email" class="active">Эл.почта</label>
                                </div>

                                <div class="input-field">
                                    <input type="tel" id="edituser_phone" name="phone" value="<?= $profile->phone ?>">
                                    <label for="edituser_phone" class="active">Телефон</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Изменить пароль</h4>
                                <div class="input-field">
                                    <input type="password" id="edituser_oldpassword" name="oldpassword">
                                    <label for="edituser_oldpassword" class="">Введите старый пароль</label>
                                </div>

                                <div class="input-field">
                                    <input type="password" id="edituser_newpassword" name="newpassword">
                                    <label for="edituser_newpassword" class="">Введите новый пароль</label>
                                </div>

                                <div class="input-field">
                                    <input type="password" id="edituser_newpassword2" name="newpassword2">
                                    <label for="edituser_newpassword2" class="">Повторите новый пароль</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clear_fix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn_default col-xs-12 col-md-auto" data-dismiss="modal">Отмена</button>
                            <button id="update_info" type="button" class="btn btn_primary pull-right col-xs-12 col-md-auto">Сохранить изменения</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    <? endif; ?>

</section>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/profile.js"></script>