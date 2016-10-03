<div class="columns-area">
  <div class="panel panel-default quick-start">
      <div class="panel-body">
        <ul class="no-li clearfix">
          <li class="inline">
            <div class="">
              Быстрый старт
            </div>
          </li>
          <li class="inline">
            <a href="<?=URL::site($organization->website . '/event/new'); ?>" class="inline">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Создать мероприятие
            </a>
          </li>
          <li class="inline">
            <a href="<?=URL::site($organization->website . '/settings/team'); ?>" class="inline">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Пригласить организатора
            </a>
          </li>
        </ul>
      </div>
  </div>

	<!-- SEARCHING  -->
	<div class="panel panel-default searching">
		<div class="panel-body">
			<ul class="no-li clearfix">
				<li class="inline">
					Поиск мероприятия
				</li>
				<li class="inline search-block clearfix">
					<input name="event_name" type="text" class="inline" placeholder="Введите название мероприятия">

          <div class="inline select_wrapper">
            <select name="event_sort" class="select_btn">
              <option value="0" data-btn='<i class="fa fa-sort" aria-hidden="true"></i>' data-text="" data-class="active"></option>
              <option value="1" data-text="Название мероприятия" data-class="">Название мероприятия</option>
              <option value="2" data-text="Дата начала мероприятия" data-class="">Дата начала мероприятия</option>
            </select>
          </div>

          <div class="inline select_wrapper">
            <select name="event_type" class="select_btn">
              <option value="0" data-btn='<i class="fa fa-filter" aria-hidden="true"></i>' data-text="" data-class="active"></option>
              <option value="1" data-text="черновик" data-class="">черновик</option>
              <option value="2" data-text="виден всем" data-class="">виден всем</option>
              <option value="3" data-text="виден команде" data-class="">виден команде</option>
            </select>
          </div>
				</li>
			</ul>
		</div>
	</div>






<ul class="no-li" id="events_list">
  <!-- LIST OF EVENTS -->
  <? for($i = 0; $i < count($events); $i++) : ?>
  <li class="event_wrapper ">
    <div class="event_card">
      <div class="event_card-image" style="background-image: url('<?=$assets; ?>img/bg2.jpg');">
      </div>
      <div class="event_card-content">
        <span class="event_card-title">
          <span class="event_name_search pointer"><?=$events[$i]['name']; ?></span>
          <i class="fa fa-ellipsis-v pull-right pointer" aria-hidden="true"></i>
        </span>
      </div>
      <div class="event_card-reveal animated">
        <span class="event_card-title">
          <span class="pointer"><?=$events[$i]['name']; ?></span>
          <i class="fa fa-close pull-right pointer" aria-hidden="true"></i>
        </span>
        <p><?=$events[$i]['short_description']; ?></p></p>
        <p>
          <i class="fa fa-calendar" aria-hidden="true"></i>
          <span class="event_time_search"><?=$events[$i]['start_time']; ?></span>
        </p>
        <p class="event-status bgcolor_red">
          <i class="fa fa-eye" aria-hidden="true"></i>
          <span class="event_type_search">черновик</span>
        </p>
      </div>
      <div class="event_card-action clearfix">
        <a href="<?=URL::site('events/' . $events[$i]['name']); ?>" class="underlinehover pull-left">Страница</a>
        <a href="<?=URL::site('events/' . $events[$i]['name']); ?>/results" class="underlinehover pull-right">Результаты</a>
      </div>
    </div>
  </li>
  <? endfor; ?>
</ul>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="../../../assets/vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-all.js"></script>
