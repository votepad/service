$(document).ready(function () {


    $("openMobileMenu").on("click", function () {
        $(this).addClass('header-wrapper_btn--open');
    });



    $('body').on('click', '.mobile-close', function() {
        $('#HeaderMobile').animateCss('fadeOutLeft');
        $('#HeaderMobile').wait(200).removeClass("open animated fadeOutLeft");
        $('body').removeClass('mobile-open')
        $('.header_text-logo').wait(100).removeClass("mobile-open");
        $('#OpenMobileHeader').wait(100).removeClass("mobile-open");
        $(this).remove();
    });

    $(window).resize(function () {
        if ( $(window).width() > 992 && $('body').hasClass('mobile-open') ) {
            $('body').find('.mobile-close').click();
        }
    });

    $(window).scroll(function () {
        if ( $(window).scrollTop() > 620 ) {
            $('#toTop').css('display','block');
        } else {
            $('#toTop').css('display','none');
        }
    });

    $('#ToSection2').click(function(){
        $('body').animate({ scrollTop: $('.section-2').offset().top }, 600);
    });

    $('.toEvents').click(function(){
        $('body').animate({ scrollTop: $('.section-4').offset().top }, 600);
    });
    if (window.location.href.split('/')[3] == "#events") {
        $('body').animate({ scrollTop: $('.section-4').offset().top }, 600);
    }
    if (window.location.href.split('/')[3] == "features#scoringsystem") {
        $('body').animate({ scrollTop: $('.section-scoringsystem').offset().top - 65 }, 600);
    }
    if (window.location.href.split('/')[3] == "features#immediatelyresults") {
        $('body').animate({ scrollTop: $('.section-immediatelyresults').offset().top - 65 }, 600);
    }
    if (window.location.href.split('/')[3] == "features#correctlyresults") {
        $('body').animate({ scrollTop: $('.section-correctlyresults').offset().top - 65 }, 600);
    }

    $('#toTop').click(function(){
        $('body').animate({ scrollTop: 0 }, 600);
    });


    /**
    * Open Subscribe Form
    *
    $('.publish').click(function(){
        swal({
            title: 'Стань первым!',
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: 'Быть в курсе!',
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            html:
                'Совсем скоро наш сервис начнёт работу! Узнайте о старте первым, просто оставив нам вашу эл. почту!' +
                '<div class="input-field label-with-icon">' +
                    '<input type="email" id="publish_email" placeholder="Введите email" autofocus>' +
                    '<label for="publish_email" class="icon-label" style="left: 0;">' +
                        '<i aria-hidden="true" class="fa fa-envelope"></i>' +
                    '</label>' +
                '</div>' +
                'Хотите принять участие в beta-тестирование сервиса? <br><br>' +
                '<input type="checkbox" id="betatest" class="">' +
                '<label for="betatest"> Принять участие </label>',

            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    if ($('#publish_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#publish_email').val()) ) {
                        $.notify({
                            message: 'Вы ввели неправильно email. Попробуйте ввести снова!'
                        },{
                            type: 'danger'
                        });
                        $('#publish_email').addClass('invalid');
                    } else {
                        resolve([
                            $('#publish_email').val(),
                            $('#betatest').is(':checked')
                        ])
                    }
                })
            },
        }).then(function (result) {
            $.notify({
                message: 'Успешно! Совсем скоро Вам прийдет уведомление о запуске сервиса!'
            },{
                type: 'success'
            });
            // send data
            swal(JSON.stringify(result))
        })
    })


    /**
    * Open Feedback Form
    */
    var allowSimbols = new RegExp("[^a-zA-Zа-яА-Я0-9-_=№#%&*()«»!?,.;:@'\"\n ]");

    $('.askquestion').click(function(){
        swal({
            title: 'Связь с командой',
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: 'Узнать!',
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            html:
                'Если у вас возник вопрос, то не стесняйтесь спросить его у нас!' +
                '<div class="input-field label-with-icon">' +
                    '<input type="email" id="askquestion_email" placeholder="Email для обратной связи" autofocus>' +
                    '<label for="askquestion_email" class="icon-label" style="left: 0;">' +
                        '<i aria-hidden="true" class="fa fa-envelope"></i>' +
                    '</label>' +
                '</div>' +
                '<div class="input-field">'+
                    '<textarea id="question" name="question" placeholder="Напишете, что Вас интересует"></textarea>'+
                '</div>',

            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    if ($('#askquestion_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#askquestion_email').val()) ) {
                        $.notify({
                            message: 'Вы ввели неправильно email. Попробуйте ввести снова!'
                        },{
                            type: 'danger'
                        });
                        $('#askquestion_email').addClass('invalid');
                    } else if ( allowSimbols.test($('#question').val()) || $('#question').val() == ''  ) {
                        $.notify({
                            message: 'Вы используете запрещенные символы, пожалуйста исключите их!'
                        },{
                            type: 'danger'
                        });
                        $('#question').addClass('invalid');
                    } else {
                        resolve([
                            $('#askquestion_email').val(),
                            $('#question').val()
                        ])
                    }
                })
            },
        }).then(function (result) {
            $.notify({
                message: 'Успешно! Мы ответим вам в ближайшее время!'
            },{
                type: 'success'
            });
            // send data
            swal(JSON.stringify(result))
        })
    });

});
