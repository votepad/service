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
                    <!-- нужно втавить file upload для изображения с preview -->
                    <div class="">
                        <img src="<?=$assets; ?>img/user/no-user.png" alt="Avatar" class="pronwe_boxShadow pronwe_border-1px" style="max-width:150px; width:inherit; border-radius:10%; margin:0 auto;">
                    </div>
                    <div class="btn_area">
                        <input type="file" id="choose-user-photo" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                        <label for="choose-user-photo" class="btn btn-default">
                            <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span>
                            <span class="buttonText">Выберите фото</span>
                        </label>
                    </div>
                    
                </div>
                <div class="col-sm-8">
                    <div class="form-horizontal">
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Фамилия</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="surname" data-pk="<?=$user['id']; ?>"><?=$user['surname']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Имя</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="name" data-pk="<?=$user['id']; ?>"><?=$user['name']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Отчество</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="lastname" data-pk="<?=$user['id']; ?>"><?=$user['lastname'];?></a>
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
                                    <a href="#" id="number" data-pk="<?=$user['id']; ?>"><?=$user['number']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Город</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="city" data-type="typeaheadjs" data-pk="<?=$user['id']; ?>"><?=$user['city']; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>