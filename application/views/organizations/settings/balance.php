<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" href="<?=$assets; ?>vendor/datatables/media/css/dataTables.bootstrap.css">

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
			<table id="curent_payments_application" class="table table-bordered table-hover" cellspacing="0">
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
						<td style="width: 10%">Туров Николай</td>
						<td style="width: 10%">Федеральный конкурс Ты Нужен Людям</td>
						<td style="width: 7.5%">10000</td>
						<td style="width: 7.5%">5</td>
						<td style="width: 10%">14.08.2016</td>
					</tr>
					<tr>
						<td style="width: 10%">Николай</td>
						<td style="width: 10%">Мисс ИТМО</td>
						<td style="width: 7.5%">80000</td>
						<td style="width: 7.5%">7</td>
						<td style="width: 10%">10.08.2016</td>
					</tr>
				</tbody>
			</table>

			<table id="history_of_payments" class="table table-bordered table-hover" cellspacing="0">
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
						<td style="width: 10%">Туров Николай</td>
						<td style="width: 10%">Федеральный конкурс Ты Нужен Людям</td>
						<td style="width: 10%">10000</td>
						<td style="width: 7.5%">5</td>
						<td style="width: 10%">15.08.2016</td>
						<td style="width: 7.5%">Успешно</td>
					</tr>
					<tr>
						<td style="width: 10%">Туров Николай</td>
						<td style="width: 10%">Мисс ИТМО</td>
						<td style="width: 10%">80000</td>
						<td style="width: 7.5%">7</td>
						<td style="width: 10%">10.08.2016</td>
						<td style="width: 7.5%">В обработке</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-settings-balance.js"></script>
