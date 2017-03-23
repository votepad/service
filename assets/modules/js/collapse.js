var collapse = (function(collapse) {


    collapse.nodes = {};


    collapse.init = function() {

        collapse.nodes = document.querySelectorAll('[data-toggle="collapse"]');

        if (collapse.nodes.length > 0) {
            var nodeBtn, nodeList;

            for (var i = 0; i < collapse.nodes.length; i++) {

                nodeBtn = collapse.nodes[i];
                nodeList = document.getElementById(collapse.nodes[i].getAttribute('area-control'));

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
            nodeList = document.getElementById(event.target.getAttribute('area-control'));


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
        nodeBtn.classList.remove('collapsed');
        nodeList.style.height = nodeListHeight(nodeList) + "px";
        nodeList.classList.add('in');
    };


    var removeCollapse = function (nodeBtn, nodeList) {
        nodeBtn.classList.add('collapsed');
        nodeList.style.height = "0";
        nodeList.classList.remove('in');
    };


    var nodeListHeight = function (nodeList) {
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