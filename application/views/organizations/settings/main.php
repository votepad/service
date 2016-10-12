<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" href="<?=$assets; ?>vendor/cropper/dist/cropper.css">
<link rel="stylesheet" href="<?=$assets; ?>css/upload.css">

<div class="columns-area">
	<div class="block block-default">
		<div id="topmenu" class="block-heading tabs">
				<?=$topmenu; ?>
		</div>
		<div class="block-body">
			<form action="<?=URL::site('organization/' . $organization->id . '/update'); ?>" method="POST" id="update_main_info">
				<div class="col-xs-12 col-md-6">
					<div class="input-field">
						<input type="text" id="org_name" name="org_name" class="input-area" length="60" autocomplete="off" value="<?=$organization->name; ?>">
						<label for="org_name" class="input-label active">Название организации</label>
					</div>
					<div class="input-field">
						<input type="text" id="org_site" name="org_site" class="input-area" autocomplete="off" value="<?=$organization->website; ?>" disabled>
						<label for="org_site" class="input-label active">Ссылка на страницу организации</label>
						<span class="help-block">Хотите изменить ссылку на Вашу организацию?<a id="open_feedback" class="link underlinehover">Напишите нам</a></span>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="input-field">
						<input type="text" id="official_org_site" name="official_org_site" class="input-area" autocomplete="off" value="<?=$organization->website; ?>">
						<label for="official_org_site" class="input-label active">Ссылка на официальный сайт</label>
					</div>
					<button type="submit" class="btn btn-md btn-labeled btn-success pull-left col-xs-12 col-lg-5">
						<span class="btn-text">Обновить</span>
						<span class="btn-icon"><i class="fa fa-check"></i></span>
					</button>
					<button type="button" id="remove_organization" class="btn btn-md btn-labeled btn-danger pull-right col-xs-12 col-lg-5 col-lg-offset-2">
						<span class="btn-text">Удалить организацию</span>
						<span class="btn-icon"><i class="fa fa-times"></i></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-settings-main.js"></script>
<script>
	$(document).ready(function() {

		'use strict';

        $('#remove_organization').click(function(){

            if (!confirm('Вы уверены что хотите удалить организацию?'))
                return;

            /**
             * Prepare data before sending
             */
            var data = {

                url     : "<?=URL::site('organization/' . $organization->id . '/delete'); ?>",

                type    : 'POST',

                data    : {

                    id_organization : <?=$organization->id; ?>

                },

                beforeSend  : function(callback) {},

                success     : function(callback) {
                    console.log(callback);
                },

                error       : function(callback) {
                    console.log(callback);
                }
            };

            /**
             * Send ajax request
             */
            $.ajax(data);

        });


	});
</script>
