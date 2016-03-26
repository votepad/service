// Xeditable Demo
// ----------------------------------- 

(function(window, document, $, undefined){
    
    $(function(){

        // Font Awesome support
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-success btn-sm editable-submit">'+
                '<i class="fa fa-fw fa-check"></i>'+
            '</button>'+
            '<button type="button" class="btn btn-default btn-sm editable-cancel">'+
                '<i class="fa fa-fw fa-times"></i>'+
            '</button>';

        //defaults
        $.fn.editable.defaults.url = '/Ajax/Editable';
        $.fn.editable.defaults.mode = 'inline';
        //enable / disable
        $('#enable').click(function() {
            $('#user .editable').editable('toggleDisabled');
        });
        
        var url = location.protocol+'//'+location.hostname+'/pronwe/';
        
        $('#surname').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'text',
            name: 'surname',
            emptytext: 'Не заполнено',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
            validate: function(value) {
                if($.trim(value) === '') return 'Заполните поле';
            }
        });

        $('#name').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'text',
            name: 'name',
            emptytext: 'Не заполнено',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
            validate: function(value) {
                if($.trim(value) === '') return 'Заполните поле';
            }
        });

        $('#lastname').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'text',
            name: 'lastname',
            emptytext: 'Не заполнено',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
            validate: function(value) {
                if($.trim(value) === '') return 'Заполните поле';
            }
        });

        $('#sex').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'select',
            name: 'sex',
            prepend: 'Не выбрано',
            emptytext: 'Не заполнено',
            source: [
                {value: 'Мужской', text: 'Мужской'},
                {value: 'Женский', text: 'Женский'}
            ],
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
            validate: function(value) {
                if($.trim(value) === '') return 'Заполните поле';
            }
        });

        $('#number').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'tel',
            name: 'number',
            placeholder: '+79991234567',
            emptytext: 'Не заполнено',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
            validate: function(value) {
                if($.trim(value) === '') return 'Заполните поле';
            }
        });
        
        /*$('#city').editable({
            url: url+'/Profile_Ajax/update/',
            emptytext: 'Не заполнено',
            typeahead: {
                name: 'city',
                local: [
                    {value: 'ru', tokens: ['Russia']}, 
                    {value: 'gb', tokens: ['Great Britain']}, 
                    {value: 'us', tokens: ['United States']}
                ],
                template: function(item) {
                    return item.tokens[0] + ' (' + item.value + ')'; 
                },
            },
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
            validate: function(value) {
                if($.trim(value) === '') return 'Заполните поле';
            }
        });*/

        $('#city').editable({
        value: '',
        url: url+'/Profile_Ajax/update/',
        emptytext: 'Не заполнено',
        ajaxOptions: {
            dataType: 'json'
        },
        success: function(data, config) {
            console.log(data);
        },
        error: function(data) {
            console.log(data);
        },
        validate: function(value) {
            if($.trim(value) === '') return 'Заполните поле';
        },
        typeahead: {
            name: 'city',
            local: ["Санкт-Петербург","Москва","Выборг","Екатеринбурге","Пермь","Сочи","Краснодар"] /*more: typeahead database php*/
        }
    });    


    });
})(window, document, window.jQuery);
