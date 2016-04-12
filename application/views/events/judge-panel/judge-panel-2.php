<section>
	<div class="content-wrapper">
		<h3>Настройка порядка выступления участников
			<small>Вы можете 
				<a href="">посмотреть, как видят эту страницу жюри.</a>
			</small>
		</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="setting-rating-area" action="#">
					<div>
						<?php for($i = 0; $i < count($stages); $i++) : ?>
							<h3><?=$stages[$i]['name']; ?></h3>

							<div>
								<?php
									$criterias = $criteria->getCriteriasByStageId($stages[$i]['id']);
									$maxscores = $criterias[0]['maxscore'];
								?>
								<div class="col-md-12 ">
									<div class="alert description">
										<p><?=$criterias[0]['name']; ?></p>
									</div>
								</div>

								<div id="stage-<?=$stages[$i]['id']; ?>" data-toggle="portlet" class="portlets-wrapper">
									<?php for($k = 0; $k < count($participants); $k++): ?>

										<div id="participant-id<?=$participants[$k]['id']; ?>" class="panel panel-primary">
											<div class="panel-heading portlet-handler">
											</div>

											<div class="panel-wrapper">
												<div class="panel-body">
													<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 text-center">
														<img src="<?=URL::base(). 'uploads/'. $participants[$k]['photo']; ?>" class="pronwe_boxShadow pronwe_border-1px participant">
													</div>
													<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
														<h2><?=$participants[$k]['name']; ?></h2>

														<div class="buttons" data-toggle="buttons">
															<?php for($l = 0; $l <= $maxscores; $l++) : ?>
																<button class="mb-sm btn btn-primary">
																	<input type="radio" name="score-<?=$stages[$i]['id']; ?>-1" autocomplete="off" value="<?=$l; ?>" checked=""> <?=$l; ?>
																</button>
															<?php endfor; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									<? endfor; ?>
								</div>
							</div>
						<?php endfor; ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>