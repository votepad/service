//Навигация по этапам мероприятия

var stagena = function () {

    var stage           = null,
        startX          = null,
        s               = 1,
        checkDownMouse  = false,

        CLASSES         = {
            tab:       'tabs__btn',
            tabActive: 'tabs__btn--active',
            headerTab: 'tabs__header'
        },

        ID              = {
            stag: 'stages-nav'
        };


    var handlers = {

        mouseDown: function(event) {
            if ( event.which > 1) {
                return;
            }

            event = touchSupported(event);

            startX = event.clientX;

            checkDownMouse = true;
        },

        mouseMove: function (event) {
            if ( event.which > 1 || !checkDownMouse ) {
                return;
            }

            event.preventDefault();

            event = touchSupported(event);

            var finX = event.clientX;

            stage.scrollLeft -= (finX - startX);

            startX = finX;

        },

        mouseUp: function (event) {
            checkDownMouse = false;
        }
    };


    var prepareTab = function (nameEvent) {


        var tab = document.createElement('DIV');

        tab.innerText = nameEvent;
        tab.name = 0;
        tab.dataset.toggle = 'tabs';
        tab.dataset.block = "stage" + s;
        s += 1;
        tab.classList.add(CLASSES.tab);
        tab.addEventListener('click', clicked);

        return tab;
    };

    var clicked = function () {
        var tab = this,
            tabs = tab.parentNode.childNodes,
            isCheckedInd = -1;

        for (i = 0; i < tabs.length; i++) {
            if (tabs[i].name == 1) {
                isCheckedInd = i;
                break;
            }
        }

        //console.log(isCheckedInd);

        if (isCheckedInd > -1 ){
            tabs[isCheckedInd].classList.remove(CLASSES.tabActive);
            tabs[isCheckedInd].name = 0;
        }

        tab.classList.add(CLASSES.tabActive);

        tab.name = !tab.name;
    };

    var initMenu = function (namesOfEvents) {

        stage.classList.add(CLASSES.headerTab);

        for (i = 0; i < namesOfEvents.length; i++){

            stage.appendChild(prepareTab(namesOfEvents[i]));
        }

        stage.firstChild.click();

        stage.addEventListener('touchstart', handlers.mouseDown, false);
        stage.addEventListener('mousedown', handlers.mouseDown, false);

        stage.addEventListener('touchmove', handlers.mouseMove, false);
        stage.addEventListener('mousemove', handlers.mouseMove, false);

        document.addEventListener('mouseup', handlers.mouseUp, false);
    };

    var init = function (namesOfEvents) {
        stage = document.getElementById(ID.stag);

        initMenu(namesOfEvents);
    };

    return{
        init: init
    };

}();
