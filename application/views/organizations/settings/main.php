<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.css">

<h3 class="page-header">
	Изменение основной информации об организации
</h3>

<div class="row">
	<form class="form" action="<?=URL::site('organization/' . $organization->id . '/update'); ?>" method="POST" id="update_main_info">
		<div class="form_body">
			<div class="col-xs-12">
				<div class="row row-col">
					<div class="input-field col-xs-12 col-md-6">
						<input type="text" id="org_name" name="org_name" length="60" value="<?=$organization->name; ?>">
						<label for="org_name" class="input-label active">Название организации</label>
					</div>
					<div class="input-field col-xs-12 col-md-6">
						<input type="text" id="org_site" disabled value="<?=$organization->uri; ?>">
						<label for="org_site" class="input-label active">Ссылка на страницу организации</label>
						<span class="help-block">Хотите изменить ссылку на Вашу организацию? <a id="openChangeSiteModal" class="underlinehover" style="color: #bbb">Напишите нам</a></span>
					</div>
				</div>
				<div class="row row-col">
					<div class="input-field col-xs-12 col-md-6">
						<textarea id="org_description" name="org_description" length="300"><?=$organization->description; ?></textarea>
						<label for="org_description">Описание организации</label>
						<span class="help-block">Данная информация поможет найти Вашу организацию через поисковые системы.</span>
					</div>
					<div class="input-field col-xs-12 col-md-6">
						<input type="text" id="official_org_site" name="official_org_site" value="<?=$organization->website; ?>">
						<label for="official_org_site" class="input-label active">Ссылка на официальный сайт</label>
					</div>

				</div>
			</div>
		</div>
		<div class="form_submit clear_fix">
			<button type="button" id="submit_btn" class="btn btn_primary col-xs-12 col-md-4 col-lg-3 pull-right">
				Обновить информацию
			</button>
			<button type="button" id="remove_organization" class="btn btn_default col-xs-12 col-md-4 col-lg-3">
				Удалить организацию
			</button>
		</div>
	</form>
</div>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organization/settings-maininfo.js"></script>
<script>
	$(document).ready(function() {

		'use strict';

		/**
	    * Delete Organization
	    */
	    $('#remove_organization').click(function(){

			swal({
				text: "Вы уверены что хотите удалить организацию?",
				showCancelButton: true,
				confirmButtonText: 'Удалить!',
				cancelButtonText: 'Отмена!',
				confirmButtonClass: 'btn btn_primary',
				cancelButtonClass: 'btn btn_default',
				buttonsStyling: false
			}).then(function () {

				/**
		         * Send ajax request for deleted
		         */
		         $.ajax({
		             url: "<?=URL::site('organization/' . $organization->id . '/delete'); ?>",
		             type: 'POST',
		             data: {
		                 id : <?=$organization->id; ?>
		             },
		             beforeSend: function(callback) {

		             },
		             success: function(response) {

		                 response = JSON.parse(response);

		                 if (response.code != '40') {
		                     return;
                         }

                         var host        = window.location.host,
                             protocol    = window.location.protocol;

                         window.location.replace(protocol+'//'+host+'/user/'+<?= $user->id; ?>);
		             },
		             error: function(callback) {
		                 console.log(callback);
		             }
				 });

				 $.notify({
                    message: 'Организация удалена!'
                },{
                    type: 'success'
                });
			})


	     });

	});
</script>
