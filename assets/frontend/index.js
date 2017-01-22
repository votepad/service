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

nwe.ui        = require('./modules/nwe.ui');
nwe.transport = require('./modules/nwe.transport');
nwe.uploader  = require('./modules/nwe.uploader');

module.exports = nwe;

