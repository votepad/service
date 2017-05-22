var newOrgEvent = function (newOrgEvent) {

    var newSubstance    = null,
        sectionsNumber  = null,
        sections        = null,
        btnPrev         = null,
        btnNext         = null,
        translateX      = null,
        btnSubmit       = null,
        progressWrapper = null,
        progress        = null,
        checkURI        = null;


    var prepare_ = function (number) {
        sectionsNumber  = number;
        newSubstance    = document.getElementById('newSubstance');
        sections        = document.getElementsByClassName('form__wrapper');
        btnPrev         = document.getElementById('btnPrev');
        btnNext         = document.getElementById('btnNext');
        btnSubmit       = document.getElementById('btnSubmit');
        progressWrapper = document.getElementById('progress');
        checkURI        = document.getElementsByClassName('vp-site__input')[0];

        if (btnPrev)
            btnPrev.addEventListener('click', prevSection_);
        
        if (btnNext)
            btnNext.addEventListener('click', nextSection_);
        
        if (newSubstance)
            newSubstance.addEventListener('submit', submitSubstance_);

        if (checkURI)
            checkURI.addEventListener('keyup', checkURI_);


        translateX = 0;
        progress = 0;
        sections[0].parentNode.style.width = sectionsNumber * 100 + "%";

        var inputs = document.querySelectorAll('[data-section]');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i]   .addEventListener('blur', isElementValid_)
        }

    };
    
    var prevSection_ = function () {
        switchSections_('prev');
    };

    var nextSection_ = function () {
        switchSections_('next');
    };

    var switchSections_ = function(direction) {

        if (! isSectionDone_(Math.abs(translateX/100) + 1)) {
            vp.notification.notify({
                type: 'danger',
                message: "Пожалуйста, заполните все поля"
            });
            return;
        }


        switch (direction) {
            case 'next':
                translateX -= 100;
                break;
            case 'prev':
                translateX += 100;
                break;
        }

        if (translateX < 0 && translateX > -(sectionsNumber - 1)*100 ) {
            btnPrev.classList.remove('hide');
            btnNext.classList.remove('hide');
        } else if (translateX === -(sectionsNumber - 1)*100 ) {
            btnPrev.classList.remove('hide');
            btnNext.classList.add('hide');
        } else if (translateX === 0) {
            btnPrev.classList.add('hide');
            btnNext.classList.remove('hide');
        }

        for (var i = 0; i < sections.length; i++) {
            sections[i].style.transform = 'translateX(' + translateX + '%)';
        }
    };

    var isElementValid_ = function () {
        if (this.name !== 'uri') {
            if (this.value === "") {
                this.classList.add('invalid');
                if (this.dataset.valid === "true") {
                    this.dataset.valid = "false";
                    progress -= parseInt(this.dataset.percent);
                }
            } else {
                this.classList.remove('invalid');
                if (this.dataset.valid === "false") {
                    this.dataset.valid = "true";
                    progress += parseInt(this.dataset.percent);
                }
            }
            updateProgress_();
        }
    };


    var isSectionDone_ = function (section) {
        var is_valid = true,
            inputs = document.querySelectorAll('[data-section="' + section + '"]');

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value === "" || inputs[i].dataset.valid === "false") {
                inputs[i].classList.add('invalid');
                is_valid = false
            }
        }
        return is_valid;
    };

    var updateProgress_ = function () {
        progressWrapper.style.width = progress + "%";

        if (progress >= 80) {
            btnSubmit.classList.remove('hide');
        } else {
            btnSubmit.classList.add('hide');
        }
    };

    var submitSubstance_ = function (e) {
        var is_valid = true,
            inputs = document.querySelectorAll('[data-section]');

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value === "") {
                inputs[i].classList.add('invalid');
                is_valid = false
            } else {
                inputs[i].classList.remove('invalid');
            }
        }

        if (!is_valid) {
            vp.notification.notify({
                type: 'danger',
                message: "Пожалуйста, заполните все поля"
            });
            e.preventDefault();
        }

    };

    var checkURI_ = function () {

        var ajaxData = {
            url: this.dataset.check + this.value,
            type: 'POST',
            success: function (is_invalid) {
                if ( is_invalid === "true") {

                    vp.notification.notify({
                        type: 'danger',
                        message: 'К сожалению, такой адрес занят. Пожалуйста, придумайте другой.',
                        time: 3
                    });

                    checkURI.classList.add('invalid');
                    if (checkURI.dataset.valid === "true") {
                        checkURI.dataset.valid = "false";
                        progress -= parseInt(checkURI.dataset.percent);
                    }
                } else {
                    checkURI.classList.remove('invalid');
                    if (checkURI.dataset.valid === "false") {
                        checkURI.dataset.valid = "true";
                        progress += parseInt(checkURI.dataset.percent);
                    }
                }
                updateProgress_();
            },
            error: function (callback) {
                console.log('Ajax error on checking website', callback);
            }
        };

        vp.ajax.send(ajaxData);
    };


    newOrgEvent.init = function (number) {
        prepare_(number);
    };

    return newOrgEvent;
}({});