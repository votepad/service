<div class="org-nav">
  <a href="<?=URL::site('organization/' . $id); ?>" class="menu-btn">
      Мероприятия
  </a>
  <a href="<?=URL::site('organization/' . $id . '/settings/main'); ?>" class="menu-btn">
      Настройки
  </a>
  
  <div class="dropdown menu-btn nodisp">
	<a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Быстрый старт
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu" aria-labelledby="dLabel">
		<li>
			<a href="#" class="">
				<i class="fa fa-plus" aria-hidden="true"></i>
				Создать мероприятие
			</a>
		</li>
		<li>
			<a href="#" class="">
				<i class="fa fa-paper-plane" aria-hidden="true"></i>
				Пригласить организатора
			</a>
		</li>
	</ul>
	</div>
</div>
