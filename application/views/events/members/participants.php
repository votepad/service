<link rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.full.min.css">
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event/participants.js"></script>


<h3 class="page-header">Список участников
    <a id="save" class="displaynone"><i class="fa fa-save" aria-hidden="true"></i></a>
    <a id="edit" class="displaynone"><i class="fa fa-edit" aria-hidden="true"></i></a>
</h3>

<div class="row" id="table_wrapper">
    <div id="preloader" class="text-center">
		<i class="fa fa-spinner fa-pulse fa-fw"></i>
		Загрузка данных
    </div>
    <div id="participants" class="displaynone"></div>
</div>

<input type="hidden" value="<?=$event->id; ?>" id="id_event">
<script src="<?=$assets; ?>frontend/production/nwe.js"></script>

<script>

    nwe.uploader.init({
        node : document.getElementById('testing'),
        server  : '/transport',
        success : function(result) {
            alert(result);
        },
        error : function() {
            alert(result);
        }
    });

</script>
