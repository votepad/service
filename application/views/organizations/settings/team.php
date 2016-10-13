<!-- =============== PAGE STYLES ===============-->


<div class="columns-area">
	<div class="block block-default org_team">
		<div id="topmenu" class="block-heading tabs">
			<?=$topmenu; ?>
		</div>
		<div class="block-body">
			<ul class="col-xs-12 ls_none">
				<!--<?=Debug::Vars($organization->team);?>-->
				<? for($i = 0; $i < count($organization->team); $i++) : ?>
				<li class="block block-default user-block">
					<div class="block-heading">
						<button class="edit-team-btn" data-toggle="collapse" data-target="#user<?=$i; ?>">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</button>
						<div class="col-xs-12 col-sm-3 col-md-2">
							<div class="userImageBlock">
								<img src="<?=$assets; ?>img/user/02.jpg">
							</div>
						</div>
						<div class="col-xs-12 col-sm-9 col-md-10 userDesc">
							<p class="user-name"><?=$organization->team[$i]->lastname . ' ' . $organization->team[$i]->name . ' ' . $organization->team[$i]->surname; ?></p>
							<span class="user-role bg_red_a100"><?=$organization->team[$i]->role_name; ?></span>
							<p class="user-rools">
								Глобальный доступ к администрированию аккаунтов, администрированию мероприятий и управлению балансом организации
							</p>
							<p class="user-events">
								Ответственный за мероприятия: Мистер ИТМО
							</p>
						</div>
					</div>
					<div id="user<?=$i; ?>" class="block-body collapse in ">
						<form action="" >
							<div class="col-xs-12 col-md-6">
								<h4 style="margin: 0; font-weight: normal;">Права доступа</h4>
								<div class="input-field">
									<input type="checkbox" id="manageuser" name="manageuser" class="input-area" checked="">
									<label for="manageuser">
										Управлением пользователем
										<div class="help-block">Возможность добавлять или удалять организаторов, редактировать права доступа, назначать ответственных за мероприятия.</div>
									</label>
								</div>
								<div class="input-field">
									<input type="checkbox" id="manageevent" name="manageevent" class="input-area" checked="">
									<label for="manageevent">
										Создавать мероприятия
										<div class="help-block">Возможность добавлять и удалять мероприятия.</div>
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="input-field">
									<input type="text" id="position" name="position" class="input-area" autocomplete="off" value="<?=$organization->team[$i]->role_name; ?>">
									<label for="position" class="input-label active">Должность</label>
								</div>
								<div class="input-field">
									<select id="events" name="events" class="form-control input-width eventsToUser" multiple="multiple">
										<option value="1">Мисс ИТМО</option>
										<option value="2" selected="selected">Мистер ИТМО</option>
										<option value="3">Федеральный конкурс ты нужен людям</option>
									</select>
									<label for="events" class="input-label active">Мероприятия</label>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="col-xs-12 col-md-6 pad0">
									<button type="button" id="remove_user" class="btn btn-md btn-labeled btn-danger pull-left col-xs-12 col-md-9 col-lg-6">
										<span class="btn-text">Удалить пользователя</span>
										<span class="btn-icon"><i class="fa fa-trash"></i></span>
									</button>
								</div>
								<div class="col-xs-12 col-md-6 pad0">
									<button type="button" id="submit_btn" class="btn btn-md btn-labeled btn-success col-xs-12 col-md-5 col-lg-4">
										<span class="btn-text">Обновить</span>
										<span class="btn-icon"><i class="fa fa-check"></i></span>
									</button>
									<button type="button" class="btn btn-md btn-labeled btn-default col-xs-12 col-md-5 col-md-offset-2 col-lg-4 col-lg-offset-4" id="canselEdit" data-toggle="collapse" data-target="#user<?=$i; ?>">
										<span class="btn-text">Отмена</span>
										<span class="btn-icon"><i class="fa fa-times"></i></span>
									</button>
								</div>
							</div>

						</form>
						<!--<div class="form-group input-width">
							<label class="control-label">Мероприятия</label>
							<select name="events" class="form-control input-width eventsToUser" multiple="multiple">
								<option value="1">Мисс ИТМО</option>
								<option value="2" selected="selected">Мистер ИТМО</option>
								<option value="3">Федеральный конкурс ты нужен людям</option>
							</select>
							<span class="help-block" >Выберите меропиятия, которые сможет редактировать пользователь</span>
						</div>-->
					</div>
				</li>
				<? endfor; ?>
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

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.full.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-settings-team.js"></script>
