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


    var changeTab = function(event) {

        var node = event.target;
        if (! node.classList.contains('tab') )
            node = event.target.parentElement;


        var newBlockId = node.getAttribute('aria-controls'),
            newBlock = document.getElementById(newBlockId),
            blocksContent = newBlock.parentElement.children,
            headerTabs = node.parentElement.parentElement.getElementsByTagName("li"),
            className;

        /**
         * Change header active tab
         */
        for (var i = 0; i < headerTabs.length; i++) {
            headerTabs[i].children[0].classList.remove("tab--active");
        }

        node.classList.add("tab--active");


        /**
         * Change tabs content
         */
        for (var i = 0; i < blocksContent.length; i++) {
            blocksContent[i].classList.remove("tab_block--active");
        }

        newBlock.classList.add("tab_block--active");

    };

    return tabs;

})({});

module.exports = tabs;
