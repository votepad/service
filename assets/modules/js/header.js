var header = (function(header) {

    var headerWrapper = document.getElementsByClassName('header__wrapper')[0],
        headerMenuIcon = document.getElementById('openMobileMenu'),
        headerBrand = document.getElementsByClassName('header__brand')[0],
        headerMenu = document.getElementsByClassName('header__menu')[0],
        headerMenuRight = document.getElementsByClassName('header__menu')[1],
        headerMenuItems = [],
        headerMobile = document.getElementsByClassName('mobile')[0],
        headerLinks = document.getElementsByClassName('header__button'),
        mobileLinks = document.getElementsByClassName('mobile__menu__link'),
        mobileCollapseLinks = document.getElementsByClassName('mobile__collapse__link'),
        address = window.location.pathname.split('/'),
        address3 = '/' + address[1] + '/' + address[2] + '/' + address[3],
        address4 = address3 + '/' + address[4],
        btnHref, i, item;

    var backdrop = document.createElement('div');
        backdrop.className = "modal-backdrop in";

    var headerMenuRightWidth = headerMenuRight.clientWidth + 1;
        headerMenuRight.style.width = headerMenuRight.clientWidth + 1 + "px";



    header.init = function() {

        headerMenuIcon.addEventListener('click', openMobileMenu, false);
        backdrop.addEventListener('click', closeMobileMenu, false);

        setActiveClassOnMenuItems();
        createHeaderMenuItems();
        calculateHeaderMenuWidth();
        //changeHeaderMenuItems();
        headerWrapper.style.opacity = "1";
    };


    window.onresize = function(event) {
        calculateHeaderMenuWidth();
        changeHeaderMenuItems();
    };


    /**
     * setActiveClassOnMenuItems - set Active class for btns
     */
    var setActiveClassOnMenuItems = function () {

        for (i = 0; i < headerLinks.length; i++) {
            if (headerLinks[i].href) {
                btnHref = headerLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3]);

                if ( btnHref.test(address3) ) {
                    headerLinks[i].classList.add('header__button--active');
                }
            }
        }

        for (i = 0; i < mobileLinks.length; i++) {
            if (mobileLinks[i].href) {
                btnHref = mobileLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3]);

                if (btnHref.test(address3)) {
                    mobileLinks[i].parentNode.classList.add('mobile__menu__item--active');
                    mobileLinks[i].classList.add('mobile__menu__link--active');
                }
            }
        }

        for (i = 0; i < mobileCollapseLinks.length; i++) {
            if (mobileCollapseLinks[i].href) {
                btnHref = mobileCollapseLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3] + '/' + btnHref[4]);
                
                if (btnHref.test(address4)) {
                    mobileCollapseLinks[i].parentNode.parentNode.parentNode.classList.add('mobile__menu__item--active');
                    mobileCollapseLinks[i].classList.add('mobile__collapse__link--active');
                }
            }
        }

    };



    /**
     * openMobileMenu - open mobile menu on click
     */
    var openMobileMenu = function() {
        if ( ! headerMenuIcon.parentNode.classList.contains('header__menu-icon--open')) {
            headerMenuIcon.parentNode.classList.add('header__menu-icon--open');
            document.body.classList.add('modal-open');
            headerBrand.classList.add('header__brand--active');
            headerMobile.classList.add('mobile--open');
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
        headerMobile.classList.remove('mobile--open');
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
                    class: headerMenu.childNodes[i].className,
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

        headerMenu.innerHTML = "";
        var maxWidth = headerMenu.clientWidth,
            curWidth = 80,
            hasAdditional = false;

        var MenuItem = "",
            additionalMenuItem = "";

        if (window.innerWidth > 992) {

            if (document.getElementsByClassName('modal-backdrop')[0]) {
                closeMobileMenu();
            }

            for (i = 0; i < headerMenuItems.length; i++) {
                if (maxWidth > curWidth + headerMenuItems[i].width) {
                    curWidth += headerMenuItems[i].width;
                    MenuItem += "<a href='" + headerMenuItems[i].href + "' class='" + headerMenuItems[i].class + "'>" + headerMenuItems[i].text + "</a>";
                } else {
                    hasAdditional = true;
                    additionalMenuItem += "<a href='" + headerMenuItems[i].href + "' class='dropdown__menu-link'>" + headerMenuItems[i].text + "</a>";
                }
            }
            if (hasAdditional) {
                headerMenu.innerHTML = MenuItem + '<div class="dropdown" data-toggle="dropdown"><a class="header__button dropdown__btn"><span style="margin-right: 5px">Ещё</span><i class="fa fa-caret-down" aria-hidden="true"></i></a><div class="dropdown__menu dropdown__menu--right">' + additionalMenuItem + '</div></div>';
            } else {
                headerMenu.innerHTML = MenuItem;
            }
        }

        if (window.innerWidth < 460) {
            headerMenuRight.classList.add('hide')
        } else {
            headerMenuRight.classList.remove('hide')
        }
    };


    return header;


})({});