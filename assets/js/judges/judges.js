//Преобразование touch-нажатий в схожие с нажатием мышки событиями

var touchSupported = function(e) {

    if (e.changedTouches)
        var touch = e.changedTouches[0];
    else
        return e;

    e.pageX = touch.pageX;
    e.pageY = touch.pageY;

    e.clientX = touch.clientX;
    e.clientY = touch.clientY;

    e.screenX = touch.screenX;
    e.screenY = touch.screenY;

    e.target = touch.target;

    return e;
};

//Модуль слайдера

var slider = function(){

    var letters = ['A', 'B', 'C', 'Ц', 'D', 'E', 'F', 'Ё'];

    letters.sort();

    //Получение элементов ползунка

    var sliderElem = document.getElementById('slider');
    var letterElem = document.getElementById('letter');
    var bandElem =  sliderElem.children[0];
    var circleElem = sliderElem.children[1];

    circleElem.style.left = 0;

    //Получение координат полосы прокрутки

    var bandCord = bandElem.getBoundingClientRect();

    //Переменные для обработки события прокрутки

    var circleCord = null;
    var circleWidth = null;

    //Переменная для обработки события изменение окна

    var proportionForResize = null;

    //Переменная для проверки события клика мышки на ползунок

    var checkDownMouse = false;

    var handlers = {

        downMouse: function(event) {

            if ( event.which > 1) {
                return;
            }

            event.preventDefault();

            event = touchSupported(event);

            circleCord = circleElem.getBoundingClientRect();

            bandCord = bandElem.getBoundingClientRect();

            circleWidth = (circleCord.right - circleCord.left) / 2;

            circleElem.style.left = event.pageX - bandCord.left - circleWidth + 'px';

            checkDownMouse = true;
        },

        moveMouse: function (event) {

            if ( event.which > 1 || !checkDownMouse ) {
                return;
            }

            event = touchSupported(event);

            var newLeft =  event.pageX - bandCord.left - circleWidth ;

            var rightEdge = sliderElem.offsetWidth - circleElem.offsetWidth;

            var newLetterIndex = Math.floor(newLeft / (rightEdge / letters.length));

            if ( newLetterIndex < 0 )
                newLetterIndex = 0;
            if ( newLetterIndex > letters.length - 1 )
                newLetterIndex = letters.length - 1;

            // курсор ушёл вне слайдера
            if (newLeft < 0) {
                newLeft = 0;
            }

            if (newLeft > rightEdge) {
                newLeft = rightEdge;
            }

            letterElem.innerHTML = letters[newLetterIndex];
            circleElem.style.left = newLeft + 'px';
            proportionForResize = newLeft / (bandCord.right - bandCord.left);
        },

        upMouse: function (event) {
            checkDownMouse = false;

        },

        //Изменение положение ползунка на линии при изменении размеров окна

        replaceCirclePosition: function () {
            requestAnimationFrame(function () {

                bandCord = bandElem.getBoundingClientRect();

                circleElem.style.left = proportionForResize * (bandCord.right - bandCord.left) + 'px';
            })
        }
    };

    sliderElem.addEventListener('touchstart', handlers.downMouse, false);
    sliderElem.addEventListener('mousedown', handlers.downMouse, false);

    sliderElem.addEventListener('touchmove', handlers.moveMouse, false);
    sliderElem.addEventListener('mousemove', handlers.moveMouse, false);

    sliderElem.addEventListener('mouseup', handlers.upMouse, false);

    window.addEventListener('resize', handlers.replaceCirclePosition, false);
};

//Навигация по этапам мероприятия

var stage_nav = function () {

    var stage = document.getElementById('stage');

    var startX = null;

    //Переменная для проверки события клика мышки на ползунок

    var checkDownMouse = false;

    var handlers = {

        downMouse: function(event) {

            if ( event.which > 1) {
                return;
            }

            event = touchSupported(event);

            startX = event.clientX;

            checkDownMouse = true;
        },

        moveMouse: function (event) {

            if ( event.which > 1 || !checkDownMouse ) {
                return;
            }

            event = touchSupported(event);

            var finX = event.clientX;

            stage.scrollLeft -= (finX - startX);

            startX = finX;

        },

        upMouse: function (event) {
            checkDownMouse = false;
        }
    };

    stage.addEventListener('touchstart', handlers.downMouse, false);
    stage.addEventListener('mousedown', handlers.downMouse, false);

    stage.addEventListener('touchmove', handlers.moveMouse, false);
    stage.addEventListener('mousemove', handlers.moveMouse, false);

    stage.addEventListener('mouseup', handlers.upMouse, false);
};

function init() {
    slider();
    stage_nav();
}

document.addEventListener('DOMContentLoaded', init);