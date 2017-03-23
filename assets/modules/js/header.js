var header = (function(header) {

    var headerWrapper = document.getElementsByClassName('header-wrapper')[0],
        headerMenuIcon = document.getElementById('openMobileMenu'),
        headerBrand = document.getElementsByClassName('header-brand')[0],
        headerMenu = document.getElementsByClassName('header-menu')[0],
        headerMenuItems = [],
        headerMenuRight = document.getElementsByClassName('header-menu-right')[0],
        headerMobile = document.getElementsByClassName('header-mobile')[0],
        headerLinks = document.getElementsByClassName('header-menu_btn'),
        mobileLinks = document.getElementsByClassName('mobile-menu_item-btn'),
        mobileCollapseLinks = document.getElementsByClassName('mobile-menu_collapse-btn'),
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
        changeHeaderMenuItems();
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

        /* class="header-menu_btn" */
        for (i = 0; i < headerLinks.length; i++) {
            if (headerLinks[i].href) {
                btnHref = headerLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3]);

                if ( btnHref.test(address3) ) {
                    headerLinks[i].classList.add('header-menu_btn--active');
                }
            }
        }

        /* class="mobile-menu_item-btn" */
        for (i = 0; i < mobileLinks.length; i++) {
            if (mobileLinks[i].href) {
                btnHref = mobileLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3]);

                if (btnHref.test(address3)) {
                    mobileLinks[i].parentNode.classList.add('mobile-menu_item--active');
                    mobileLinks[i].classList.add('mobile-menu_item-btn--active');
                }
            }
        }

        /* class="mobile-menu_collapse-btn" */

        for (i = 0; i < mobileCollapseLinks.length; i++) {
            if (mobileCollapseLinks[i].href) {
                btnHref = mobileCollapseLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3] + '/' + btnHref[4]);
                
                if (btnHref.test(address4)) {
                    mobileCollapseLinks[i].parentNode.parentNode.parentNode.classList.add('mobile-menu_item--active');
                    mobileCollapseLinks[i].classList.add('mobile-menu_collapse-btn--active');
                }
            }
        }

    };



    /**
     * openMobileMenu - open mobile menu on click
     */
    var openMobileMenu = function() {
        if ( ! headerMenuIcon.classList.contains('header-wrapper_btn--open')) {
            headerMenuIcon.classList.add('header-wrapper_btn--open');
            document.body.classList.add('modal-open');
            headerBrand.classList.add('header-brand--active');
            headerMobile.classList.add('header-mobile--open');
            document.body.appendChild(backdrop);
        } else {
            closeMobileMenu();
        }
    };


    /**
     * closeMobileMenu - close mobile menu on click
     */
    var closeMobileMenu = function() {
        headerMenuIcon.classList.remove('header-wrapper_btn--open');
        document.body.classList.remove('modal-open');
        headerBrand.classList.remove('header-brand--active');
        headerMobile.classList.remove('header-mobile--open');
        document.getElementsByClassName('modal-backdrop')[0].remove()
    };


    /**
     * calculateHeaderMenuWidth - add style.width to `header-menu` and `header-menu--right`
     */
    var calculateHeaderMenuWidth = function() {
        var width = headerWrapper.clientWidth - headerMenuIcon.clientWidth - headerBrand.clientWidth - headerMenuRightWidth - 80;

        if (width > 0) {
            headerMenu.style.width = width + "px";
        } else {
            headerMenu.style.width = 0 + "px";
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
                    additionalMenuItem += "<a href='" + headerMenuItems[i].href + "' class='dropdown-menu_btn'>" + headerMenuItems[i].text + "</a>";
                }
            }
            if (hasAdditional) {
                headerMenu.innerHTML = MenuItem + '<div class="dropdown-block" data-toggle="dropdown"><a class="header-menu_btn dropdown-btn"><span style="margin-right: 5px">Ещё</span><i class="fa fa-caret-down header_icon" aria-hidden="true"></i></a><div class="dropdown-menu dropdown-menu--right">' + additionalMenuItem + '</div></div>';
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