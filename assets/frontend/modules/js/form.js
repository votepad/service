module.exports = (function (form) {

    function prepare_() {

        var inputs   = document.getElementsByClassName('form-group__input'),
            textarea = document.getElementsByClassName('form-group__textarea');

        for (var i = 0; i < inputs.length; i++) {

            if (!inputs[i].parentNode.classList.contains('form-group--with-icon') && inputs[i].parentNode.getElementsByClassName('form-group__label')[0]) {

                inputs[i].addEventListener('blur', checkOnEmptyValue_);
                checkOnEmptyValue_(inputs[i]);

                if(inputs[i].hasAttribute('maxlength')) {

                    var counter = vp.draw.node('SPAN', 'form-group__counter');

                    counter.innerHTML = '0/' + inputs[i].getAttribute('maxlength');
                    inputs[i].parentNode.appendChild(counter);
                    inputs[i].addEventListener('keyup', updateCounter_);
                    updateCounter_(inputs[i]);

                }

            }

        }

        for (var i = 0; i < textarea.length; i++) {

            textarea[i].addEventListener('blur', checkOnEmptyValue_);
            checkOnEmptyValue_(textarea[i]);

            textarea[i].addEventListener('keyup', resizeTextareaHeight_);
            resizeTextareaHeight_(textarea[i]);

            if(textarea[i].hasAttribute('maxlength')) {

                var counter = vp.draw.node('SPAN', 'form-group__counter');

                counter.innerHTML = '0/' + textarea[i].getAttribute('maxlength');
                textarea[i].parentNode.appendChild(counter);
                textarea[i].addEventListener('keyup', updateCounter_);
                updateCounter_(textarea[i]);

            }

        }

    }


    function resizeTextareaHeight_(element) {

        if (element.nodeType !== 1) element = this;

        window.setTimeout(function () {

            element.style.height = 'auto';
            element.style.height = element.scrollHeight + 'px';

        }, 0);

    }


    function updateCounter_(el) {

        if (el.nodeType !== 1) el = this;

        var counter = el.parentNode.getElementsByClassName('form-group__counter')[0];

        el.style.paddingRight =  parseInt(counter.offsetWidth + 5) + 'px';
        el.style.width =  'calc(100% - ' + parseInt(counter.offsetWidth + 5) + 'px)';
        counter.innerHTML = el.value.length + '/' + el.getAttribute('maxlength');

    }

    function checkOnEmptyValue_(el) {

        if (el.nodeType !== 1) el = this;

        var label = document.querySelector('[for="' + el.id + '"]');

        if (label && el.placeholder === '') {

            if (el.value === '' && el.type !== 'datetime-local')
                label.classList.remove('form-group__label--active');

            else
                label.classList.add('form-group__label--active');

        } else {

            label.classList.add('form-group__label--active');

        }

    }



    var validateForm_ = function (formBlock) {

        var inputs   = formBlock.getElementsByClassName('form-group__input'),
            textarea = formBlock.getElementsByClassName('form-group__textarea'),
            isValid  = true;

        for (var i = 0; i < inputs.length; i++) {

            if (inputs[i].value === '') {

                inputs[i].classList.add('form-group__input--invalid');
                if (inputs[i].parentNode.classList.contains('choices__inner'))
                    inputs[i].parentNode.classList.add('choices__inner--invalid');
                isValid = false;

            } else {

                inputs[i].classList.remove('form-group__input--invalid');
                if (inputs[i].parentNode.classList.contains('choices__inner'))
                    inputs[i].parentNode.classList.remove('choices__inner--invalid');

            }

        }

        for (var i = 0; i < textarea.length; i++) {

            if (textarea[i].value === '') {

                textarea[i].classList.add('form-group__textarea--invalid');
                isValid = false;

            } else {

                textarea[i].classList.remove('form-group__textarea--invalid');

            }

        }

        return isValid;

    };

    form.initInput = function (input) {

        input = document.getElementById(input);

        if (!input) {

            vp.core.log('Could not initialize input', 'error', 'VP form');
            return;

        }

        if (!input.parentNode.classList.contains('form-group--with-icon') &&
                input.parentNode.getElementsByClassName('form-group__label')[0]) {

            input.addEventListener('blur', checkOnEmptyValue_);
            checkOnEmptyValue_(input);

            if(input.hasAttribute('maxlength')) {

                var counter = vp.draw.node('SPAN', 'form-group__counter');

                counter.innerHTML = '0/' + input.getAttribute('maxlength');
                input.parentNode.appendChild(counter);
                input.addEventListener('keyup', updateCounter_);
                updateCounter_(input);

            }

        }


    };

    /**
     * Add Class Loading to element
     * @param element - ELEMENT_NODE
     */
    form.addLoadingClass = function (element) {

        var block = null;

        if (element.nodeType === 1) {

            block = element;

        } else {

            vp.core.log('Could not catch element', 'error', 'VP form');
            return;

        }

        if (block.classList.contains('modal')) {

            block = block.getElementsByClassName('modal__wrapper')[0];

        }

        if (!block) {

            vp.core.log('Could not catch element', 'error', 'VP form');
            return;

        }

        block.classList.add('loading');

    };



    /**
     * Add Class Loading to element
     * @param element - ELEMENT_NODE
     */
    form.removeLoadingClass = function (element) {

        var block = null;

        if (element.nodeType === 1) {

            block = element;

        } else {

            vp.core.log('Could not catch element', 'error', 'VP form');
            return;

        }

        if (block.classList.contains('modal')) {

            block = block.getElementsByClassName('modal__wrapper')[0];

        }

        if (!block) {

            vp.core.log('Could not catch element', 'error', 'VP form');
            return;

        }

        block.classList.remove('loading');

    };


    form.initTextarea = function (textarea) {

        textarea = document.getElementById(textarea);

        if (!textarea) {

            vp.core.log('Could not initialize textarea', 'error', 'VP form');
            return;

        }

        textarea.addEventListener('blur', checkOnEmptyValue_);
        checkOnEmptyValue_(textarea);

        textarea.addEventListener('keyup', resizeTextareaHeight_);
        resizeTextareaHeight_(textarea);

        if(textarea.hasAttribute('maxlength')) {

            var counter = vp.draw.node('SPAN', 'form-group__counter');

            counter.innerHTML = '0/' + textarea.getAttribute('maxlength');
            textarea.parentNode.appendChild(counter);
            textarea.addEventListener('keyup', updateCounter_);
            updateCounter_(textarea);

        }

    };


    form.validate = function (formBlock) {

        return validateForm_(formBlock);

    };


    form.init = function () {

        prepare_();

    };

    return form;

})({});