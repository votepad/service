var dropdown = (function(dropdown) {


    var nodes = {};


    dropdown.init = function() {

        dropdown.nodes = document.querySelectorAll('[data-toggle="dropdown"]');

        for (var i = 0; i < dropdown.nodes.length; i++) {
            dropdown.nodes[i].addEventListener('mouseenter', openDropdown, false);
            dropdown.nodes[i].addEventListener('mouseleave', hideDropdown, false);
            dropdown.nodes[i].addEventListener('click', changeDropdown, false);
        }

    };


    var changeDropdown = function (event) {

        if (event.target.parentNode.parentNode.classList.contains('dropdown-block')) {
            event = event.target.parentNode.parentNode;
        } else if (event.target.parentNode.classList.contains('dropdown-block')){
            event = event.target.parentNode;
        } else {
            event = event.target;
        }

        if (event.classList.contains('dropdown-block--open')) {
            event.classList.remove('dropdown-block--open');
        } else {
            event.classList.add('dropdown-block--open');
        }

    };

    var openDropdown = function (event) {
        event.target.classList.add('dropdown-block--open');
    };


    var hideDropdown = function (event) {
        event.target.classList.remove('dropdown-block--open');
    };

    return dropdown;


})({});