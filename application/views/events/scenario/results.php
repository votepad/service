<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/formula.css" />


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/scenario/jumbotron_navigation', array('id' => $event->id));; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header"> Итоговый результат <br>
            <small>У мероприятия может быть только один результат, который отобразиться на странице мероприптия.</small>
        </h3>


        <form class="form" id="result" method="POST" action="<?= URL::site('results/save/' . $event->id) ?>" >
            <?= Form::hidden('result_id', $event->result->id) ?>
            <div class="form_heading">
                Формула подсчета итогового результата
                <button id="saveResult" type="submit" class="form_heading-icon hide fl_r"><i class="fa fa-save" aria-hidden="true"></i></button>
                <a id="editResult" class="form_heading-icon fl_r"><i class="fa fa-edit" aria-hidden="true"></i></a>
            </div>
            <div class="form_body clear_fix">
                <div class="col-xs-12 m-t-20 m-b-20">
                    <div class="row">
                        <i><u>Текущая формула:</u></i>
                        <div id="result_formula_print" class="formula formula-print inlineblock"  data-items='<?= $event->result->formula ?:'[]' ?>'></div>
                    </div>
                    <div class="row hide">
                        <span class="hide" id="allContests" data-items='<?= $event->contestsJSON ?>'></span>
                        <div id="result_formula" class="formula"></div>
                    </div>
                </div>
            </div>
            <?= Form::hidden('csrf', Security::token()) ?>
        </form>


    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/formula.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/results.js"></script>
</div>