$(document).ready(function () {

    $('.header-landing__menu-icon').click(function () {
       $('.header-landing__menu').addClass('fadeInDown').addClass('show');
       $('body').append('<div class="backdrop"></div>');
    });

    $('body').on('click', '.backdrop', function () {
        $('.header-landing__menu').removeClass('fadeInDown').addClass('fadeOutUp');
        setTimeout(function () {
            $('.header-landing__menu').removeClass('show').removeClass('fadeOutUp');
            $('.backdrop').remove();
        }, 400);
    });

    $('.toDescription').click(function () {
        $('body').animate({ scrollTop: $('#eventDescription').offset().top }, 600);
    });

    $('.toResults').click(function () {
        $('body').animate({ scrollTop: $('#eventResult').offset().top }, 600);
    });

});