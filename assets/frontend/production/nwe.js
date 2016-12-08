var nwe =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	/**
	 * @copyright Khaydarov Murod
	 */

	var uploader = (function(uploader) {

	    uploader.init = function(settings) {

	        Promise.resolve()

	            .then(uploader.core.handle(settings))
	            .then(uploader.ui.make)
	            .then(uploader.transport.prepare)
	            .catch(function(error) {
	                console.log(error);
	            });

	    };

	    return uploader;

	})({});

	uploader.core        = __webpack_require__(5);
	uploader.draw        = __webpack_require__(2);
	uploader.ui          = __webpack_require__(3);
	uploader.transport   = __webpack_require__(4);

	module.exports = {
	    uploader : uploader
	};



/***/ },
/* 2 */
/***/ function(module, exports) {

	/**
	 * @author Khaydarov Murod
	 */

	var draw = (function(draw){

	    /**
	     * Draws node
	     * @param tagName
	     * @param className
	     * @param properties
	     * @returns {Element}
	     */
	    draw.node = function(tagName, className, properties) {

	        var tag = document.createElement(tagName);
	        tag.className += className;

	        for(var property in properties) {
	            tag.setAttribute(property, properties[property]);
	        }

	        return tag;
	    };

	    return draw;

	})({});

	module.exports = draw;

/***/ },
/* 3 */
/***/ function(module, exports) {

	/**
	 * @copyright Khaydarov Murod
	 */

	var ui = (function(ui) {

	    ui.make = function() {
	        
	        return nwe.uploader.draw.node("INPUT", "", { type: "file", tt: nwe.uploader.core.settings.handler.id } );
	    };

	    return ui;

	})({});

	module.exports = ui;


/***/ },
/* 4 */
/***/ function(module, exports) {

	/**
	 * @copyright Khaydarov Murod
	 */

	var transport = (function(transport) {

	    /**
	     * @protected
	     *
	     * Native ajax method.
	     * @param {Object} data - Callbacks and data
	     */
	    transport.ajax = function (data) {

	        console.log(data);

	        if (!data || !data.url){
	            return;
	        }

	        var XMLHTTP          = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"),
	            success_function = function(){};

	        data.async           = true;
	        data.type            = data.type || 'GET';
	        data.data            = data.data || '';
	        data['content-type'] = data['content-type'] || 'application/json; charset=utf-8';
	        success_function     = data.success || success_function ;

	        if (data.type == 'GET' && data.data) {
	            data.url = /\?/.test(data.url) ? data.url + '&' + data.data : data.url + '?' + data.data;
	        }

	        if (data.withCredentials) {
	            XMLHTTP.withCredentials = true;
	        }

	        if (data.beforeSend && typeof data.beforeSend == 'function') {
	            data.beforeSend.call();
	        }

	        XMLHTTP.open( data.type, data.url, data.async );
	        XMLHTTP.setRequestHeader("Content-type", data['content-type'] );
	        XMLHTTP.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	        XMLHTTP.onreadystatechange = function() {
	            if (XMLHTTP.readyState == 4 && XMLHTTP.status == 200) {
	                success_function(XMLHTTP.responseText);
	            }
	        };

	        XMLHTTP.send(data.data);

	    };

	    /**
	     * @protected
	     *
	     * Makes UI elements
	     */
	    transport.prepare = function(input) {
	        
	        /**
	         * For handler clicked
	         */
	        nwe.uploader.core.settings.handler.addEventListener('click', function() {

	            input.click();

	        }, false);

	        /**
	         * When file is selected
	         */
	        input.addEventListener('change', transport.fileSelected, false);

	    };

	    transport.fileSelected = function() {

	        var input = this,
	            files = input.files,
	            filesLength = files.length,
	            formdData = new FormData(),
	            file,
	            i;

	        formdData.append('files', files[0], files[0].name);

	        nwe.uploader.transport.ajax({

	            url: nwe.uploader.core.settings.server,
	            type: "POST",
	            data: formdData,
	            success: nwe.uploader.core.settings.success,
	            error: nwe.uploader.core.settings.error

	        });

	    };


	    return transport;

	})({});

	module.exports = transport;

/***/ },
/* 5 */
/***/ function(module, exports) {

	/**
	 * @author Khaydarov Murod
	 */

	var core = (function(core) {

	    core.settings = {

	        handler : null,
	        server  : null,
	        success : function() {},
	        error   : function() {}
	    };


	    core.handle = function(settings) {

	        this.settings.handler = settings.handler;
	        this.settings.server  = settings.server;
	        this.settings.success = settings.success;
	        this.settings.error   = settings.error;
	    };

	    return core;


	})({});

	module.exports = core;

/***/ }
/******/ ]);