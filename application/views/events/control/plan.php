<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v<?= filemtime("assets/static/css/event.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event-control.css">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=View::factory('events/control/jumbotron_navigation', array('id' => $event->id)); ?>
        </div>

    </div>


    <section class="section__content">


        <? foreach ($event->contests as $i => $contest): ?>
        <div class="block m-t-30">
            <div class="block_heading" data-toggle="collapse" data-area="contest<?= $contest->id; ?>" data-opened="false">
                <h4><?= $contest->name; ?></h4>
            </div>
            <div id="contest<?= $contest->id; ?>" class="collapse">
                <div class="block_body ">
                    заблокировать критерий
                    <br>
                    заплокировать этапы
                    <br>
                    заблокировать member на этапе
                </div>
            </div>
        </div>
        <? endforeach; ?>

        <!---
        <div id="ban-participant" class="panel panel-primary">
                                <div class="panel-heading portlet-handler">Запретить участвовать
                                    <a href="#" data-tool="panel-collapse" class="pull-right">
                                        <em class="fa fa-minus"></em>
                                    </a>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <!-- отправляем через ajax --
                <form method="POST" action="=URL::site('blockparticipants') ;?>">
                    <input type="hidden" name="id_event" value="=$id_event; ?>">
                    <div class="form-group">
                        <select name="stage" class="form-control">
                            <!-- выводим список этапов --
                             for($i = 0; $i < count($stages); $i++) : ?>
                                <option value="=$stages[$i]['id']; ?>">=$stages[$i]['name']; ?></option>
                             endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- выводим список участников --
                         for($i = 0; $i < count($participants_1); $i++) : ?>
                            <div class="checkbox c-checkbox needsclick">
                                <label class="needsclick">
                                    <input type="checkbox" name="id[]" value="=$participants_1[$i]['id']; ?>" class="needsclick">
                                    <span class="fa fa-check"></span>=$participants_1[$i]['name']; ?>
                                </label>
                            </div>
                         endfor; ?>

                        <button type="submit" class="btn btn-default btn_area pull-right">Запретить участвовать</button>
                    </div>
                </form>
        </div>
        </div>
        </div>

        </div>

        <div id="portles-1-2" data-toggle="portlet" class="col-md-8">

            <div id="confirm-steps" class="panel panel-primary">
                <div class="panel-heading portlet-handler">Переход к следующему этапу
                    <a href="#" data-tool="panel-collapse" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 50%">Название этапа</th>
                                <th class="text-center" style="width: 25%">Следующий этап</th>
                            </tr>
                            </thead>
                            <tbody>
                             for($i = 0; $i < count($stages); $i++) : ?>
                                <tr>
                                    <td>=$stages[$i]['name']; ?></td>
                                    <td id="=$stages[$i]['id']; ?>" class="text-center">
                                        <button id="openStage" class="btn btn-default btn-open btn-open-=$i; ?>">Открыть доступ</button>
                                    </td>
                                </tr>
                             endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="addscore-participant" class="panel panel-primary">
                <div class="panel-heading portlet-handler">Поставить дополнительный балл
                    <a href="#" data-tool="panel-collapse" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- отправляем через ajax --
                        <form method="POST" action="=URL::site('addExtraScore') ;?>">
                            <input type="hidden" name="id_event" value="=$id_event; ?>">
                            <div class="form-group">
                                <select name="stage" class="form-control">
                                    <!-- выводим список этапов --
                                     for($i = 0; $i < count($stages); $i++) : ?>
                                        <option value="=$stages[$i]['id']; ?>">=$stages[$i]['name']; ?></option>
                                     endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <!-- выводим список участников --
                                         for($i = 0; $i < count($participants_1); $i++) : ?>
                                            <div class="checkbox c-checkbox needsclick">
                                                <label class="needsclick">
                                                    <input type="checkbox" name="id[]" value="=$participants_1[$i]['id']; ?>" class="needsclick">
                                                    <span class="fa fa-check"></span>=$participants_1[$i]['name']; ?>
                                                </label>
                                            </div>
                                         endfor; ?>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="row">
                                            <label class="col-lg-5 control-label">Введитее балл</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="score">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default btn_area pull-right">Поставить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        -->
    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?= $assets; ?>static/js/event/control.js"></script>

</div>