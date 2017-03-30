<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/ajax.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/cookies.js"></script>

<ul class="jumbotron_nav-list jumbotron_nav_org-list">

    <? if(! $isLogged) : ?>
    <li class="jumbotron_nav-item jumbotron_nav_org-item">
        <button class="dropdown_btn" onclick="$.notify({message: 'Вы не авторизованы! Пожалуйста, <b>авторизуйтесь</b> или пройдите <b>регистрацию</b>.'},{timer: 3000, type: 'warning'});">
            Вступить в организацию
        </button>
    </li>
    <? endif; ?>


    <? if($isLogged && !$isMember): ?>
    <li id="sendRequest" class="jumbotron_nav-item jumbotron_nav_org-item <? echo $isSendRequest ? 'displaynone' : ''?>">
        <button class="dropdown_btn" onclick="sendRequest();">
            Вступить в организацию
        </button>
    </li>
    <li id="cancelRequest" class="jumbotron_nav-item jumbotron_nav_org-item dropdown <? echo !$isSendRequest ? 'displaynone' : ''?>" data-toggle="dropdown" data-position="right" >
        <div class="dropdown__btn">
            Вы подали заявку
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </div>
        <div class="jumbotron_nav_org-dropdownmenu dropdown__menu">
            <a class="jumbotron_nav_org-dropdownitem dropdown__link" onclick="cancelRequest();">
                Отменить заявку
            </a>
        </div>
    </li>

    <script type="text/javascript">

        function sendRequest() {

            ajaxData = {
                url: '/organization/<?=$id; ?>/join',
                success: function (response) {

                    response = JSON.parse(response);

                    if (response.code == '43') {
                        notify('successRespond');
                        document.getElementById('sendRequest').classList.add('displaynone');
                        document.getElementById('cancelRequest').classList.remove('displaynone');
                    } else {
                        notify('error');
                        return;
                    }
                },
                error: function (callback) {
                    notify('error');
                    console.log(callback);
                }
            };

            ajax.send(ajaxData);

        }

        function cancelRequest() {

            ajaxData = {
                url: '/organization/<?=$id; ?>/member/reject/<?=$userID; ?>',
                success: function(response) {

                    response = JSON.parse(response);

                    if (response.code == '48') {
                        notify("successCancel");
                        document.getElementById('sendRequest').classList.remove('displaynone');
                        document.getElementById('cancelRequest').classList.add('displaynone');
                    } else {
                        notify("error");
                        return;
                    }

                },
                error: function(callback) {
                    notify("error");
                    console.log(callback);
                }
            };

            ajax.send(ajaxData);

        }

    </script>
    <? endif; ?>


    <? if($isLogged && $isMember && !$isOwner) : ?>
    <li class="jumbotron_nav-item jumbotron_nav_org-item dropdown" data-toggle="dropdown" data-position="right" >
        <div role="button" class="dropdown_btn">
            Вы состоите в организации
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </div>
        <div class="jumbotron_nav_org-dropdownmenu dropdown_menu">
            <a class="jumbotron_nav_org-dropdownitem dropdown_item" onclick="leaveOrganization();">
                Выйти из организации
            </a>
        </div>
    </li>

    <script type="text/javascript">

        function leaveOrganization() {

            ajaxData = {
                url: '/organization/<?=$id; ?>/member/remove/<?=$userID;?>',
                success: function(response) {

                    response = JSON.parse(response);

                    if (response.code == '47') {
                        notify("successLeave");
                        window.location.reload();
                    } else {
                        notify("error");
                        return;
                    }

                },
                error: function(callback) {
                    notify("error");
                    console.log(callback);
                }
            };

            ajax.send(ajaxData);
        }

    </script>
    <? endif; ?>


    <? if($isLogged && $isMember && $isOwner): ?>
    <li class="jumbotron_nav-item jumbotron_nav_org-item">
        <div class="dropdown_btn" style="cursor: default">
            Вы основали эту организацию
        </div>
    </li>
    <? endif; ?>

</ul>


<script type="text/javascript">

    /**
     * Notify Frontend Fields
     */
    function notify(field) {

        switch (field) {

            case "successRespond":
                message = 'Ваша заявка подана!';
                type = 'success';
                break;
            case "successCancel":
                message = 'Вы успешно отменили заявку!';
                type = 'success';
                break;
            case "successLeave":
                message = 'Вы покинули организацию!';
                type = 'success';
                break;
            default:
                message = 'Произошла ошибка. Попробуйте снова';
                type = 'warning';
        }

        $.notify({
            message: message
        }, {
            type: type
        });
    }


</script>