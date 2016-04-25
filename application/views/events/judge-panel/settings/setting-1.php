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
						<form id="setting-rating-area-2" action="#">
							<div>
								<input type="hidden" id="id_event" value="<?=$event['id']; ?>">
								<?php for($i = 0; $i < count($stages); $i++) : ?>
								<h3><?=$stages[$i]['name'] ; ?></h3>
								<div>
									<div class="col-xs-12 btn_area1">
										<div class="col-lg-10 col-md-9 col-sm-8 alert description">
											<p><?=$stages[$i]['description']; ?></p>
										</div>
									</div>
									<div id="stage <?=$i. ' ' . $stages[$i]['id']; ?>" data-toggle="portlet" class="portlets-wrapper">
										<div class="col-lg-4 col-md-5">
											<ul role="tablist" class="text-center nav nav-s">
												<?php for($j = 0; $j < count($participants[$i]); $j++): ?>
													<li id="part <?=$participants[$i][$j]['id'] ;?>" role="presentation" class="btn btn-default btn_area1 ">
														<a href="#stage-<?=$i; ?>-part-<?=$j; ?>" aria-controls="stage-<?=$i; ?>-part-<?=$j; ?>" role="tab" data-toggle="tab"><?=$participants[$i][$j]['name']; ?></a>
													</li>
												<?php endfor; ?>
											</ul>
										</div>

										<div class="tab-content col-lg-offset-4 col-md-offset-5">
											<?php for($j = 0; $j < count($participants[$i]); $j++) : ?>
											<div id="stage-<?=$i; ?>-part-<?=$j; ?>" role="tabpanel" class="tab-pane ">
												<img src="<?=URL::base(). 'uploads/' . $participants[$i][$j]['photo'] ; ?>" alt="" class="pronwe_boxShadow pronwe_border-1px participant img-pos">
												<div class="score-area">
														<?php
																$criterias = Model_Stages::getCriteriasByStageId($stages[$i]['id']);
																for($k = 0; $k < count($criterias); $k++):
															?>
													<fieldset>
														<div class="btn_area1">
															<?=$criterias[$k]['name']; ?>
														</div>
														<div class="buttons" data-toggle="buttons">
															<?php for($l = 1; $l <= $criterias[$k]['maxscore']; $l++): ?>
																<button class="mb-sm btn btn-s btn-primary">
																	<input type="radio" autocomplete="off"> <?=$l; ?>
																</button>
															<?php endfor; ?>
														</div>
													</fieldset>
													<?php endfor; ?>
												</div>
											</div>
											<?php endfor; ?>
										</div>
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