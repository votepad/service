/**
 * Module for printing || creating || editing formulas
 *
 * @usage: formula.create(element, options);
 *
 * @element => HTML element
 * @options => { 'mode': @mode, 'allItems': @allItems, 'curItems': @curItems }
 *
 * @mode     => print||create||edit
 * @curItems => [{id: 1, name: 'name', coeff: '0.5'}]
 * @allItems => [{id: 1, name: 'name'}]
 *
 * @mode is required
 * @curItems is not required
 * @allItems is not required
 * 
 * @return JSON Object {id: coeff, id2: coeff2}
 */

var formula = function(formula) {

    var modes = {
            PRINT: "print",
            CREATE: "create",
            EDIT: "edit",
        },
        input = null,
        formulaNodes  = {
            list: null,
            additionList: null,
            additionItems: []
        };
    

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
        this.allItems = parseItems_(options.allItems);
        this.curItems = parseItems_(options.curItems);
        this.toJSON   = toJSON_;
        this.destroy  = destroy_;

        switch(this.mode) {

            case modes.PRINT:
                print_(this);
                break;

            case modes.CREATE:
                create_(this);
                break;

            case modes.EDIT:
                create_(this);
                update_(this);
                break;

            default:
                console.log("Mode is not allowed");
                break;

        }

    }


    /**
     * Parse formula Items if they exist
     * @param items
     * @returns null || JSON Object
     * @private
     */
    function parseItems_(items) {
        try {
            return JSON.parse(items);
        } catch (e) {
            return null;
        }
    }


    /**
     * Create New formula
     * @param formula
     * @private
     */
    function create_(formula) {

        var area    = vp.draw.node('DIV', 'formula__area clear_fix'),
            label   = vp.draw.node('LABEL','formula__label'),
            addBtn  = vp.draw.node('DIV','formula__item-add'),
            addIcon = vp.draw.node('I', 'fa fa-plus', {'aria-hidden':'true'});

        label.textContent = "Формула";

        formulaNodes.list          = vp.draw.node('UL','formula__list');
        formulaNodes.additionList  = vp.draw.node('UL', 'formula__addition-list hide');
        formulaNodes.additionItems = createAdditionItems_(formula.allItems);

        input      = vp.draw.node('INPUT','',{type:'hidden', name:'formula'});

        area.appendChild(input);
        area.appendChild(label);
        area.appendChild(formulaNodes.list);
        addBtn.appendChild(addIcon);
        addBtn.appendChild(formulaNodes.additionList);
        area.appendChild(addBtn);

        formula.el.appendChild(area);
        
        document.body.addEventListener('click', hideAdditionList_);
        addBtn.addEventListener('click', showAdditionList_);

    }
    

    /**
     * Create `formulaNodes.additionItems`
     * @param items
     * @returns {Array}
     * @private
     */
    function createAdditionItems_(items) {
        var arr = [], i, li;

        for (i = 0; i < items.length; i++) {

            li = vp.draw.node('LI', 'formula__addition-item', {'data-id': items[i].id});
            li.textContent = items[i].name;

            li.addEventListener('click', addFormulaItem_);
            arr.push(li);
        }

        return arr;
    }
    


    /**
     * Create item for `formulaNodes.list`
     * @param element
     * @returns {Element}
     * @private
     */
    function createFormulaItem_(element) {
        var item     = vp.draw.node('LI', 'formula__item', {'data-id': element.dataset.id}),
            close    = vp.draw.node('I', 'fa fa-times formula__item-icon', {'aria-hidden':'true', 'data-id': element.id, 'data-name': element.innerHTML}),
            input    = vp.draw.node('INPUT', 'formula__item-input', {value: '1', type: 'number', step: '0.1'}),
            multiply = vp.draw.node('I', 'fa fa-circle formula__item-multiply', {'aria-hidden':'true'}),
            name     = vp.draw.node('SPAN', 'formula__item-name');
        
        name.textContent = element.innerHTML;
        close.addEventListener('click', removeFormulaItem_);

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
    function addFormulaItem_(el) {
        var element = el.nodeType === 1 ? el : formulaNodes.additionItems[this.id];
        formulaNodes.additionItems.splice(this.id, 1);

        var item = createFormulaItem_(element);
        formulaNodes.list.appendChild(item);
    }


    /**
     * Remove item from `formulaNodes.list`
     * Add item to `formulaNodes.additionItems`
     * @private
     */
    function removeFormulaItem_() {
        var li = vp.draw.node('LI', 'formula__addition-item', {'data-id':this.dataset.id});
        
        li.textContent = this.dataset.name;
        li.addEventListener('click', addFormulaItem_);

        formulaNodes.additionItems.push(li);
        this.parentNode.remove();
    }
    

    /**
     * Show `formulaNodes.additionItems` on click
     * @private
     */
    function showAdditionList_() {

        getAdditionItems_();

        formulaNodes.additionList.classList.toggle('hide')

    }


    /**
     * Hide `formulaNodes.additionItems` on click
     * @private
     */
    function hideAdditionList_(event) {

        if ( ! formulaNodes.additionList.classList.contains('hide') &&
             ! event.target.parentNode.classList.contains('formula__item-add') )
        {

            formulaNodes.additionList.classList.add('hide');

        }

    }


    /**
     * Get `formulaNodes.additionItems`
     * @private
     */
    function getAdditionItems_() {

        formulaNodes.additionList.innerHTML = "";

        if (formulaNodes.additionItems.length > 0) {

            for (var i = 0; i < formulaNodes.additionItems.length; i++) {
                formulaNodes.additionItems[i].id = i;
                formulaNodes.additionList.appendChild(formulaNodes.additionItems[i]);
            }

        } else {

            var child = vp.draw.node('SPAN', 'formula__addition-item');

            child.textContent = "Элементы не найдены";

            formulaNodes.additionList.appendChild( child );

        }

    }



    function update_(formula) {

        for (var i = 0; i < formula.curItems.length; i++) {

            for (var j = 0; j < formulaNodes.additionItems.length; j++) {

                if (formula.curItems[i]["id"] === formulaNodes.additionItems[j].dataset.id) {
                    addFormulaItem_(formulaNodes.additionItems[j]);
                }

            }

        }


    }



    /**
     * Print formula
     * @param formula
     * @private
     */
    function print_(formula) {

        var item, name, coeff, multiply, multiplyIcon, i;

        for (i = 0; i < formula.curItems.length; i++) {

            item         = vp.draw.node('SPAN', 'formula__print', {'data-id': formula.curItems[i].id});
            multiply     = vp.draw.node('SPAN', 'formula__print-math');
            multiplyIcon = vp.draw.node('I','fa fa-times', {'aria-hidden':'true'});
            name         = vp.draw.node('SPAN', 'formula__print-name');
            coeff        = vp.draw.node('SPAN', 'formula__print-coeff');

            name.textContent  = formula.curItems[i].name;
            coeff.textContent = formula.curItems[i].coeff;

            multiply.appendChild(multiplyIcon);
            item.appendChild(name);
            item.appendChild(multiply);
            item.appendChild(coeff);

            formula.el.appendChild(item);
        }

    }


    /**
     * Create JSON String for saving in DB
     * @private
     */
    function toJSON_() {
        var arr = {}, i;

        for (i = 0; i < formulaNodes.list.childElementCount; i++) {

            arr[formulaNodes.list.children[i].dataset.id] = formulaNodes.list.children[i].children[1].value;

        }

        input.value = JSON.stringify(arr);

        return input.value !== "{}";
    }

    /**
     * Destroy Formula 
     * @private
     */
    function destroy_() {
        formula = null;
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
    formula.version = '0.0.2';
    return formula;

}();