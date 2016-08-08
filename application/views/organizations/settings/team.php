<div class="columns-area">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-tabs">
				<md-button class="md-btn" ng-href="orgpage-settings-main.html" aria-label="tabSettingsMain" md-ink-ripple="#64b5f6">
					Организация
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn active" ng-href="orgpage-settings-team.html" aria-label="tabSettingsTeam" md-ink-ripple="#64b5f6">
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
			<ul class="pad-l-r-15">
				<li class="no-li user-block">
					<div class="userImageBlock inline">
						<img src="http://pronwe.local/http://pronwe.local/assets/img/user/02.jpg">
					</div>
					<md-button class="md-icon-button edit-team-btn" aria-label="editteambtn" data-toggle="collapse" data-target="#user1" md-ink-ripple="#64b5f6">
						<md-icon md-svg-icon="http://pronwe.local/http://pronwe.local/assets/img/icons/edit.svg"></md-icon>
					</md-button>
					<div class="inline user-block-right-column">
						<div class="user-header">
							<h4 class="inline">Николай Туров</h4>
							<span class="inline">Создатель организации</span>
						</div>
						<div class="">
							<p class="user-rools">
								Глобальный доступ к администрированию аккаунтов, администрированию мероприятий и управлению балансом организации
							</p>
							<p class="user-events">
								Ответственный за мероприятия: Мистер ИТМО
							</p>
						</div>

						<div id="user1" class="collapse">
							<form action="" >
								<div class="form-group">
									<label class="control-label">Права доступа</label>
									<div class="checkbox rools">
										<label class="">
											<input type="checkbox" name="manageuser" checked>Управлением пользователем
										</label>
										<span>Возможность добавлять или удалять организаторов, редактировать права доступа</span>
									</div>
									<div class="checkbox rools">
										<label class="">
											<input type="checkbox" name="manageevent" checked>Управлением мероприятиями
										</label>
										<span>Возможность добавлять или удалять ответственных организаторов за мероприятия</span>
									</div>
									<div class="checkbox rools">
										<label class="">
											<input type="checkbox" name="managebalance" checked>Финансовая информация
										</label>
										<span>Возможность производить оплату за предоставляемые услуги, получать информацию по расходам</span>
									</div>
								</div>
								<div class="form-group input-width">
									<label class="control-label">Должность<span style="color: red">*</span></label>
									<input type="text" name="position" class="form-control input-sm" maxlength="50" required value="Создатель организации">
									<span class="help-block">Будет отображена только для членов команды</span>
								</div>
								<div class="form-group input-width">
									<label class="control-label">Мероприятия</label>
									<select name="events" class="form-control input-width eventsToUser" multiple="multiple">
										<option value="1">Мисс ИТМО</option>
										<option value="2" selected="selected">Мистер ИТМО</option>
										<option value="3">Федеральный конкурс ты нужен людям</option>
									</select>
									<span class="help-block" >Выберите меропиятия, которые сможет редактировать пользователь</span>
								</div>
								<div class="input-width">
									<md-button type="submit" class="md-btn md-btn-md md-btn-labeled md-btn-success ">
										<span class="md-btn-icon"><i class="fa fa-check"></i></span> Сохранить
									</md-button>

									<md-button id="canselEdit" data-toggle="collapse" data-target="#user1" aria-label="cansel" class="md-btn md-btn-md md-btn-default" md-ink-ripple="#64b5f6" style="float: right;">Отмена</md-button>
								</div>
							</form>
						</div>
					</div>
				</li>
				<li class="no-li user-block">
					<div class="userImageBlock inline">
						<img src="http://pronwe.local/http://pronwe.local/assets/img/user/01.jpg">
					</div>
					<md-button class="md-icon-button edit-team-btn" aria-label="editteambtn" data-toggle="collapse" data-target="#user2" md-ink-ripple="#64b5f6">
						<md-icon md-svg-icon="http://pronwe.local/http://pronwe.local/assets/img/icons/edit.svg"></md-icon>
					</md-button>
					<div class="inline user-block-right-column">
						<div class="user-header">
							<h4 class="inline">Екатерина Иванова</h4>
							<span class="inline">Заместитель администратора</span>
						</div>
						<div class="">
							<p class="user-rools">
								Доступ к администрированию мероприятий и управлению балансом организации
							</p>
							<p class="user-events">
								Ответственный за мероприятия: Мисс ИТМО
							</p>
						</div>

						<div id="user2" class="collapse">
							<form action="" >
								<div class="form-group">
									<label class="control-label">Права доступа</label>
									<div class="checkbox rools">
										<label class="">
											<input type="checkbox" name="manageuser">Управлением пользователем
										</label>
										<span>Возможность добавлять или удалять организаторов, редактировать права доступа</span>
									</div>
									<div class="checkbox rools">
										<label class="">
											<input type="checkbox" name="manageevent" checked>Управлением мероприятиями
										</label>
										<span>Возможность добавлять или удалять ответственных организаторов за мероприятия</span>
									</div>
									<div class="checkbox rools">
										<label class="">
											<input type="checkbox" name="managebalance" checked>Финансовая информация
										</label>
										<span>Возможность производить оплату за предоставляемые услуги, получать информацию по расходам</span>
									</div>
								</div>
								<div class="form-group input-width">
									<label class="control-label">Должность<span style="color: red">*</span></label>
									<input type="text" name="position" class="form-control input-sm" maxlength="50" required value="Заместитель администратора">
									<span class="help-block">Будет отображена только для членов команды</span>
								</div>
								<div class="form-group input-width">
									<label class="control-label">Мероприятия</label>
									<select name="events" class="form-control input-width eventsToUser" multiple="multiple">
										<option value="1" selected="selected">Мисс ИТМО</option>
										<option value="2">Мистер ИТМО</option>
										<option value="3">Федеральный конкурс ты нужен людям</option>
									</select>
									<span class="help-block" >Выберите меропиятия, которые сможет редактировать пользователь</span>
								</div>
								<div class="input-width">
									<md-button type="submit" class="md-btn md-btn-md md-btn-labeled md-btn-success ">
										<span class="md-btn-icon"><i class="fa fa-check"></i></span> Сохранить
									</md-button>

									<md-button id="canselEdit" data-toggle="collapse" data-target="#user2" aria-label="cansel" class="md-btn md-btn-md md-btn-default" md-ink-ripple="#64b5f6" style="float: right;">Отмена</md-button>
								</div>
							</form>
						</div>
					</div>
				</li>
			</ul>

			<div class="pad-l-r-15">
				<md-button aria-label="newUser" class="md-btn md-btn-md md-btn-default newUser" md-ink-ripple="#64b5f6">
					Пригласить организатора в команду
				</md-button>

				<form action="" class="newUserForm" name="newUserForm">
					<h4>Пригласить организатора в команду</h4>
					<div class="form-group input-width">
						<label class="control-label">Электронная почта<span style="color: red">*</span></label>
						<input type="email" name="email" ng-model="email" class="form-control input-sm" required>
									<span class="error" ng-show="newUserForm.email.$dirty && newUserForm.email.$invalid">
  										<span ng-show="newUserForm.email.$error.required">Введите email</span>
  										<span ng-show="newUserForm.email.$error.email">Неправильно введен email</span>
									</span>
					</div>
					<div class="form-group">
						<label class="control-label">Права доступа</label>
						<div class="checkbox rools">
							<label class="">
								<input type="checkbox" name="manageuser">Управлением пользователем
							</label>
							<span>Возможность добавлять или удалять организаторов, редактировать права доступа</span>
						</div>
						<div class="checkbox rools">
							<label class="">
								<input type="checkbox" name="manageevent">Управлением мероприятиями
							</label>
							<span>Возможность добавлять или удалять ответственных организаторов за мероприятия</span>
						</div>
						<div class="checkbox rools">
							<label class="">
								<input type="checkbox" name="managebalance">Финансовая информация
							</label>
							<span>Возможность производить оплату за предоставляемые услуги, получать информацию по расходам</span>
						</div>
					</div>
					<div class="form-group input-width">
						<label class="control-label">Должность<span style="color: red">*</span></label>
						<input type="text" name="position" ng-model="position" class="form-control input-sm" maxlength="50" required>
						<span class="help-block" ng-show="newUserForm.position.$valid || newUserForm.position.$pristine">Будет отображена только для членов команды</span>
									<span class="error" ng-show="newUserForm.position.$dirty && newUserForm.position.$invalid">
										<span ng-show="newUserForm.position.$error.required">Введите должность</span>
									</span>
					</div>
					<div class="form-group input-width">
						<label class="control-label">Мероприятия</label>
						<select name="events" class="form-control input-width eventsToUser" multiple="multiple">
							<option value="1">Мисс ИТМО</option>
							<option value="2">Мистер ИТМО</option>
							<option value="3">Федеральный конкурс ты нужен людям</option>
						</select>
						<span class="help-block" >Выберите меропиятия, которые сможет редактировать пользователь</span>
					</div>
					<div class="input-width">
						<md-button type="submit" ng-disabled="
											newUserForm.email.$dirty && newUserForm.email.$invalid || newUserForm.email.$pristine ||
											newUserForm.position.$dirty && newUserForm.position.$invalid || newUserForm.position.$pristine"
								   class="md-btn md-btn-md md-btn-success">Отправить приглашение</md-button>

						<md-button id="canselnewUser" aria-label="cansel" class="md-btn md-btn-md md-btn-default" md-ink-ripple="#64b5f6" style="float: right;">Отмена</md-button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>