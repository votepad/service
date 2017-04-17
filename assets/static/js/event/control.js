$(document).ready(function () {

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

        $('#' + block + ' .dataTables_scrollHeadInner').css('width','100%');
        $('#' + block + ' .dataTable').css('width','100%');

    });

});