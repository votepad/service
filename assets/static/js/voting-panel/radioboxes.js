var radioboxes = function (name) {

    var ToggleEvent = new CustomEvent('toggle');

    var CLASSES = {
            wrapper: 'vp-radiobox',
            checked: 'vp-radiobox--checked',
            defaultRadiobox: 'vp-default-radiobox--hidden'
         },

        NAMES = {
            radiobox: 'vp-custom-radiobox',
            defaultInput: 'vp-custom-radiobox'
        },

        currentRadio = null;

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
            wrapper.classList.add(CLASSES.checked);
            input.checked = true;
            currentRadio = wrapper;
        }

    };

    var clicked = function () {

        var radio = this,
            input = radio.querySelector('input');

        if (currentRadio) currentRadio.classList.remove(CLASSES.checked);
        currentRadio = radio;
        currentRadio.classList.add(CLASSES.checked);

        input.checked = true;

        ToggleEvent.value = input.value;
        radio.dispatchEvent(ToggleEvent);

    };


    var init = function (name) {

        var radios = document.getElementsByName(name);
        Array.prototype.forEach.call(radios, prepareRadioBox);

    };

    init(name)

};