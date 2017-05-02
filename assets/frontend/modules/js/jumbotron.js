var jumbotron = (function(jumbotron) {

    var address     = null,
        elements    = null,
        elAddress    = null;

    var prepare__ = function () {

        address = window.location.pathname.split('/');
        address =   '/' + address[1] + '/' + address[2] + '/' + address[3] + '/' + address[4];
        
        elements = document.getElementsByClassName('jumbotron__nav-btn');

        for (var i = 0; i < elements.length; i++ ) {

            if ( elements[i].hasAttribute('href') ) {
                elAddress = elements[i].getAttribute('href').split('/');
                elAddress = new RegExp(elAddress[1] + '/' + elAddress[2] + '/' + elAddress[3] + '/' + elAddress[4]);
            }

            if ( elAddress.test(address) ) {
                elements[i].classList.add('active');
            } else {
                elements[i].classList.remove('active');
            }
        }
    };
    
    jumbotron.init = function () {
        prepare__();   
    };
    
    return jumbotron;

})({});

module.exports = jumbotron;