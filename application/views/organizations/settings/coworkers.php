<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

<h3 class="page-header">
	Список сотрудников
</h3>

<div class="block" >
	<ul class="ui_tabs ui_tabs_header clear_fix">
	    <li id="">
	        <a data-ui="tabs" aria-controls="coworkers" class="ui_tab ui_tab-active">Состоят в организации
				<span class="ui_tab_count">5</span>
			</a>
	    </li>
	    <li id="">
	        <a data-ui="tabs" aria-controls="newCoworkers" class="ui_tab">Новые заявки
				<span class="ui_tab_count">25</span>
			</a>
			<button data-href="http://link" id="inviteBtn" class="btn btn_primary ui_tab-btn">Пригласить</button>
	    </li>
	</ul>
    <div class="ui_tabs_content clear_fix">

        <div id="coworkers" class="ui_tab_block active">

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



        <div id="newCoworkers" class="ui_tab_block">

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
<script type="text/javascript" src="<?=$assets; ?>js/tabs.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/organization/settings-coworkers.js"></script>
