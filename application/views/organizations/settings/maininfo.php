<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('organizations/blocks/jumbotron_wrapper', array('organization' => $organization)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('organizations/settings/jumbotron_navigation', array('id' => $organization->id)); ?>
        </div>

    </div>


    <section class="section__content">

        <h3 class="page-header">
            Изменение основной информации об организации
        </h3>

        <div class="row">
            <form class="form" action="<?=URL::site('organization/' . $organization->id . '/update'); ?>" method="POST" id="update_main_info">
                <div class="form_body clear_fix">
                    <div class="col-xs-12">
                        <div class="row row-col">
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="text" id="org_name" name="org_name" length="60" value="<?=$organization->name; ?>" placeholder="Например: <?=$organization->name; ?>">
                                <label for="org_name" class="input-label active">Название организации</label>
                            </div>
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="text" id="org_site" name="org_site" class="vp_site" length="38" value="<?=$organization->uri; ?>" placeholder="Например: http://votepad.ru/<?=$organization->uri; ?>">
                                <label for="org_site" class="input-label active">Ссылка на страницу организации</label>
                                <span class="help-block">Хотите изменить ссылку на Вашу организацию? <a id="openChangeSiteModal" class="underlinehover" style="color: #bbb">Напишите нам</a></span>
                            </div>
                        </div>
                        <div class="row row-col">
                            <div class="input-field col-xs-12 col-md-6">
                                <textarea id="org_description" name="org_description" length="300" placeholder="Например: <?=$organization->description; ?>"><?=$organization->description; ?></textarea>
                                <label for="org_description">Описание организации</label>
                                <span class="help-block">Данная информация поможет найти Вашу организацию через поисковые системы.</span>
                            </div>
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="text" id="official_org_site" name="official_org_site" value="<?=$organization->website; ?>" placeholder="Например: <?=$organization->website; ?>">
                                <label for="official_org_site" class="input-label active">Ссылка на официальный сайт</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form_submit clear_fix">
                    <button type="submit" class="btn btn_primary col-xs-12 col-md-4 col-lg-3 pull-right">
                        Обновить информацию
                    </button>
                    <button type="button" id="remove_organization" class="btn btn_default col-xs-12 col-md-4 col-lg-3">
                        Удалить организацию
                    </button>
                </div>
            </form>
        </div>

    </section>


    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/organization/settings-maininfo.js"></script>
    <script>
        $(document).ready(function() {

            'use strict';

            /**
            * Delete Organization
            */
            $('#remove_organization').click(function(){

                vp.notification.notify({
                    type: 'confirm',
                    size: 'large',
                    showCancelButton: true,
                    confirmText: "Да, удалить организацию",
                    cancelText: "Нет, отмена",
                    message: '<h3 class="text--default">Вы уверены что хотите удалить организацию?</h3>',
                    confirm: removeOrganization
                });

                function removeOrganization() {

                    var ajaxData = {
                        url: '/organization/<?=$organization->id;?>/delete',
                        data: {
                            id : <?=$organization->id; ?>
                        },
                        success: function(response) {

                            response = JSON.parse(response);

                            if (response.code != '40') {
                                return;
                            }

                            vp.notification.notify({
                                type: 'success',
                                message: 'Организация удалена!',
                                time: 3
                            });

                            var host        = window.location.host,
                                protocol    = window.location.protocol;

                            window.location.replace(protocol+'//'+host+'/user/'+<?= $user->id; ?>);

                        },
                        error: function(callback) {
                            console.log(callback);
                        }

                    };

                    vp.ajax.send(ajaxData);

                }


             });

        });
    </script>
</div>