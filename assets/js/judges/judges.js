var slider = function(){

    var letters = ['A', 'B', 'C', 'Ц', 'D', 'E', 'F', 'Ё'];

    letters.sort();

    //Получение элементов ползунка

    var sliderElem = document.getElementById('slider');
    var letterElem = document.getElementById('letter');
    var bandElem =  sliderElem.children[0];
    var circleElem = sliderElem.children[1];

    //Получение координат полосы прокрутки

    var bandCord = bandElem.getBoundingClientRect();

    //Переменные для обработки события прокрутки

    var circleCord = null;
    var shiftX = null;

    //Обработка touch-нажатия

    circleElem.addEventListener('touchstart', function(event) {

        if (event.targetTouches.length != 1) {
            return;
        }

        var touch = event.targetTouches[0];

        circleCord = circleElem.getBoundingClientRect();

        shiftX = touch.pageX - circleCord.left;

    }, false);

    //Обработка touch-перемещения

    circleElem.addEventListener('touchmove', function (event) {

        if (event.targetTouches.length != 1) {
            return;
        }

        var touch = event.targetTouches[0];

        var newLeft = touch.pageX - shiftX - bandCord.left;

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

        letterElem.innerHTML = letters[newLetterIndex];
        circleElem.style.left = newLeft + 'px';

    }, false);

};

var stage_nav = function () {

    var stage = document.getElementById('stage');

    var leftSize = stage.style.left;

    var lenStage = stage.scrollWidth;

    var windowWidth =  window.innerWidth;

    var startX = null;

    function FirstPosition() {

        var newLeft = null;

        if ( windowWidth >= lenStage ){
            newLeft = Math.floor((windowWidth - lenStage)/2);
        }
        else{
            newLeft = 0;
        }

        stage.style.left = newLeft + 'px';
    }

    FirstPosition();

    stage.addEventListener('touchstart', function(event) {

        if (event.targetTouches.length != 1) {
            return;
        }

        leftSize = stage.style.left;

        lenStage = stage.scrollWidth;

        var touch = event.targetTouches[0];

        startX = touch.pageX;

    }, false);

    stage.addEventListener('touchmove', function (event) {

        if (event.targetTouches.length != 1) {
            return;
        }

        var touch = event.targetTouches[0];

        var newLeft = touch.pageX - startX + leftSize;

        if ( newLeft < windowWidth - lenStage)
            newLeft = windowWidth - lenStage;

        if (newLeft > 0){
            newLeft = 0;
        }

        if ( windowWidth >= lenStage ){
            newLeft = Math.floor((windowWidth - lenStage)/2);
        }

        stage.style.left = newLeft + 'px';

    }, false);




};

function init() {
    slider();
    stage_nav();
}


document.addEventListener('DOMContentLoaded', init);
