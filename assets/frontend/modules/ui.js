/**
 * @copyright Khaydarov Murod
 */

var ui = (function(ui) {

    ui.make = function() {
        
        return nwe.uploader.draw.node("INPUT", "", { type: "file", tt: nwe.uploader.core.settings.handler.id } );
    };

    return ui;

})({});

module.exports = ui;
