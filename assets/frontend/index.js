/**
 * @copyright Khaydarov Murod
 */

var nwe = (function(nwe) {

    nwe.init = function() {

        Promise.resolve()

            .then(nwe.ui.make.input)

            .catch(function() {
                console.log('something gone');
            });

    };

    return nwe;

})({});

