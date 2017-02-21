<?
    $isLogged = Dispatch::isLogged();
    $owner    = Model_PrivillegedUser::getUserOrganization(Session::instance()->get('id_user')) == $organization->id;
    $allowed = $isLogged && $owner;
?>


<div class="jumbotron_wrapper parallax-container">
    <div class="parallax jumbotron_cover">
        <img id="org-background-uploaded" src="/uploads/organizations/o_<?=$organization->cover; ?>">
    </div>

    <? if ($allowed) : ?>
    <div class="jumbotron_wrapper_edit">
        <a id="jumbotron_org-cover-edit" role="button" class="jumbotron_wrapper_edit-btn">
            <i class="fa fa-camera jumbotron_wrapper_edit-icon" aria-hidden="true"></i>
            <span class="jumbotron_wrapper_edit-text">Обновить фото обложки</span>
        </a>
    </div>
    <? endif; ?>


    <div class="jumbotron_org-avatar">
        <img id="jumbotron_org-avatar-uploaded" src="/uploads/organizations/m_<?=$organization->logo; ?>">

        <? if ($allowed) : ?>
        <div class="jumbotron_org-avatar-edit">
            <a id="jumbotron_org-avatar-edit" href="#" role="button">
                <i class="fa fa-camera" aria-hidden="true"></i>
                <span>Обновить логотип организации</span>
            </a>
        </div>
        <? endif; ?>
    </div>
    <div class="jumbotron_org-name-background"></div>
    <div class="jumbotron_org-name">
        <h2><?=$organization->name; ?></h2>
        <a href="//<?=$organization->officialSite; ?>" title="Официальный сайт">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
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
    $('#jumbotron_org-avatar-edit').click(function() {

        var params = {

            success : function(callback) {

                $('.jumbotron_org-avatar').addClass('whirl');

                var file = JSON.parse(callback),
                    image   = file.filename,
                    el = document.getElementById('jumbotron_org-avatar-uploaded');

                $.when( $.ajax({
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
                })).then(function(){
                    $('.jumbotron_org-avatar').removeClass('whirl');
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
    $('#jumbotron_org-cover-edit').click(function() {

        var params = {

            success : function(callback) {

                $('.jumbotron_cover').addClass('whirl');

                var file = JSON.parse(callback),
                    image   = file.filename,
                    el = document.getElementById('org-background-uploaded');

                $.when( $.ajax({
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
                })).then(function(){
                    $('.jumbotron_cover').removeClass('whirl');
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
