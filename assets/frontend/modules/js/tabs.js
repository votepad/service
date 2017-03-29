var tabs = (function(tabs) {


    var nodes = [];


    tabs.init = function() {

        tabs.nodes = document.querySelectorAll('[data-toggle="tabs"]');

        if (tabs.nodes.length > 0) {
            for (var i = 0; i < tabs.nodes.length; i++) {
                tabs.nodes[i].addEventListener('click', changeTab, false);
            }
        }

    };


    var changeTab = function(event) {

        var tabBtn = event.target;

        if (! tabBtn.classList.contains('tabs__btn') )
            tabBtn = event.target.parentElement;

        var newBlock = document.getElementById(tabBtn.getAttribute('data-area')),
            blocksContent = newBlock.parentElement.children,
            headerTabs = tabBtn.parentElement.parentElement.getElementsByTagName("a");


        /**
         * Change header active tabBtn
         */
        for (var i = 0; i < headerTabs.length; i++) {
            headerTabs[i].classList.remove("tabs__btn--active");
        }
        tabBtn.classList.add("tabs__btn--active");


        /**
         * Change tabs content
         */
        for (var i = 0; i < blocksContent.length; i++) {
            blocksContent[i].classList.remove("tabs__block--active");
        }
        newBlock.classList.add("tabs__block--active");

    };

    return tabs;

})({});
