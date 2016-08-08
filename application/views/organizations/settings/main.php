<div class="columns-area">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-tabs">
				<md-button class="md-btn active" ng-href="orgpage-settings-main.html" aria-label="tabSettingsMain" md-ink-ripple="#64b5f6">
					Организация
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn" ng-href="orgpage-settings-team.html" aria-label="tabSettingsTeam" md-ink-ripple="#64b5f6">
					Команда
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn" ng-href="orgpage-settings-logs.html" aria-label="tabSettingsLogs" md-ink-ripple="#64b5f6">
					Активности
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn" ng-href="orgpage-settings-balance.html" aria-label="tabSettingsBalance" md-ink-ripple="#64b5f6">
					Оплата услуг
					<div class="active-link"></div>
				</md-button>
			</div>
		</div>
		<div class="panel-body">
			<form>
				<div class="settings-main-c1 inline">
					<h4>Основная информация</h4>
					<div class="form-group">
						<label class="control-label">Название организации</label>
						<input type="text" name="orgname" class="form-control input-sm" value="Университет ИТМО" required>
					</div>
					<div class="form-group">
						<label class="control-label">Ссылка на страницу</label>
						<input type="text" name="orgsite" class="form-control input-sm" value="http://ifmo.votepad.ru" disabled>
						<span class="help-block">Хотите изменить ссылку на Вашу организацию? Напишите нам <a href="">support@votepad.ru</a></span>
					</div>
					<div class="form-group">
						<label class="control-label">Ссылка на официальный сайт</label>
						<input type="text" name="orgofficialsite" class="form-control input-sm" value="http://ifmo.ru" required>
					</div>
					<md-button id="logo_upload" class="md-btn md-btn-md md-btn-default upload" md-ink-ripple="#64b5f6">Обновить фото логотипа</md-button>
					<md-button id="back_upload" class="md-btn md-btn-md md-btn-default upload" md-ink-ripple="#64b5f6" style="float: right;">Обновить фото обложки</md-button>
				</div>
				<div class="settings-main-c2 inline">
					<h4>Контактная информация</h4>
					<div class="form-group">
						<label class="control-label">Доверенное лицо</label>
						<input type="text" name="person" class="form-control input-sm" value="Туров Николай Дмитриевич" required>
						<span class="help-block">Фамилия Имя Отчество</span>
					</div>
					<div class="form-group">
						<label class="control-label">Электронная почта</label>
						<input type="email" name="email" class="form-control input-sm" value="ifmo@ya.ru" required>
					</div>
					<div class="form-group">
						<label class="control-label">Контактный телефон</label>
						<input type="text" name="phone" ng-model="phone" class="form-control" mask="+9 (999) 999-9999" clean="true" ng-value="79999876543" required>
					</div>
					<md-button type="submit" class="md-btn md-btn-md md-btn-labeled md-btn-success ">
						<span class="md-btn-icon"><i class="fa fa-check"></i></span> Сохранить
					</md-button>
					<md-button class="md-btn md-btn-md md-btn-labeled md-btn-danger" style="float: right;">
						<span class="md-btn-icon"><i class="fa fa-times"></i></span> Удалить организацию
					</md-button>
				</div>
			</form>
		</div>
	</div>
</div>