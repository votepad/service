<div class="columns-area">
	<div class="block block-default">
		<div id="topmenu" class="block-heading tabs">
				<?=$topmenu; ?>
		</div>
		<div class="block-body">
			<form action="<?=URL::site('organization/' . $organization->id . '/update'); ?>" method="POST" id="update_main_info">
				<div class="col-xs-12 col-md-6">
					<div class="input-field">
						<input type="text" id="org_name" name="org_name" class="input-area" autocomplete="off" length="60" value="<?=$organization->name; ?>">
						<label for="org_name" class="input-label active">Название организации</label>
					</div>
					<div class="input-field">
						<div type="text" id="org_site" class="input-area" disabled style="line-height: 2em"><?=$organization->website; ?></div>
						<label for="org_site" class="input-label active">Ссылка на страницу организации</label>
						<span class="help-block">Хотите изменить ссылку на Вашу организацию?<a id="open_feedback" class="link underlinehover">Напишите нам</a></span>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="input-field">
						<input type="text" id="official_org_site" name="official_org_site" class="input-area" autocomplete="off" value="<?=$organization->officialSite; ?>">
						<label for="official_org_site" class="input-label active">Ссылка на официальный сайт</label>
					</div>
					<div class="col-xs-12 col-md-5 col-lg-5 pad0">
						<button type="button" id="submit_btn" class="btn btn-md btn-labeled btn-success col-xs-12 col-md-auto">
							<span class="btn-text">Обновить</span>
							<span class="btn-icon"><i class="fa fa-check" aria-hidden="true"></i></span>
						</button>
					</div>
					<div class="col-xs-12 col-md-7 col-lg-5 col-lg-offset-2 pad0">
						<button type="button" id="remove_organization" class="btn btn-md btn-labeled btn-danger col-xs-12 col-md-auto" style="float:right">
							<span class="btn-text">Удалить организацию</span>
							<span class="btn-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- =============== PAGE SCRIPTS ===============-->
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
