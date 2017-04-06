var formula = function(formula) {

    var items_all = [],
        items_selected = [],
        items_coeff = [],
        operators = [];

    var __prepare = function () {

    };


    function formula(el, options) {

        if (!(el && el.nodeType && el.nodeType === 1)) {
            throw 'formula: `el` must be HTMLElement, and not ' + {}.toString.call(el);
        }

        options = _extend({}, options);

        this.el = el;
        //this.mode = options.mode;
        this.allItems = _parseItems(options.allItems);
        this.curItems = _parseItems(options.curItems);

        console.log(this.curItems);
    }


    /**
     * Parse formula Items if they exist
     * @param items
     * @returns null || JSON Objct
     * @private
     */
    function _parseItems(items) {

        if (items === null) {

            return null;

        } else {

            return JSON.parse(items);

        }

    }


    function _extend(dst, src) {
        if (dst && src) {
            for (var key in src) {
                if (src.hasOwnProperty(key)) {
                    dst[key] = src[key];
                }
            }
        }

        return dst;
    }



    /**
     * Create function instance
     * @param el - HTMLElement
     * @param options - Object
     * @returns {formula}
     */
    formula.create = function (el, options) {
        return new formula(el, options);
    };


    // Export
    formula.version = '0.0.0';
    return formula;


}();