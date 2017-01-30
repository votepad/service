$(document).ready(function () {


    $('#OpenMobileHeader').click(function () {
        if ( $(window).width() < 390 ) {
            $('.header-btn').css('display','none');
        }

        if ( $(this).hasClass('mobile-open') ) {
            $('body').find('.mobile-close').click();
        } else {
            $('body').addClass('mobile-open').append('<div class="mobile-close"></div>');;
            $('#HeaderMobile').animateCss('fadeInLeft');
            $('#HeaderMobile').addClass("open");
            $('.header_text-logo').wait(200).addClass("mobile-open");
            $('#OpenMobileHeader').addClass("mobile-open");
        }
    });

    $('body').on('click', '.mobile-close', function() {
        $('#HeaderMobile').animateCss('fadeOutLeft');
        $('#HeaderMobile').wait(200).removeClass("open animated fadeOutLeft");
        $('body').removeClass('mobile-open')
        $('.header_text-logo').wait(100).removeClass("mobile-open");
        $('#OpenMobileHeader').wait(100).removeClass("mobile-open");
        $('.header-btn').css('display','block');
        $(this).remove();
    });

    $(window).resize(function () {
        if ( $(window).width() > 992 && $('body').hasClass('mobile-open') ) {
            $('body').find('.mobile-close').click();
        }
        if ( $(window).width() < 390 ) {
            $('.header-btn').css('display','none');
        } else {
            $('.header-btn').css('display','block');
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
        $('body').animate({ scrollTop: 620 }, 600);
    });

    $('#toTop').click(function(){
        $('body').animate({ scrollTop: 0 }, 600);
    });

});
