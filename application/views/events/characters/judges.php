<link rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.full.min.css">
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/event/judges.js"></script>

<h3 class="page-header">Способ предоставления доступа жюри к системе</h3>

<div class="row">
    <form class="block">
        <p>
            <div class="switch">
                <label><input type="checkbox" checked=""> <span></span> </label>
                по логину и паролю, которые выдаются жюри перед мероприятием
            </div>
        </p>
        <p>
            <div class="switch">
                <label><input type="checkbox"> <span></span> </label>
                по логину и паролю, которые отправляютмя жюри на электронную почту
            </div>
        </p>
        <p>
            <div class="switch">
                <label><input type="checkbox"> <span></span> </label>
                по уникальной ссылке, которая отправляется на электронную почту жюри
            </div>
        </p>
        <button type="submit" name="" class="btn btn-md btn-with-icon">Сохранить</button>
    </form>
</div>


<h3 class="page-header">Представители жюри
    <a class="pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
</h3>

<div class="row" id="judges"></div>
