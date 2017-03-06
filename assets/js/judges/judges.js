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

    var circleWidth = null;

    var proportion = null;

    //Переменные для обработки события прокрутки

    var circleCord = null;
    var shiftX = null;

    var handlers = {

        touchStart: function(event) {

           //console.log('here');
            if ( event.which > 1) {

                console.log('out');
                return;
            }

            //console.log('start1');

            event.preventDefault();

            event = touchSupported(event);

            circleCord = circleElem.getBoundingClientRect();

            bandCord = bandElem.getBoundingClientRect();

            shiftX = event.pageX - circleCord.left;

            circleWidth = (circleCord.right - circleCord.left) / 2;

            //console.log('start2');

            circleElem.style.left = event.pageX - bandCord.left - circleWidth + 'px';

            console.log(event.pageX - bandCord.left - circleWidth );

        },
        touchMove: function (event) {

            if ( event.which > 1) {
                console.log(event.which);
                return;
            }

            event = touchSupported(event);

            var newLeft =  event.pageX - bandCord.left - circleWidth ;

            var rightEdge = sliderElem.offsetWidth - circleElem.offsetWidth;

            var newLetterIndex = Math.floor(newLeft/(rightEdge/letters.length));

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

            //console.log(newLeft);
            letterElem.innerHTML = letters[newLetterIndex];
            circleElem.style.left = newLeft + 'px';
            proportion = newLeft / (bandCord.right-bandCord.left);
        },

        resize: function () {
            requestAnimationFrame(function () {
                bandCord = bandElem.getBoundingClientRect();
                console.log(proportion*(bandCord.right-bandCord.left));
                circleElem.style.left = proportion*(bandCord.right-bandCord.left) + 'px';
                //console.log('ok');
            })
        }
    };

    sliderElem.addEventListener('touchstart', handlers.touchStart, false);
    sliderElem.addEventListener('mousedown', handlers.touchStart, false);

    sliderElem.addEventListener('touchmove', handlers.touchMove, false);
    sliderElem.addEventListener('mousemove', handlers.touchMove, false);

    window.addEventListener('resize', handlers.resize, false);
};

var stage_nav = function () {

    var stage = document.getElementById('stage');

    var startX = null;

    var handlers = {
        touchStart: function(event) {

            if ( event.which > 1) {
                return;
            }

            event = touchSupported(event);

            startX = event.clientX;

        },

        touchMove: function (event) {

            if ( event.which > 1) {
                return;
            }

            event = touchSupported(event);

            var finX = event.clientX;

            stage.scrollLeft -= (finX - startX);

            //console.log(finX - startX, stage.scrollLeft);

            startX = finX;

        }
    };

    stage.addEventListener('touchstart', handlers.touchStart, false);
    stage.addEventListener('mousedown', handlers.touchStart, false);

    stage.addEventListener('touchmove', handlers.touchMove, false);
    stage.addEventListener('mousemove', handlers.touchMove, false);
};

function init() {
    slider();
    stage_nav();
    console.log('kek');
}


document.addEventListener('DOMContentLoaded', init);
