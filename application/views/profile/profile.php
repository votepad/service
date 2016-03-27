<?php

$user   = $user->getUserInfo();
?>


<section>
    <div class="content-wrapper">
        <h3>Добро подаловать в личный кабинет
            <small>Здесь вы можете исправить информацию о себе</small>
        </h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-4 text-center">
                    <form id="image-upload" method="POST">
                        <div class="">
                            <img id="image" src="<?=$assets; ?>img/user/no-user.png" alt="Avatar" class="pronwe_boxShadow pronwe_border-1px" style="width:150px; height: 150px; border-radius:10%; margin:0 auto;">
                        </div>
                        <div class="btn_area">
                            <input id="choose-image" type="file"tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);" onchange="readURL(this)">
                            <label for="choose-image" class="btn btn-default fileinput-button">
                                <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span>
                                <span class="buttonText">Обновить фото</span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <div class="form-horizontal">
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Фамилия</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="surname" class="editable" data-pk="<?=$user['id']; ?>"><?=$user['surname']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Имя</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="name" class="editable" data-pk="<?=$user['id']; ?>"><?=$user['name']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Отчество</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="lastname" class="editable" data-pk="<?=$user['id']; ?>"><?=$user['lastname'];?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Пол</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="sex" data-pk="<?=$user['id']; ?>"><?=$user['sex'];?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Номер телефона</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="number" class="editable" data-pk="<?=$user['id']; ?>"><?=$user['number']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Город</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="city" data-pk="<?=$user['id']; ?>"><?=$user['city']; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

