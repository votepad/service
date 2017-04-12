<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header"> Итоговая оценка <br>
            <small>Задайте фрмулу, по которой будет подсчитываться итоговая оценка для действующих лиц.</small>
        </h3>

        <!-- Participants Result -->
        <form class="form form_collapse" id="participantResult" method="POST" action="" >
            <div class="form_body">
                <h4 class="p-l-20">Добавить результат учатсников</h4>
                <div class="row hidden">
                    <div id="participantResultFormula" class="formula"></div>
                </div>
            </div>
            <div class="form_submit hidden clear_fix">
                <button type="button" class="btn btn_default col-sm-12 col-md-auto pull-left">
                    Удалить результат
                </button>
                <button type="submit" class="btn btn_primary col-sm-12 col-md-auto pull-right">
                    Сохранить
                </button>
            </div>
        </form>

        <!-- Teams Result -->
        <form class="form form_collapse" id="teamResult" method="POST" action="" >
            <div class="form_body">
                <h4 class="p-l-20">Добавить результат команд</h4>
                <div class="row hidden">
                    <div id="teamResultFormula" class="formula"></div>
                </div>
            </div>
            <div class="form_submit hidden clear_fix">
                <input type="hidden" id="event_id" value="5">
                <button type="button" class="btn btn_default col-sm-12 col-md-auto pull-left">
                    Удалить результат
                </button>
                <button type="submit" class="btn btn_primary col-sm-12 col-md-auto pull-right">
                    Сохранить
                </button>
            </div>
        </form>

        <!-- Group Result -->
        <form class="form form_collapse" id="groupResult" method="POST" action="" >
            <div class="form_body">
                <h4 class="p-l-20">Добавить результат групп</h4>
                <div class="row hidden">
                    <div id="groupResultFormula" class="formula"></div>
                </div>
            </div>
            <div class="form_submit hidden clear_fix">
                <input type="hidden" id="event_id" value="5">
                <button type="button" class="btn btn_default col-sm-12 col-md-auto pull-left">
                    Удалить результат
                </button>
                <button type="submit" class="btn btn_primary col-sm-12 col-md-auto pull-right">
                    Сохранить
                </button>
            </div>
        </form>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/results.js"></script>
</div>