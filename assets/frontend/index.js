/**
 * @copyright Khaydarov Murod
 */

var nwe = (function(nwe) {

    nwe.init = function() {

        Promise.resolve()

            .then(nwe.ui.make.input)

            .catch(function() {
                console.log('something gone');
            });

    };


})({});

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

