<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.full.min.css?v=<?= filemtime("assets/vendor/handsontable/handsontable.full.min.css") ?>">



    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/members/jumbotron_navigation', array('id' => $event->id));; ?>
        </div>

    </div>


    <section class="section__content">
        <div id="eventCode" data-id="<?=$event->code; ?>" class="eventCode">
            <h2>Код мероприятия</h2>
        </div>


        <h3 class="page-header">Представители жюри
            <a id="save" class="displaynone"><i class="fa fa-save" aria-hidden="true"></i></a>
            <a id="edit" class="pull-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
            <br><small>Для входа в систему сообщите представителям жюри код мероприятия и пароль. Пароль у каждого представителя жюри должен быть различен.</small>
        </h3>

        <div class="row" id="table_wrapper">
            <div id="preloader" class="text-center">
                <i class="fa fa-spinner fa-pulse fa-fw"></i>
                Загрузка данных
            </div>
            <div id="judges" class="displaynone"></div>
        </div>

        <input type="hidden" value="<?=$event->id; ?>" id="id_event">
    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/judges.js"></script>

</div>