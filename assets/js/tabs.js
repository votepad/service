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


    var changeTab = function() {

        var newBlockId = this.getAttribute('aria-controls'),
            newBlock = document.getElementById(newBlockId),
            blocksContent = newBlock.parentElement.children,
            headerTabs = this.parentElement.parentElement.children,
            className;

        /**
         * Change header active tab
         */
        for (var i = 0; i < headerTabs.length; i++) {
            className = headerTabs[i].children[0].className.replace(" ui_tab-active", "");
            headerTabs[i].children[0].className = className;
        }

        this.className = this.className + " ui_tab-active";


        /**
         * Change tabs content
         */
        for (var i = 0; i < blocksContent.length; i++) {
            className = blocksContent[i].className.replace(" active", "");
            blocksContent[i].className = className;
        }

        newBlock.className = newBlock.className + " active";

    };

    return tabs;

})({});
