<?
    $isLogged = Dispatch::isLogged();
    $owner    = Model_PrivillegedUser::getUserOrganization(Session::instance()->get('id_user')) == $organization->id;
    $allowed = $isLogged && $owner;
?>

<div class="parallax-container org-background">
  <div class="parallax">
    <img id="org-background-uploaded" src="/uploads/organizations/o_<?=$organization->cover; ?>">
  </div>
    <? if ($allowed) : ?>
    <div class="edit-org-back">
      <a id="edit_org_back" href="#" role="button">
        <i class="fa fa-camera" aria-hidden="true"></i>
        <span>Обновить фото обложки</span>
      </a>
    </div>
    <? endif; ?>
<div class="org-avatar">
    <img id="org-avatar-uploaded" src="/uploads/organizations/m_<?=$organization->logo; ?>">
    <? if ($allowed) : ?>
    <div class="edit-org-avatar">
	<a id="edit_org_avatar" href="#" role="button">
      <i class="fa fa-camera" aria-hidden="true"></i>
	  <span>Обновить логотип организации</span>
	</a>
    </div>
    <? endif; ?>
</div>
<div class="org-name-background"></div>
<div class="org-name">
    <h2>
        <?=$organization->name; ?>
        <a href="http://<?=$organization->officialSite; ?>" class="inline" data-toggle="tooltip" data-placement="top" title="Официальный сайт">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    </h2>
</div>
</div>
<? if ($allowed): ?>
<script>

    var nwe = (function(nwe) {

        nwe.init = function() {

            Promise.resolve()

                .then(nwe.ui.make.input)

                .catch(function() {
                    console.log('something gone');
                });

        };

        nwe.ajax = function(params) {

            var xhr = new XMLHttpRequest(),
                success = typeof params.success == 'function' ? params.success : function(){},
                error   = typeof params.error   == 'function' ? params.error   : function(){};

            xhr.open('POST', '/transport/', true);

            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    success(xhr.responseText);
                } else {
                    console.log("request error: %o", xhr);
                }
            };

            xhr.send(params.data);

        };

        return nwe;

    })({});

    nwe.ui = {

        /** Input where file will be keeped */
        input : null,

        /**
         * Makes UI elements
         */
        make : {

            input : function() {

                var input = document.createElement('input');
                input.type = 'file';

                input.addEventListener('change', nwe.file.uploaded, false);

                nwe.ui.input = input;
            }
        }

    };

    nwe.file = {

        /**
         * XMLHTTPRequest callbacks
         */
        callbacks : null,

        /** Uploaded callback */
        uploaded : function() {

            var input    = nwe.ui.input,
                files    = input.files,
                formData = new FormData();

            formData.append('files', files[0], files[0].name);

            nwe.ajax({
                data    : formData,
                success : nwe.file.callbacks.success,
                error   : nwe.file.callbacks.error
            });
        },

        /** When button is clicked */
        selectAndUpload : function(params) {
            nwe.ui.input.click();
            nwe.file.callbacks = params;
        }

    };


    nwe.init();


    /**
     * Upload organization logo
     */
    $('#edit_org_avatar').click(function() {

        var params = {

            success : function(callback) {

                var file = JSON.parse(callback),
                    image   = file.filename,
                    el = document.getElementById('org-avatar-uploaded');

                $.ajax({
                    url  : "/organization/<?=$organization->id; ?>/update_with_ajax",
                    type : "POST",
                    data : {
                        field : 'logo',
                        value : image
                    },
                    beforeSend : function() {
                        el.style.opacity = 0.3;
                    },
                    success : function(result) {
                        el.src = '/uploads/organizations/m_' + image;
                        el.style.opacity = 1;
                    },
                    error : function(result) {
                        console.log('something gone wrong!');
                    }
                });

            },

            error : function(callback) {
                console.log(callback);
            }
        };

        nwe.file.selectAndUpload(params);
    });

    /**
     * Upload or Change organizations cover
     */
    $('#edit_org_back').click(function() {

        var params = {

            success : function(callback) {

                var file = JSON.parse(callback),
                    image   = file.filename,
                    el = document.getElementById('org-background-uploaded');

                $.ajax({
                    url  : "/organization/<?=$organization->id; ?>/update_with_ajax",
                    type : "POST",
                    data : {
                        field : 'cover',
                        value : image
                    },
                    beforeSend : function() {
                        el.style.opacity = 0.3;
                    },
                    success : function(result) {
                        el.src = "/uploads/organizations/o_"+image;
                        el.style.opacity = 1;
                    },
                    error : function(result) {
                        console.log('something gone wrong!');
                    }
                });

            },

            error : function(callback) {
                console.log(callback);
            }
        };

        nwe.file.selectAndUpload(params);

    });

</script>
<? endif; ?>
