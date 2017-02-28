<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title>Профиль UserName | Votepad.ru</title>

    <meta name="description" content="" />
    <meta name="keywords" content="страница профиля, профиль, votepad, profile, user" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css?v=<?= filemtime("assets/css/icons_fonts.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css?v=<?= filemtime("assets/css/app_v1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/profile.css?v=<?= filemtime("assets/css/profile.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/profile.js"></script>

</head>
<body>
<?=$header; ?>

<div class="jumbotron block jumbotron_profile">

    <!-- Jumbotron Wrapper -->
    <?=$jumbotron_wrapper; ?>

</div>

<section>
    <div class="profile_info block">
        <div class="block_body text-center">
            <? if ($isLogged && $logged_user->id == $user->id) :?>
                <a id="profile_info-edit" class="profile_info-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            <? endif; ?>
            <div class="profile_info-avatar">
                <img src="<?=$assets; ?>img/logo.jpg" alt="User Avatar">
            </div>
            <div class="profile_info-description row">
                <h1 class="profile_info-description-name"><?= $user->name ?> <?= $user->surname ?></h1>
                <h3 class="profile_info-description-email"><?= $user->email ?></h3>
            </div>
        </div>
    </div>

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

<!-- Modal - Update User Info -->
<form action="" method="POST" class="modal fade" id="edituser_modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title">Изменение персональной информации</h4>
            </div>
            <div class="modal-body">
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
                        <div class="input-field">
                            <input type="text" id="edituser_name" name="name" value="<?= $user->name ?> <?= $user->surname ?>">
                            <label for="edituser_name" class="active">ФИО</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-field">
                            <input type="email" id="edituser_email" name="email" value="<?= $user->email ?>">
                            <label for="edituser_email" class="active">Эл.почта</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
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
                <button type="button" class="btn btn_default col-xs-12 col-md-auto" data-dismiss="modal">Отмена</button>
                <button id="update_info" type="button" class="btn btn_primary pull-right col-xs-12 col-md-auto">Сохранить изменения</button>
            </div>

        </div>
    </div>
</form>

</section>

<?=$footer; ?>

</body>
</html>
