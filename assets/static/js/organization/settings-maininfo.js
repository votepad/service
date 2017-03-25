$(document).ready(function(){


    var url = window.location.href.split('/')[0]+"//"+window.location.href.split('/')[2],
        elements = [
            {
                name: "org_name",
                flag: true
            },
            {
                name: "org_site",
                flag: true
            },
            {
                name: "org_description",
                flag: true
            },
            {
                name: "official_org_site",
                flag: true
            },
        ];


    /**
    * Submit form
    */
    $('#update_main_info').submit(function () {

        var isValid = true;
        $('#update_main_info input, textarea').each(function(){
            id = $(this).attr('id');
            if (isValid == true) {
                isValid = isElementInvalid($(this), 'submit')
            }
        });

        if ( isValid) {
            $('#update_main_info').addClass('whirl');
            $("#org_site").inputmask('remove');
        } else {
            return false
        }

    });


    /**
    * Validation
    */
    $("#org_name").inputmask({
        mask: '*{1,60}',
        definitions: {
            '*': {
                validator: "[a-zA-Z0-9а-яА-Я№\"' ]",
            }
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        oncomplete: function(){
            isElementInvalid($(this), "valid");
        },
        onincomplete: function(){
            isElementInvalid($(this), "invalid");
        }
    });


    $("#org_site").inputmask({
        mask: '\\http://vote\\p\\a\\d.ru/*{4,20}',
        definitions: {
            '*': {
                validator: "[a-z0-9]",
            }
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        positionCaretOnClick: "none",

        oncomplete: function(){
            var $this = $(this),
                website = $("#org_site").inputmask('unmaskedvalue');

            /*
            **  Checking organization website in DB
            */
            $.when(
                $.ajax({
                    url: url + '/organization/checkwebsite/' + website,
                    type: "POST",
                    data: {
                        website: website
                    }
                })
            ).then(function( data) {
                if ( data == "false") {
                    isElementInvalid($this, "valid");
                }
                else {
                    if ( ! $this.parent().children('span').hasClass('error-block') ) {
                        $.notify({
                            message: 'К сожалению, такой адрес организации занят. Пожалуйста, придумайте другой адрес'
                        },{
                            type: 'danger'
                        });
                    }
                    isElementInvalid($this, "invalid");
                }
            });
        },
        onincomplete: function(){
            $("#org_site").closest('.input-field').find('.counter').text('');
            isElementInvalid($(this), "invalid");
        }
    });

    var allowedDescSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№\" ]");

    $("#org_description").on('keydown', function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode == 13) {
            e.preventDefault();
        }
    });

    $("#org_description").on('fucus, blur', function(e){
        if ( $(this).val() != "" && $(this).val().length > 1 && $(this).val().length < parseInt($(this).attr('length')) && ! allowedDescSymbols.test($(this).val()) ) {
            isElementInvalid($(this), "valid");
        } else {
            isElementInvalid($(this), "invalid");
        }
    });


    $("#official_org_site").inputmask({
        mask: '[\\http]|[\\http\\s]://*{2,}.a{2,}',
        definitions: {
            '*': {
                validator: "[a-zA-Zа-яА-Я0-9-]",
            },
            'a': {
                validator: "[a-zA-Zа-яА-Я0-9-_.!*'()@&=+$/?#]",
            },
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        positionCaretOnClick: "none",
        oncomplete: function(){
            isElementInvalid($(this), "valid");
        },
        onincomplete: function(){
            isElementInvalid($(this), "invalid");
        }
    });



    /**
     * Searching Elements in `elements` array
     */
    function findElement(name) {
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].name == name) {
                return i;
            }
        }
    }


    /**
     * Changing flag of elements progress + add/remove invalid class
     */
    function isElementInvalid($el, status) {

        var i = findElement($el.attr('name'));

        if (status == "valid" ) {

            $el.removeClass('invalid');
            if ( elements[i].flag == false ) {
                elements[i].flag = true;
            }

        } else if ( status == "invalid" ) {

            $el.addClass('invalid');
            if ( elements[i].flag == true ) {
                elements[i].flag = false;
            }

        } else if ( status == "submit" ) {

            if ( elements[i].flag == false ) {
                $el.addClass('invalid');
                return false;
            } else {
                $el.removeClass('invalid');
                return true;
            }

        }

    }

});
