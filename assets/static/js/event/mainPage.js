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

    $('.jumbotron__edit-block').click( function () {

        var self = this,
            imgTag = $('#event-background-uploaded')[0];

        vp.transport.init({
            url : '/transport/5',
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
