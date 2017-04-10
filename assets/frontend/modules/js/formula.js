var formula = function(formula) {

    function formula(el, options) {

        if (!(el && el.nodeType && el.nodeType === 1)) {
            throw 'formula: `el` must be HTMLElement, and not ' + {}.toString.call(el);
        }


        this.el = el;
        this.mode = options.mode;
        this.allItems = __parseItems(options.allItems);
        this.curItems = __parseItems(options.curItems);

        if (this.mode === "print") {
            __print(this);
        }
    }


    function __print(formula) {
        var output = "";
        for (var i = 0; i < formula.curItems.length; i++) {
            output += formula.curItems.name + "*" + formula.curItems.coeff + "+"
        }
        formula.el.innerHTML = output;
        console.log(formula.el);
    }


    /**
     * Parse formula Items if they exist
     * @param items
     * @returns null || JSON Object
     * @private
     */
    function __parseItems(items) {
        if (items === undefined) {
            return null;
        } else {
            return JSON.parse(items);
        }
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