var main =
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
/***/ function(module, exports) {

	/**
	 * @copyright Khaydarov Murod
	 */

	var nwe = (function(nwe) {

	    nwe.init = function() {

	        Promise.resolve()

	            .then(nwe.ui.make.input)

	            .catch(function() {
	                console.log('something gone');
	            });

	    };


	})({});

	nwe.file = {

	    /**
	     * XMLHTTPRequest callbacks
	     */
	    callbacks : null,

	    /** Uploaded callback */
	    uploaded : function() {

	        var input    = nwe.ui.input,
	            files    = input.files,
	            formData = new FormData();

	        formData.append('files', files[0], files[0].name);

	        nwe.ajax({
	            data    : formData,
	            success : nwe.file.callbacks.success,
	            error   : nwe.file.callbacks.error
	        });
	    },

	    /** When button is clicked */
	    selectAndUpload : function(params) {
	        nwe.ui.input.click();
	        nwe.file.callbacks = params;
	    }

	};


	nwe.init();


	/**
	 * Upload organization logo
	 */
	$('#edit_org_avatar').click(function() {

	    var params = {

	        success : function(callback) {

	            var file = JSON.parse(callback),
	                image   = file.filename,
	                el = document.getElementById('org-avatar-uploaded');

	            $.ajax({
	                url  : "/organization/<?=$organization->id; ?>/update_with_ajax",
	                type : "POST",
	                data : {
	                    field : 'logo',
	                    value : image
	                },
	                beforeSend : function() {
	                    el.style.opacity = 0.3;
	                },
	                success : function(result) {
	                    el.src = '/uploads/organizations/m_' + image;
	                    el.style.opacity = 1;
	                },
	                error : function(result) {
	                    console.log('something gone wrong!');
	                }
	            });

	        },

	        error : function(callback) {
	            console.log(callback);
	        }
	    };

	    nwe.file.selectAndUpload(params);
	});

	/**
	 * Upload or Change organizations cover
	 */
	$('#edit_org_back').click(function() {

	    var params = {

	        success : function(callback) {

	            var file = JSON.parse(callback),
	                image   = file.filename,
	                el = document.getElementById('org-background-uploaded');

	            $.ajax({
	                url  : "/organization/<?=$organization->id; ?>/update_with_ajax",
	                type : "POST",
	                data : {
	                    field : 'cover',
	                    value : image
	                },
	                beforeSend : function() {
	                    el.style.opacity = 0.3;
	                },
	                success : function(result) {
	                    el.src = "/uploads/organizations/o_"+image;
	                    el.style.opacity = 1;
	                },
	                error : function(result) {
	                    console.log('something gone wrong!');
	                }
	            });

	        },

	        error : function(callback) {
	            console.log(callback);
	        }
	    };

	    nwe.file.selectAndUpload(params);

	});



/***/ }
/******/ ]);