<link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css">
<link rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.full.min.css">
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/event/participants.js"></script>


<h3 class="page-header">Список участников
    <a id="save" class="displaynone"><i class="fa fa-save" aria-hidden="true"></i></a>
    <a id="edit" class="pull-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
</h3>

<div class="row" id="table_wrapper">
    <div id="preloader" class="text-center">
		<i class="fa fa-spinner fa-pulse fa-fw"></i>
		Загрузка данных
    </div>
    <div id="participants" class="displaynone"></div>
</div>

<script src="<?=$assets; ?>frontend/production/main.js">
