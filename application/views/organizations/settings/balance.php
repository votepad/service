<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" href="<?=$assets; ?>vendor/datatables/dist/css/dataTables.bootstrap.min.css">

<div class="columns-area">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-tabs">
				<a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/main'); ?>">
					Организация
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/team'); ?>">
					Команда
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/logs'); ?>">
					Активности
					<div class="active-link"></div>
				</a>
				<a class="md-btn active" href="<?=URL::site('organization/' . $id . '/settings/balance'); ?>">
					Оплата услуг
					<div class="active-link"></div>
				</a>
			</div>
		</div>
		<div class="panel-body">
			<a href="" class="md-btn md-btn-md md-btn-success linktopaymentpage">Произвести оплату</a>
			<div class="sale">
				Текущая скидка организации: <b>2%</b>
				<a href="">Как увеличить скидку?</a>
			</div>
			<table id="curent_payments_application" class="table table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="sorting">Пользователь</th>
						<th class="sorting">Мероприятие</th>
						<th class="no-sort">Сумма, руб</th>
						<th class="no-sort">Скидка, %</th>
						<th class="sorting">Дата создания</th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Туров Николай</td>
						<td>Федеральный конкурс Ты Нужен Людям</td>
						<td>10000</td>
						<td>5</td>
						<td>14.08.2016</td>
					</tr>
					<tr>
						<td>Николай</td>
						<td>Мисс ИТМО</td>
						<td>80000</td>
						<td>7</td>
						<td>10.08.2016</td>
					</tr>
				</tbody>
			</table>

			<table id="history_of_payments" class="table table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="sorting">Пользователь</th>
						<th class="sorting">Мероприятие</th>
						<th class="no-sort">Сумма, руб</th>
						<th class="no-sort">Скидка, %</th>
						<th class="sorting">Дата оплаты</th>
						<th class="sorting">Статус</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Туров Николай</td>
						<td>Федеральный конкурс Ты Нужен Людям</td>
						<td>10000</td>
						<td>5</td>
						<td>15.08.2016</td>
						<td>Успешно</td>
					</tr>
					<tr>
						<td>Туров Николай</td>
						<td>Мисс ИТМО</td>
						<td>80000</td>
						<td>7</td>
						<td>10.08.2016</td>
						<td>В обработке</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/dist/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-settings-balance.js"></script>
