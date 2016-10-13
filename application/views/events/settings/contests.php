<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title; ?></title>

	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/bootstrap/dist/css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/select2/dist/css/select2.css">

	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/cropper/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>css/upload.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>css/app.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>css/event.css">

	<script type="text/javascript" src="<?=$assets;?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/jquery-validation/dist/jquery.validate.js"></script>

	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>

	<script type="text/javascript" src="<?=$assets;?>vendor/select2/dist/js/select2.full.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/select2/dist/js/i18n/ru.js"></script>

	<script type="text/javascript" src="<?=$assets;?>vendor/cropper/dist/cropper.js"></script>
	<script type="text/javascript" src="<?=$assets;?>js/upload.js"></script>

	<script type="text/javascript" src="<?=$assets;?>js/events/event-edit-main-info.js"></script>
	<script type="text/javascript" src="<?=$assets;?>js/events/event-competitions.js"></script>

</head>
<body>


<div class="wrapper">


	<div class="content-wrapper">
		<!-- EVENT INFO -->

		<?=$event_jumbo; ?>

		<!-- SECTION START -->
		<div class="columns-area">
			<!-- CREATE NEW COMPETITION -->
			<div class="panel panel-default">
				<div class="panel-heading">Новый конкурс</div>
				<div class="panel-body">
					<form  method="POST" class="pad-l-15 pad-r-15" id="new_competition_form">
						<div class="form-group">
							<input type="text" name="competition_name" class="form-control" placeholder="Название конкурса">
						</div>
						<div class="form-group">
							<textarea name="competition_about" class="form-control" placeholder="Расскажите о конкурсе" rows="3" maxlength="2000"></textarea>
							<span class="help-block pull-right">Осталось <span id="competition_about_max_length">2000</span> символов.</span>
						</div>
						<button type="submit" class="md-btn md-btn-success col-xs-2">Создать конкурс</button>
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Конкурс №1.
					<strong class="inline">НАЗВ.КОНКУРСА</strong>
					<div class="pull-right">
						<button type="button" class="edit_competition">Изменить</button>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group pad-l-15 pad-r-15">
						<label>О конкурсе</label>
						<div>fkjgfdjkjgfl</div>
					</div>
					<ul class="no-li form-group pad-l-15 pad-r-15 stages" id="stages_1">
						<li>
							<div class="panel panel-default panel-sm">
								<div class="panel-heading">
									<a data-toggle="collapse" href="#collaps_stage_1" aria-expanded="false" aria-controls="collaps_stage_1"><div class="inline" data-toggle="tooltip" data-placement="right" title="Подробнее"><span>Этап №1.</span>
											<strong class="for_edit_form" name="stage_name_1">НАЗВ.ЭТАПА</strong>
										</div></a>
									<div class="pull-right">
										<button type="button" class="edit">Изменить</button>
									</div>
								</div>
								<div class="panel-body collapse" id="collaps_stage_1">
									<div class="form-group">
										<label>Об этапе</label><br>
										<span class="for_edit_form" name="stage_about_1">Что то об этапе</span>
									</div>
									<div class="form-group">
										<label>Представители жюри:</label>
										<span class="for_edit_form" name="stage_judges_1">Жюри 1, Жюри 2</span>
									</div>
									<div class="form-group">
										<label>Жюри будут оценивать</label>
										<span class="for_edit_form" name="stage_characters_1">участников</span>
									</div>
									<div class="form-group">
										<label>Критерии</label>
										<table id="stage_criterions_1" class="table table-bordered table-hover stage_criterions" cellspacing="0" width="100%">
											<thead>
											<tr>
												<th>#</th>
												<th>Название критерия</th>
												<th>Полное описание</th>
												<th>Максимальный балл</th>
												<th>Минимальный балл</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<th>1</th>
												<th>
													<span class="for_edit_form" name="criterion_name_1_1">name</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_desc_1_1">description</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_max_1_1">1</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_min_1_1">10</span>
												</th>
											</tr>
											<tr>
												<th>1</th>
												<th>
													<span class="for_edit_form" name="criterion_name_1_2">name 2</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_desc_1_2">description 2</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_max_1_2">2</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_min_1_2">20</span>
												</th>
											</tr>
											<tr>
												<th>1</th>
												<th>
													<span class="for_edit_form" name="criterion_name_1_3">name 3</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_desc_1_3">description 3</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_max_1_3">3</span>
												</th>
												<th>
													<span class="for_edit_form" name="criterion_min_1_3">30</span>
												</th>
											</tr>
											</tbody>
										</table>
										<span class="ctiterion_total">Всего 0 критерев</span>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<div class="pad-l-15 pad-r-15">
						<button id="add_stage" class="md-btn md-btn-md md-btn-labeled md-btn-success">
							<span class="md-btn-icon"><i class="fa fa-plus"></i></span> Добавить этап
						</button>
					</div>
				</div>
			</div>

			<!-- Modal EDIT MAIN EVENT INFO -->
			<div class="modal fade" id="edit_main_event_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Изменение основной информации о мероприяии</h4>
						</div>
						<form method="POST" id="event_main_info" class="form-horizontal">
							<div class="modal-body">
								<div class="form-group">
									<label for="eventname" class="control-label">Название мероприятия</label>
									<div class="input-area">
										<input type="text" id="eventname" name="eventname" class="form-control input-sm" value="Мисс ИТМО">
										<label id="eventname-error" class="error-input" for="eventname" style="display: none;"></label>
									</div>
								</div>
								<div class="form-group">
									<label for="eventsite" class="control-label">Страница мероприятия</label>
									<div class="input-area">
										<div class="input-group">
											<span class="input-group-addon">ifmo.votepad.ru/events/</span>
											<input type="text" id="eventsite" name="eventsite" class="form-control" disabled="" value="miss-itmo">
										</div>
										<label id="eventsite-error" class="error-input" for="eventsite" style="display:none"></label>
										<span class="help-block">По этому адресу будет доступена страница мероприятия.</span>
									</div>
								</div>
								<div class="form-group">
									<label for="eventshortdesc" class="control-label">Краткое описание</label>
									<div class="input-area">
										<textarea type="text" id="eventshortdesc" name="eventshortdesc" class="form-control input-sm" maxlength="170" rows=2>Мероприятие проходит ежегодно, где 11 девушек соревнуются за титул "Мисс университета ИТМО".</textarea>
										<label id="eventshortdesc-error" class="error-input" for="eventshortdesc" style="display:none"></label>
										<span class="help-block">Краткое описание будет доступно в лентах новостей, а также на страницы организации. <br>Осталось <span id="shortdesc_max_length">170</span> символов.</span>
									</div>
								</div>
								<div class="form-group">
									<label for="eventdata" class="control-label">Дата и время</label>
									<div class="input-area">
										<div class="date-input">
											<input type="datetime-local" id="eventstart" name="eventstart" class="form-control input-sm" value="2016-09-17T12:00">
											—
											<input type="datetime-local" id="eventend" name="eventend" class="form-control input-sm" value="2016-09-18T17:00">
										</div>
										<label id="eventstart-error" class="error-input" for="eventstart" style="display: none;"></label>
										<label id="eventend-error" class="error-input" for="eventend" style="display: none;"></label>
										<span class="help-block">Выберите дату начала и завершения мероприятия.</span>
									</div>
								</div>
								<div class="form-group">
									<label for="eventstatus" class="control-label">Стаус мероприятия</label>
									<div class="input-area">
										<select id="eventstatus" name="eventstatus" class="form-control input-sm">
											<option value=""></option>
										</select>
										<label id="eventstatus-error" class="error-input" for="eventstatus" style="display: none;"></label>
										<span class="help-block">Выберите статус мероприятия, он нужен для поиска мероприятия в системе.</span>
									</div>
								</div>
								<div class="form-group">
									<label for="eventcity" class="control-label">Город</label>
									<div class="input-area">
										<select id="eventcity" name="eventcity" class="form-control input-sm">
											<option value=""></option>
										</select>
										<label id="eventcity-error" class="error-input" for="eventcity" style="display: none;"></label>
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="control-label">E-mail</label>
									<div class="input-area">
										<input type="email" id="email" name="email" class="form-control input-sm" value="turov96@ya.ru">
										<label id="email-error" class="error-input" for="email" style="display: none;"></label>
										<span class="help-block">Email для обратной связи.</span>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="md-btn md-btn-default" data-dismiss="modal">Отмена</button>
								<button type="submit" id="save_event_main_info" class="md-btn md-btn-success">Сохранить</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<!-- SECTION END -->
	</div>

	<footer></footer>
</div>
</body>
</html>
