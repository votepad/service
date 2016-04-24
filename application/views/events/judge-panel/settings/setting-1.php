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
				<div class="panel-heading panel-title" style="font-size: 1.2em"><a data-toggle="collapse" data-parent="#accordion" href="#panelview" aria-expanded="true" aria-controls="panelview" id="panel-view">Настроека внешнего вида панели жюри</a></div>
				<div id="panelview" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse">
					<div class="panel-body">
			
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