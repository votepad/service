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
				<div class="info">Заполните информацию о мероприятии</div>
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
						<input type="text" id="event_site" name="event_site" class="input-area nwe_site" autocomplete="off" data-orgwebsite="<?=$organization->website; ?>">
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
						<input type="hidden" id="address_coords" name="address_coords">
						<input type="text" id="address" name="address" class="input-area" autocomplete="off">
						<label for="password" class="input-label">Адрес</label>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<select id="users" name="users" class="" multiple="multiple" >
							<? foreach($team as $key => $value) : ?>
								<option value="<?=$value->id_user; ?>"><?=$value->lastname. ' ' .$value->name; ?></option>
							<? endforeach; ?>
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
			<input type="hidden" name="id_organization" value="<?=$organization->id; ?>">
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
