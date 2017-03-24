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

        if (event.target.parentNode.parentNode.classList.contains('dropdown')) {
            event = event.target.parentNode.parentNode;
        } else if (event.target.parentNode.classList.contains('dropdown')){
            event = event.target.parentNode;
        } else {
            event = event.target;
        }

        if (event.classList.contains('dropdown--open')) {
            event.classList.remove('dropdown--open');
        } else {
            event.classList.add('dropdown--open');
        }

    };

    var openDropdown = function (event) {
        event.target.classList.add('dropdown--open');
    };


    var hideDropdown = function (event) {
        event.target.classList.remove('dropdown--open');
    };

    return dropdown;


})({});