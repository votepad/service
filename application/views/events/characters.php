<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title; ?></title>

	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/datatables/dist/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/datatables/buttons/css/buttons.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/datatables/select/css/select.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/datatables/editor.datatables/css/editor.bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/cropper/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/upload.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/app1.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/event.css">
	
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>

	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>

	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/dist/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/dist/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/buttons/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/buttons/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/select/js/dataTables.select.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/editor.datatables/js/dataTables.editor.min.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/editor.datatables/js/editor.bootstrap.min.js"></script>
	

	<script type="text/javascript" src="<?=$assets; ?>vendor/cropper/dist/cropper.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/upload.js"></script>

	<script type="text/javascript" src="<?=$assets; ?>js/events/event-edit-main-info.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/events/event-characters.js"></script>
	

</head>
<body>


<div class="wrapper">
	

	<div class="content-wrapper">
		<!-- EVENT INFO -->
		<?=$event_jumbo; ?>

		<!-- SECTION START -->
		<div class="columns-area">
			<!--   JUDGES  -->
			<div class="panel panel-default">
				<div class="panel-heading">Жюри мероприятия</div>
				<div class="panel-body">
					<table id="table_judges" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">ФИО жюри</th>
								<th class="sorting">E-mail</th>
								<th class="no-sort">Должность</th>
								<th class="no-sort">Фотография</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!--   CHECKING PARTISIPANTS GROPS TEAMS  -->
			<div class="panel panel-default">
				<div class="panel-heading">Категория оценивания</div>
				<div class="panel-body">
					<form id="whom_vote" class="form-horizontal">
						<div class="col-xs-3">
							<h4><strong>Жюри будут оценивать:</strong></h4>
							<p>Вы можете выбрать несколько вариатов</p>
							<button  type="submit" class="md-btn md-btn-md md-btn-success" style="margin-top:15px;">Сохранить</button>	
						</div>
						<div class="col-xs-9">
							<div id="participants" class="text-center col-xs-4">
								<label class="checking_p_g_t md-btn">
									<input type="checkbox" name="participants" checked>
									<div>
										<i class="fa fa-5x fa-user" aria-hidden="true"></i>
									</div>
									<p>участников</p>
								</label>
							</div>
							<div id="groups" class="text-center col-xs-4">
								<label class="checking_p_g_t md-btn">
									<input type="checkbox" name="groups" checked>
									<div>
										<i class="fa fa-5x fa-users" aria-hidden="true"></i>
									</div>
									<p>группы</p>
								</label>
							</div>
							<div id="teams" class="text-center col-xs-4">
								<label class="checking_p_g_t md-btn" style="white-space: normal; padding: 0">
									<input type="checkbox" name="teams">
									<div>
										<i class="fa fa-3x fa-users" aria-hidden="true"></i>
										<i class="fa fa-3x fa-users" aria-hidden="true"></i>
										<i class="fa fa-3x fa-users" aria-hidden="true"></i>	
									</div>
									<p style="margin-top:0">команды</p>
								</label>
							</div>
						</div>
						<div class="text-center">
							
						</div>
					</form>
				</div>
			</div>
			<!--   PARTISIPANTS  --
			<div class="panel panel-default">
				<div class="panel-heading">Участники</div>
				<div class="panel-body">
					<table id="table_participants" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">ФИО участника</th>
								<th class="no-sort">Описание участника</th>
								<th class="no-sort">Фотография</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!--   GROUPS  --
			<div class="panel panel-default">
				<div class="panel-heading">Группы</div>
				<div class="panel-body">
					<table id="table_groups" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название группы</th>
								<th class="no-sort">Описание группы</th>
								<th class="no-sort">Логотип групп</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!--   TEAMS  --
			<div class="panel panel-default">
				<div class="panel-heading">Команды</div>
				<div class="panel-body">
					<table id="table_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название команды</th>
								<th class="no-sort">Описание команды</th>
								<th class="no-sort">Логотип Команды</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>


			<!--   PARTISIPANTS - GROUPS  --
			<div class="panel panel-default">
				<div class="panel-heading">Участники и группы</div>
				<div class="panel-body">
					<h4><strong>Создание групп</strong></h4>
					<p>Создайте группы, по которым будут распределены участники </p>
					<table id="table_groups" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название группы</th>
								<th class="no-sort">Описание группы</th>
								<th class="no-sort">Логотип</th>
							</tr>
						</thead>
					</table>
					<h4><strong>Создание участников</strong></h4>
					<p>Создайте участников и распределите их по группам</p>
					<table id="table_participants_groups" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">ФИО участника</th>
								<th class="sorting">Группа</th>
								<th class="no-sort">Описание участника</th>
								<th class="no-sort">Фотография</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
			<!--   PARTISIPANTS - TEAMS  --
			<div class="panel panel-default">
				<div class="panel-heading">Участники и команды</div>
				<div class="panel-body">
					<h4><strong>Создание команд</strong></h4>
					<p>Создайте команды, по которым будут распределены участники </p>
					<table id="table_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название команды</th>
								<th class="no-sort">Описание команды</th>
								<th class="no-sort">Логотип Команды</th>
							</tr>
						</thead>
					</table>
					<h4><strong>Создание участников</strong></h4>
					<p>Создайте участников и распределите их по командам</p>
					<table id="table_participants_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">ФИО участника</th>
								<th class="sorting">Команда</th>
								<th class="no-sort">Описание участника</th>
								<th class="no-sort">Фотография</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

			<!--   GROUPS - TEAMS  --
			<div class="panel panel-default">
				<div class="panel-heading">Группы и команды</div>
				<div class="panel-body">
					<h4><strong>Создание команд</strong></h4>
					<p>Создайте команды, по которым будут распределены группы </p>
					<table id="table_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название команды</th>
								<th class="no-sort">Описание команды</th>
								<th class="no-sort">Логотип Команды</th>
							</tr>
						</thead>
					</table>
					<h4><strong>Создание групп</strong></h4>
					<p>Создайте группы и распределите их по командам</p>
					<table id="table_groups_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название группы</th>
								<th class="sorting">Команда</th>
								<th class="no-sort">Описание группы</th>
								<th class="no-sort">Логотип группы</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

			<!--   PARTICIPANTS - GROUPS - TEAMS  -->
			<div class="panel panel-default">
				<div class="panel-heading">Участники, группы и команды</div>
				<div class="panel-body">
					<h4><strong>Создание команд</strong></h4>
					<p>Создайте команды, по которым будут распределены группы </p>
					<table id="table_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название команды</th>
								<th class="no-sort">Описание команды</th>
								<th class="no-sort">Логотип Команды</th>
							</tr>
						</thead>
					</table>
					<h4><strong>Создание групп</strong></h4>
					<p>Создайте группы и распределите их по командам</p>
					<table id="table_groups_teams" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">Название группы</th>
								<th class="sorting">Команда</th>
								<th class="no-sort">Описание группы</th>
								<th class="no-sort">Логотип группы</th>
							</tr>
						</thead>
					</table>
					<h4><strong>Создание участников</strong></h4>
					<p>Создайте участников и распределите их по группам</p>
					<table id="table_participants_groups" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="sorting">ФИО участника</th>
								<th class="sorting">Группа</th>
								<th class="no-sort">Описание участника</th>
								<th class="no-sort">Фотография</th>
							</tr>
						</thead>
					</table>
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