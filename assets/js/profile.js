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
        
        var url = location.protocol+'//'+location.hostname+'/pronwe/';
        
        $('.editable').editable({
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
            }
        });

        $('#sex').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'select',
            name: 'sex',
            emptytext: 'Не заполнено',
            source: [
                {value: 1, text: 'Мужской'},
                {value: 2, text: 'Женский'}
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
            type: 'tel',
            name: 'number',
            placeholder: '+79991234567',
        });
        
        $('#city').editable({
            url: url+'/Profile_Ajax/update/',
            type: 'select',
            name: 'city',
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
            source: [
                {value: 1, text: 'Санкт-Петербург'},
                {value: 2, text: 'Москва'},
                {value: 3, text: 'Пермь'},
                {value: 4, text: 'Екатеренбург'},
                {value: 5, text: 'Сочи'},
            ],
        });    

        function readURL(input) {
            if (input.files && input.files[0]) {
                var type   = ['image/gif','image/jpg','image/jpeg','image/png'];
                var width  = 1024;
                var height = 768;
                var size   = 525000; // bytes
                var file   = input.files[0];
                function errType () {
                    alert('Error type ...');
                    input.value = '';
                }
                function errSize () {
                    alert('Error size ...');
                    input.value = '';
                }
                function errWidth() {
                    alert('Error width ...');
                    input.value = '';
                }
                function errHeight() {
                    alert('Error height ...');
                    input.value = '';
                }
                if (type.indexOf(file.type) == -1) {
                    errType ();
                    return false;
                } else if (file.size > size) {
                    errSize();
                    return false;
                } else if (file.width < width) {
                    errWidth();
                    return false;
                } else if (file.height < height) {
                    errHeight();
                    return false;
                } else {
                    var reader = new FileReader();            
                        reader.onload = function (e) {
                            $('#image').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                }
            }
        }
        
        $("#choose-image").change(function(){
            readURL(this);
        });

    });
})(window, document, window.jQuery);
