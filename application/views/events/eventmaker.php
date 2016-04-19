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
						<div class="panel-heading portlet-handler">Авторизованные жюри
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<?php for($i = 0; $i < count($judges); $i++) : ?>
									<div class="row btn_area1">
										<div class="col-xs-3">
											<div class="media">
												<img src="<?=URL::base().'uploads/' . $judges[$i]['photo']; ?>" class="img-responsive img-circle">
											</div>
										</div>
										<div class="col-xs-9">
											<p><?=$judges[$i]['name']; ?></p>
										</div>
									</div>
								<?php endfor; ?>
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
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="width: 50%">Название этапа</th>
											<th class="text-center" style="width: 25%">Следующий этап</th>
										</tr>
									</thead>
									<tbody>
									<?php for($i = 0; $i < count($stages); $i++) : ?>
										<tr>
											<td><?=$stages[$i]['name']; ?></td>
											<td id="<?=$stages[$i]['id']; ?>" class="text-center">
												<button id="openStage" class="btn btn-default btn-open btn-open-<?=$i; ?>">Открыть доступ</button>
											</td>
										</tr>
									<?php endfor; ?>
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
								<form method="POST" action="<?=URL::site('blockparticipants') ;?>">
									<div class="form-group">
										<select name="stage" class="form-control">
											<!-- выводим список этапов -->
											<?php for($i = 0; $i < count($stages); $i++) : ?>
												<option value="<?=$stages[$i]['id']; ?>"><?=$stages[$i]['name']; ?></option>
											<?php endfor; ?>
										</select>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-5">
												<!-- выводим список участников -->
												<?php for($i = 0; $i < count($participants_1); $i++) : ?>
												<div class="checkbox c-checkbox needsclick">
													<label class="needsclick">
														<input type="checkbox" name="id[]" value="<?=$participants_1[$i]['id']; ?>" class="needsclick">
														<span class="fa fa-check"></span><?=$participants_1[$i]['name']; ?>
													</label>
												</div>
												<?php endfor; ?>
											</div>
											<div class="col-lg-7">
												<div class="row">
													<label class="col-lg-5 control-label">Введитее балл</label>
													<div class="col-lg-7">
														<input type="number" class="form-control" name="score">
													</div>
												</div>
												<button type="submit" class="btn btn-default btn_area pull-right">Запретить участвовать</button>
											</div>
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
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="tabpanel">
									<ul role="tablist" class="nav nav-tabs">
										<?php for($i = 0; $i < count($stages); $i++): ?>
										<li role="presentation" <?=($i == 0)? "class='active'": '' ; ?> style="width: <?=100/( count($stages) + 1); ?>%"><a href="#stage-<?=($i + 1); ?>" aria-controls="stage-<?=($i + 1); ?>" role="tab" data-toggle="tab"><?=$stages[$i]['name']; ?></a></li>
										<?php endfor; ?>
										<li role="presentation" style="width: <?=100/( count($stages) + 1); ?>%"><a href="#total" aria-controls="total" role="tab" data-toggle="tab">Общий рейтинг</a></li>
									</ul>
									<div class="tab-content">
										<?php for($i = 0; $i < count($stages); $i++): ?>
										<div id="stage-<?=($i + 1); ?>" role="tabpanel" <?=($i == 0)? "class='tab-pane active'": "class='tab-pane'" ; ?>>
											<table class="table table-hover" id="for-stage-<?=($i + 1); ?>">
												<thead>
													<tr>
														<td></td>
														<?php for($j = 0; $j < count($judges); $j++): ?>
															<td><?=$judges[$j]['name']; ?></td>
														<?php endfor; ?>
													</tr>
												</thead>
												<tbody>
												<?php for($j = 0; $j < count($participants); $j++) : ?>
													<tr>
														<td><?=$participants[$i][$j]['name']; ?></td>
														<?php for($k = 0; $k < count($judges); $k++): ?>
															<td>
																<?php
																	$score = Model_Score::getScore($id_event, $stages[$i]['id'], $judges[$k]['id'], $participants[$i][$j]['id']);
																	echo $score ?: 0;
																?>
															</td>
														<?php endfor; ?>
													</tr>
												<?php endfor; ?>
												</tbody>
											</table>
										</div>
										<?php endfor; ?>
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