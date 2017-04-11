var formula = function(formula) {


    var __formulaList   = null,
        __additionList  = [];

    
    function formula(el, options) {

        if (!(el && el.nodeType && el.nodeType === 1)) {
            throw 'formula: `el` must be HTMLElement, and not ' + {}.toString.call(el);
        }


        this.el = el;
        this.mode = options.mode;
        this.allItems = __parseItems(options.allItems);
        this.curItems = __parseItems(options.curItems);
        this.toJSON   = __toJSON;

        if (this.mode === "print") {
            __print(this);
        } else if (this.mode === "create") {
            __create(this);
        }
    }


    /**
     * Create New formula
     * @param formula
     * @private
     */
    function __create(formula) {

        var area    = document.createElement('div'),
            label   = document.createElement('label'),
            ul      = document.createElement('ul'),
            input   = document.createElement('input');

        area.className  = "formula__area clear_fix";
        label.className = "formula__label";
        ul.className    = "formula__list";

        var add = document.createElement('div'),
            icon_add = document.createElement('i');

        add.className = "formula__item-add";
        icon_add.className = "fa fa-plus";
        label.innerHTML = "Формула";
        input.type = "hidden";
        input.name = "formula";

        add.append(icon_add);
        area.append(input);
        area.append(label);
        area.append(ul);
        area.append(add);

        formula.el.appendChild(area);

        __formulaList = ul;

        __createAdditionList(formula.allItems);
        document.body.addEventListener('click', __hideAdditionList);
        add.addEventListener('click', __showAdditionList);

    }


    /**
     * Add item to `formula__list`
     * Remove item from __additionList
     * @param event
     * @private
     */
    function __addFormulaItem(event) {
        var element = __additionList[event.target.id];
        __additionList.splice(event.target.id, 1);

        var item = __createFormulaItem(element);
        __formulaList.append(item);
    }


    /**
     * Create item for `formula__list`
     * @param element
     * @private
     */
    function __createFormulaItem(element) {
        var item = document.createElement('div'),
            close = document.createElement('i'),
            input = document.createElement('input'),
            multiply = document.createElement('i'),
            name = document.createElement('span');

        item.className = "formula__item";
        item.dataset.id = element.dataset.id;
        close.className = "fa fa-times formula__item-icon";
        close.dataset.id = element.id;
        close.dataset.name = element.innerHTML;
        close.addEventListener('click', __removeFormulaItem);
        input.className = "formula__item-input";
        input.value = "1";
        input.type = "number";
        input.step = "0.1";
        multiply.className = "fa fa-circle formula__item-multiply";
        name.className = "formula__item-name";
        name.innerHTML = element.innerHTML;

        item.append(close);
        item.append(input);
        item.append(multiply);
        item.append(name);

        return item;
    }


    /**
     * Remove item from `formula__list`
     * Add item to __additionList
     * @param event
     * @private
     */
    function __removeFormulaItem(event) {
        var li = document.createElement('li');
        li.className = "formula__addition-item";
        li.dataset.id = event.target.dataset.id;
        li.innerHTML = event.target.dataset.name;
        li.addEventListener('click', __addFormulaItem);
        __additionList.push(li);
        event.target.parentNode.remove();
    }


    /**
     * Show AdditionList on click
     * @param event
     * @private
     */
    function __showAdditionList(event) {
        if (event.target.parentNode.children.length == 1) {
            event.target.parentNode.append(__printAdditionList());
        }
    }


    /**
     * Hide AdditionList on click
     * @param event
     * @private
     */
    function __hideAdditionList(event) {
        var list = document.querySelector('.formula__addition-list');
        if (!event.target.parentNode.classList.contains('formula__item-add') && list !== null) {
            list.remove();
        }
    }


    /**
     * Print AdditionList
     * @returns {Element}
     * @private
     */
    function __printAdditionList() {
        var ul = document.createElement('ul');
            ul.className = "formula__addition-list";

        if (__additionList.length > 0) {
            for (var i = 0; i < __additionList.length; i++) {
                __additionList[i].id = i;
                ul.append(__additionList[i]);
            }
        } else {
            var span = document.createElement('span');
            span.className = "formula__addition-item";
            span.innerHTML = "Элементы не найдены";
            ul.append(span);
        }

        return ul;
    }


    /**
     * Create Addition List on init
     * @param items
     * @private
     */
    function __createAdditionList(items) {

        for (var i = 0; i < items.length; i++) {
            var li = document.createElement('li');
            li.className = "formula__addition-item";
            li.dataset.id = items[i].id;
            li.innerHTML = items[i].name;
            li.addEventListener('click', __addFormulaItem);
            __additionList.push(li);
        }

    }


    /**
     * Print formula
     * @param formula
     * @private
     */
    function __print(formula) {

        var item, name, coeff, plus, multiply;

        for (var i = 0; i < formula.curItems.length; i++) {
            item = document.createElement('span');
            item.classList = "formula__print";
            item.dataset.id = formula.curItems[i].id;

            plus = document.createElement('span');
            plus.className = "formula__print-math";
            plus.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i>';

            multiply = document.createElement('span');
            multiply.className = "formula__print-math";
            multiply.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';

            name = document.createElement('span');
            name.className = "formula__print-name";
            name.innerHTML = formula.curItems[i].name;

            coeff = document.createElement('span');
            coeff.className = "formula__print-coeff";
            coeff.innerHTML = formula.curItems[i].coeff;

            item.append(name);
            item.append(multiply);
            item.append(coeff);
            if (i + 1 != formula.curItems.length) {
                item.append(plus);
            }

            formula.el.append(item)
        }

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


    function __toJSON() {
        var arr = [], out;

        for (var i = 1; i < __formulaList.children.length; i++) {
            out = {
                "id": __formulaList.children[i].dataset.id,
                "name":__formulaList.children[i].children[3].innerHTML,
                "coeff":__formulaList.children[i].children[1].value

            };
            arr.push(out);
        }
        return JSON.stringify(arr);

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