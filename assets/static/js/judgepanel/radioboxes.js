var radioboxes = function (radioboxes) {

    var CLASSES     = {
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

        var input       = document.createElement('INPUT');

        input.type      = 'radio';
        input.name      = wrapper.dataset.name || NAMES.defaultInput;
        input.value     = wrapper.dataset.value;
        input.checked   = false;
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

        if ( currentRadio != null ){
            if (currentInput.value != input.value) {
                currentRadio.classList.remove(CLASSES.checked);
            }
        }

        wrapper.classList.add(CLASSES.checked);

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

        var radiboxes = document.getElementsByName('vp-custom-radiobox');
        var radibox = new Set();

        for (i = 0; i < radiboxes.length; i++){
            radibox.add(radiboxes[i].dataset.name);
        }

        for (let dataName of radibox) {
            blok = new radioboxes(document.querySelectorAll('span[data-name=' + dataName + ']'));
            blok.initial();
        }
    };

    return{
        init: init
    };


}();
