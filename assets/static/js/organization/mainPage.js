/**
 * Created by khaydarovm on 11.04.17.
 */

$(document).ready( function() {

    var callbacks_ = {

        holder : null,

        beforeSend : function (holder) {

            var fileReader = new FileReader(),
                input = vp.transport.getInput(),
                file = input.files[0];

            callbacks_.holder = holder;

            fileReader.readAsDataURL(file);

            fileReader.onload = function(event) {

                callbacks_.holder.classList.add('jumbotron--loading');
                callbacks_.holder.src = event.target.result;

            }

        },

        success : function (response) {

            var result = JSON.parse(response);
            if ( result.success ) {

                callbacks_.holder.src = result.data.url;
                callbacks_.holder.classList.remove('jumbotron--loading');

            }

        },

        error : function () {


        }

    };

    $('#jumbotron_org-cover-edit').click( function () {

        var self = this,
            imgTag = $('#org-background-uploaded')[0];

        vp.transport.init({
            url : '/transport/4',
            params : {
                id : +self.dataset.pk
            },
            multiple : false,
            accept: '*',
            beforeSend : callbacks_.beforeSend.bind(self, imgTag),
            success : callbacks_.success,
            error : callbacks_.error
        });

    });

    $('.jumbotron_org-avatar-edit').click( function () {

        var self = this,
            imgTag = $('#jumbotron_org-avatar-uploaded')[0];

        vp.transport.init({
            url : '/transport/3',
            params : {
                id : +self.dataset.pk
            },
            multiple : false,
            accept: '*',
            beforeSend : callbacks_.beforeSend.bind(self, imgTag),
            success : callbacks_.success,
            error : callbacks_.error
        });

    });

});
