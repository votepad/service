var eventLanding = function (eventLanding) {


    eventLanding.toggleMenu = function (element) {

        if (element.parentNode.classList.contains('header__wrapper')) {
            element.parentNode.classList.toggle('header__wrapper--opened');
        }

    };

    var prepare_ = function () {

    };


    document.addEventListener('DOMContentLoaded', prepare_);

    return eventLanding;

}({});