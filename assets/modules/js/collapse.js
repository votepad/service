var collapse = (function(collapse) {


    var nodes = {};


    collapse.init = function() {

        collapse.nodes = document.querySelectorAll('[data-toggle="collapse"]');

        if (collapse.nodes.length > 0) {
            var nodeBtn, nodeList;

            for (var i = 0; i < collapse.nodes.length; i++) {

                nodeBtn = collapse.nodes[i];
                nodeList = document.getElementById(collapse.nodes[i].dataset.area);

                if (checkCollapse(nodeBtn)){
                    addCollapse(nodeBtn, nodeList);
                } else {
                    removeCollapse(nodeBtn, nodeList);
                }

                collapse.nodes[i].addEventListener('click', changeCollapse, false);

            }

        }

    };


    var changeCollapse = function (event) {
        var nodeBtn = event.target,
            nodeList = document.getElementById(event.target.dataset.area);

        if (checkCollapse(nodeBtn)){
            addCollapse(nodeBtn, nodeList);
        } else {
            removeCollapse(nodeBtn, nodeList);
        }

    };


    var checkCollapse = function (nodeBtn) {
        if (nodeBtn.classList.contains('collapsed'))
            return true;
        return false;
    };


    var addCollapse = function (nodeBtn, nodeList) {
        nodeList.style.height = calculateHeight(nodeList) + "px";
        nodeList.classList.add('collapse--open');
        nodeBtn.classList.remove('collapsed');
    };


    var removeCollapse = function (nodeBtn, nodeList) {
        nodeList.style = "";
        nodeList.classList.remove('collapse--open');
        nodeBtn.classList.add('collapsed');
    };


    var calculateHeight = function (nodeList) {
        var height = 0;
        for (var i = 0; i < nodeList.childNodes.length; i++) {
            if (nodeList.childNodes[i].className) {
                height += nodeList.childNodes[i].clientHeight;
            }
        }
        return height;
    };


    return collapse;


})({});