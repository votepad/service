var vp =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

var ajax = function () {

    var send = function (data) {

        if (!data || !data.url) return;

        var XMLHTTP          = window.XMLHttpRequest ? new window.XMLHttpRequest() : new window.ActiveXObject('Microsoft.XMLHTTP'),
            successFunction  = function () {};

        data.async           = true;
        data.type            = data.type || 'GET';
        data.data            = data.data || '';
        data['content-type'] = data['content-type'] || 'application/json; charset=utf-8';
        successFunction      = data.success || successFunction;

        if (data.type == 'GET' && data.data) {

            data.url = /\?/.test(data.url) ? data.url + '&' + data.data : data.url + '?' + data.data;

        }

        if (data.withCredentials) {

            XMLHTTP.withCredentials = true;

        }

        if (data.beforeSend && typeof data.beforeSend == 'function') {

            data.beforeSend.call();

        }

        XMLHTTP.open(data.type, data.url, data.async);

        if (!isFormData(data.data)) {
            XMLHTTP.setRequestHeader('Content-type', data['content-type']);
        }

        XMLHTTP.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        XMLHTTP.onreadystatechange = function () {

            if (XMLHTTP.readyState == 4 && XMLHTTP.status == 200) {

                successFunction(XMLHTTP.responseText);

            }

        };

        XMLHTTP.send(data.data);

    };

    var isFormData = function (data) {

        return typeof data.append == 'function';

    };

    return {
        send: send
    }

}();

module.exports = ajax;

/***/ }),
/* 1 */
/***/ (function(module, exports) {

var collapse = (function(collapse) {


    var nodes = [];


    collapse.init = function() {

        nodes = document.querySelectorAll('[data-toggle="collapse"]');

        if (nodes.length > 0) {

            for (var i = 0; i < nodes.length; i++) {

                nodes[i].addEventListener('click', toggle, false);
                
                if(nodes[i].dataset.opened == "true") {
                    openCollapse(nodes[i], document.getElementById(nodes[i].dataset.area));
                }

            }
        }

    };


    var toggle = function (event) {
        var btn = event.target,
            list = document.getElementById(btn.dataset.area);

        if (btn.dataset.opened == "false") {
            openCollapse(btn,list);
        } else {
            hideCollapse(btn,list);
        }

    };


    var openCollapse = function (btn, list) {
        btn.dataset.opened = "true";

        if (!list.dataset.height)
            list.dataset.height = calculateHeight(list);

        list.style.height = list.dataset.height + "px";

    };


    var hideCollapse = function (btn, list) {
        btn.dataset.opened = "false";
        list.style.height = "0";
    };


    var calculateHeight = function (list) {
        var height = 0;
        for (var i = 0; i < list.childNodes.length; i++) {
            if (list.childNodes[i].className) {
                height += list.childNodes[i].clientHeight;
            }
        }
        return height;
    };


    return collapse;


})({});

module.exports = collapse;

/***/ }),
/* 2 */
/***/ (function(module, exports) {

var cookies = function () {

    var get = function (name) {

        var match = document.cookie.match(RegExp(name+"=([^;]*)"));

        return match ? decodeURIComponent(match[1]).split('~')[1] : undefined;

    };

    var set = function(options) {

        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var date = new Date();
            date.setTime(date.getTime() + expires * 1000);
            expires = options.expires = date;
        }

        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        var value = encodeURIComponent(options.value);

        var updatedCookie = options.name + "=" + value;

        for (var propName in options) {

            if (propName == 'name' || propName == 'value') {
                continue;
            }

            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;

    };

    var remove = function (name) {

        set({
            name: name,
            value: '',
            expires: -1,
            path: '/'
        });

    };

    return {
        get: get,
        set: set,
        remove: remove
    }

}();

module.exports = cookies;

/***/ }),
/* 3 */
/***/ (function(module, exports) {

var header = (function(header) {

    var headerWrapper   = null,
        headerMenuIcon  = null,
        headerBrand     = null,
        headerMenu      = null,
        headerMenuRight = null,
        headerMenuItems = [],
        headerMobile    = null,
        headerLinks     = null,
        mobileLinks     = null,
        mobileCollapseLinks = null,

        address = window.location.pathname.split('/'),
        address = '/' + address[1] + '/' + address[2] + '/' + address[3] + '/' + address[4],
        btnHref, i, item,
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
        headerLinks = document.getElementsByClassName('header__button');
        mobileLinks = document.getElementsByClassName('mobile-aside__menu-link');
        mobileCollapseLinks = document.getElementsByClassName('mobile-aside__collapse-link');

        headerMenuRightWidth = headerMenuRight.clientWidth + 1;
        headerMenuRight.style.width = headerMenuRight.clientWidth + 1 + "px";

    };


    header.init = function() {

        prepare_();

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

        for (i = 0; i < headerLinks.length; i++) {
            if (headerLinks[i].href) {
                btnHref = headerLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3] + '/' + btnHref[4]);

                if ( btnHref.test(address) ) {
                    headerLinks[i].classList.add('header__button--active');
                }
            }
        }

        for (i = 0; i < mobileLinks.length; i++) {
            if (mobileLinks[i].href) {
                btnHref = mobileLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3] + '/' + btnHref[4]);

                if (btnHref.test(address)) {
                    mobileLinks[i].parentNode.classList.add('mobile-aside__menu__item--active');
                    mobileLinks[i].classList.add('mobile-aside__menu-link--active');
                }
            }
        }

        for (i = 0; i < mobileCollapseLinks.length; i++) {
            if (mobileCollapseLinks[i].href) {
                btnHref = mobileCollapseLinks[i].getAttribute('href').split('/');
                btnHref = new RegExp(btnHref[1] + '/' + btnHref[2] + '/' + btnHref[3] + '/' + btnHref[4]);
                
                if (btnHref.test(address)) {
                    mobileCollapseLinks[i].parentNode.parentNode.parentNode.classList.add('mobile-aside__menu__item--active');
                    mobileCollapseLinks[i].classList.add('mobile-aside__collapse-link--active');
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

/***/ }),
/* 4 */
/***/ (function(module, exports) {

var tabs = (function(tabs) {


    tabs.nodes = {};


    tabs.init = function() {

        tabs.nodes = document.querySelectorAll('[data-ui="tabs"]');

        listenNode();
    };


    var listenNode = function() {

        for (var i = 0; i < tabs.nodes.length; i++) {
            tabs.nodes[i].addEventListener('click', changeTab, false);
        }

    };


    var changeTab = function(event) {

        var node = event.target;
        if (! node.classList.contains('tab') )
            node = event.target.parentElement;


        var newBlockId = node.getAttribute('aria-controls'),
            newBlock = document.getElementById(newBlockId),
            blocksContent = newBlock.parentElement.children,
            headerTabs = node.parentElement.parentElement.getElementsByTagName("li"),
            className;

        /**
         * Change header active tab
         */
        for (var i = 0; i < headerTabs.length; i++) {
            headerTabs[i].children[0].classList.remove("tab--active");
        }

        node.classList.add("tab--active");


        /**
         * Change tabs content
         */
        for (var i = 0; i < blocksContent.length; i++) {
            blocksContent[i].classList.remove("tab_block--active");
        }

        newBlock.classList.add("tab_block--active");

    };

    return tabs;

})({});

module.exports = tabs;


/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Entry point of Votepad scripts
 *
 * @description Contains of separate modules
 *
 * @author Khaydarov Murod <murod.haydarov@gmail.com>
 * @copyright Votepad Team 2017
 */

var votepad = ( function (votepad) {

    return votepad;

})({});

votepad.ajax     = __webpack_require__(0);
votepad.header   = __webpack_require__(3);
votepad.collapse = __webpack_require__(1);
votepad.cookies  = __webpack_require__(2);
votepad.tabs     = __webpack_require__(4);

module.exports = votepad;

/***/ })
/******/ ]);
//# sourceMappingURL=votepad.bundle.js.map