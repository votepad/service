//Навигация по этапам мероприятия

var stagena = function () {

    var ToggleEvent     = new window.CustomEvent('toggle'),
        clickEvent      = new Event("click", {bubbles : true, cancelable : true}),
        stage           = null,
        startX          = null,
        s               = 1,
        checkDownMouse  = false,

        CLASSES         = {
            tab: 'tabs__btn',
            tabActive: 'tabs__btn--active',
            headerTab: 'tabs__header'
        },

        ID              = {
            stag: 'stages-nav'
        };


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

        console.log(isCheckedInd);

        if (isCheckedInd > -1 ){
            tabs[isCheckedInd].classList.toggle(CLASSES.tabActive);
            tabs[isCheckedInd].name = 0;

            ToggleEvent.checked = false;

            tabs[isCheckedInd].dispatchEvent(ToggleEvent);
        }

        tab.classList.toggle(CLASSES.tabActive);

        ToggleEvent.checked = !ToggleEvent.checked;
        tab.name = !tab.name;

        tab.dispatchEvent(ToggleEvent);
    };

    var initMenu = function (namesOfEvents) {

        stage.classList.add(CLASSES.headerTab);

        for (i = 0; i < namesOfEvents.length; i++){

            stage.appendChild(prepareTab(namesOfEvents[i]));
        }

        stage.firstChild.dispatchEvent(clickEvent);

        stage.addEventListener('touchstart', handlers.downMouse, false);
        stage.addEventListener('mousedown', handlers.downMouse, false);

        stage.addEventListener('touchmove', handlers.moveMouse, false);
        stage.addEventListener('mousemove', handlers.moveMouse, false);

        document.addEventListener('mouseup', handlers.upMouse, false);
    };

    var init = function (namesOfEvents) {
        stage = document.getElementById(ID.stag);

        initMenu(namesOfEvents);
    };

    return{
        init: init
    };

}();
