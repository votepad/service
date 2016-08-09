<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>


<div class="columns-area">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-tabs">
				<a class="md-btn" href="http://pronwe.local/organization/10/settings/main">
					Организация
					<div class="active-link"></div>
				</a>
				<a class="md-btn active" href="http://pronwe.local/organization/10/settings/team">
					Команда
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="http://pronwe.local/organization/10/settings/logs">
					Активности
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="http://pronwe.local/organization/10/settings/balance">
					Оплата услуг
					<div class="active-link"></div>
				</a>
			</div>
		</div>
		<div class="panel-body">
			<ul class="pad-l-r-15">
				<li class="no-li user-block">
					<div class="userImageBlock inline">
						<img src="<?=$assets; ?>img/user/02.jpg">
					</div>
					<button class="md-icon-button edit-team-btn" data-toggle="collapse" data-target="#user1">
						<i class="fa fa-edit" aria-hidden="true"></i>
					</button>
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
									<button type="submit" class="md-btn md-btn-md md-btn-labeled md-btn-success ">
										<span class="md-btn-icon"><i class="fa fa-check"></i></span> Сохранить
									</button>

									<button type="button" id="canselEdit" data-toggle="collapse" data-target="#user1" class="md-btn md-btn-md md-btn-default" style="float: right;">Отмена</button>
								</div>
							</form>
						</div>
					</div>
				</li>
				<li class="no-li user-block">
					<div class="userImageBlock inline">
						<img src="<?=$assets; ?>img/user/01.jpg">
					</div>
					<button class="md-icon-button edit-team-btn" data-toggle="collapse" data-target="#user2">
						<i class="fa fa-edit" aria-hidden="true"></i>
					</button>
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
									<button type="submit" class="md-btn md-btn-md md-btn-labeled md-btn-success ">
										<span class="md-btn-icon"><i class="fa fa-check"></i></span> Сохранить
									</button>

									<button type="button" id="canselEdit" data-toggle="collapse" data-target="#user2" class="md-btn md-btn-md md-btn-default" style="float: right;">Отмена</button>
								</div>
							</form>
						</div>
					</div>
				</li>
			</ul>

			<div class="pad-l-r-15">
				<button type="button" class="md-btn md-btn-md md-btn-default newUser">
					Пригласить организатора в команду
				</button>

				<form action="" class="newUserForm" name="newUserForm">
					<h4>Пригласить организатора в команду</h4>
					<div class="form-group input-width">
						<label class="control-label">Электронная почта<span style="color: red">*</span></label>
						<input type="email" name="email" class="form-control input-sm" required>
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
						<input type="text" name="position" class="form-control input-sm" maxlength="50" required>
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
						<button type="submit" class="md-btn md-btn-md md-btn-success">Отправить приглашение</button>

						<button type="button" id="canselnewUser" class="md-btn md-btn-md md-btn-default" style="float: right;">Отмена</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>