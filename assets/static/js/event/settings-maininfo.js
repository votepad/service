$(document).ready(function() {

    $("#site").inputmask({
        mask: "\\http://vote\\p\\a\\d.ru/a{4,20}",
        definitions: {
            'a': {
                validator: "[a-z0-9]",
            }
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        clearIncomplete: true,
        oncomplete: function(){
            isElementInvalid($(this), "valid");
        },
        onincomplete: function(){
            isElementInvalid($(this), "invalid");
        }
    });

    $("#keywords").select2({
        tags: true,
        tokenSeparators: [',', ' ', ';', '.'],
    });


});