var eventLanding = function (eventLanding) {


    eventLanding.toggleMenu = function (element) {

        if (element.parentNode.classList.contains('header__wrapper')) {
            element.parentNode.classList.toggle('header__wrapper--opened');
        }

    };


    var toggleTab_ = function(event) {
        var element = event.target;

        if (element.nodeType !== 1) return;

        var activeBtn = document.querySelector('.section__header-link--active[data-tabsgroup="' + element.dataset.tabsgroup + '"]');

        if (activeBtn) {
            var activeBlock = document.getElementById(activeBtn.dataset.area);
            if (activeBlock) {
                activeBlock.classList.add('hide');
            }
            activeBtn.classList.remove('section__header-link--active');
        }

        var block = document.getElementById(element.dataset.area);

        if (block) {
            block.classList.remove('hide');
            element.classList.add('section__header-link--active');
        }

    };




    var prepare_ = function () {
        var tabs = document.querySelectorAll('[data-toggle="tabs"]');

        for (var i = 0; i < tabs.length; i++) {
            tabs[i].addEventListener('click', toggleTab_);
        }
    };


    document.addEventListener('DOMContentLoaded', prepare_);

    return eventLanding;

}({});