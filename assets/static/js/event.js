var myevent = (function (myevent) {

    var corePrefix      = "VP myevent";

    myevent.updateBranding = function (element) {

        var eventBranding = document.getElementById('eventBranding'),
            oldBrandingScr  = eventBranding.src;

        var callbacks_ = {

            beforeSend : function() {

                var fileReader = new FileReader(),
                    input = vp.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function(event) {

                    eventBranding.classList.add('image--loading');
                    eventBranding.src = event.target.result;

                }
            },

            success : function(response) {

                response = JSON.parse(response);

                if (parseInt(response.code) !== 48) {
                    eventBranding.src = oldBrandingScr;
                    vp.notification.notify({
                        type: response.status,
                        message: response.message
                    });
                } else {
                    eventBranding.src = response.url;
                }

                eventBranding.classList.remove('image--loading');
            },

            error : function(response) {

                eventBranding.src = oldBrandingScr;
                vp.core.log('error occur on updating event branding', response.status, corePrefix);

            }

        };

        vp.transport.init({
            url : '/transport/3',
            params : {
                id : + element.dataset.pk
            },
            multiple : false,
            accept: '*',
            beforeSend : callbacks_.beforeSend,
            success : callbacks_.success,
            error : callbacks_.error
        });
    };

    return myevent;

})({});