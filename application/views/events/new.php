<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Новое мероприятие</title>

	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/select2/dist/css/select2.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/app1.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/event.css">

	
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/events/event-new.js"></script>

</head>
<body>


<div class="wrapper">
	<header></header>

	<div class="content-wrapper">
		<div class="panel panel-default newevent-wrapper">
			<div class="panel-body">
				<h2>Введите основную информацию о мероприятии</h2>
				<p>Заполнив форму, Вы создатите страницу мероприятия, где сможете оформить всю необходимую информацию.</p>
				<form method="POST" action="<?=URL::site('event/add'); ?>" id="new_event" class="">
					<div class="form-group">
						<label for="eventname" class="control-label">Название мероприятия</label>
						<div class="input-area">
							<input type="text" id="eventname" name="event_name" class="form-control input-sm">
							<label id="eventname-error" class="error-input" for="eventname" style="display: none;"></label>
						</div>
					</div>
					<div class="form-group">
							<label for="eventsite" class="control-label">Страница мероприятия</label>
							<div class="input-area">
								<div class="input-group">
									<span class="input-group-addon">название_орг.votepad.ru/events/</span>
									<input type="text" id="eventsite" name="event_site" class="form-control">
								</div>
								<label id="eventsite-error" class="error-input" for="eventsite" style="display:none"></label>
								<span class="help-block">По этому адресу будет доступена страница мероприятия.</span>
							</div>
						</div>
					<div class="form-group">
						<label for="eventshortdesc" class="control-label">Краткое описание</label>
						<div class="input-area">
							<textarea type="text" id="eventshortdesc" name="event_shortdesc" class="form-control input-sm" maxlength="170" rows=2></textarea>
							<label id="eventshortdesc-error" class="error-input" for="eventshortdesc" style="display:none"></label>
							<span class="help-block">Краткое описание будет доступно в лентах новостей, а также на страницы организации. <br>Осталось <span id="shortdesc_max_length">170</span> символов.</span>
						</div>
					</div>
					<div class="form-group">
						<label for="eventdata" class="control-label">Дата и время</label>
						<div class="input-area">
							<div class="date-input">
								<input type="datetime-local" id="event_start" name="eventstart" class="form-control input-sm">
								—
								<input type="datetime-local" id="event_end" name="eventend" class="form-control input-sm">
							</div>
							<label id="eventstart-error" class="error-input" for="eventstart" style="display: none;"></label>
							<label id="eventend-error" class="error-input" for="eventend" style="display: none;"></label>
							<span class="help-block">Выберите дату начала и завершения мероприятия.</span>
						</div>
					</div>
					<div class="form-group">
						<label for="eventstatus" class="control-label">Стаус мероприятия</label>
						<div class="input-area">
							<select id="eventstatus" name="event_status" class="form-control input-sm" >
								<option value=""></option>
							</select>
							<label id="eventstatus-error" class="error-input" for="eventstatus" style="display: none;"></label>
							<span class="help-block">Выберите статус мероприятия, он нужен для поиска мероприятия в системе.</span>
						</div>
					</div>
					<div class="form-group">
						<label for="eventcity" class="control-label">Город</label>
						<div class="input-area">
							<select id="eventcity" name="event_city" class="form-control input-sm" >
								<option value=""></option>
							</select>
							<label id="eventcity-error" class="error-input" for="eventcity" style="display: none;"></label>
						</div>
					</div>
					<div class="form-group text-center">
						<button type="button" class="md-btn org-info-btn" data-toggle="collapse" data-target="#orginfo">
							<i class="fa fa-info" aria-hidden="true"></i> 
							<span>Контактная информация организатора</span>
						</button>
					</div>
					<div id="orginfo" class="collapse">
						<div class="form-group">
							<label for="responsible_persons" class="control-label">Ответственные лица</label>
							<div class="input-area">
								<select id="responsible_persons" name="responsible_persons" class="form-control select2-width input-sm" multiple="multiple">
									<option value="1" selected="selected">Туров Николай</option>
									<option value="2">Иванов Иван</option>
								</select>
								<label id="responsible_persons-error" class="error-input" for="responsible_persons" style="display: none;"></label>
								<span class="help-block">Выберите ответственных за мероприятие, они смогут редактировать его.</span>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">E-mail</label>
							<div class="input-area">
								<input type="email" id="email" name="event_email" class="form-control input-sm" value="turov96@ya.ru">
								<label id="email-error" class="error-input" for="email" style="display: none;"></label>
								<span class="help-block">Email для обратной связи.</span>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<label class="confirm-rools">
							<input type="checkbox" id="confirmrools" name="confirmrools">
							Я прочитал(а) <a href="#/rools/publishevent" class="md-btn md-btn-xs" style="font-size: 1em; font-weight: bold; color: #64b5f6;">правила публикации мероприятия</a> и согласен(а) с ними
							<br>
							<label id="confirmrools-error" class="error-input" for="confirmrools" style="display: none;"></label>
						</label>
					</div>
					<div class="form-group text-center">
						<button type="submit" class="md-btn md-btn-lg md-btn-success ">Опубликовать мероприятие</button>
					</div>

					<input type="hidden" name="organization" value="<?=$organization; ?>">
				</form>
			</div>
		</div>
	</div>

	<footer></footer>
</div>
</body>
</html>