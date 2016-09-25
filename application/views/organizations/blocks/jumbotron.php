<div class="edit-org-back">
  <i class="fa fa-camera" aria-hidden="true"></i>
  <a id="edit_org_back" href="#" role="button">Обновить фото обложки</a>
</div>
<div class="org-avatar">
    <img id="org-avatar-uploaded" src="/uploads/organizations/m_<?=$organization->logo; ?>">
    <div class="edit-org-avatar">
      <i class="fa fa-camera" aria-hidden="true"></i>
      <a id="edit_org_avatar" href="#" role="button">Обновить логотип организации</a>
    </div>
</div>
<div class="org-name-background"></div>
<div class="org-name">
    <h2>
        <?=$organization->name; ?>
        <a href="http://<?=$organization->website; ?>" class="inline" data-toggle="tooltip" data-placement="top" title="Официальный сайт">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    </h2>
</div>

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
                    el = $('#org-background-uploaded');

                $.ajax({
                    url  : "/organization/<?=$organization->id; ?>/update_with_ajax",
                    type : "POST",
                    data : {
                        field : 'cover',
                        value : image
                    },
                    beforeSend : function() {
                        el.css('opacity', '.3');
                    },
                    success : function(result) {
                        el.css('background-image', "url(http://pronwe.local/uploads/organizations/o_"+image+")");
                        el.css('background-size', '100% 100%');
                        el.css('opacity', '1');
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
