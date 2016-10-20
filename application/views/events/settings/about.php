<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title; ?></title>

	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/summernote/dist/summernote.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>vendor/cropper/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>css/upload.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>css/app.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets;?>css/event.css">

	<script type="text/javascript" src="<?=$assets;?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/jquery-validation/dist/jquery.validate.js"></script>

	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>

	<script type="text/javascript" src="<?=$assets;?>vendor/summernote/dist/summernote.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/summernote/dist/lang/summernote-ru-RU.js"></script>
	<script type="text/javascript" src="<?=$assets;?>vendor/cropper/dist/cropper.js"></script>
	<script type="text/javascript" src="<?=$assets;?>js/upload.js"></script>

	<script type="text/javascript" src="<?=$assets;?>js/events/event-edit-main-info.js"></script>
	<script type="text/javascript" src="<?=$assets;?>js/events/event-about.js?v=<?=filemtime("assets/js/events/event-about.js") ?>"></script>


</head>
<body>


<div class="wrapper">

	<div class="content-wrapper">
		<!-- EVENT INFO -->
		<?=$event_jumbo; ?>

		<!-- SECTION START -->
		<div class="columns-area">

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="pull-right">
						<button id="edit_event_about" class="md-btn md-btn-md md-btn-labeled md-btn-primary">
							<span class="md-btn-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> Редактировать
						</button>
					</div>
					<div id="event_about"></div>

					<div id="no_event_about">
						<? if (empty($event['full_description'])) : ?>

							<p>Вы ещё не рассказали о мероприятии, пожалуйста, расскажите о нём.</p>

						<? else : ?>

							<?=$event['full_description']; ?>

						<? endif ; ?>
					</div>

					<input type="hidden" id="hidden_id_of_current_event" value="<?=$event['id']; ?>">
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
						<form action="<?=URL::site(); ?>" method="POST" id="event_main_info" class="form-horizontal">
							<div class="modal-body">
									<div class="form-group">
										<label for="eventname" class="control-label">Название мероприятия</label>
										<div class="input-area">
											<input type="text" id="eventname" name="eventname" class="form-control input-sm" value="<?=$event['name']; ?>">
											<label id="eventname-error" class="error-input" for="eventname" style="display: none;"></label>
										</div>
									</div>
									<div class="form-group">
											<label for="eventsite" class="control-label">Страница мероприятия</label>
											<div class="input-area">
												<div class="input-group">
													<span class="input-group-addon">ifmo.votepad.ru/events/</span>
													<input type="text" id="eventsite" name="eventsite" class="form-control" disabled="" value="<?=$event['name'] . '.pronwe.ru'; ?>">
												</div>
												<label id="eventsite-error" class="error-input" for="eventsite" style="display:none"></label>
												<span class="help-block">По этому адресу будет доступена страница мероприятия.</span>
											</div>
										</div>
									<div class="form-group">
										<label for="eventshortdesc" class="control-label">Краткое описание</label>
										<div class="input-area">
											<textarea type="text" id="eventshortdesc" name="eventshortdesc" class="form-control input-sm" maxlength="170" rows=2><?=$event['short_description']; ?></textarea>
											<label id="eventshortdesc-error" class="error-input" for="eventshortdesc" style="display:none"></label>
											<span class="help-block">Краткое описание будет доступно в лентах новостей, а также на страницы организации. <br>Осталось <span id="shortdesc_max_length">170</span> символов.</span>
										</div>
									</div>
									<div class="form-group">
										<label for="eventdata" class="control-label">Дата и время</label>
										<div class="input-area">
											<div class="date-input">
												<input type="datetime-local" id="eventstart" name="eventstart" class="form-control input-sm" value="<?=$event['start_time']; ?>">
												—
												<input type="datetime-local" id="eventend" name="eventend" class="form-control input-sm" value="<?=$event['end_time']; ?>">
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
