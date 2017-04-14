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



    /** formate Dates */
    var today = moment(),
        start = moment($('#eventStartTime').val()),
        end = moment($('#eventEndTime').val());

    $('#eventTimeCounter').html(today.to(start));

    if (start.year() === end.year() && start.month() === end.month() && start.date() === end.date()) {
        $('#eventTime').html(start.format('D MMM YYYY с hh:mm') + " до " + end.format('hh:mm'));
    } else if (start.year() === end.year() && start.month() === end.month() && start.date() !== end.date()) {
        $('#eventTime').html(start.date() + "-" + end.date() + " " + start.format('MMM YYYY с hh:mm') + " до " + end.format('hh:mm'));
    } else if (start.year() === end.year() && start.month() !== end.month() && start.date() === end.date() || start.year() === end.year() && start.month() !== end.month() && start.date() !== end.date()) {
        $('#eventTime').html(start.format('D MMM') + " - " + end.format('D MMM YYYY') + " с " + start.format('hh:mm') + " до " + end.format('hh:mm'));
    } else {
        $('#eventTime').html(start.format('D MMM YYYY с hh:mm') + " - " + end.format('D MMM YYYY до hh:mm'));
    }


    /**  */
    $('[data-toggle="tabs"]').click(function () {

        var areas       = $(this).attr('data-block').split('_')[0],
            openedID    = $(this).attr('data-block').split('_')[1];


        $('.' + areas + '-header__item').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');

        $('.' + areas + '-body').each(function () {
            $(this).addClass('hide');
        });
        $('#' + $(this).attr('data-block')).removeClass('hide');


        console.log();
    })

});