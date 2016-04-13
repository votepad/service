<?php $user   = $user->getUserInfo(); ?>
<section>
    <div class="content-wrapper">
        <h3>Добро подаловать в личный кабинет
            <small>Изменение персональной информации</small>
        </h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-4 text-center">
                    <form id="image-upload" method="POST">
                        <div class="">
                            <img id="image" src="<?=URL::base().'uploads/' . $user['avatar']; ?>" alt="Avatar" class="pronwe_boxShadow pronwe_border-1px logo-preview">
                        </div>
                        <div class="btn_area">
                            <input id="choose-image" type="file"tabindex="-1" class="logo-input" onchange="readURL(this)">
                            <label for="choose-image" class="btn btn-default fileinput-button">
                                <span class="fa fa-folder-open"></span>
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
                                    <a href="#" class="editable" data-type="text" data-name="surname" data-pk="<?=$user['id']; ?>"><?=$user['surname']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Имя</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" class="editable" data-type="text" data-name="name" data-pk="<?=$user['id']; ?>"><?=$user['name']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Отчество</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" class="editable" data-type="text" data-name="lastname" data-pk="<?=$user['id']; ?>"><?=$user['lastname'];?></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m0">
                            <label class="col-sm-4 control-label">Пол</label>
                            <div class="col-sm-8">
                                <p>
                                    <a href="#" id="sex" data-value="<?=$user['sex']; ?>" data-pk="<?=$user['id']; ?>"><?=$gender->get( $user['sex']); ?></a>
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
                                    <a href="#" id="city" data-value="<?=$user['city']; ?>" data-pk="<?=$user['id']; ?>"><?=$city->get( $user['city']); ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

