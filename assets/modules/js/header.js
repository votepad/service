
var headerWrapper = document.getElementsByClassName('header-wrapper')[0],
    headerMenuIcon = document.getElementById('openMobileMenu'),
    headerBrand = document.getElementsByClassName('header-wrapper_brand')[0],
    headerMenu = document.getElementsByClassName('header-wrapper_menu')[0],
    headerMenuRight = document.getElementsByClassName('header-wrapper_menu-right')[0],
    headerMenuBtn = document.getElementsByClassName('header-wrapper_menu_btn'),
    headerMenuItems = [],
    address = window.location.pathname.split('/'),
    address = '/' + address[1] + '/' + address[2] + '/' + address[3],
    btnHref;


var backdrop = document.createElement('div');
    backdrop.className = "modal-backdrop in";

var headerMenuRightWidth = headerMenuRight.clientWidth + 1;
    headerMenuRight.style.width = headerMenuRight.clientWidth + 1 + "px";

/**
 * Event Listener
 */
headerMenuIcon.addEventListener('click', openMobileMenu, false);
backdrop.addEventListener('click', closeMobileMenu, false);


/**
 * Call Functions on init
 */
createHeaderMenuItems();
calculateHeaderMenuWidth();
changeHeaderMenuItems();



/**
 * Add active class to header btn
 */
for (var i = 0; i < headerMenuBtn.length; i++) {
    btnHref = '';
    if (headerMenuBtn[i].getAttribute('href') != null)
        btnHref = headerMenuBtn[i].getAttribute('href').split('/');

    btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3]);

    if ( btnHref.test(address) ) {
        headerMenuBtn[i].classList.add('header-wrapper_menu_btn--active');
    } else {
        headerMenuBtn[i].classList.remove('header-wrapper_menu_btn--active');
    }
}


/**
 * Window Resize
 */
window.onresize = function(event) {
    calculateHeaderMenuWidth();
    changeHeaderMenuItems();
};


/**
 * Functions
 *
 * openMobileMenu - open mobile menu on click
 * closeMobileMenu - close mobile menu on click
 * calculateHeaderMenuWidth - add style.width to header-wrapper_menu and header-wrapper_menu-right
 */

function openMobileMenu () {
    if ( ! headerMenuIcon.classList.contains('header-wrapper_btn--open')) {
        headerMenuIcon.classList.add('header-wrapper_btn--open');
        document.body.classList.add('modal-open');
        headerBrand.classList.add('header-wrapper_brand--active');
        document.body.appendChild(backdrop);
    } else {
        closeMobileMenu();
    }
}

function closeMobileMenu() {
    headerMenuIcon.classList.remove('header-wrapper_btn--open');
    document.body.classList.remove('modal-open');
    headerBrand.classList.remove('header-wrapper_brand--active');
    document.getElementsByClassName('modal-backdrop')[0].remove()
}

function calculateHeaderMenuWidth() {
    var width = headerWrapper.clientWidth - headerMenuIcon.clientWidth - headerBrand.clientWidth - headerMenuRightWidth - 50;

    if (width > 0) {
        headerMenu.style.width = width + "px";
    } else {
        headerMenu.style.width = 0 + "px";
    }

}

function createHeaderMenuItems() {
    var item;
    for (var i=0; i < headerMenu.childNodes.length; i++) {
        if (headerMenu.childNodes[i].href) {
            item = {
                obj: headerMenu.childNodes[i],
                text: headerMenu.childNodes[i].innerHTML,
                class: headerMenu.childNodes[i].className,
                href: headerMenu.childNodes[i].getAttribute('href'),
                width: headerMenu.childNodes[i].clientWidth
            }
            headerMenuItems.push(item);
        }
    }
}

function changeHeaderMenuItems() {

    headerMenu.innerHTML = "";
    var maxWidth = headerMenu.clientWidth,
        curWidth = 80,
        hasAdditional = false;

    var MenuItem = "",
        additionalMenuItem = ""

    if (window.innerWidth > 992) {
        for (var i = 0; i < headerMenuItems.length; i++) {
            if (maxWidth > curWidth + headerMenuItems[i].width) {
                curWidth += headerMenuItems[i].width;
                MenuItem += "<a href='" + headerMenuItems[i].href + "' class='" + headerMenuItems[i].class + "'>" + headerMenuItems[i].text + "</a>";
            } else {
                hasAdditional = true;
                additionalMenuItem += "<a href='" + headerMenuItems[i].href + "' class='" + headerMenuItems[i].class + " dropdown_item'>" + headerMenuItems[i].text + "</a>";
            }
        }
        if (hasAdditional) {
            headerMenu.innerHTML = MenuItem + '<div class="dropdown" data-toggle="dropdown" data-position="right"><a class="header-wrapper_menu_btn dropdown_btn"><span class="header_text" style="margin-right: 5px">Ещё</span><i class="fa fa-caret-down header_icon" aria-hidden="true"></i></a><div class="dropdown_menu">' + additionalMenuItem + '</div></div>';
        } else {
            headerMenu.innerHTML = MenuItem;
        }
    }

    if (window.innerWidth < 450) {
        headerMenuRight.classList.add('hide')
    } else {
        headerMenuRight.classList.remove('hide')
    }
}
