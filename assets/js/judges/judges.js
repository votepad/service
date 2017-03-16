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

    var rightEdge = null;

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

            rightEdge = sliderElem.offsetWidth - circleElem.offsetWidth;

            letterElem.innerHTML = letters[Math.floor((event.pageX - bandCord.left - circleWidth) / (rightEdge / letters.length))];

            checkDownMouse = true;
        },

        moveMouse: function (event) {

            if ( event.which > 1 || !checkDownMouse ) {
                return;
            }

            event.preventDefault();

            event = touchSupported(event);

            var newLeft =  event.pageX - bandCord.left - circleWidth ;

            console.log('kek', rightEdge);

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

    document.addEventListener('mouseup', handlers.upMouse, false);

    window.addEventListener('resize', handlers.replaceCirclePosition, false);
};

//Навигация по этапам мероприятия

var stage_nav = function () {

    var stage = document.getElementById('stage_nav');

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

            event.preventDefault();

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

    document.addEventListener('mouseup', handlers.upMouse, false);
};


var stages_holder = function () {

    var stages = document.getElementsByClassName('stages_holder').item(0);

    //Переменная для запоминания левой позиции блока

    var startX = null;

    //Переменная для скролла блока

    var moveX = null;

    //Длина одного блока

    var widthCurrentElem = null;

    //Объект полосы блоков

    var sliderElem = null;

    //Переменная для проверки события клика мышки на ползунок

    var checkDownMouse = false;

    //Текущее кол-во блоков, которое было прокручено

    var numberOfBlock = null;

    var handlers = {

        //При нажатии на кнопку, мы должны запомнить начальное положение блоков, а также проинициалировать переменную для скролла
        //Так же мы должны просчитать размер единичного блока

        downMouse: function (event) {

            var currentElem = event.target.closest('.stages_holder_stage_peoples_criteria_holder-criteria');

            if (event.which > 1 || !currentElem) {
                return;
            }

            widthCurrentElem = currentElem.getBoundingClientRect().width;

            event = touchSupported(event);

            startX = moveX = event.clientX;

            checkDownMouse = true;
        },

        moveMouse: function (event) {

            var currentElem = event.target.closest('.stages_holder_stage_peoples-criteria-holder');

            if (event.which > 1 || !checkDownMouse || !currentElem) {
                return;
            }

            event.preventDefault();

            event = touchSupported(event);

            var finX = event.clientX;

            currentElem.scrollLeft -= (finX - moveX);

            moveX = finX;

        },

        upMouse: function (event) {

            var currentElem = event.target.closest('.stages_holder_stage_peoples-criteria-holder');

            if (event.which > 1 || !currentElem) {
                return;
            }

            sliderElem = currentElem;

            event = touchSupported(event);

            var finX = event.clientX;

            //Перменные для анимации

            var startAnimate = currentElem.scrollLeft;

            var endAnimate = (widthCurrentElem + 10) * numberOfBlock - startAnimate;

            //Длина участка траектории, при котором один блок сменяется на другой

            var widthFingerScroll = widthCurrentElem / 10;

            //Обработка нового положения, если скролл идет влево

            if (finX - startX > widthFingerScroll){

                numberOfBlock = Math.floor((startAnimate - finX + startX) / widthCurrentElem);

                endAnimate = (widthCurrentElem + 10) * numberOfBlock - startAnimate;
            }
            else{

                //Обработка нового положения, если скролл идет вправо

                if ( finX - startX < (-1)*widthFingerScroll){

                    numberOfBlock = Math.ceil((startAnimate - finX + startX) / widthCurrentElem);

                    endAnimate = (widthCurrentElem + 10) * numberOfBlock - startAnimate;
                }
            }

            if ( startAnimate != 0 && startAnimate < (currentElem.childElementCount - 1)  * (widthCurrentElem + 10) - 10 )
                animate(functionForAnimate, currentElem, startAnimate, endAnimate);

            checkDownMouse = false;
        },

        replaceBlockPosition: function () {
            requestAnimationFrame(function () {

               widthCurrentElem = sliderElem.getBoundingClientRect().width;

               sliderElem.scrollLeft = (widthCurrentElem + 10) * numberOfBlock;
            })
        }
    };

    stages.addEventListener('touchstart', handlers.downMouse, false);
    stages.addEventListener('mousedown', handlers.downMouse, false);

    stages.addEventListener('touchmove', handlers.moveMouse, false);
    stages.addEventListener('mousemove', handlers.moveMouse, false);

    stages.addEventListener('touchend', handlers.upMouse, false);
    stages.addEventListener('mouseup', handlers.upMouse, false);

    window.addEventListener('resize', handlers.replaceBlockPosition, false);
};


var animate = function (options, elem, startan, end) {

    var start = performance.now();

    requestAnimationFrame(function animate(time) {
        // timeFraction от 0 до 1
        var timeFraction = (time - start) / options.duration;
        if (timeFraction > 1) timeFraction = 1;

        // текущее состояние анимации
        var progress = options.timing(timeFraction);

        options.draw(progress, elem, startan, end);

        if (timeFraction < 1) {
            requestAnimationFrame(animate);
        }

    });
};

var functionForAnimate = {
    duration: 200,
    timing: function(timeFraction) {
        return timeFraction;
    },

    draw: function(progress, elem, start, end) {
        elem.scrollLeft = start + progress * end;
        //console.log(elem.scrollLeft);
    }
};


function init() {
    slider();
    stage_nav();
    stages_holder();
}

document.addEventListener('DOMContentLoaded', init);