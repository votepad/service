<!-- =============== PAGE STYLES ===============-->

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>js/organizations/settings-team.js"></script>

<h3 class="page-header">
	Состав команды
</h3>

<div class="block">
	<?=Debug::Vars($organization->team);?>
</div>

<!-- Users In Team -->
<div class="row">

	<? for($i = 0; $i < count($organization->team); $i++) : ?>

	<div class="card card-sm clear_fix" action="" id="">
		<div class="card_image" id="">
			<img src="<?=$assets; ?>img/user/02.jpg" alt="">
		</div>
		<div class="card_title">
			<div class="card_title-text" id="">
				<?=$organization->team[$i]->lastname . ' ' . $organization->team[$i]->name . ' ' . $organization->team[$i]->surname; ?>
			</div>
			<div class="card_title-dropdown">
				<div role="button" class="card_title-dropdown-icon">
					<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
				</div>
				<div class="card_title-dropdown-menu">
					<a class="card_title-dropdown-item edit">
						Изменить информацию
					</a>
					<a class="card_title-dropdown-item delete" data-pk="19">
						Удалить организатора
					</a>
				</div>
			</div>
		</div>
		<div class="card_content">
			<p class="card_content-text">
				<i><u>Права доступа:</u></i>
				<span id="">
					<option value="">Управление пользователями</option>
					<option value="">Управление мероприятиями</option>
				</span>
			</p>
			<p class="card_content-text">
				<i><u>Мероприятия:</u></i>
				<span id="participants_team-1">
					<option value="1">Мисс ИТМО</option>
					<option value="2">Мистер ИТМО</option>
					<option value="3">Федеральный конкурс ты нужен людям</option>
				</span>
			</p>
		</div>
	</div>

	<? endfor; ?>

</div>



<h3 class="page-header">
	Пригласить организатора в команду
</h3>

<!-- Invite New User -->
<div class="row">
	<form class="form" action="" method="POST" id="">
		<div class="form_body">
			<div class="col-xs-12">
				<div class="row row-col">
				</div>
			</div>
		</div>
	</form>
</div>
