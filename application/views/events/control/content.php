<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

    <div class="jumbotron block" style="height: 260px;">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

    </div>


    <section class="section__content">

        <div class="block block_default m-t-30">
            <div class="block_heading">
                <h4>Опубликовать результаты</h4>
            </div>
            <div class="block_body">
                этап 1 -
                <br>
                этап2
            </div>
        </div>


        <? foreach ($event->contests as $i => $contest): ?>
            <!-- CONTEST START -->
            <div class="block m-t-30">
                <div class="block_heading text-center">
                    <h4><?= $contest->name; ?></h4>
                </div>


                <ul class="stage-header clear_fix text-center">

                    <? foreach ($event->contests[$i]->stages as $j => $stage): ?>

                        <li class="stage-header__item <? echo $j == 0 ? 'active' : '' ?>" data-toggle="tabs" data-btnGroup="stage_<?= $i; ?>" data-block="stage_<?= $i . '_' . $j; ?>"><?= $stage->name; ?></li>

                    <? endforeach; ?>

                </ul>

                <? foreach ($event->contests[$i]->stages as $j => $stage): ?>
                    <!-- STAGE START -->
                    <div id="stage_<?= $i . '_' . $j; ?>" data-blockGroup="stage_<?= $i; ?>" class="block_body <? echo $j != 0 ? 'hide' : '' ?>">

                        <table class="stage__table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th class="no-sort">Judge 1</th>
                                    <th class="no-sort">Judge 2</th>
                                    <th class="no-sort">Judge 3</th>
                                    <th class="no-sort">Judge 4</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                        <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>5</td>
                            <td>5</td>
                            <td>8</td>
                            <td>8</td>
                            <td>13</td>
                        </tr>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>5</td>
                            <td>5</td>
                            <td>8</td>
                            <td>8</td>
                            <td>1385</td>
                        </tr>
                        </tbody>
                    </table>

                    </div>
                    <!-- STAGE END -->
                <? endforeach; ?>

            </div>
            <!-- CONTEST END -->
        <? endforeach;?>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>static/js/event/control.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.stage__table').DataTable({
                'paging': false,
                'searching': false,
                'info': false,
                'scrollX': true,
                "order": [[ 5, "desc" ]],
                columnDefs: [
                    { 'targets' : 'no-sort', 'orderable': false },
                ]
            });
        });
    </script>
</div>