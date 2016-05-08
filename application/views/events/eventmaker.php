<section>
	<div class="content-wrapper">
		<h3>Панель администрирования мероприятия
			<small>Во время мероприятия, вы можете отследить сколько жюри онлайн, сколько подтвердили выставленные баллы на каждом этапе, разрешить переход к следующему этапу, запретить оценивание некоторых участников, предварительно поставив им балл</small>
		</h3>
		
		<div class="portlets-wrapper">
			<!-- START row-->
			<div class="row">
				<div id="portles-1-1" data-toggle="portlet" class="col-md-4">

					<div id="setting" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Настройки
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse">
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
									<input type="hidden" name="id_event" value="<?=$id_event; ?>">
									<div class="form-group">
										<select name="stage" class="form-control">
											<!-- выводим список этапов -->
											<?php for($i = 0; $i < count($stages); $i++) : ?>
												<option value="<?=$stages[$i]['id']; ?>"><?=$stages[$i]['name']; ?></option>
											<?php endfor; ?>
										</select>
									</div>
									<div class="form-group">
										<!-- выводим список участников -->
										<?php for($i = 0; $i < count($participants_1); $i++) : ?>
											<div class="checkbox c-checkbox needsclick">
												<label class="needsclick">
													<input type="checkbox" name="id[]" value="<?=$participants_1[$i]['id']; ?>" class="needsclick">
													<span class="fa fa-check"></span><?=$participants_1[$i]['name']; ?>
												</label>
											</div>
										<?php endfor; ?>
											
										<button type="submit" class="btn btn-default btn_area pull-right">Запретить участвовать</button>
									</div>
								</form>
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

					<div id="addscore-participant" class="panel panel-primary">
						<div class="panel-heading portlet-handler">Поставить дополнитеьный балл
							<a href="#" data-tool="panel-collapse" class="pull-right">
								<em class="fa fa-minus"></em>
							</a>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<!-- отправляем через ajax -->
								<form method="POST" action="<?=URL::site('addExtraScore') ;?>">
									<input type="hidden" name="id_event" value="<?=$id_event; ?>">
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
												<button type="submit" class="btn btn-default btn_area pull-right">Поставить</button>
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
							<div class="panel-body" id="tabs">
								<ul class="nav nav-tabs">
									<?php for($i = 0; $i < count($stages); $i++): ?>
									<li style="width: <?=100/( count($stages) + 1); ?>%"><a href="#stage-<?=($i + 1); ?>" ><?=$stages[$i]['name']; ?></a></li>
									<?php endfor; ?>
									<li style="width: <?=100/( count($stages) + 1); ?>%"><a href="#total" >Общий рейтинг</a></li>
								</ul>
								<?php for($i = 0; $i < count($stages); $i++):
									?>
								<div id="stage-<?=($i + 1); ?>">
									<table class="table table-hover" id="for-stage-<?=($i + 1); ?>">
										<thead>
											<tr>
												<td></td>
												<?php for($j = 0; $j < count($judges); $j++): ?>
													<td class="text-center"><?=$judges[$j]['name']; ?></td>
												<?php endfor; ?>
												<td class="text-center" style="color: blue;">Сумма:</td>
											</tr>
										</thead>
										<tbody>
										<?php for($j = 0; $j < count($participants_1); $j++) :
												$amount[$j] = 0;
											?>
											<tr>
													<td><?=$participants_1[$j]['name']; ?></td>
												<?php for($k = 0; $k < count($judges); $k++): ?>
													<td class="text-center scoreinfo" title="Подробно" value="<?=$stages[$i]['id'].'-'. $judges[$k]['id'].'-'. $participants_1[$j]['id']; ?>">
														<?php
															$score = Model_Score::getScore($id_event, $stages[$i]['id'], $judges[$k]['id'], $participants_1[$j]['id']);
															$additional = Model_Score::getAdditionalScores($id_event, $stages[$i]['id'], $participants_1[$j]['id']);
															$amount[$j] += $score;
															echo $score ?: 0;

															$count = ($additional == 0 && Model_Stages::isBlockedParticipantsExist($stages[$i]['id']) ) ? count($judges) : 1;

														?>
													</td>
												<?php endfor; ?>
												<td class="text-center"><?=$amount[$j] / (count($judges) ? $count : 1); ?><?=( isset($additional) && $additional != 0) ? '(+'. $additional .')': '' ; ?></td>
											</tr>
										<?php endfor; ?>
										</tbody>
									</table>
								</div>
								<?php endfor; ?>

								<div id="total">
									<table class="table table-hover" id="total">
										<thead>
										<tr>
											<td></td>
											<?php for($j = 0; $j < count($judges); $j++): ?>
												<td class="text-center"> Итог ( <?=$judges[$j]['name']; ?> )</td>
											<?php endfor; ?>
											<td class="text-center">Результат:</td>
										</tr>
										</thead>
										<tbody>
										<?php for($j = 0; $j < count($participants_1); $j++) :
												$sum[$j] 		= 0;
												$additional1[$j] = 0;
											?>
											<tr>
												<td><?=$participants_1[$j]['name']; ?></td>
												<?php for($k = 0; $k < count($judges); $k++): ?>
													<td class="text-center">
														<?php
															$score = Model_Score::getTotalScore($id_event, $judges[$k]['id'], $participants_1[$j]['id']);
															$additional1[$j] = Model_Score::getAdditionalScores($id_event, '0', $participants_1[$j]['id']) ?: 0;
															$sum[$j] 	+= $score;
															echo $score ;
														?>
													</td>
												<?php endfor; ?>
													<td class="text-center"><?=$sum[$j]. ' (+'. $additional1[$j] .') = '  . ($sum[$j] + $additional1[$j]);?></td>
											</tr>
										<? endfor; ?>
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
	<!-- Modal-->
   <div tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 id="myModalLabel" class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button>
            </div>
         </div>
      </div>
   </div>

</section>