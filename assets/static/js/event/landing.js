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


    /**
     * Show/hide block and add/remove active class from btns
     */
    $('[data-toggle="tabs"]').click(function () {

        var areaGroup    = $(this).attr('data-btnGroup'),
            block        = $(this).attr('data-block');


        $('[data-btnGroup=' + areaGroup + ']').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');

        $('[data-blockGroup=' + areaGroup + ']').each(function () {
            $(this).addClass('hide');
        });
        $('#' + block).removeClass('hide');

    });


    /**
     *
     */

});