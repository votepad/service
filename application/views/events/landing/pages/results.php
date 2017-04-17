<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">

<div class="section__wrapper">

    <div class="jumbotron-landing valign">
        <div class="container" style="z-index: 2">
            <a href="<?=URL::site('event/' . $event->id); ?>" class="jumbotron-landing__title"><?=$event->name; ?></a>
        </div>
        <div class="jumbotron-filter"></div>

        <div class="parallax">
            <img id="" src="/uploads/events/branding/<?=$event->branding; ?>">
        </div>

    </div>

    <section id="eventResult" class="container">
        <h1 class="text-brand m-t-50 text-center">
            Результаты мероприятия
        </h1>


        <!-- CONTEST START -->
        <div id="contest_1" class="m-t-50 clear_fix">
            <h2 class="text-brand">Contest 1</h2>
            <div class="contest-description">
                contest_description : lalalalalala lllallalalal and zksld sdadcb xziume cx jb asd,mx  kawjdvsdjk fvm,j chsdkj
                <br>
                Contest contains 3 stages.
            </div>

            <div class="contest-body">

                <ul class="stage-header">
                    <li class="stage-header__item active" data-toggle="tabs" data-btnGroup="stage_1" data-block="stage_1_1">Stage 1</li>
                    <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_1" data-block="stage_1_2">Stage 2</li>
                    <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_1" data-block="stage_1_3">Stage 3</li>
                </ul>

                <!-- STAGE START -->
                <ul id="stage_1_1" data-blockGroup="stage_1" class="stage-body">

                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name">name</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:50%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name">name</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:50%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name">name</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:50%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name"> namenamenamenamenamenamename</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:100%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- STAGE END -->

                <ul id="stage_1_2" data-blockGroup="stage_1" class="stage-body hide">
                    stage 2 - users
                </ul>
                <ul id="stage_1_3" data-blockGroup="stage_1" class="stage-body hide">
                    stage 3 - users
                </ul>
            </div>
        </div>
        <!-- CONTEST END -->

        <!-- CONTEST START -->
        <div id="contest_2" class="m-t-50 clear_fix">
            <h2 class="text-brand">Contest 2</h2>
            <div class="contest-description">
                contest_description : lalalalalala lllallalalal and zksld sdadcb xziume cx jb asd,mx  kawjdvsdjk fvm,j chsdkj
                <br>
                Contest contains 3 stages.
            </div>

            <div class="contest-body clear_fix">

                <ul class="stage-header">
                    <li class="stage-header__item active" data-toggle="tabs" data-btnGroup="stage_2" data-block="stage_2_1">Stage 1</li>
                    <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_2" data-block="stage_2_2">Stage 2</li>
                    <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_2" data-block="stage_2_3">Stage 3</li>
                </ul>

                <!-- STAGE START -->
                <ul id="stage_2_1" data-blockGroup="stage_2" class="stage-body">

                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name">name</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:50%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name">name</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:50%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name">name</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:50%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="member col-xs-12 col-md-4 col-lg-3">
                        <div class="member__area">
                            <span class="member__name"> namenamenamenamenamenamename</span>
                            <div class="member__logo">
                                <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                <div class="member__position">2</div>
                            </div>
                            <div class="member__rating-area">
                                <div data-pk="2" class="member__rating-bar" style="width:100%">
                                    <span class="member__bar">10/20</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- STAGE END -->

                <ul id="stage_2_2" data-blockGroup="stage_2" class="stage-body hide">
                    stage 2 - users
                </ul>
                <ul id="stage_2_3" data-blockGroup="stage_2" class="stage-body hide">
                    stage 3 - users
                </ul>
            </div>
        </div>
        <!-- CONTEST END -->


    </section>

</div>