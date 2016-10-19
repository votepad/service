<!-- =============== PAGE STYLES ===============-->


<div class="columns-area">
	<div class="block block-default org_team">
		<div id="topmenu" class="block-heading tabs">
			<?=$topmenu; ?>
		</div>
		<div class="block-body">
			<?=Debug::Vars($organization->team);?>
			<ul class="col-xs-12 ls_none">
				<? for($i = 0; $i < count($organization->team); $i++) : ?>
				<li class="block block-default user-block">
					<div class="block-heading">
						<button class="edit-team-btn" data-toggle="collapse" data-target="#user<?=$i; ?>">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</button>
						<div class="userImage">
							<div class="userImageBlock">
								<img src="<?=$assets; ?>img/user/02.jpg">
							</div>
						</div>
						<div class="userDesc">
							<p class="user-name"><?=$organization->team[$i]->lastname . ' ' . $organization->team[$i]->name . ' ' . $organization->team[$i]->surname; ?></p>
							<span class="user-role bg_red_a100"><?=$organization->team[$i]->role_name; ?></span>
							<p class="user-rools">
								<b>Права доступа</b>:
								<span>Управление пользователями</span>,
								<span>Управление мероприятиями</span>.
							</p>
						</div>
					</div>
					<div id="user<?=$i; ?>" class="block-body collapse">
						<form action="" >
							<div class="col-xs-12 col-md-6 access">
								<h4>Права доступа</h4>
								<div class="input-field">
									<input type="checkbox" id="manageuser-<?=$i; ?>" name="manageuser" class="input-area" checked="">
									<label for="manageuser-<?=$i; ?>">
										Управление пользователями
										<div class="help-block">Возможность добавлять или удалять организаторов, редактировать права доступа, назначать ответственных за мероприятия.</div>
									</label>
								</div>
								<div class="input-field">
									<input type="checkbox" id="manageevent-<?=$i; ?>" name="manageevent" class="input-area" checked="">
									<label for="manageevent-<?=$i; ?>">
										Управление мероприятиями
										<div class="help-block">Возможность добавлять и удалять мероприятия.</div>
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="input-field">
									<input type="text" id="position-<?=$i; ?>" name="position" class="input-area position" maxlength="50" autocomplete="off" value="<?=$organization->team[$i]->role_name; ?>">
									<label for="position-<?=$i; ?>" class="input-label active">Должность</label>
								</div>
								<div class="input-field">
									<select id="events-<?=$i; ?>" name="events" class="eventsToUser" multiple="multiple" >
										<option value="1">Мисс ИТМО</option>
										<option value="2" selected="selected">Мистер ИТМО</option>
										<option value="3">Федеральный конкурс ты нужен людям</option>
									</select>
									<label for="events-<?=$i; ?>" class="input-label active">Мероприятия</label>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="col-xs-12 col-md-6 pad0">
									<button type="button" id="remove_user" class="btn btn-md btn-labeled btn-danger pull-left col-xs-12 col-md-auto">
										<span class="btn-text">Удалить пользователя</span>
										<span class="btn-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
									</button>
								</div>
								<div class="col-xs-12 col-md-6 pad0">
									<button type="button" class="submit_btn btn btn-md btn-labeled btn-success col-xs-12 col-md-auto">
										<span class="btn-text">Обновить</span>
										<span class="btn-icon"><i class="fa fa-check" aria-hidden="true"></i></span>
									</button>
									<button type="button" class="btn btn-md btn-labeled btn-default col-xs-12 col-md-auto" style="float:right" data-toggle="collapse" data-target="#user<?=$i; ?>">
										<span class="btn-text">Закрыть</span>
										<span class="btn-icon"><i class="fa fa-times" aria-hidden="true"></i></span>
									</button>
								</div>
							</div>

						</form>
					</div>
				</li>
				<? endfor; ?>
			</ul>


			<!-- New User  -->

			<div class="col-xs-12">
				<button type="button" class="btn btn-md btn-labeled btn-default" data-toggle="collapse" data-target="#newuser">
					<span class="btn-text">Пригласить организатора в команду</span>
					<span class="btn-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
				</button>

				<form action="" id="newuser" class="block block-default collapse" name="newUserForm">
					<div class="block-heading">
						Пригласить организатора в команду
					</div>
					<div class="block-body">
						<div class="col-xs-12 col-md-6">
							<div class="input-field">
								<input type="text" id="username" name="username" class="input-area" autocomplete="off">
								<label for="username" class="input-label">Фамилия Имя Отчество</label>
							</div>
							<div class="input-field">
								<input type="text" id="email" name="email" class="input-area" autocomplete="off">
								<label for="email" class="input-label">E-mail</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 martop-15">
							<div class="input-field">
								<input type="text" id="position" name="position" class="input-area" autocomplete="off" length="50">
								<label for="position" class="input-label">Должность</label>
							</div>
							<div class="input-field">
								<select id="events" name="events" class="eventsToUser" multiple="multiple">
									<option value="1">Мисс ИТМО</option>
									<option value="2">Мистер ИТМО</option>
									<option value="3">Федеральный конкурс ты нужен людям</option>
								</select>
								<label for="events" class="input-label">Мероприятия</label>
							</div>
						</div>
						<div class="col-xs-12">
							<div>Права доступа</div>
							<div class="input-field col-xs-6">
								<input type="checkbox" id="manageuser" name="manageuser" class="input-area">
								<label for="manageuser">
									Управление пользователями
									<div class="help-block">Возможность добавлять или удалять организаторов, редактировать права доступа, назначать ответственных за мероприятия.</div>
								</label>
							</div>
							<div class="input-field col-xs-6">
								<input type="checkbox" id="manageevent" name="manageevent" class="input-area">
								<label for="manageevent">
									Управление мероприятиями
									<div class="help-block">Возможность добавлять и удалять мероприятия.</div>
								</label>
							</div>
						</div>
						<div class="col-xs-12">
							<button type="button" class="submit_btn btn btn-md btn-labeled btn-success col-xs-12 col-md-auto">
								<span class="btn-text">Отправить приглашение</span>
								<span class="btn-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
							</button>
							<button type="button" id="canselnewUser" class="btn btn-md btn-labeled btn-default col-xs-12 col-md-auto" style="float:right" data-toggle="collapse" data-target="#newuser">
								<span class="btn-text">Отмена</span>
								<span class="btn-icon"><i class="fa fa-times" aria-hidden="true"></i></span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.full.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-settings-team.js"></script>
