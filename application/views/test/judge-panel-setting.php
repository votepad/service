<?php
?>

	<link rel="stylesheet" href="<?=$assets; ?>css/judge.panel.css">
	<script src="<?=$assets; ?>js/judge.panel.js"></script>

	<script src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script src="<?=$assets; ?>vendor/jquery.steps/jquery.steps.js"></script>

	<script src="<?=$assets; ?>vendor/jquery-ui/ui/core.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/widget.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/mouse.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-ui/ui/sortable.js"></script>
	<script src="<?=$assets; ?>vendor/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap.js"></script>
	<script src="<?=$assets; ?>vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
	<script src="<?=$assets; ?>js/app.js"></script>
	
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
						<h3>Название первого этапа</h3>
						<div>
							<div class="col-md-12 ">
								<div class="alert description">
									<p>Выводим название критерия, по которым оцениваются участники</p>
								</div>
							</div>
							<div id="stage-1" data-toggle="portlet" class="portlets-wrapper">
								<div id="partisipant-id1" class="panel panel-primary">
									<div class="panel-heading portlet-handler"></div>
									<div class="panel-wrapper">
										<div class="panel-body">
											<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 text-center">
												<img src="" class="pronwe_boxShadow pronwe_border-1px participant">
											</div>
											<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
												<h2>Имя участника</h2>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-primary active">
														<input type="radio" name="score-1-1" autocomplete="off" value="0" checked=""> 0 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-1" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-1" autocomplete="off" value="2"> 2 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-1" autocomplete="off" value="3"> 3 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-1" autocomplete="off" value="4"> 4 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-1" autocomplete="off" value="5"> 5 
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
		                     	
								<div id="partisipant-id2" class="panel panel-primary">
									<div class="panel-heading portlet-handler"></div>
									<div class="panel-wrapper">
										<div class="panel-body">
											<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 text-center">
												<img src="" class="pronwe_boxShadow pronwe_border-1px participant">
											</div>
											<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
												<h2>Имя участника</h2>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-primary active">
														<input type="radio" name="score-1-2" autocomplete="off" value="0" checked=""> 0 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-2" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-2" autocomplete="off" value="2"> 2 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-2" autocomplete="off" value="3"> 3 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-2" autocomplete="off" value="4"> 4 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-1-2" autocomplete="off" value="5"> 5 
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<h3>Название второго этапа</h3>
						<div>
							<div class="col-md-12 ">
								<div class="alert description">
									<p>Выводим название критерия, по которым оцениваются участники</p>
								</div>
							</div>
							<div id="stage-2" data-toggle="portlet" class="portlets-wrapper">
								<div id="partisipant-id8" class="panel panel-primary">
									<div class="panel-heading portlet-handler"></div>
									<div class="panel-wrapper">
										<div class="panel-body">
											<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 text-center">
												<img src="" class="pronwe_boxShadow pronwe_border-1px participant">
											</div>
											<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
												<h2>Имя участника</h2>
												<div class="buttons" data-toggle="buttons">
													<button class="mb-sm btn btn-primary active">
														<input type="radio" name="score-2-1" autocomplete="off" value="0" checked=""> 0 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-2-1" autocomplete="off" value="1"> 1
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-2-1" autocomplete="off" value="2"> 2 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-2-1" autocomplete="off" value="3"> 3 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-2-1" autocomplete="off" value="4"> 4 
													</button>
													<button class="mb-sm btn btn-primary">
														<input type="radio" name="score-2-1" autocomplete="off" value="5"> 5 
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>

						<!-- и так далее -->
					</div>
				</form>
			</div>
		</div>
	</div>
</section>