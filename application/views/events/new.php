<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Новое мероприятие | NWE</title>


	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/votepad_fonts.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/app.css">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/event.css">

	<!-- =============== VENDOR SCRIPTS ===============-->
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/moment/moment.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

	<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.full.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/events/event-new.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/app.js"></script>

</head>
<body>
	<div class="content-wrapper newevent-wrapper clearfix">
		<form method="POST" action="<?=URL::site('event/add'); ?>" class="block block-default">
			<div class="block-heading bg_grey_600">
				<div class="info">Заполните информацию о мероприятие</div>
				<div class="pb_newevent">
					<div class="pb_wrapper"></div>
				</div>
			</div>
			<div class="block-body">
				<div class="step displayblock">
					<div class="input-field">
						<input type="text" id="event_name" name="event_name" class="input-area" length="60" autocomplete="off">
						<label for="event_name" class="input-label">Название мероприятия</label>
						<span class="help-block">Название увидят на гости, просматривающие Вашу страницу.</span>
					</div>
					<div class="input-field">
						<input type="text" id="event_site" name="event_site" class="input-area nwe_site" autocomplete="off" data-orgname="<?=$organization; ?>">
						<label for="event_site" class="input-label">Страница мероприятия</label>
						<span class="help-block">По этому адресу будет доступна страница мероприятия.</span>
					</div>
				</div>
				<div class="step displaynone" style="margin-top:0">
					<div class="input-field">
						<textarea id="event_desc" name="event_desc" class="input-area input-textarea" autocomplete="off" length="200" style="max-height: 88px;"></textarea>
						<label for="event_desc" class="input-label">Раскажите о мероприятии</label>
						<span class="help-block">Описание будет доступно на странице мероприятия.</span>
					</div>
					<div class="input-field">
						<select id="keywords" name="event_keywords" multiple="multiple"></select>
						<label for="org_phone" class="input-label active">Ключевые слова</label>
						<span class="help-block">По этим словам Ваше мероприятие можно будет найти через поисковые системы.</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field col-sm-5 col-xs-12 pad0">
						<input type="text" id="datestart" name="datestart" class="input-area" autocomplete="off">
						<label for="datestart" class="input-label">Дата начала</label>
					</div>
					<div class="input-field col-sm-5 col-sm-offset-2 col-xs-12 pad0">
						<input type="text" id="dateend" name="dateend" class="input-area" autocomplete="off">
						<label for="dateend" class="input-label">Дата завершения</label>
					</div>
					<div class="input-field col-xs-12 pad0">
						<input type="text" id="address" name="address" class="input-area" autocomplete="off">
						<label for="password" class="input-label">Адрес</label>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<select id="users" name="users" class="" multiple="multiple" >
							<option value="1">Who are you?</option>
							<option value="2" selected="selected">Туров Николай</option>
						</select>
						<label for="users" class="input-label active">Ответственные лица</label>
						<span class="help-block">Ответственные лица за мероприяия имеют полный доступ к изменению информации о мероприятии.</span>
					</div>
					<div class="input-field">
						<input type="checkbox" id="confirmrools" name="confirmrools" class="input-area">
						<label for="confirmrools">
							Мною прочитаны<a href="#/modal_rools" class="link_uppercase underlinehover">правила публикации мероприятия</a>
						</label>
					</div>
				</div>
			</div>
			<div class="block-footer clearfix">
				<button id="btnprevious" type="button" class="nav_button fl_l displaynone">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>Назад
				</button>
				<button id="btnnext" type="button" class="nav_button fl_r">
					Продолжить<i class="fa fa-arrow-right" aria-hidden="true"></i>
				</button>
				<button id="btnsubmit" type="button" class="nav_button fl_r displaynone">
					Опубликовать<i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
				</button>
			</div>
			<input type="hidden" name="organization" value="<?=$organization; ?>">
		</form>
	</div>
	<footer class="bg_grey_800">
		<ul class="fl_l nwe_links ls_none">
			<li><a href="#">EventStream</a></li>
			<li><a href="#">Правила</a></li>
			<li><a href="#">Помощь</a></li>
			<li><a href="#">Связаться со службой поддержки</a></li>
		</ul>
		<div class="fl_r nwe_copyright">
			<a href="//pronwe.ru">NewEvent | NWE</a>
		</div>
	</footer>
</body>
</html>










<!--
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
									<span class="input-group-addon">НАЗВАНИЕ_ОРГАНИЗАЦИИ.nwe.ru/events/</span>
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
							<label id="eventstart-error" class="error-input" for="event_start" style="display: none;"></label>
							<label id="eventend-error" class="error-input" for="event_end" style="display: none;"></label>
							<span class="help-block">Выберите дату начала и завершения мероприятия.</span>
						</div>
					</div>
					<div class="form-group">
						<label for="eventstatus" class="control-label">Стаус мероприятия</label>
						<div class="input-area">
							<select id="eventstatus" name="event_status" class="form-control input-sm" >
								<option value=""></option>
								<option value="1">Международное</option>
								<option value="2">Всероссийское</option>
								<option value="3">Региональное</option>
								<option value="4">Городской</option>
								<option value="5">Локальное (университет, колледж, школа и т.п.)</option>
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
									<option value="1">Санкт-Петербург</option>
									<option value="2">Москва</option>
							</select>
							<label id="eventcity-error" class="error-input" for="eventcity" style="display: none;"></label>
						</div>
					</div>
					<div class="form-group">
						<label for="eventcity" class="control-label">Логотип</label>
						<div class="input-area">
							<button type="button" id="eventlogo_upload" class="md-btn md-btn-md md-btn-default upload">Выбрать логотип мероприятия</button>
							<span class="help-block">Если у Вас не готов логотип, то можно выбрать его позже.</span>
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
