<section>
	<div class="content-wrapper">
		<h3>Настройка порядка выступления участников
			<small>Вы можете
				<a href="">посмотреть, как видят эту страницу жюри.</a>
			</small>
		</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="setting-rating-area-2" action="#">
					<div>
						<?php for($i = 0; $i < count($stages); $i++) : ?>
						<h3><?=$stages[$i]['name'] ; ?></h3>
						<div>
							<div class="col-xs-12 btn_area1">
								<div class="col-lg-10 col-md-9 col-sm-8 alert description">
									<p><?=$stages[$i]['description']; ?></p>
								</div>
							</div>
							<div id="stage-<?=$stages[$i]['id']; ?>" data-toggle="portlet" class="portlets-wrapper">
								<div class="col-lg-4 col-md-5">
									<ul role="tablist" class="text-center nav nav-s">
										<?php for($j = 0; $j < count($participants); $j++): ?>
											<li id="part-id<?=$participants[$j]['id'] ;?>" role="presentation" class="btn btn-default btn_area1 active">
												<a href="#stage-1-part-id<?=$participants[$j]['id']; ?>" aria-controls="stage-1-part-id<?=$participants[$j]['id']; ?>" role="tab" data-toggle="tab"><?=$participants[$j]['name']; ?></a>
											</li>
										<?php endfor; ?>
									</ul>
								</div>

								<div class="tab-content col-lg-offset-4 col-md-offset-5">
									<?php for($j = 0; $j < count($participants); $j++) : ?>
									<!--participant 1-->
									<div id="stage-1-part-id1" role="tabpanel" class="tab-pane active">
										<img src="<?=URL::base(). 'uploads/' . $participants[$j]['photo'] ; ?>" alt="" class="pronwe_boxShadow pronwe_border-1px participant img-pos">
										<div class="score-area">
											<!--criterion 1-->
											<?php
													$criterias = $criteria->getCriteriasByStageId($stages[$i]['id']);
													for($k = 0; $k < count($criterias); $k++):
												?>
											<fieldset>
												<div class="btn_area1">
													<?=$criterias[$k]['name']; ?>
												</div>
												<div class="buttons" data-toggle="buttons">
													<?php for($l = 0; $l < $criterias[$k]['maxscore']; $l++): ?>
														<button class="mb-sm btn btn-s btn-primary active">
															<input type="radio" name="score-<?=$i. '-' . $j . '-'. $k; ?>" autocomplete="off" value="<?=$l; ?>" checked=""> <?=$l; ?>
														</button>
													<?php endfor; ?>
												</div>
											</fieldset>
											<?php endfor; ?>
										</div>
									</div>
									<?php endfor; ?>
									<!--participant 2-->
									<div id="stage-1-part-id2" role="tabpanel" class="tab-pane">
										<img src="<?=$assets; ?>img/user/02.jpg" alt="" class="pronwe_boxShadow pronwe_border-1px participant img-pos">
										<div class="score-area">
											<!--criterion 1-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №1 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-2-1" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-1" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-1" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-1" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-1" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-1" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
											<!--criterion 2-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №2 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-2-2" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-2" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-2" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-2" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-2" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-2" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
											<!--criterion 3-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №3 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-2-3" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-3" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-3" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-3" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-3" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-2-3" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
										</div>
									</div>
									<!--participant 3-->
									<div id="stage-1-part-id8" role="tabpanel" class="tab-pane">
										<img src="<?=$assets; ?>img/user/03.jpg" alt="" class="pronwe_boxShadow pronwe_border-1px participant img-pos">
										<div class="score-area">
											<!--criterion 1-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №1 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-3-1" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-1" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-1" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-1" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-1" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-1" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
											<!--criterion 2-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №2 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-3-2" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-2" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-2" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-2" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-2" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-2" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
											<!--criterion 3-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №3 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-3-3" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-3" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-3" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-3" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-3" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-3-3" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
										</div>
									</div>
									<!--participant 4-->
									<div id="stage-1-part-id10" role="tabpanel" class="tab-pane ">
										<img src="<?=$assets; ?>img/user/04.jpg" alt="" class="pronwe_boxShadow pronwe_border-1px participant img-pos">
										<div class="score-area">
											<!--criterion 1-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №1 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-4-1" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-1" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-1" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-1" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-1" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-1" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
											<!--criterion 2-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №2 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-4-2" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-2" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-2" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-2" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-2" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-2" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
											<!--criterion 3-->
											<fieldset>
												<div class="btn_area1">
													Описание критерия №3 за что ставиться балл
												</div>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-s btn-primary active">
														<input type="radio" name="score-1-4-3" autocomplete="off" value="0" checked=""> 0
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-3" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-3" autocomplete="off" value="2"> 2
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-3" autocomplete="off" value="3"> 3
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-3" autocomplete="off" value="4"> 4
													</button>
													<button class="mb-sm btn btn-s btn-primary">
														<input type="radio" name="score-1-4-3" autocomplete="off" value="5"> 5
													</button>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endfor; ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>