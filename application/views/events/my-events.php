<section>
	<div class="content-wrapper">
		<h3>Мои мероприятия
			<small>Здесь Вы можете отреактировать мероприятие, настроить очереность выступления участников, создать приветственную страницу Вашего мероприятия, а также удалить мероприятие.</small>
		</h3>
		<div class="panel panel-default">
			<div class="panel-body">
			<!--выводим не более 5 мероприятий в таблице-->
				<table id="table-my-event" class="table table-bordered table-striped table-hover" cellspacing="0">
					<thead>
						<tr>
							<th class="sorting text-center" style="width: 5%">#</th>
							<th class="no-sort text-center" style="width: 5%">Логотип</th>
							<th class="sorting" >Название мероприятия</th>
							<th class="sorting" style="width: 15%">Дата начала</th>
							<th class="no-sort text-center" style="width: 15%">Редактирование</th>
							<th class="no-sort text-center" style="width: 15%">Управление</th>
							<th class="no-sort text-center" style="width: 5%">Удаление</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i = 0; $i < count($events); $i++): ?>
						<tr id="event_<?=$events[$i]['id']; ?>">
							<td class="text-center"><?=$i+1; ?></td>
							<td style="width: 5%">
								<div class="media">
									<img src="<?=URL::base(); ?>uploads/<?=$events[$i]['photo']; ?>" alt="Image" class="img-responsive img-circle">
								</div>
							</td>
							<td><?=$events[$i]['title'] ;?></td>
							<td style="width: 15%"><?php echo strftime('%d %b %Y  в  %H:%M', strtotime($events[$i]['start_datetime'])); ?></td>
							<td style="width: 15%">
								<div class="col-xs-4 text-center">
									<a href="<?=URL::base(). 'events/'. $events[$i]['id']. '/edit/'; ?>" data-toggle="tooltip" data-title="Редактирование информации о мероприятии">
										<em class="fa fa-edit icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">

									<a href="<?=URL::base(). 'event/'. $events[$i]['id']. '/setting'. $events[$i]['type']; ?>" data-toggle="tooltip" data-title="Настройка панели жюри">

										<em class="fa fa-user icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#1" data-toggle="tooltip" data-title="Настройка приветственной страницы мероприятия">
										<em class="fa fa-users icon-edit"></em>
									</a>
								</div>
							</td>
							<td style="width: 15%">
								<!-- логика: 
									1)заводим в table Events столбец, хранящий информацию о заполненности мероприятия
									2)при создании мероприятия ставим по умолчанию 25
									3)если мы создали не менее двух участников, не менее одного жюри и не менее 1 этапа с 1 критерием , то +25
									4) если мы настраиваем порядок выступления, то +25
									5) если мы создаем приветственную страницу мероприятия то +25
								-->
								<div class="col-xs-4 text-center">
									<div data-label="50%" class="radial-bar radial-bar-50 radial-bar-xs"></div>
								</div>
								<!--  Если заполненности мероприятия равна 100, то меняем класс icon-publish-no на icon-publish-yes и разрешаем создавать домен 3 уровня-->
								<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Опубликовать мероприятие">
										<em class="fa fa-check icon-publish-no"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="<?=URL::base(). 'events/'. $events[$i]['id']. '/eventmaker/'; ?>" data-toggle="tooltip" data-title="Панель организатора">
										<em class="fa fa-table icon-organel"></em>
									</a>
								</div>
							</td>
							<td class="text-center" style="width: 15%">
								<a id="deleteEvent" href="#">
									<em class="fa fa-remove icon-remove"></em>
								</a>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>