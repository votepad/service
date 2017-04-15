var radioboxe = function () {

    var ToggleEvent = new window.CustomEvent('toggle'),

        CLASSES     = {
            wrapper: 'vp-radiobox',
            radiobox: 'vp-radiobox__circle',
            checked: 'vp-radiobox--checked',
            defaultRadiobox: 'vp-default-radiobox--hidden'
         },

        NAMES       = {
            radiobox: 'vp-custom-radiobox',
            defaultInput: 'vp-custom-radiobox'
        };


    var prepareRadioBox = function (wrapper) {

        var input       = document.createElement('INPUT'),
            radiobox    = document.createElement('SPAN'),
            text        = document.createElement('SPAN');
            firstChild  = wrapper.firstChild;


        text.innerText = wrapper.innerHTML;


        input.type  = 'radiobox';
        input.name  = wrapper.dataset.name || NAMES.defaultInput;
        input.value = 1;
        input.classList.add(CLASSES.defaultRadiobox);

        radiobox.classList.add(CLASSES.radiobox);
        radiobox.appendChild(input);
        radiobox.appendChild(text);

        wrapper.innerText = " ";
        wrapper.classList.add(CLASSES.wrapper);
        wrapper.addEventListener('click', clicked);


        if (wrapper.dataset.checked) {
            input.checked = true;

            wrapper.classList.add(CLASSES.checked);
        }

        if (firstChild){

            wrapper.insertBefore(radiobox, firstChild);
        } else {

            wrapper.appendChild(radiobox);
        }

    };

    var clicked = function () {

        var wrapper     = this,
            radiobox    = wrapper.querySelector('.' + CLASSES.radiobox),
            radioboxes  = wrapper.parentNode.querySelectorAll('.' + CLASSES.radiobox),
            input       = radiobox.querySelector('input'),
            inputs      = wrapper.parentNode.querySelectorAll('input');

        var isCheckedInd = -1;

        for (i = 0; i < inputs.length; i++) {
            if (inputs[i].checked) {
                isCheckedInd = i;
                break;
            }
        }

        if (isCheckedInd > -1 && radioboxes[isCheckedInd] != radiobox ){
            radioboxes[isCheckedInd].classList.toggle(CLASSES.checked);
            inputs[isCheckedInd].checked = false;

            ToggleEvent.checked = inputs[isCheckedInd].checked;

            radioboxes[isCheckedInd].dispatchEvent(ToggleEvent);
        }

        radiobox.classList.toggle(CLASSES.checked);
        input.checked = !input.checked;

        ToggleEvent.checked = input.checked;

        radiobox.dispatchEvent(ToggleEvent);
    };


    var init = function () {

        var radioboxes = document.getElementsByName(NAMES.radiobox);

        Array.prototype.forEach.call(radioboxes, prepareRadioBox);
    };

    return{
        init: init
    };

}();
