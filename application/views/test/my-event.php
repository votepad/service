<?php
?>

	<link rel="stylesheet" href="<?=$assets; ?>css/table-my-event.css">
	
	<!-- DATATABLES-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/datatables/media/css/jquery.dataTables.css">
	<script src="<?=$assets; ?>vendor/datatables/media/js/jquery.dataTables.js"></script>
	<script src="<?=$assets; ?>vendor/datatables/media/plugins/date-de.js"></script>
	<script src="<?=$assets; ?>vendor/datatable-bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="<?=$assets; ?>js/myevent.js"></script>


<section>
	<div class="content-wrapper">
		<h3>Мои мероприятия
			<small>Здесь Вы можете реактировать мероприятие, создать панель для Жюри, где они будут выставлять оценки, создать приветственную страницу Вашего мероприятия, а также удалить мероприятие</small>
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
							<th class="no-sort" style="width: 15%">Дата начала</th>
							<th class="no-sort text-center" style="width: 15%">Редактирование</th>
							<th class="no-sort text-center" style="width: 15%">Управление</th>
							<th class="no-sort text-center" style="width: 5%">Удаление</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">1</td>
							<td>
								<div class="media">
									<img src="<?=$assets; ?>img/temp/miss_itmo.jpg" alt="Image" class="img-responsive img-circle">
								</div>
							</td>
							<td>Мисс ИТМО</td>
							<td>28.04.2016 17:00</td>
							<td>
								<div class="col-xs-4 text-center">
									<a href="#1" data-toggle="tooltip" data-title="Редактирование информации о мероприятие">
										<em class="fa fa-edit icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#1" data-toggle="tooltip" data-title="Настройка панели жюри">
										<em class="fa fa-user icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#1" data-toggle="tooltip" data-title="Настройка приветственной страницы мероприятия">
										<em class="fa fa-users icon-edit"></em>
									</a>
								</div>
							</td>
							<td>
								<div class="col-xs-4 text-center">
                            		<div data-label="50%" class="radial-bar radial-bar-50 radial-bar-xs"></div>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Опубликовать мероприятие">
										<em class="fa fa-share-alt icon-publish-no"></em>
									</a>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Панель организатора">
										<em class="fa fa-table icon-organel"></em>
									</a>
                            	</div>
							</td>
							<td class="text-center">
								<a href="#1">
									<em class="fa fa-remove icon-remove"></em>
								</a>
							</td>
						</tr>
						<tr>
							<td class="text-center">2</td>
							<td>
								<div class="media">
									<img src="<?=$assets; ?>img/temp/vesnavitmo.jpg" alt="Image" class="img-responsive img-circle">
								</div>
							</td>
							<td>Весна в ИТМО</td>
							<td>31.05.2016 17:00</td>
							<td>
								<div class="col-xs-4 text-center">
									<a href="#2" data-toggle="tooltip" data-title="Редактирование информации о мероприятие">
										<em class="fa fa-edit icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#2" data-toggle="tooltip" data-title="Настройка панели жюри">
										<em class="fa fa-user icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#2" data-toggle="tooltip" data-title="Настройка приветственной страницы мероприятия">
										<em class="fa fa-users icon-edit"></em>
									</a>
								</div>
							</td>
							<td>
								<div class="col-xs-4 text-center">
                            		<div data-label="75%" class="radial-bar radial-bar-75 radial-bar-xs"></div>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Опубликовать мероприятие">
										<em class="fa fa-share-alt icon-publish-no"></em>
									</a>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Панель организатора">
										<em class="fa fa-table icon-organel"></em>
									</a>
                            	</div>
							</td>
							<td class="text-center">
								<a href="#1">
									<em class="fa fa-remove icon-remove"></em>
								</a>
							</td>
						</tr>
						<tr>
							<td class="text-center">3</td>
							<td>
								<div class="media">
									<img src="<?=$assets; ?>img/temp/tnl.jpg" alt="Image" class="img-responsive img-circle">
								</div>
							</td>
							<td>Ты нужен людям финал</td>
							<td>10.05.2016 15:00</td>
							<td>
								<div class="col-xs-4 text-center">
									<a href="#3" data-toggle="tooltip" data-title="Редактирование информации о мероприятие">
										<em class="fa fa-edit icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#3" data-toggle="tooltip" data-title="Настройка панели жюри">
										<em class="fa fa-user icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#3" data-toggle="tooltip" data-title="Настройка приветственной страницы мероприятия">
										<em class="fa fa-users icon-edit"></em>
									</a>
								</div>
							</td>
							<td>
								<div class="col-xs-4 text-center">
                            		<div data-label="100%" class="radial-bar radial-bar-100 radial-bar-xs"></div>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Опубликовать мероприятие">
										<em class="fa fa-share-alt icon-publish-yes"></em>
									</a>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Панель организатора">
										<em class="fa fa-table icon-organel"></em>
									</a>
                            	</div>
							</td>
							<td class="text-center">
								<a href="#3">
									<em class="fa fa-remove icon-remove"></em>
								</a>
							</td>
						</tr>
						<tr>
							<td class="text-center">4</td>
							<td>
								<div class="media">
									<img src="<?=$assets; ?>img/temp/misteritmo.png" alt="Image" class="img-responsive img-circle">
								</div>
							</td>
							<td>Мистер ИТМО</td>
							<td>30.11.2016 17:00</td>
							<td>
								<div class="col-xs-4 text-center">
									<a href="#4" data-toggle="tooltip" data-title="Редактирование информации о мероприятие">
										<em class="fa fa-edit icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#4" data-toggle="tooltip" data-title="Настройка панели жюри">
										<em class="fa fa-user icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#4" data-toggle="tooltip" data-title="Настройка приветственной страницы мероприятия">
										<em class="fa fa-users icon-edit"></em>
									</a>
								</div>
							</td>
							<td>
								<div class="col-xs-4 text-center">
                            		<div data-label="0%" class="radial-bar radial-bar-0 radial-bar-xs"></div>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Опубликовать мероприятие">
										<em class="fa fa-share-alt icon-publish-no"></em>
									</a>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Панель организатора">
										<em class="fa fa-table icon-organel"></em>
									</a>
                            	</div>
							</td>
							<td class="text-center">
								<a href="#4">
									<em class="fa fa-remove icon-remove"></em>
								</a>
							</td>
						</tr>
						<tr>
							<td class="text-center">5</td>
							<td>
								<div class="media">
									<img src="<?=$assets; ?>img/temp/ifse.png" alt="Image" class="img-responsive img-circle">
								</div>
							</td>
							<td>International Festival Of Social Entrepreneurship</td>
							<td>22.06.2016 14:00</td>
							<td>
								<div class="col-xs-4 text-center">
									<a href="#5" data-toggle="tooltip" data-title="Редактирование информации о мероприятие">
										<em class="fa fa-edit icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#5" data-toggle="tooltip" data-title="Настройка панели жюри">
										<em class="fa fa-user icon-edit"></em>
									</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#5" data-toggle="tooltip" data-title="Настройка приветственной страницы мероприятия">
										<em class="fa fa-users icon-edit"></em>
									</a>
								</div>
							</td>
							<td>
								<div class="col-xs-4 text-center">
                            		<div data-label="25%" class="radial-bar radial-bar-25 radial-bar-xs"></div>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Опубликовать мероприятие">
										<em class="fa fa-share-alt icon-publish-no"></em>
									</a>
                            	</div>
                            	<div class="col-xs-4 text-center">
									<a href="#" data-toggle="tooltip" data-title="Панель организатора">
										<em class="fa fa-table icon-organel"></em>
									</a>
                            	</div>
							</td>
							<td class="text-center">
								<a href="#5">
									<em class="fa fa-remove icon-remove"></em>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>