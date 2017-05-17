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
            $('.modal-backdrop').click();
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
        $('.modal-backdrop').click();
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


});
