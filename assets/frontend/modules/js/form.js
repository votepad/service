module.exports = (function (form) {

    function prepare_() {

        var inputs = document.getElementsByClassName('form-group__input');

        for (var i = 0; i < inputs.length; i++) {

            if (!inputs[i].parentNode.classList.contains('form-group--with-icon')) {

                inputs[i].addEventListener('blur', checkOnEmptyValue_);
                checkOnEmptyValue_(inputs[i]);

            }

        }

    }

    function checkOnEmptyValue_(el) {

        if (el.nodeType !== 1) el = this;

        var label = document.querySelector('[for="' + el.id + '"]');

        if (label && el.placeholder === '') {

            if (el.value === '')
                label.classList.remove('form-group__label--active');

            else
                label.classList.add('form-group__label--active');

        } else {

            label.classList.add('form-group__label--active');

        }

    }

    form.init = function () {

        prepare_();

    };

    return form;

})({});