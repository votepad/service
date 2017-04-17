//Модуль слайдера

var slider = function(letters) {

    //Получение элементов ползунка

    var sliderElem          = document.getElementById('slider'),
        letterElem          = document.getElementById('letter'),
        bandElem            = document.getElementById('band'),
        circleElem          = document.getElementById('circle'),
        bandCord            = bandElem.getBoundingClientRect(),
        circleCord          = null,
        circleWidth         = null,
        proportionForResize = null,
        checkDownMouse      = false,
        rightEdge           = null;

    circleElem.style.left   = 0;


    var handlers = {

        getNewLetter: function (left, right, elem) {

            letters.sort();

            var newLetterIndex = Math.floor(left / (right / letters.length));

            if (newLetterIndex < 0)
                newLetterIndex = 0;
            if (newLetterIndex > letters.length - 1)
                newLetterIndex = letters.length - 1;


            elem.innerHTML = letters[newLetterIndex];

        },


        downMouse: function (event) {

            if (event.which > 1) {
                return;
            }

            event.preventDefault();

            event = touchSupported(event);

            circleCord = circleElem.getBoundingClientRect();

            bandCord = bandElem.getBoundingClientRect();

            circleWidth = (circleCord.right - circleCord.left) / 2;

            rightEdge = sliderElem.offsetWidth - circleElem.offsetWidth;


            var l = event.pageX - bandCord.left - circleWidth;

            if (l < 0) {
                l = 0;
            }

            if (l > rightEdge) {
                l = rightEdge;
            }

            circleElem.style.left = l + 'px';


            handlers.getNewLetter(event.pageX - bandCord.left - circleWidth, rightEdge, letterElem);

            checkDownMouse = true;
        },

        moveMouse: function (event) {

            if (event.which > 1 || !checkDownMouse) {
                return;
            }

            event.preventDefault();

            event = touchSupported(event);

            var newLeft = event.pageX - bandCord.left - circleWidth;


            // курсор ушёл вне слайдера
            if (newLeft < 0) {
                newLeft = 0;
            }

            if (newLeft > rightEdge) {
                newLeft = rightEdge;
            }

            handlers.getNewLetter(newLeft, rightEdge, letterElem);


            circleElem.style.left = newLeft + 'px';
            proportionForResize = newLeft / (bandCord.right - bandCord.left);
        },

        upMouse: function (event) {
            checkDownMouse = false;

        },

        //Изменение положение ползунка на линии при изменении размеров окна

        replaceCirclePosition: function () {
            bandCord = bandElem.getBoundingClientRect();

            circleElem.style.left = proportionForResize * (bandCord.right - bandCord.left) + 'px';
        }
    };

    sliderElem.addEventListener('touchstart', handlers.downMouse, false);
    sliderElem.addEventListener('mousedown', handlers.downMouse, false);

    sliderElem.addEventListener('touchmove', handlers.moveMouse, false);
    sliderElem.addEventListener('mousemove', handlers.moveMouse, false);

    document.addEventListener('mouseup', handlers.upMouse, false);

    window.addEventListener('resize', handlers.replaceCirclePosition, false);
};