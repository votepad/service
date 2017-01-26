<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>

<link href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sortable/Sortable.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/results.js"></script>

<h3 class="page-header"> Итоговая оценка
    <a id="update" class="pull-right" data-toggle="tooltip" data-placement="left" title="Изменить информацию"><i class="fa fa-save" aria-hidden="true"></i></a>
    <br>
    <small>Задайте фрмулу, по которой будет подсчитываться итоговая оценка для действующих лиц.</small>
</h3>

<div id="showVideo" class="block displaynone" style="height:200px">
    <h2 class="center">
        Как создать сценарий?
        <small>видео</small>
    </h2>
</div>

<!-- Result Blocks -->
<form method="POST" action="" id="result" enctype="multipart/form-data">

    <!--  Participants Formula Block  -->
    <div id="result_part">
        <h4 class="page-header">
            Результирующий балл, полученный участником
        </h4>
        <div class="form">
            <div class="form_body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-field">
                            <input id="result_formula_part" type="hidden" name="formula" value="">
                            <ul id="result_formula_part_area" class="dragable-inputarea">

                            </ul>
                            <label for="result_formula_part" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, чтобы создать формулу">Итоговая оценка, полученная участниками</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="result_drop_part" class="drop">

                            <!-- Droparea remove area -->
                            <div id="result_droparea_part" class="drop-area">
                                <i class="fa fa-3x fa-trash-o valign" aria-hidden="true"></i>
                            </div>

                            <!-- contests where only PARTS will take part in -->
                            <div class="clear_fix">
                                <span class="dragable-label">Список конкурсов, где принимают участие участники:</span>
                                <ul id="result_contest_part" class="dragable-area">
                                    <li class="item" data-val="id_1">Балл за "Конкурс 1"</li>
                                    <li class="item" data-val="id_2">Балл за "конкурс 2"</li>
                                </ul>
                            </div>

                            <!-- Math Symbols -->
                            <div class="clear_fix">
                                <span class="dragable-label">Алгебраические операции:</span>
                                <ul id="result_math_part" class="dragable-area">
                                    <li class="item dark" data-val="math0"><span class="icon-bracket-left"></span></li>
                                    <li class="item dark" data-val="math1"><span class="icon-bracket-right"></span></li>
                                    <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                                    <li class="item dark" data-val="math3"><span class="icon-minus"></span></li>
                                    <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                                    <li class="item dark" data-val="math5"><span class="icon-divide"></span></li>
                                </ul>
                            </div>

                            <!-- Coefficients -->
                            <div class="clear_fix">
                                <span class="dragable-label">Весовые коэффициенты:</span>
                                <ul id="result_coeff_part" class="dragable-area">
                                    <li class="item dark" data-val="coeff_0.5">0.5</li>
                                    <li class="item dark" data-val="coeff_0.7">0.7</li>
                                    <li class="item dark" data-val="coeff_0.9">0.9</li>
                                </ul>
                                <button type="button" class="coeff-add" onclick="addcoeff(result_coeff_part)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Teams Formula Block  -->
    <div id="result_team">
        <h3 class="page-header">
            Результирующий балл, полученный командой
        </h3>
        <div class="form">
            <div class="form_body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-field">
                            <input id="result_formula_team" type="hidden" name="formula" value="">
                            <ul id="result_formula_team_area" class="dragable-inputarea">

                            </ul>
                            <label for="result_formula_team" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, чтобы создать формулу">Итоговая оценка, полученная командой</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="result_drop_team" class="drop">

                            <!-- Droparea remove area -->
                            <div id="result_droparea_team" class="drop-area">
                                <i class="fa fa-3x fa-trash-o valign" aria-hidden="true"></i>
                            </div>

                            <!-- contests where only TEAMS will take part in -->
                            <div class="clear_fix">
                                <span class="dragable-label">Список конкурсов, где принимают участие команды:</span>
                                <ul id="result_contest_team" class="dragable-area">
                                    <li class="item" data-val="id_1">Балл за "Конкурс 3"</li>
                                    <li class="item" data-val="id_2">Балл за "конкурс 4"</li>
                                </ul>
                            </div>

                            <!-- Math Symbols -->
                            <div class="clear_fix">
                                <span class="dragable-label">Алгебраические операции:</span>
                                <ul id="result_math_team" class="dragable-area">
                                    <li class="item dark" data-val="math0"><span class="icon-bracket-left"></span></li>
                                    <li class="item dark" data-val="math1"><span class="icon-bracket-right"></span></li>
                                    <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                                    <li class="item dark" data-val="math3"><span class="icon-minus"></span></li>
                                    <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                                    <li class="item dark" data-val="math5"><span class="icon-divide"></span></li>
                                </ul>
                            </div>

                            <!-- Coefficients -->
                            <div class="clear_fix">
                                <span class="dragable-label">Весовые коэффициенты:</span>
                                <ul id="result_coeff_team" class="dragable-area">
                                    <li class="item dark" data-val="coeff_0.5">0.5</li>
                                    <li class="item dark" data-val="coeff_0.7">0.7</li>
                                    <li class="item dark" data-val="coeff_0.9">0.9</li>
                                </ul>
                                <button type="button" class="coeff-add" onclick="addcoeff(result_coeff_team)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Groups Formula Block  -->
    <div id="result_group">
        <h3 class="page-header">
            Результирующий балл, полученный группой
        </h3>
        <div class="form">
            <div class="form_body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="input-field">
                        <input id="result_formula_group" type="hidden" name="formula" value="">
                        <ul id="result_formula_group_area" class="dragable-inputarea">

                        </ul>
                        <label for="result_formula_group" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, чтобы создать формулу">Итоговая оценка, полученная группой</label>
                    </div>
                </div>
                <div class="col-sm-12">
                     <div id="result_drop_group" class="drop">

                         <!-- Droparea remove area -->
                         <div id="result_droparea_group" class="drop-area">
                             <i class="fa fa-3x fa-trash-o valign" aria-hidden="true"></i>
                         </div>

                         <!-- contests where only GROUPS will take part in -->
                         <div class="clear_fix">
                             <span class="dragable-label">Список конкурсов, где принимают участие команды:</span>
                             <ul id="result_contest_group" class="dragable-area">
                                 <li class="item" data-val="id_1">Балл за "Конкурс 5"</li>
                                 <li class="item" data-val="id_2">Балл за "конкурс 6"</li>
                             </ul>
                         </div>

                         <!-- Math Symbols -->
                         <div class="clear_fix">
                             <span class="dragable-label">Алгебраические операции:</span>
                             <ul id="result_math_group" class="dragable-area">
                                 <li class="item dark" data-val="math0"><span class="icon-bracket-left"></span></li>
                                 <li class="item dark" data-val="math1"><span class="icon-bracket-right"></span></li>
                                 <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                                 <li class="item dark" data-val="math3"><span class="icon-minus"></span></li>
                                 <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                                 <li class="item dark" data-val="math5"><span class="icon-divide"></span></li>
                             </ul>
                         </div>

                         <!-- Coefficients -->
                         <div class="clear_fix">
                             <span class="dragable-label">Весовые коэффициенты:</span>
                             <ul id="result_coeff_group" class="dragable-area">
                                 <li class="item dark" data-val="coeff_0.5">0.5</li>
                                 <li class="item dark" data-val="coeff_0.7">0.7</li>
                                 <li class="item dark" data-val="coeff_0.9">0.9</li>
                             </ul>
                             <button type="button" class="coeff-add" onclick="addcoeff(result_coeff_group)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                         </div>

                     </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</form>

<input type="hidden" id="event_id" value="5">

</form>
