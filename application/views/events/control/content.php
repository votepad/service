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


        <div class="block m-t-30">

            <div class="">
                <a role="button" data-toogle="tags" data-block="stage_0" class="">Итоговый за этап</a>
                <a role="button" data-toogle="tags" data-block="stage_1">этап 1</a>
                <a role="button" data-toogle="tags" data-block="stage_2">этап 2</a>
            </div>

            <div id="stage_1" class="block_body">
                <table id="example" class="display" cellspacing="0" width="100%">
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

            </div   >
            <div id="stage_2" class="block_body">
sda
            </div>
        </div>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#example').DataTable({
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

        vp.tabs.init();
    </script>
</div>