<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title></title>

        <!-- =============== VENDOR STYLES ===============-->
        <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css">
        <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css">
        <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/header.css">
        <link rel="stylesheet" href="<?=$assets; ?>css/judges.css">


        <!-- =============== VENDOR SCRIPTS ===============-->
        <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>static/js/judges/judges.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/votepad.bundle.js"></script>
    </head>
    <body>

    <?=$header?>
    <?=$jumbotron_wrapper?>


    <div id="stage_nav" class="stage_nav">
        <ul class="stage_nav-ul tabs__header">
            <li class="stage_nav_ul-li tabs__btn tabs__btn--active" data-toogle="tabs" data-block="qw">Деловая игра</li>
            <li class="stage_nav_ul-li tabs__btn " data-toogle="tabs" data-block="qw1">Доклад участника</li>
            <li class="stage_nav_ul-li">Доклад участника</li>
            <li class="stage_nav_ul-li">Творческий этап</li>
            <li class="stage_nav_ul-li">Творческий этап</li>
        </ul>
    </div>

        <div class="stages_holder tabs__content"> <!--Держатель этапов-->

            <div class="stages_holder-stage tabs__block tabs__block--active" id="qw"> <!--Один этап-->

                <div class="stages_holder_stage-peoples"> <!--Человек на этапе-->

                    <div id="LOL" class="stages_holder_stage_peoples-criteria-holder"> <!--Критерии для человека-->

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>КЕЕЕК</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ЛОООЛ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХЕХ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>КЕЕЕК</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ЛОООЛ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХЕХ</h1>
                        </div>

                    </div>


                </div>

                <div class="stages_holder_stage-peoples"> <!--Человек на этапе-->

                    <div class="stages_holder_stage_peoples-criteria-holder"> <!--Критерии для человека-->

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХЕХ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХАХ</h1>
                        </div>

                    </div>


                </div>


            </div>

            <div class="stages_holder-stage tabs__block" id="qw1"> <!--Один этап-->

                <div class="stages_holder_stage-peoples"> <!--Человек на этапе-->

                    <div id="LOL" class="stages_holder_stage_peoples-criteria-holder"> <!--Критерии для человека-->

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>КЕЕЕК</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ЛОООЛ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХЕХ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>КЕЕЕК</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ЛОООЛ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХЕХ</h1>
                        </div>

                    </div>


                </div>

                <div class="stages_holder_stage-peoples"> <!--Человек на этапе-->

                    <div class="stages_holder_stage_peoples-criteria-holder"> <!--Критерии для человека-->

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХЕХ</h1>
                        </div>

                        <div class="stages_holder_stage_peoples_criteria_holder-criteria"> <!--Критерий-->
                            <h1>ХАХ</h1>
                        </div>

                    </div>


                </div>


            </div>


        </div>




       <!--<div class="row">
           <div class="col-xs-12">

               <card class="card card_withimage clear_fix open" id="team_17">

                   <div class="card_image" id="logo_team_17">
                       <img src="/uploads/teams/m_" alt="">
                   </div>

                   <div class="card_withimage card_title">
                       <div class="card_title-text" id="name_team_17">
                           ваолмвталом
                       </div>
                   </div>

               </card>

           </div>
       </div>-->
    </body>
    <script type="text/javascript">
        vp.tabs.init();
    </script>
</html>
