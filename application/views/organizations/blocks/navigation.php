<?
    $owner      = Model_PrivillegedUser::getUserOrganization(Session::instance()->get('id_user')) == $id;
    $isLogged   = Dispatch::isLogged();
?>


<div class="org-nav">
  <a href="<?=URL::site('organization/' . $id); ?>" class="menu-btn">
      Мероприятия
  </a>
  <? if ( $owner && $isLogged): ?>
  <a href="<?=URL::site('organization/' . $id . '/settings/main'); ?>" class="menu-btn">
      Настройки
  </a>
	<a href="#" class="dropdown menu-btn displaynone" id="open_quick_start" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Быстрый старт
		<i class="fa fa-caret-down" aria-hidden="true"></i>
	</a>
	<ul class="dropdown-menu" aria-labelledby="open_quick_start">
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
  <? endif; ?>

</div>
