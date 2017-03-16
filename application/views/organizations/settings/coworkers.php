<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

<h3 class="page-header">
	Список сотрудников
</h3>

<div class="block" >
	<ul class="tabs tabs_header clear_fix">
	    <li id="">
	        <a data-ui="tabs" aria-controls="coworkers" class="tab tab--active">Состоят в организации
				<span class="tab_count">5</span>
			</a>
	    </li>
	    <li id="">
	        <a data-ui="tabs" aria-controls="newCoworkers" class="tab">Новые заявки
				<span class="tab_count">25</span>
			</a>
	    </li>
		<button data-href="http://link" id="inviteBtn" class="btn btn_primary tab_btn">Пригласить</button>
	</ul>
    <div class="tabs_content clear_fix">

        <div id="coworkers" class="tab_block tab_block--active">

			<div id="coworker_id15" class="coworker_row col-xs-12 col-md-6">
				<div class="coworker_photo_wrap">
					<a class="coworker_photo" href="">
						<img class="coworker_photo_img" alt="Co-worker" src="">
					</a>
				</div>
				<div class="coworker_info">
					<div class="coworker_field coworker_field-title">
						<a href="">Фамилия Имя Отчество</a>
					</div>
					<div class="coworker_field coworker_field-contact">
						<span>test@ya.ru</span>
						<span>+7 (981) 959-9898</span>
					</div>
					<div class="coworker_controls clear_fix">
						<button data-id="15" data-name="ФИО" class="btn btn_default deletebtn">Исключить</button>
					</div>
				</div>
			</div>
			<div id="coworker_id16" class="coworker_row col-xs-12 col-md-6">
				<div class="coworker_photo_wrap">
					<a class="coworker_photo" href="">
						<img class="coworker_photo_img" alt="Co-worker" src="">
					</a>
				</div>
				<div class="coworker_info">
					<div class="coworker_field coworker_field-title">
						<a href="">Фамилия Имя Отчество</a>
					</div>
					<div class="coworker_field coworker_field-contact">
						<span>test@ya.ru</span>
						<span>+7 (981) 959-9898</span>
					</div>
					<div class="coworker_controls clear_fix">
						<button data-id="16" data-name="ФИО 2" class="btn btn_default deletebtn">Исключить</button>
					</div>
				</div>
			</div>

        </div>



        <div id="newCoworkers" class="tab_block">

			<div id="coworker_id17" class="coworker_row col-xs-12 col-md-6">
				<div class="coworker_photo_wrap">
					<a class="coworker_photo" href="">
						<img class="coworker_photo_img" alt="Co-worker" src="">
					</a>
				</div>
				<div class="coworker_info">
					<div class="coworker_field coworker_field-title">
						<a href="">Фамилия Имя Отчество</a>
					</div>
					<div class="coworker_field coworker_field-contact">
						<span>test@ya.ru</span>
						<span>+7 (981) 959-9898</span>
					</div>
					<div class="coworker_controls clear_fix">
						<button data-id="17" data-name="ФИО 17" class="btn btn_primary acceptbtn">Принять заявку</button>
						<button data-id="17" data-name="ФИО 17" class="btn btn_text cancelbtn">Отклонить</button>
					</div>
				</div>
			</div>
			<div id="coworker_id18" class="coworker_row col-xs-12 col-md-6">
				<div class="coworker_photo_wrap">
					<a class="coworker_photo" href="">
						<img class="coworker_photo_img" alt="Co-worker" src="">
					</a>
				</div>
				<div class="coworker_info">
					<div class="coworker_field coworker_field-title">
						<a href="">Фамилия Имя Отчество</a>
					</div>
					<div class="coworker_field coworker_field-contact">
						<span>test@ya.ru</span>
						<span>+7 (981) 959-9898</span>
					</div>
					<div class="coworker_controls clear_fix">
						<button data-id="18" data-name="ФИО 18" class="btn btn_primary acceptbtn">Принять заявку</button>
						<button data-id="18" data-name="ФИО 18" class="btn btn_text cancelbtn">Отклонить</button>
					</div>
				</div>
			</div>

        </div>
    </div>
</div>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>js/modules/tabs.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/modules/ajax.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organization/settings-coworkers.js"></script>
