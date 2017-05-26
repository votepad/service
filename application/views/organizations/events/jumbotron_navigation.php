<?
    $isOwner = $organization->isOwner(($user && $user->id) ? $user->id : 0);
    $isMember = $organization->isMember(($user && $user->id) ? $user->id : 0);
?>

<ul class="jumbotron__nav-list jumbotron__nav--org-list">

    <? if(! $isLogged) : ?>
    <li class="jumbotron__nav-item jumbotron__nav--org-item">
        <button class="dropdown_btn" onclick="vp.notification.notify({ type: 'warning', message: 'Вы не авторизованы! Пожалуйста, <b>авторизуйтесь</b> или пройдите <b>регистрацию</b>.', time: 3});">
            Вступить в организацию
        </button>
    </li>
    <? endif; ?>


    <? if($isLogged && !$isMember): ?>
    <li id="sendRequest" class="jumbotron__nav-item jumbotron__nav--org-item <? echo $isSendRequest ? 'displaynone' : ''?>">
        <button class="dropdown_btn" onclick="sendRequest();">
            Вступить в организацию
        </button>
    </li>
    <li id="cancelRequest" class="jumbotron__nav-item jumbotron__nav--org-item dropdown <? echo !$isSendRequest ? 'displaynone' : ''?>" data-toggle="dropdown" data-position="right" >
        <div class="dropdown__btn">
            Вы подали заявку
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </div>
        <div class="jumbotron__nav_org-dropdownmenu dropdown__menu">
            <a class="jumbotron__nav_org-dropdownitem dropdown__link" onclick="cancelRequest();">
                Отменить заявку
            </a>
        </div>
    </li>

    <script type="text/javascript">

        function sendRequest() {
            
            ajaxData = {
                url: '/organization/<?=$organization->id; ?>/join',
                success: function (response) {

                    response = JSON.parse(response);

                    if (response.code == '43') {
                        vp.notification.notify({
                            type: 'success',
                            message: 'Ваша заявка подана!',
                            time: 3
                        });
                        document.getElementById('sendRequest').classList.add('displaynone');
                        document.getElementById('cancelRequest').classList.remove('displaynone');
                    } else {
                        vp.notification.notify({
                            type: 'warning',
                            message: 'Произошла ошибка. Попробуйте снова',
                            time: 3
                        });

                    }
                },
                error: function (callback) {
                    vp.notification.notify({
                        type: 'warning',
                        message: 'Произошла ошибка. Попробуйте снова',
                        time: 3
                    });
                    console.log(callback);
                }
            };

            vp.ajax.send(ajaxData);

        }

        function cancelRequest() {

            ajaxData = {
                url: '/organization/<?=$organization->id; ?>/member/reject/<?=$user->id; ?>',
                success: function(response) {

                    response = JSON.parse(response);

                    if (response.code == '48') {
                        vp.notification.notify({
                            type: 'success',
                            message: 'Вы учпешно отменили заявку',
                            time: 3
                        });
                        document.getElementById('sendRequest').classList.remove('displaynone');
                        document.getElementById('cancelRequest').classList.add('displaynone');
                    } else {
                        vp.notification.notify({
                            type: 'warning',
                            message: 'Произошла ошибка. Попробуйте снова',
                            time: 3
                        });
                    }

                },
                error: function(callback) {
                    vp.notification.notify({
                        type: 'warning',
                        message: 'Произошла ошибка. Попробуйте снова',
                        time: 3
                    });
                    console.log(callback);
                }
            };

            vp.ajax.send(ajaxData);

        }

    </script>
    <? endif; ?>


    <? if($isLogged && $isMember && !$isOwner) : ?>
    <li class="jumbotron__nav-item jumbotron__nav--org-item dropdown" data-toggle="dropdown" data-position="right" >
        <div role="button" class="dropdown__btn">
            Вы состоите в организации
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </div>
        <div class="jumbotron__nav_org-dropdownmenu dropdown__menu">
            <a class="jumbotron__nav_org-dropdownitem dropdown__link" onclick="leaveOrganization();">
                Выйти из организации
            </a>
        </div>
    </li>

    <script type="text/javascript">

        function leaveOrganization() {

            ajaxData = {
                url: '/organization/<?=$organization->id; ?>/member/remove/<?=$user->id;?>',
                success: function(response) {

                    response = JSON.parse(response);

                    if (response.code == '47') {
                        vp.notification.notify({
                            type: 'success',
                            message: 'Вы покинули организацию!',
                            time: 3
                        });
                        window.location.reload();
                    } else {
                        vp.notification.notify({
                            type: 'warning',
                            message: 'Произошла ошибка. Попробуйте снова',
                            time: 3
                        });
                        return;
                    }

                },
                error: function(callback) {
                    vp.notification.notify({
                        type: 'warning',
                        message: 'Произошла ошибка. Попробуйте снова',
                        time: 3
                    });
                    console.log(callback);
                }
            };

            vp.ajax.send(ajaxData);
        }

    </script>
    <? endif; ?>


    <? if($isLogged && $isMember && $isOwner): ?>
    <li class="jumbotron__nav-item jumbotron__nav--org-item">
        <div class="dropdown_btn" style="cursor: default">
            Вы основали эту организацию
        </div>
    </li>
    <? endif; ?>

</ul>
