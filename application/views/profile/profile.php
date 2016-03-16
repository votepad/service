<?php

$user   = $user->getUserInfo();
?>
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
                            <table id="user" class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td width="35%">Фамилия</td>
                                    <td width="65%">
                                        <a href="#" class="editable" data-name='lastname' data-type="text" data-pk="<?=$user['id']; ?>"><?=$user['lastname']; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Имя</td>
                                    <td width="65%">
                                        <a href="#" class="editable" data-name='name' data-type="text" data-pk="<?=$user['id']; ?>" data-title="Введите имя"><?=$user['name']; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Отчество</td>
                                    <td width="65%">
                                        <a href="#" class="editable" data-name='surname' data-type="text" data-pk="<?=$user['id']; ?>" data-title="Введите отчество"><?=$user['surname'];?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Номер телефона</td>
                                    <td width="65%">
                                        <a href="#" class="editable" data-name='number' data-type="text" data-pk="<?=$user['id']; ?>" data-title="Введите номер телефона"><?=$user['number']; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Город</td>
                                    <td width="65%">
                                        <a href="#" class="editable" data-name='city' data-type="text" data-pk="<?=$user['id']; ?>" data-title="Город"><?=$user['city']; ?></a>
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
<script>
    $(function(){
        var url = location.protocol+'//'+location.hostname+'/pronwe/';

        $('.editable').editable({
            url: url+'/Profile_Ajax/update/',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>

