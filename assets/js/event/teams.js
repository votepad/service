$(document).ready(function() {

    /*
     *  Vars
    */

    var url = "http://pronwe/assets/img/user",
        template_modal = ['<form class="modal fade" id="',
                            '" tabindex="-1" role="dialog" aria-labelledby="',
                            '" method="post" action="',
                            '"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" aria-hidden="true"></i></button><h4 class="modal-title" id="',
                            '">Редактирование информации о команде</h4></div><div class="modal-body"><div class="row"><div class="input-field"><input type="text" id="',
                            '" name="name" value="','"><label for="','" class="active">Название команды</label></div></div><div class="row"><div class="input-field"><textarea id="',
                            '" name="description">','</textarea><label for="','" class="active">Описание команды</label></div></div><div class="row"><div class="input-field"><select multiple id="',
                            '" name="participants">','</select><label for="','">Состав команды</label></div></div><label class="btn btn_default btn_labeled" for="','"><span class="btn_label"><i class="fa fa-paperclip" aria-hidden="true"></i></span><span class="btn_text">Выбрать логотип</span><input type="file" id="',
                            '" name="logo" accept="image/*"></label></div><div class="modal-footer"><button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button><button id="update-info" type="button" class="btn btn_primary">Сохранить изменения</button></div></div></div></form>'
                        ];



    /*
     *  Open new_team form
    */
    $('#new_team').click(function() {
        $(this).addClass('open');
    });



    /*
     *  Close new_team form if inputs are empty
    */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#new_team").is('#new_team') && $('#name-0').val() == "" && $('#description-0').val() == "" && $("#participants-0").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0 ) {
            $('#new_team').removeClass('open');
            checking_el_valid($('#name-0'), 'valid');
            checking_el_valid($('#description-0'), 'valid');
            checking_el_valid($("#participants-0"), 'valid');
        }
    });



    /*
     *  Create select2 for new_team form
    */
    $('.participants_in_team').select2({
        language: 'ru',
        templateResult: render_image_for_select2
    });



    /*
     *   Btn Submit new_team form
     *   including validation via inputmask
    */
    $('#create_team').click(function() {
        var form = $(this).closest('form'),
            stat_1, stat_2, stat_3;

        stat_1 = checking_el_valid($('#name-0'), '');
        stat_2 = checking_el_valid($('#description-0'), '');
        stat_3 = checking_el_valid($("#participants-0"), '');

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
     * On change Input Field and Textarea Field
    */
    $('body').on('blur', 'input[type="text"], textarea', function(){
        checking_el_valid($(this));
    });


    /*
     *
    */
    $('body').on('change', 'input[type="file"]', function(){
        var btn = $(this).parent();

        if ($(this).val() == "") {
            btn.children('.btn_text').text("Выбрать логотип");
        } else {
            btn.children('.btn_text').text("Логотип выбран");
        }
    });



    /*
     * On load Add hidden class on long text in card_content-text
    */
    $('.card').each(function () {
        var first = $('.card_content-text:nth-child(1)', this),
            second = $('.card_content-text:nth-child(2)', this);

        if (first.height() > 64) {
            first.addClass('card_height-4em').append('<div class="card_content-text-hidden"  title="Показать полностью"></div>');
        }
        if (second.height() > 48) {
            second.addClass('card_height-3em').append('<div class="card_content-text-hidden" title="Показать полностью"></div>');
        }
    });



    /*
     *   Generate Modal Form for changing information about team
    */
    $('.edit').click(function(){
        var card = $(this).closest('.card'),
            id = card.attr('id'),
            modal_id = "modal_" + id,
            action = card.attr('action'),
            name = $.trim($("#name_" + id).text()),
            description = $.trim($("#description_" + id).text()),
            participants = $("#participants_" + id).html(),
            modal = template_modal[0] + modal_id + template_modal[1] + modal_id + "-Label" + template_modal[2] + action  // modal and form parametrs
                    + template_modal[3] + modal_id + "-Label"  + template_modal[4] // Label for modal
                    + id + "_name" + template_modal[5] + name + template_modal[6] + id + "_name" + template_modal[7] // input name
                    + id + "_description" + template_modal[8] + description + template_modal[9] + id + "_description" + template_modal[10] // textarea
                    + id + "_participants" + template_modal[11] + participants + template_modal[12] + id + "_participants" + template_modal[13] // select
                    + id + "_logo" + template_modal[14]+ id + "_logo" + template_modal[15]; // for changing logo

        // append editing modal form
        $('body').append(modal);

        // initialize select2
        $("#" + id + "_participants").select2({
            language: 'ru',
            templateResult: render_image_for_select2
        });

        // initialize textarea_resize
        $($("#" + id + "_description")).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        // initialize modal
        $("#" + modal_id).modal({
            backdrop: 'static',
            keyboard: false
        });

    });


    /*
     *   Close Modal Form without Saving
    */
    $('body').on('click', 'button[data-dismiss="modal"]', function(){
        $(this).wait(320).closest('.modal').remove();
    });


    /*
     *   Save Modification in Modal Form
    */
    $('body').on('click', '#update-info', function(){
        var form = $(this).closest('.modal'),
            id = form.attr('id').replace('modal_', ''),
            stat_1 = checking_el_valid($("#" + id + "_name")),
            stat_2 = checking_el_valid($("#" + id + "_description")),
            stat_3 = checking_el_valid($("#" + id + "_participants"));


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
     *  Delete Team
    */
    $('body').on('click', '.delete', function(){

        if (!confirm("Вы уверены что хотите продолжить это действие?"))
            return;

        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var teamPk = $('#team-' + dataPk).get(0),
            eventPk = $('#event_id').val();

        $.ajax({
            url : '/teams/delete/' + eventPk + '/' + dataPk,
            data : {},
            success : function(callback) {
                teamPk.remove();
            },
            error : function(callback) {
                console.log("Something gone wrong");
            }
        })

    });




    /*
     *    Function for Rendering Image for select2 elements
    */
    function render_image_for_select2 (team) {
        if (!team.id) {
            return team.text;
        }
        var $team = $(
            '<span class="select2-results__withlogo"><img src="' + url + '/' + team.element.value.toLowerCase() + '" class="select2-results__logo" /> <span class="select2-results__text">' + team.text + '</span></span>'
        );
        return $team;
    };


    /*
     *   Function for Checking on Valid new_team Form
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
