$(document).ready(function(){

    /**
    * Open Modal for change Organization Site
    */
    $('#openChangeSiteModal').click(function(){
        swal({
            title: 'Изменение адреса сайта',
            buttonsStyling: false,
            confirmButtonText: 'Готово',
            confirmButtonClass: 'btn btn_primary',
            html:
                'Напишите письмо с темой "Изменить информацию об организации" с ссылкой на организацию.<br><br>' +
                'На эл.почту <a href="mailto:votepad@ya.ru">votepad@ya.ru</a>',

        });
    })




    /**
    * Submit form
    */
    $('#submit_btn').click(function () {
        var $valid;
        var form = $('#update_main_info');

        if ( checkingField('org_name') && checkingField('org_description') ) {
            $valid = true;
        } else {
            $valid = false;
        }

        if (officialSite == 'invalid') {
            $valid = false;
        }

        if ( $valid == true ) {
            form[0].submit();
        }

    });


    /**
    * Validation
    */
    var officialSite = 'valid';
    $("#official_org_site").inputmask({
        mask: '[\\http]|[\\http\\s]://*{2,}.a{2,}',
        definitions: {
            '*': {
                validator: "[a-zA-Zа-яА-Я0-9-]",
            },
            'a': {
                validator: "[a-zA-Zа-яА-Я0-9-.!'()@&=+$/?#]",
            },
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        positionCaretOnClick: "none",
        oncomplete: function(){
            officialSite = 'valid';
            $('#official_org_site').removeClass('invalid')
        },
        onincomplete: function(){
            officialSite = 'invalid';
            $('#official_org_site').addClass('invalid')
        }
    });


    /**
    * Test Symbols
    */
    var allowSimbols = new RegExp("[^a-zA-Zа-яА-Я0-9-_=№#%&*()«»!?,.;:@'\"\n ]");

    function checkingField(id) {
        var $this = $('#' + id);
        if ( allowSimbols.test($this.val()) ) {
            $this.addClass('invalid')
            errorSymbols();
            return false;
        } else if ( $this.val() == '') {
            $this.addClass('invalid')
            errorEmpty();
            return false;
        }

        return true;
    }


    /**
    * Notify Messages
    * - error symbols
    * - emty field
    */
    function errorSymbols() {
        $.notify({
            message: 'Вы используете запрещенные символы, пожалуйста исключите их!'
        },{
            type: 'danger'
        });
    }

    function errorEmpty() {
        $.notify({
            message: 'Вы ничего не ввели, пожалуйста введите информацию!'
        },{
            type: 'danger'
        });
    }

});
