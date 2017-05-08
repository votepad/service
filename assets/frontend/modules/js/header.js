var header = (function(header) {

    var headerWrapper   = null,
        headerMenuIcon  = null,
        headerBrand     = null,
        headerMenu      = null,
        headerMenuRight = null,
        headerMenuItems = [],
        headerMobile    = null,
        i, item,
        headerMenuRightWidth = null;

    var backdrop = document.createElement('div');
        backdrop.className = "modal-backdrop in";

    var prepare_ = function () {

        headerWrapper = document.getElementsByClassName('header__wrapper')[0];
        headerMenuIcon = document.getElementById('openMobileMenu');
        headerBrand = document.getElementsByClassName('header__brand')[0];
        headerMenu = document.getElementsByClassName('header__menu')[0];
        headerMenuRight = document.getElementsByClassName('header__menu')[1];
        headerMobile = document.getElementsByClassName('mobile-aside')[0];

        headerMenuRightWidth = headerMenuRight.clientWidth + 1;
        headerMenuRight.style.width = headerMenuRight.clientWidth + 1 + "px";

    };


    header.init = function() {

        prepare_();

        headerMenuIcon.addEventListener('click', openMobileMenu, false);
        backdrop.addEventListener('click', closeMobileMenu, false);

        createHeaderMenuItems();
        calculateHeaderMenuWidth();
        changeHeaderMenuItems();
        headerWrapper.style.opacity = "1";

        window.onresize = function(event) {
            calculateHeaderMenuWidth();
            changeHeaderMenuItems();
        };
    };



    /**
     * openMobileMenu - open mobile menu on click
     */
    var openMobileMenu = function() {
        if ( ! headerMenuIcon.parentNode.classList.contains('header__menu-icon--open')) {
            headerMenuIcon.parentNode.classList.add('header__menu-icon--open');
            document.body.classList.add('modal-open');
            headerBrand.classList.add('header__brand--active');
            headerMobile.classList.add('mobile-aside--open');
            document.body.appendChild(backdrop);
        } else {
            closeMobileMenu();
        }
    };


    /**
     * closeMobileMenu - close mobile menu on click
     */
    var closeMobileMenu = function() {
        headerMenuIcon.parentNode.classList.remove('header__menu-icon--open');
        document.body.classList.remove('modal-open');
        headerBrand.classList.remove('header__brand--active');
        headerMobile.classList.remove('mobile-aside--open');
        document.getElementsByClassName('modal-backdrop')[0].remove()
    };


    /**
     * calculateHeaderMenuWidth - add style.width to `header__menu`
     */
    var calculateHeaderMenuWidth = function() {
        var width = headerWrapper.clientWidth - headerMenuIcon.clientWidth - headerBrand.clientWidth - headerMenuRightWidth - 80;

        if (width > 0) {
            headerMenu.style.width = width + "px";
        } else {
            headerMenu.style.width = "0";
        }

    };

    /**
     * createHeaderMenuItems - create array of HeaderMenuItems
     */
    var createHeaderMenuItems = function () {
        item;
        for (i=0; i < headerMenu.childNodes.length; i++) {
            if (headerMenu.childNodes[i].href) {
                item = {
                    obj: headerMenu.childNodes[i],
                    text: headerMenu.childNodes[i].innerHTML,
                    href: headerMenu.childNodes[i].getAttribute('href'),
                    width: headerMenu.childNodes[i].clientWidth
                };
                headerMenuItems.push(item);
            }
        }
    };


    /**
     * changeHeaderMenuItems - change HeaderMenuItems on resize
     */
    var changeHeaderMenuItems = function() {

        var maxWidth = headerMenu.clientWidth,
            curWidth = 80,
            hasAdditional = false;

        var additionalMenuItem ="";

        if (window.innerWidth > 992) {
            headerMenu.classList.remove('hide');

            if (document.getElementsByClassName('modal-backdrop')[0]) {
                closeMobileMenu();
            }

            for (i = 0; i < headerMenuItems.length; i++) {
                if (maxWidth > curWidth + headerMenuItems[i].width) {
                    curWidth += headerMenuItems[i].width;
                    headerMenuItems[i].obj.classList.remove('hide');
                } else {
                    hasAdditional = true;
                    headerMenuItems[i].obj.classList.add('hide');
                    additionalMenuItem += "<a href='" + headerMenuItems[i].href + "' class='dropdown__link'>" + headerMenuItems[i].text + "</a>";
                }
            }

            if (document.getElementById('additionalMenuItem')) {
                if (hasAdditional) {
                    document.getElementById('additionalMenuItem').parentNode.classList.remove('hide');
                    document.getElementById('additionalMenuItem').innerHTML = additionalMenuItem;
                } else {
                    document.getElementById('additionalMenuItem').parentNode.classList.add('hide');
                }
            }


        } else {
            headerMenu.classList.add('hide');
        }

        if (window.innerWidth < 460) {
            headerMenuRight.classList.add('hide')
        } else {
            headerMenuRight.classList.remove('hide')
        }

    };


    return header;


})({});

module.exports = header;