<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/tabs.css?v=<?= filemtime("assets/frontend/modules/css/tabs.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/profile.css?v=<?= filemtime("assets/static/css/profile.css") ?>">

    <div class="jumbotron block jumbotron_profile">
        <div class="jumbotron__wrapper parallax-container">

            <div class="parallax">
                <img id="user-cover-uploaded" src="/uploads/profiles/branding/<?=$profile->branding; ?>">
            </div>
            <? if ($isLogged && $profile->isOwner) :?>
            <div class="jumbotron__edit-block">
                <a id="user-cover-edit" role="button" class="jumbotron__edit-btn js-user-jumbotron-cover">
                    <i class="fa fa-camera jumbotron__edit-icon" aria-hidden="true"></i>
                    <span class="jumbotron__edit-text">Обновить фото шапки</span>
                </a>
            </div>
            <? endif; ?>
        </div>
    </div>

    <section class="section__content">

        <?= View::factory('profile/blocks/profile-info', array('isProfileOwner' => $profile->isOwner, 'profile' => $profile)) ?>


<!--        --><?//= View::factory('profile/blocks/my-org-event',
//            array('isProfileOwner' => $profile->isOwner,
//                  'profile'        => $profile,
//                  'organizations'  => $profile->getOrganizations(),
//                  'events'         => $profile->getEvents()
//            )) ?>

    </section>


    <!-- =============== PAGE SCRIPTS ===============-->

    <? if ($isLogged) : ?>
        <input type="hidden" id="userID" data-id="<?=$user->id; ?>">
        <script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>static/js/profile.js?v=<?= filemtime("assets/static/js/profile.js") ?>"></script>
    <? endif; ?>
    <script type="text/javascript">
        $( document ).ready(function() {
            vp.tabs.init({
                search: true,
                counter: true
            });
        });
    </script>

</div>