<section>
    <div class="content-wrapper">
        <h2><?=$user['lastname']. ' ' .$user['name']. ' ' .$user['surname']; ?></h2>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2" style="padding:0 1em;">
                        <div class="user-block-picture" style="width:100%;">
                            <img src="<?=$assets; ?>img/user/<?=$user['avatar'];?>" alt="Avatar" class="pronwe_boxShadow pronwe_border-1px" style="max-width:150px; width:inherit; border-radius:10%; margin:0 auto;">
                            <div class="" title="Загрузить фотографию профиля" id="update-photo" style="padding-top: 10px">
                                <a class="load-photo">
                                    <em class="fa fa-upload" style="font-size: 1.8em"></em>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="panel">
                            <table id="user" style="clear: both" class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td width="35%">Фамилия</td>
                                    <td width="65%">
                                        <!-- IF LOGGED IN AS THAT USER <a href="#" id="firstname" data-type="text" data-pk="1" data-title="Введите фамилию">Иванов</a> -->
                                        <p class="menu-text text-primary"><?=$user['lastname']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Имя</td>
                                    <td width="65%">
                                        <a id="secondname" href="#" data-type="text" data-pk="1" data-title="Введите имя"><?=$user['name']; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Отчество</td>
                                    <td width="65%">
                                        <a id="thirdname" href="#" data-type="text" data-pk="1" data-title="Введите отчество"><?=$user['surname'];?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Номер телефона</td>
                                    <td width="65%">
                                        <a id="phonenumber" href="#" data-type="text" data-pk="1" data-title="Введите номер телефона"><?=$user['number']; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Город</td>
                                    <td width="65%">
                                        <a id="city" href="#" data-type="text" data-pk="1" data-title="Город"><?=$user['city']; ?></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

