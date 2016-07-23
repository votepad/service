<section>
	<div class="content-wrapper">
		<h3>Настройка панели жюри
			<small>Вы можете 
				<a href="">посмотреть, как видят эту страницу жюри.</a>
			</small>
		</h3>
		<!-- SETTING JUDGE PANEL VIEW -->
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading panel-title" style="font-size: 1.2em"><a data-toggle="collapse" data-parent="#accordion" href="#panelview" aria-expanded="true" aria-controls="panelview" id="panel-view">Настройка внешнего вида панели жюри</a></div>
				<div id="panelview" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse">
					<div class="panel-body">
						<form class="form-horizontal">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-12 text-left btn_area1">"Шапка" страницы</label>
									<div class="col-sm-12">
										<input type="file" name="" data-classbutton="btn btn-default" data-classinput="form-control inline" data-buttonText="Выбрать файл" data-iconName="fa fa-folder-open" data-placeholder="не выбрано" class="form-control filestyle">	
									</div> 
									<div class="text-center">
										<p style="margin: 0">или</p>
									</div>
									<div class="col-sm-12">
										<div class="input-group colorpicker-component">
											<input type="text" name="" value="#039BE5" class="form-control" />
											<span class="input-group-addon"><i></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-12 text-left btn_area1">Фон страницы</label>
									<div class="col-sm-12">
										<input type="file" name="" data-classbutton="btn btn-default" data-classinput="form-control inline" data-buttonText="Выбрать файл" data-iconName="fa fa-folder-open" data-placeholder="не выбрано" class="form-control filestyle">	
									</div> 
									<div class="text-center">
										<p style="margin: 0">или</p>
									</div>
									<div class="col-sm-12">
										<div class="input-group colorpicker-component">
											<input type="text" name="" value="#f5f7fa" class="form-control" />
											<span class="input-group-addon"><i></i></span>
										</div>
									</div>									
								</div>
							</div>
							<br>
							<div class="col-sm-6 btn_area btn_area">
								<div class="form-group">
									<label class="col-sm-12 text-left btn_area1">Цвет формы для оценивания</label>
									<div class="col-sm-12">
										<div class="input-group colorpicker-component">
											<input type="text" name="" value="#fff" class="form-control" />
											<span class="input-group-addon"><i></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 btn_area btn_area">
								<div class="form-group">
									<label class="col-sm-12 text-left btn_area1">Цвет кнопок</label>
									<div class="col-sm-12">
										<div class="input-group colorpicker-component">
											<input type="text" name="" value="#5d9cec" class="form-control" />
											<span class="input-group-addon"><i></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="checkbox c-checkbox needsclick">
									<label class="needsclick">
										<input name="" type="checkbox" value="" class="needsclick">
										<span class="fa fa-check"></span>Не показывать логотип в "шапке" страницы
									</label>
								</div>
							</div>
							<button id="panel-view-save" type="submit" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 btn btn-primary pull-right" disabled>Сохранить</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- SETTING PARTICIPANTS POSITIONS -->
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading panel-title" style="font-size: 1.2em"><a data-toggle="collapse" data-parent="#accordion" href="#partposition" aria-expanded="true" aria-controls="partposition" id="part-position">Настройка порядка выступления участников</a></div>
				<div id="partposition" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in">
					<div class="panel-body">
						<form id="setting-rating-area" action="#">
								<div id="sortable">
									<input type="hidden" id="id_event" value="<?=$event['id']; ?>">
									<?php for($i = 0; $i < count($stages); $i++) : ?>
										<h3><?=$stages[$i]['name']; ?></h3>

										<div>
											<?php

											$criterias = Model_Stages::getCriteriasByStageId($stages[$i]['id']);

											try {
												$criteria = Arr::get($criterias, '0');
												$maxscore = $criteria['maxscore'];

											} catch (Exception $e) {
												echo $e->getMessage();
												echo Debug::vars($stage[$i]['id']);
												return ;
											}

											?>
											<div class="col-md-12 ">
												<div class="alert description">
													<p><?=$criteria['name']; ?></p>
												</div>
											</div>

											<div id="stage <?=$i. ' ' . $stages[$i]['id']; ?>" data-toggle="portlet" class="portlets-wrapper">
												<?php for($k = 0; $k < count($participants[$i]); $k++): ?>

													<div id="participant-id <?=$participants[$i][$k]['id']; ?>" class="panel panel-primary">
														<div class="panel-heading portlet-handler">
														</div>

														<div class="panel-wrapper">
															<div class="panel-body">
																<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 text-center">
																	<img src="<?=URL::base(). 'uploads/'. $participants[$i][$k]['photo']; ?>" class="pronwe_boxShadow pronwe_border-1px participant">
																</div>
																<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
																	<h2><?=$participants[$i][$k]['name']; ?></h2>

																	<div class="buttons" data-toggle="buttons">
																		<?php for($l = 0; $l <= $maxscore; $l++) : ?>
																			<button class="mb-sm btn btn-s btn-primary">
																				<input type="radio"> <?=$l; ?>
																			</button>
																		<?php endfor; ?>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php endfor; ?>
											</div>
										</div>
									<?php endfor; ?>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>