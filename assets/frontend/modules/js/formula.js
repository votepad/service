/**
 * Module for printing || creating || editing formulas
 *
 * @usage: formula.create(element, options);
 *
 * @element => HTML element
 * @options => { 'mode': @mode, 'allItems': @allItems, 'curItems': @curItems }
 *
 * @mode     => print||create||edit
 * @curItems => [{'id':5, 'name':'Name1", 'coeff':'0.5'},{'id':6, 'name':'Name2", 'coeff':'0.4'}]
 * @allItems => [{'id':5, 'name':'Name1"},{'id':6, 'name':'Name2"}]
 *
 * @mode is required
 * Allow to use @allItems or @curItems or both
 */

var formula = function(formula) {


    var modes = {
            PRINT: "print",
            CREATE: "create",
        },
        input = null,
        formulaNodes  = {
            list: null,
            additionList: null,
            additionItems: []
        };



    /**
     * Create DOM element
     * @param el - string => 'div' || 'ul'
     * @param className - string => 'class1 class2'
     * @param html - string => 'text'
     * @returns {Element}
     */
    function createElement(el,className,html) {
        var el = document.createElement(el);

        className.split(' ').forEach(function (name) {
            el.classList.add(name);
        });

        el.innerHTML = html || '';

        return el;
    }


    /**
     * New formula
     * @param el - HTMLElement
     * @param options - Object
     */
    function formula(el, options) {

        if (!el.nodeType === 1) {
            throw 'formula: `el` must be HTMLElement, and not ' + {}.toString.call(el);
        }


        this.el       = el;
        this.mode     = options.mode;
        this.allItems = parseItems(options.allItems);
        this.curItems = parseItems(options.curItems);
        this.toJSON   = toJSON;

        switch(this.mode) {

            case modes.PRINT:
                print(this);
                break;

            case modes.CREATE:
                create(this);
                break;

            default:
                console.log("Mode is not allowed");
                break;

        }

    }


    /**
     * Create New formula
     * @param formula
     * @private
     */
    function create(formula) {

        var area    = createElement('div','formula__area clear_fix'),
            label   = createElement('label','formula__label', 'Формула'),
            addBtn  = createElement('div','formula__item-add'),
            addIcon = createElement('i', 'fa fa-plus');


        formulaNodes.list          = createElement('ul','formula__list');
        formulaNodes.additionList  = createElement('ul', 'formula__addition-list hide');
        formulaNodes.additionItems = createAdditionItems(formula.allItems);

        input      = document.createElement('input');
        input.type = "hidden";
        input.name = "formula";

        area.appendChild(input);
        area.appendChild(label);
        area.appendChild(formulaNodes.list);
        addBtn.appendChild(addIcon);
        addBtn.appendChild(formulaNodes.additionList);
        area.appendChild(addBtn);

        formula.el.appendChild(area);


        /**
         * TODO: change event listener
         */

        document.body.addEventListener('click', hideAdditionList);
        addBtn.addEventListener('click', showAdditionList);

    }






    /**
     * Create item for `formulaNodes.list`
     * @param element
     * @returns {Element}
     * @private
     */
    function createFormulaItem(element) {
        var item     = createElement('li', 'formula__item'),
            close    = createElement('i', 'fa fa-times formula__item-icon'),
            input    = createElement('input', 'formula__item-input'),
            multiply = createElement('i', 'fa fa-circle formula__item-multiply'),
            name     = createElement('span', 'formula__item-name', element.innerHTML);

        item.dataset.id = element.dataset.id;

        close.dataset.id = element.id;
        close.dataset.name = element.innerHTML;
        close.addEventListener('click', removeFormulaItem);

        input.value = "1";
        input.type = "number";
        input.step = "0.1";

        item.appendChild(close);
        item.appendChild(input);
        item.appendChild(multiply);
        item.appendChild(name);

        return item;
    }


    /**
     * Add item to `formulaNodes.list`
     * Remove item from `formulaNodes.additionItems`
     * @private
     */
    function addFormulaItem() {
        var element = formulaNodes.additionItems[this.id];
        formulaNodes.additionItems.splice(this.id, 1);

        var item = createFormulaItem(element);
        formulaNodes.list.appendChild(item);
    }


    /**
     * Remove item from `formulaNodes.list`
     * Add item to `formulaNodes.additionItems`
     * @private
     */
    function removeFormulaItem() {
        var li = createElement('li', 'formula__addition-item', this.dataset.name);

        li.dataset.id = this.dataset.id;
        li.addEventListener('click', addFormulaItem);

        formulaNodes.additionItems.push(li);
        this.parentNode.remove();
    }



    /**
     * Show `formulaNodes.additionItems` on click
     * @private
     */
    function showAdditionList() {

        getAdditionItems();

        formulaNodes.additionList.classList.toggle('hide')

    }


    /**
     * Hide `formulaNodes.additionItems` on click
     * @private
     */
    function hideAdditionList(event) {

        if ( ! formulaNodes.additionList.classList.contains('hide') &&
             ! event.target.parentNode.classList.contains('formula__item-add') )
        {

            formulaNodes.additionList.classList.add('hide');

        }

    }


    /**
     * Create `formulaNodes.additionItems`
     * @param items
     * @returns {Array}
     * @private
     */
    function createAdditionItems(items) {
        var arr = [], i, li;

        for (i = 0; i < items.length; i++) {

            li = createElement('li', 'formula__addition-item', items[i].name);
            li.dataset.id = items[i].id;

            li.addEventListener('click', addFormulaItem);
            arr.push(li);
        }

        return arr;
    }


    /**
     * Get `formulaNodes.additionItems`
     * @private
     */

    function getAdditionItems() {

        formulaNodes.additionList.innerHTML = "";

        if (formulaNodes.additionItems.length > 0) {

            for (var i = 0; i < formulaNodes.additionItems.length; i++) {
                formulaNodes.additionItems[i].id = i;
                formulaNodes.additionList.appendChild(formulaNodes.additionItems[i]);
            }

        } else {

            formulaNodes.additionList.appendChild( createElement('span', 'formula__addition-item', 'Элементы не найдены') );

        }

    }



    /**
     * Print formula
     * @param formula
     * @private
     */
    function print(formula) {

        var item, name, coeff, multiply, i;

        for (i = 0; i < formula.curItems.length; i++) {

            item = createElement('span', 'formula__print');
            item.dataset.id = formula.curItems[i].id;

            multiply = createElement('span', 'formula__print-math', '<i class="fa fa-times" aria-hidden="true"></i>');
            name     = createElement('span', 'formula__print-name', formula.curItems[i].name);
            coeff    = createElement('span', 'formula__print-coeff', formula.curItems[i].coeff);

            item.appendChild(name);
            item.appendChild(multiply);
            item.appendChild(coeff);

            formula.el.appendChild(item);
        }

    }


    /**
     * Parse formula Items if they exist
     * @param items
     * @returns null || JSON Object
     * @private
     */
    function parseItems(items) {
        try {
            return JSON.parse(items);
        } catch (e) {
            return null;
        }
    }


    function toJSON() {
        var arr = [], out, i;

        for (i = 0; i < formulaNodes.list.childElementCount; i++) {
            out = {
                "id": formulaNodes.list.children[i].dataset.id,
                "coeff":formulaNodes.list.children[i].children[1].value

            };
            arr.push(out);
        }

        input.value = JSON.stringify(arr);
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
    formula.version = '0.0.1';
    return formula;

}();