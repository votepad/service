var radioboxes = function (radioboxes) {

    var ToggleEvent = new window.CustomEvent('toggle'),

        CLASSES     = {
            wrapper: 'vp-radiobox',
            checked: 'vp-radiobox--checked',
            defaultRadiobox: 'vp-default-radiobox--hidden'
         },

        NAMES       = {
            radiobox: 'vp-custom-radiobox',
            defaultInput: 'vp-custom-radiobox'
        },


        currentRadio = null,
        currentInput = null;


    var prepareRadioBox = function (wrapper) {

        var input       = document.createElement('INPUT'),
            firstChild  = wrapper.firstChild;

        input.type  = 'radio';
        input.name  = wrapper.dataset.name || NAMES.defaultInput;
        input.value = wrapper.dataset.value;
        input.checked = false;
        input.classList.add(CLASSES.defaultRadiobox);

        wrapper.classList.add(CLASSES.wrapper);
        wrapper.appendChild(input);
        wrapper.addEventListener('click', clicked);


        if (wrapper.dataset.checked) {
            input.checked = true;

            wrapper.classList.add(CLASSES.checked);
        }

    };

    var clicked = function () {

        var wrapper = this,
            input = wrapper.querySelector('input');

        if (currentRadio == wrapper){
            currentRadio = null;
            currentInput = null;
        }


        if ( currentRadio != null ){
            if ( currentInput.checked == true ) {
                currentRadio.classList.toggle(CLASSES.checked);
                currentInput.checked = false;

                ToggleEvent.checked = false;

                currentRadio.dispatchEvent(ToggleEvent);
            }
        }

        wrapper.classList.toggle(CLASSES.checked);

        input.checked = !input.checked;

        ToggleEvent.checked = input.checked;

        wrapper.dispatchEvent(ToggleEvent);

        currentRadio = wrapper;

        currentInput = input;
    };


    var initial = function () {
        Array.prototype.forEach.call(radioboxes, prepareRadioBox);
    };

    return{
        initial: initial
    };
};

var radioElem = function () {

    var init = function () {
        for (i = 1; i <= 2; i++) {
            blok = new radioboxes(document.querySelectorAll('span[data-name=vp-radiobox-' + i + ']'));
            blok.initial();
        }
    };

    return{
        init: init
    };


}();
