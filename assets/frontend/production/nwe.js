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

	var nwe = (function(nwe) {

	    /**
	     * Clones object
	     *
	     *
	     * @param targetObject
	     * @returns {{}}
	     */
	    nwe.cloner = function(targetObject) {

	        var newObject = {};

	        for(var key in targetObject) {
	            if (targetObject.hasOwnProperty(key))
	                newObject[key] = null;
	        }
	        return newObject;
	    };

	    return nwe;

	})({});

	nwe.ui        = __webpack_require__(2);
	nwe.transport = __webpack_require__(3);
	nwe.uploader  = __webpack_require__(4);

	module.exports = nwe;



/***/ },
/* 2 */
/***/ function(module, exports) {

	/**
	 * @copyright Khaydarov Murod
	 */

	var ui = (function() {

	    

	})();

	module.exports = ui;


/***/ },
/* 3 */
/***/ function(module, exports) {

	/**
	 * @copyright Khaydarov Murod
	 */

	var transport = (function(transport) {

	    /**
	     * @protected
	     *
	     * @type {DOMElement}
	     */
	    transport.input = null;

	    transport.init = function() {
	        make();
	    };

	    /**
	     * @protected
	     *
	     * Native ajax method.
	     * @param {Object} data - Callbacks and data
	     */
	    transport.ajax = function (data) {

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
	    var make = function() {

	        var input = function() {

	            var input = document.createElement('input');
	            input.type = 'file';

	            return input;
	        };

	        transport.input = input();
	    };

	    return transport;

	})({});


	module.exports = transport;

/***/ },
/* 4 */
/***/ function(module, exports) {

	/**
	 * Created by behzodqurbonov on 20.01.17.
	 */

	var uploader = (function(uploader) {


	    uploader.node = null;

	    uploader.callbacks = {};

	    uploader.init = function(settings) {

	        /**
	         * Draw input
	         */
	        nwe.transport.init();

	        uploader.node   = settings.node;
	        uploader.server = settings.server;
	        uploader.callbacks.success = settings.success;
	        uploader.callbacks.error   = settings.error;
	        uploader.callbacks.before  = settings.before;


	        listenNode();
	    };

	    var listenNode = function() {

	        uploader.node.addEventListener('click', clickInput, false);

	    };

	    var clickInput = function() {

	        nwe.transport.input.click();

	        nwe.transport.input.addEventListener('change', selectAndUpload, false);
	    };

	    var selectAndUpload = function() {

	        var input = nwe.transport.input,
	            files = input['files'],
	            file  = files[0];

	        var formData = new FormData();

	        formData['files'] = file;
	        // formData.append('files', file, file.name);
	        console.log(formData);

	        nwe.transport.ajax({
	            url : uploader.server,
	            type : "POST",
	            data : formData,
	            contentType : false,
	            beforeSend : uploader.callbacks.beforeSend,
	            success : uploader.callbacks.success,
	            error : uploader.callbacks.error
	        });

	    };

	    return uploader;

	})({});

	module.exports = uploader;


/***/ }
/******/ ]);