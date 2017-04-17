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
            if (currentInput != input) {
                currentRadio.classList.remove(CLASSES.checked);
            }
        }

        wrapper.classList.add(CLASSES.checked);

        currentRadio = wrapper;

        currentInput = input;
    };


    var initial = function () {
        console.log(radioboxes);
        Array.prototype.forEach.call(radioboxes, prepareRadioBox);
    };

    initial();
};

var radioElem = function () {

    var init = function () {

        var radiboxes = document.getElementsByName('vp-custom-radiobox');
        var radibox = {};


        for (i = 0; i < radiboxes.length; i++){
            if (radibox[radiboxes[i].dataset.name] == null) {

                radibox[radiboxes[i].dataset.name] = [];
            }

            radibox[radiboxes[i].dataset.name].push(radiboxes[i]);
        }

        for (var dataName in radibox) {

            blok = new radioboxes(radibox[dataName]);
        }
    };

    return{
        init: init
    };


}();
