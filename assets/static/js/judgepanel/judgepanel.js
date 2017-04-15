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

    var eventor = new Event("mouseup", {bubbles: true, cancelable: false});


    var handlers = {

        //При нажатии на кнопку, мы должны запомнить начальное положение блоков, а также проинициалировать переменную для скролла
        //Так же мы должны просчитать размер единичного блока

        downMouse: function (event) {

            var currentElem = event.target.closest('.stages_holder_stage_peoples_criteria_holder-criteria');

            if (event.which > 1 || !currentElem) {
                return;
            }

            sliderElem = currentElem;

            widthCurrentElem = currentElem.getBoundingClientRect().width;

            event = touchSupported(event);

            startX = moveX = event.clientX;

            checkDownMouse = true;

            console.log('down');
        },

        moveMouse: function (event) {

            var currentElem = event.target.closest('.stages_holder_stage_peoples-criteria-holder');

            if (event.which > 1 || !checkDownMouse || !currentElem) {
                return;
            }

            sliderElem = currentElem;

            event.preventDefault();

            event = touchSupported(event);

            var finX = event.clientX;

            currentElem.scrollLeft -= (finX - moveX);

            moveX = finX;

        },

        upMouse: function (event) {

            var currentElem = event.target.closest('.stages_holder_stage_peoples-criteria-holder');

            if (event.which > 1 || !currentElem) {
                console.log("ex");
                return;
            }

            sliderElem = currentElem;

            event = touchSupported(event);

            var finX = event.clientX;
            var flag = true;
            if (!finX) {
                flag = !flag;
                startX = document.documentElement.clientWidth / 20;
                finX = document.documentElement.clientWidth / 10;
            }
            console.log(finX);


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

            if ( startAnimate != 0 && startAnimate < (currentElem.childElementCount - 1)  * (widthCurrentElem + 10) - 10 ) {
                if (flag){
                   animate(functionForAnimate, currentElem, startAnimate, endAnimate);
                } else {
                   currentElem.scrollLeft = startAnimate + endAnimate;
                }
            }

            console.log('ok');
            checkDownMouse = false;
        },

        replaceBlockPosition: function () {


            sliderElem = document.getElementsByClassName('stages_holder_stage_peoples_criteria_holder-criteria');
            widthCurrentElem = sliderElem[0].getBoundingClientRect().width;

            sliderElem[0].dispatchEvent(eventor);
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