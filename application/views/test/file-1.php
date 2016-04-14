<?php
?>

	<link rel="stylesheet" href="<?=$assets; ?>css/administrate-event.css">
	<script src="<?=$assets; ?>js/administrate-event.js"></script>

	<script src="<?=$assets; ?>vendor/jquery-ui/ui/core.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/widget.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/mouse.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/draggable.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/droppable.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/sortable.js"></script>
	<script src="<?=$assets; ?>vendor/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap.js"></script>
	<script src="<?=$assets; ?>vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
	<script src="<?=$assets; ?>js/app.js"></script>

	<link rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert/dist/sweetalert.css">
	<script src="<?=$assets; ?>vendor/sweetalert/dist/sweetalert.min.js"></script>


<section>
	<div class="content-wrapper">
		<h3>Панель администрирования мероприятия
			<small>Во время мероприятия, вы можете отследить сколько жюри онлайн, сколько подтвердили выставленные баллы на каждом этапе, разрешить переход к следующему этапу, запретить оценивание некоторых участников, предварительно поставив им балл</small>
		</h3>
		
		<div class="portlets-wrapper">
			<!-- START row-->
			<div class="row">
				<div id="portles-1-1" data-toggle="portlet" class="col-md-4">

					<div id="judges-online" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Авторизованных жюри 3
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
							<a href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Обновить информацию" data-spinner="standard" class="pull-right">
								<em class="fa fa-refresh"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<p>Иванов Иван Иванович 1</p>
								<p>Иванов Иван Иванович 2</p>
								<p>Иванов Иван Иванович 3</p>
							</div>
						</div>
					</div>

					<div id="setting" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Настройки
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<p>
									<a id="start-again" href="#" class="btn btn-default col-xs-12 btn_area1">Сбросить результаты</a>
								</p>
								<p>
									<a id="download" href="#" class="btn btn-default col-xs-12">Скачать результаты</a>
								</p>
							</div>
						</div>
					</div>

				</div>

				<div id="portles-1-2" data-toggle="portlet" class="col-md-8">
					
					<div id="confirm-steps" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Переход к следующему этапу
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
							<a href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Обновить информацию" data-spinner="standard" class="pull-right">
								<em class="fa fa-refresh"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="width: 50%">Название этапа</th>
											<th class="text-center" style="width: 25%">Выставили баллы, чел</th>
											<th class="text-center" style="width: 25%">Следующий этап</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>этап 1</td>
											<td class="text-center">3</td>
											<td class="text-center">
												<a href="#" class="btn btn-default">Открыть доступ</a>
											</td>
										</tr>
										<tr>
											<td>этап 2</td>
											<td class="text-center">2</td>
											<td class="text-center">
												<a href="#" class="btn btn-default">Открыть доступ</a>
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div id="ban-participant" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Запретить участвовать
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<!-- отправляем через ajax -->
								<form method="POST">
									<div class="form-group">
										<select name="stage" class="form-control">
											<!-- выводим список этапов -->
											<option>этап 1</option>
											<option>этап 2</option>
										</select>
									</div>
									<div class="form-group">
										<div class="col-lg-5">
											<!-- выводим список участников -->
											<div class="checkbox c-checkbox needsclick">
												<label class="needsclick">
													<input type="checkbox" value="" class="needsclick">
													<span class="fa fa-check"></span>Участник 1
												</label>
											</div>
											<div class="checkbox c-checkbox needsclick">
												<label class="needsclick">
													<input type="checkbox" value="" class="needsclick">
													<span class="fa fa-check"></span>Участник 2
												</label>
											</div>
										</div>
										<div class="col-lg-7">
											<label class="col-lg-5 control-label">Введитее балл</label>
											<div class="col-lg-7">
												<input type="number" class="form-control">
											</div>
											<button type="submit" class="btn btn-default btn_area pull-right">Запретить участвовать</button>
										</div>
									</div>
									
								</form>
							</div>
						</div>
					</div>

				</div>				
				<div id="portlet-3" data-toggle="portlet" class="col-md-12">
					
					<div id="raiting" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Рейтинг
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
							<a href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Обновить информацию" data-spinner="standard" class="pull-right">
								<em class="fa fa-refresh"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="tabpanel">
									<ul role="tablist" class="nav nav-tabs">
										<li role="presentation" class="active" style="width: 25%"><a href="#stage-1" aria-controls="stage-1" role="tab" data-toggle="tab">Этап 1</a></li>
										<li role="presentation" style="width: 25%"><a href="#stage-2" aria-controls="stage-2" role="tab" data-toggle="tab">Этап 2</a></li>
										<li role="presentation" style="width: 25%"><a href="#stage-3" aria-controls="stage-3" role="tab" data-toggle="tab">Этап 3</a></li>
										<li role="presentation" style="width: 25%"><a href="#total" aria-controls="total" role="tab" data-toggle="tab">Общий рейтинг</a></li>
									</ul>
									<div class="tab-content">
										<div id="stage-1" role="tabpanel" class="tab-pane active">
											<table class="table table-hover" id="for-stage-1">
												<thead>
													<tr>
														<td></td>
														<td>Иванов Иван Иванович</td>
														<td>Иванов Иван Иванович</td>
														<td>Иванов Иван Иванович</td>
														<td>Иванов Иван Иванович</td>
														<td>Иванов Иван Иванович</td>
														<td>Иванов Иван Иванович</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Иванов Иван Иванович</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 2</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 3</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 4</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 6</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div id="stage-2" role="tabpanel" class="tab-pane">
											<table class="table table-hover" id="for-stage-2">
												<thead>
													<tr>
														<td></td>
														<td>Жюри1</td>
														<td>Жюри2</td>
														<td>Жюри3</td>
														<td>Жюри4</td>
														<td>Жюри5</td>
														<td>Жюри6</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>участник 1</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 2</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 3</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 4</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 6</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div id="stage-3" role="tabpanel" class="tab-pane">
											<table class="table table-hover" id="for-stage-3">
												<thead>
													<tr>
														<td></td>
														<td>Жюри1</td>
														<td>Жюри2</td>
														<td>Жюри3</td>
														<td>Жюри4</td>
														<td>Жюри5</td>
														<td>Жюри6</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>участник 1</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 2</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 3</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 4</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 6</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div id="total" role="tabpanel" class="tab-pane">
											<table class="table table-hover" id="for-tatal">
												<thead>
													<tr>
														<td></td>
														<td>Жюри1</td>
														<td>Жюри2</td>
														<td>Жюри3</td>
														<td>Жюри4</td>
														<td>Жюри5</td>
														<td>Жюри6</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>участник 1</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 2</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 3</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 4</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
													<tr>
														<td>участник 6</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
														<td>5</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>