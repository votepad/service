<div class="content-wrapper">
	<div class="content-heading">
		<div class="col-sm-4 col-md-3 hidden-xs">
			<img src="<?=URL::base(); ?>uploads/<?=$event['photo']; ?>" alt="EventImage" class="img-thumbnail img-circle">
		</div>
		<div class="col-sm-8 col-md-9 text-white text-left orgName">
			<h1><?=$event['title']; ?></h1>
		</div>
		<a href="<?=URL::site('auth/logout'); ?>" title="Выход" class="btn-logout">
			<em class="fa fa-sign-out logout-position"></em>
		</a>
	</div>
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="rating-area-2" action="#">
					<div>
						<input type="hidden" name="id_event" value="<?=$event['id']; ?>">
						<input type="hidden" name="id_judge" value="<?=Session::instance()->get('id_judge'); ?>">
						<?php for($i = 0; $i < count($stages); $i++) : ?>
						<h3><?=$stages[$i]['name'] ; ?></h3>
						<div>
							<div class="col-xs-12">
								<div class="col-lg-10 col-md-9 col-sm-8 alert description">
									<p><?=$stages[$i]['description']; ?></p>
								</div>
							</div>
							<div id="stage-<?=$i; ?>" data-toggle="portlet" class="portlets-wrapper">
								<input type="hidden" id="<?=$stages[$i]['id']; ?>">
								<div class="col-lg-4 col-md-5">
									<ul role="tablist" class="text-center nav nav-s">
										<?php for($j = 0; $j < count($participants[$i]); $j++): ?>
											<li id="partisipant-id-<?=$j; ?>" role="presentation" class="btn btn-default btn_area1 ">
												<div id="<?=$participants[$i][$j]['id']; ?>"></div>
												<a href="#partisipant-<?=$j; ?>" aria-controls="partisipant-<?=$j; ?>" role="tab" data-toggle="tab"><?=$participants[$i][$j]['name']; ?></a>
											</li>
										<?php endfor; ?>
									</ul>
								</div>

								<div class="tab-content col-lg-offset-4 col-md-offset-5">
									<?php for($j = 0; $j < count($participants[$i]); $j++) : ?>
									<div id="partisipant-<?=$j; ?>" role="tabpanel" class="tab-pane ">
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
													<input type="hidden" name="buttons" value="<?=$j; ?>">
													<?php for($l = 1; $l <= $criterias[$k]['maxscore']; $l++): ?>
														<button class="mb-sm btn btn-s btn-primary">
															<input type="radio" name="score-<?=$i.'-'.$j.'-'.$k; ?>" autocomplete="off" value="<?=$l; ?>"> <?=$l; ?>
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
							<div class="col-md-12 thanks-<?=($i); ?> text-center" style="display: none;">
								<p style="font-size: 1.5em">Проставленные баллы зафиксированны. Дождитесь появления кнопки "Показать участников".</p>
								<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
									<a class="btn btn-primary show-part-<?=($i); ?>" style="display: none;">Показать участников</a>
								</div>
							</div>
							<input type="hidden" id='confirm-step-<?=($i); ?>'>
						</div>
						<?php endfor; ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<button id="errorMsg" type="button" data-notify="" data-message="Вы забыли поставить балл участнику" data-options="{&quot;status&quot;:&quot;danger&quot;}" style="display: none;"></button>