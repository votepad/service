<!DOCTYPE html>
<html lang="ru">


<head>
<meta charset="utf-8">

	<? foreach($css as $styles): ?>
		<link rel="stylesheet" href="<?=$assets;?><?=$styles;?>">
	<? endforeach;?>

	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

	<!-- =============== VENDOR SCRIPTS ===============-->
	<? foreach ($js as $scripts): ?>
		<script src="<?=$assets.$scripts; ?>"></script>
	<? endforeach; ?>

</head>
<body>
	<div class="content-wrapper">
		<div class="content-heading">
			<div class="col-sm-4 col-md-3 hidden-xs">
				<img src="img/temp/vesnavitmo.jpg" alt="EventImage" class="img-thumbnail img-circle">
			</div>
			<div class="col-sm-8 col-md-9 text-white text-left orgName">
				<h1>Название мероприятия</h1>
			</div>
			<a href="#" class="btn-logout">
				<em class="fa fa-sign-out logout-position"></em>
			</a>
		</div>
		<div class="col-xs-10 col-xs-offset-1">
			<div class="panel panel-default">
				<div class="panel-body">
					<form id="rating-area" action="#">
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
										<div class="panel-wrapper">
											<div class="panel-body">
												<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-center">
													<img src="img/temp/vesnavitmo.jpg" alt="Participant1" class="pronwe_boxShadow pronwe_border-1px participant">
												</div>
												<div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
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
										<div class="panel-wrapper">
											<div class="panel-body">
												<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-center">
													<img src="img/temp/vesnavitmo.jpg" alt="Participant1" class="pronwe_boxShadow pronwe_border-1px participant">
												</div>
												<div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
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
										<div class="panel-wrapper">
											<div class="panel-body">
												<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-center">
													<img src="img/temp/vesnavitmo.jpg" alt="Participant1" class="pronwe_boxShadow pronwe_border-1px participant">
												</div>
												<div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
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
							</div>

							<!-- и так далее -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<button id="errorMsg" type="button" data-notify="" data-message="Вы забыли поставить балл участнику" data-options="{&quot;status&quot;:&quot;danger&quot;}" style="display: none;"></button>
</body>
</html>