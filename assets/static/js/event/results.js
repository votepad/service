$(document).ready(function() {


    $('#participantResult, #teamResult, #groupResult').click(function () {
        $(this).addClass('open');
    });


    $('body').click(function(event) {
        if (    ! $(event.target).closest("#participantResult").is('#participantResult') &&
                ! $(event.target).closest("#teamResult").is('#teamResult') &&
                ! $(event.target).closest("#groupResult").is('#groupResult') ) {
            $('#participantResult').removeClass('open');
            $('#teamResult').removeClass('open');
            $('#groupResult').removeClass('open');
        }
    });

});
