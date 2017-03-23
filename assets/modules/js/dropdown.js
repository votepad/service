var dropdown = (function(dropdown) {


    dropdown.nodes = {};


    dropdown.init = function() {

        dropdown.nodes = document.querySelectorAll('[data-toggle="dropdown"]');

        for (var i = 0; i < dropdown.nodes.length; i++) {
            dropdown.nodes[i].addEventListener('mouseenter', openDropdown, false);
            dropdown.nodes[i].addEventListener('mouseleave', hideDropdown, false);
            dropdown.nodes[i].addEventListener('click', changeDropdown, false);
        }

    };


    var changeDropdown = function (event) {

        if (event.target.parentNode.classList.contains('dropdown') && ! event.target.parentNode.classList.contains('open')) {
            event.target.parentNode.classList.add('open');
        } else {
            event.target.parentNode.classList.remove('open');
        }

        if (event.target.parentNode.parentNode.classList.contains('dropdown') && ! event.target.parentNode.parentNode.classList.contains('open')) {
            event.target.parentNode.parentNode.classList.add('open');
        } else {
            event.target.parentNode.parentNode.classList.remove('open');
        }

    };


    var openDropdown = function (event) {
        event.target.classList.add('open');
    };


    var hideDropdown = function (event) {
        event.target.classList.remove('open');
    };


    return dropdown;


})({});