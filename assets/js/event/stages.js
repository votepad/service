$(document).ready(function() {

    /*
     *  Create Tooltips
    */
     $('[data-toggle="tooltip"]').tooltip()

    /*
     *  Vars
    */

    var url = "";


    /*
     *  Open new_stage form
    */
    $('#new_stage').click(function() {
        $(this).addClass('open');
    });



    /*
     *  Close new_stage form if inputs are empty
    */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#new_stage").is('#new_stage') && $('#name-0').val() == "" && $('#description-0').val() == ""
                && $("#participants-0").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#team-0").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#formula-0").val() == "")
        {
            $('#new_stage').removeClass('open');
            checking_el_valid($('#name-0'), 'valid');
            checking_el_valid($('#description-0'), 'valid');
            checking_el_valid($("#participants-0"), 'valid');
            checking_el_valid($("#team-0"), 'valid');
        }
    });



    /*
     *  Create select2 for new_stage form
    */
    $('.elements_in_stage').select2({
        language: 'ru',
        templateResult: render_image_for_select2
    });
    $("#group-0").select2({
        language: 'ru',
    });


    /*
     * change stage members
    */
    $("#part").click(function(){
        $("#show_participants").removeClass("displaynone");
        $("#show_teams").addClass("displaynone");
        $("#show_groups").addClass("displaynone");
        $("#team-0").val(null).trigger("change");
        $("#group-0").val(null).trigger("change");
    });

    $("#team").click(function(){
        $("#show_teams").removeClass("displaynone");
        $("#show_participants").addClass("displaynone");
        $("#show_groups").addClass("displaynone");
        $("#participants-0").val(null).trigger("change");
        $("#group-0").val(null).trigger("change");
    });

    $("#group").click(function(){
        $("#show_groups").removeClass("displaynone");
        $("#show_participants").addClass("displaynone");
        $("#show_teams").addClass("displaynone");
        $("#participants-0").val(null).trigger("change");
        $("#team-0").val(null).trigger("change");
    });


    /*
     *   Btn Submit new_stage form
     *   including validation via inputmask
    */
    $('#create_stage').click(function() {
        var form = $(this).closest('form'),
            stat_1, stat_2, stat_3;

        stat_1 = checking_el_valid($('#name-0'), '');
        stat_2 = $('#formula-0').val() != "";
        if ( ! $("#show_participants").hasClass("displaynone") ) {
            stat_3 = checking_el_valid($("#participants-0"), '');
        } else if ( ! $("#show_teams").hasClass("displaynone") ) {
            stat_3 = checking_el_valid($("#team-0"), '');
        } else {
            stat_3 = checking_el_valid($("#group-0"), '');
        }

        if ( stat_1 == true && stat_2 == true &&stat_3 == true) {
            form[0].submit();
        } else {
            $.notify({
                message: 'Пожалуйста, проверьте правильность введенных данных.'
            },{
                type: 'danger'
            });
        }
    });


    /*
     * On change Input Field
    */
    $('body').on('blur', 'input[type="text"]', function(){
        checking_el_valid($(this));
    });


    /*
     * On load Add hidden class on long text in card_content-text
    */
    $('.card').each(function () {
        var first = $('.card_content-text:nth-child(1)', this),
            second = $('.card_content-text:nth-child(2)', this),
            third = $('.card_content-text:nth-child(3)', this);

        if (first.height() > 64) {
            first.addClass('card_height-4em').append('<div class="card_content-text-hidden"  title="Показать полностью"></div>');
        }
        if (second.height() > 48) {
            second.addClass('card_height-3em').append('<div class="card_content-text-hidden" title="Показать полностью"></div>');
        }
        if (third.height() > 64) {
            third.addClass('card_height-4em').append('<div class="card_content-text-hidden" title="Показать полностью"></div>');
        }
    });



    /*
     *   Generate Modal Form for changing information about stage
    */
    $('.edit').click(function(){
        var card = this.closest('.card'),
            id = card.getAttribute('id'),
            name = $.trim(document.getElementById('name_' + id).innerHTML),
            about = $.trim(document.getElementById('description_' + id).innerHTML),
            part = $.trim(document.getElementById('participants_' + id).innerHTML),
            team = $.trim(document.getElementById('teams_' + id).innerHTML),

            modal_name = document.getElementById('editstage_name'),
            modal_about = document.getElementById('editstage_about'),
            modal_members = document.getElementById('editstage_members');


        //  Fill modal information
        modal_name.value = name;
        modal_about.innerHTML = about;
        if ( part == "") {
            modal_members.innerHTML = team;
        } else {
            modal_members.innerHTML = part;
        }


        // initialize select2
        $("#editstage_members").select2({
            language: 'ru',
            templateResult: render_image_for_select2
        });

        // initialize textarea_resize
        $($("editstage_about")).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        // initialize modal
        $("#editstage_modal").modal({
            backdrop: 'static',
            keyboard: false
        });

    });



    /*
     *   Save Modification in Modal Form
    */
    $('body').on('click', '#update-info', function(){
        var form = $(this).closest('.modal'),
            id = form.attr('id').replace('modal_', ''),
            stat_1 = checking_el_valid($("#" + id + "_name")),
            stat_2 = checking_el_valid($("#" + id + "_description")),
            stat_3;

            if ( ! $("#modal_show_participants").hasClass("displaynone") ) {
                stat_3 = checking_el_valid($("#" + id + "_participants"));
            } else {
                stat_3 = checking_el_valid($("#" + id + "_teams"));
            }

            if ( stat_1 == true && stat_2 == true && stat_3 == true) {
                form[0].submit();
            } else {
                $.notify({
                    message: 'Пожалуйста, проверьте правильность введенных данных.'
                },{
                    type: 'danger'
                });
            }
    });

    /*
     *  Delete stage
    */
    $('.delete').click(function(){

        if (!confirm("Вы уверены что хотите продолжить это действие?"))
            return;

        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var stagePk = $('#stage-' + dataPk).get(0),
            eventPk = $('#event_id').val();

        /*$.ajax({
            url : '/stages/delete/' + eventPk + '/' + dataPk,
            data : {},
            success : function(callback) {
                stagePk.remove();
            },
            error : function(callback) {
                console.log("Something gone wrong");
            }
        })*/

    });




    /*
     *    Function for Rendering Image for select2 elements
    */
    function render_image_for_select2 (el) {
        if (!el.id) {
            return el.text;
        }
        var $el = $(
            '<span class="select2-results__withlogo"><img src="' + url + '/' + el.element.dataset.logo + '" class="select2-results__logo" /> <span class="select2-results__text">' + el.text + '</span></span>'
        );
        return $el;
    };


    /*
     *   Function for Checking on Valid new_stage Form
    */
    function checking_el_valid($el, status) {

        var arr = new RegExp("[^a-zA-Zа-яА-Я0-9-_=№#%&*()«»!?,.;:@'\"\n ]");

        if ( status == 'valid' ) {
            $el.removeClass('invalid');
            return;
        }

        if ( $el.closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0 && $el.attr('multiple')) {
            $el.addClass('invalid');
            return false;
        } else if ( $el.attr('multiple') ) {
            $el.removeClass('invalid');
            return true;
        }

        if ( $el.val() == "" ) {
            $el.addClass('invalid');
            return false;
        } else if ( arr.test($el.val()) ){
            $el.addClass('invalid');
            return false;
        } else {
            $el.removeClass('invalid');
            return true;
        }

    }

});
