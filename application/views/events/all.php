<div class="columns-area">
  <div class="panel panel-default quick-start">
      <div class="panel-body">
        <ul class="no-li">
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






<div id="count_events" class="text-center"></div>
	<!-- LIST OF EVENTS -->
	<ul id="events_list" class="text-center">
		<? for($i = 0; $i < count($events); $i++) : ?>
		<li class="event-group">
			<div class="event-wrapper">
				<div class="event-shot">
					<div class="event-image" style="background: url(<?=$assets; ?>img/bg2.jpg) no-repeat;"></div>
					<a class="event-link" href="<?=URL::site('events/' . $events[$i]['name']); ?>">
						<div class="event-preview">
							<h2 class="event_name_search"><?=$events[$i]['name']; ?></h2>
							<p><?=$events[$i]['short_description']; ?></p>
							<span class="event_time_search"><?=$events[$i]['start_time']; ?></span>
							<small class="event_type_search">черновик</small>
						</div>
					</a>
					<div class="event-result" style="display: block">
						<a href="#/tnl/rating" data-toggle="tooltip" data-placement="top" title="Рейтинг">
							<i class="fa fa-users" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="event-footer">
					<ul class="event-footer-left">
						<li class="li">
							<div class="">
								<button data-toggle="dropdown" class="md-btn item">
									<i class="fa fa-share-alt" aria-hidden="true"></i>
								</button>
								<ul role="menu" class="dropdown-menu">
									<li class="vk">
										<a href="#">
											<i class="fa fa-vk" aria-hidden="true"></i>
											<span>Вконтакте</span>
										</a>
									</li>
									<li>
										<a href="#" class="facebook">
											<i class="fa fa-facebook" aria-hidden="true"></i>
											<span>Facebook</span>
										</a>
									</li>
									<li>
										<a href="#" class="twitter">
											<i class="fa fa-twitter" aria-hidden="true"></i>
											<span>Twitter</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="li">
							<button type="button" class="md-btn item" data-toggle="tooltip" data-placement="bottom" title="Связаться с организатором" onclick="open_feedback_form(email)">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</button>
						</li>
					</ul>
					<ul class="event-footer-right">
						<li class="fav">
							<button type="button" class="md-btn">
								<i class="fa fa-heart" aria-hidden="true"></i>
								<span>165</span>
							</button>
						</li>
						<li class="views">
							<div class="div-views md-btn" data-toggle="tooltip" data-placement="bottom" title="Просмотров">
								<i class="fa fa-eye" aria-hidden="true"></i>
								<span>215</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</li>
		<? endfor; ?>
	</ul>
</div>
<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="../../../assets/vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-all.js"></script>
