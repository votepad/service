var welcome = (function (welcome) {

    var corePrefix    = "VP welcome",
        moreEventsBtn = null,
        eventsWrapper = null,
        section4      = null,
        csrf          = null;


    welcome.scrollToEvents = function () {
        if (section4) {
            window.scrollTo(0, document.querySelector('.section-4').offsetTop);
        }
    };

    var loadEvents_ = function () {

        var formData = new FormData(),
            offset   = moreEventsBtn.dataset.offset;

        formData.append('csrf', csrf);
        formData.append('offset', offset);

        var ajaxData = {
            url: '/event/get',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                moreEventsBtn.textContent = "Загрузка ...";
                moreEventsBtn.classList.add('btn--disabled');
            },
            success: function(response) {
                response = JSON.parse(response);
                moreEventsBtn.textContent = "Загрузить ещё";
                moreEventsBtn.classList.remove('btn--disabled');

                if (parseInt(response.code) === 513) {

                    moreEventsBtn.dataset.offset = parseInt(offset) + parseInt(response.size);
                    eventsWrapper.innerHTML += response.html;
                    return;

                } else if (parseInt(response.code) === 514) {

                    moreEventsBtn.remove();
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });


                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on loading events','error', corePrefix, response);
                moreEventsBtn.textContent = "Загрузить ещё";
                moreEventsBtn.classList.remove('btn--disabled');
            }
        };

        vp.ajax.send(ajaxData);
    };


    var prepare_ = function () {
        moreEventsBtn = document.getElementById('moreEvents');
        eventsWrapper = document.getElementById('eventsWrapper');

        if (moreEventsBtn && eventsWrapper) {
            moreEventsBtn.addEventListener('click', loadEvents_);
        }

        section4 = document.querySelector('.section-4');

        csrf = document.getElementById('csrf');

        if (csrf) {
            csrf = csrf.value;
        }
    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return welcome;

})({});