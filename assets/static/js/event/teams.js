$(document).ready(function() {

    /*
     *  Vars
    */
    var protocol = window.location.protocol,
        hostname = window.location.hostname,
        imagePath = "http://pronwe/assets/img/user",
        card, id, name, about, part, list,
        parts_not_distributed = document.getElementById('newteam_participants').innerHTML,
        modal_name = document.getElementById('editteam_name'),
        modal_description = document.getElementById('editteam_description'),
        modal_part = document.getElementById('editteam_part'),
        modal_id = document.getElementById('editteam_identity');


    /*
     *  Open newteam form
    */
    $('#newteam').click(function() {
        $(this).addClass('open');
    });
    $('#newteam_name').focus(function() {
        $('#newteam').addClass('open');
    });


    /*
     *  Close newteam form if inputs are empty
    */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newteam").is('#newteam') && $('#newteam_name').val() == "" && $('#newteam_description').val() == "" && $("#newteam_participants").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0 ) {
            $('#newteam').removeClass('open');
            checking_el_valid($('#newteam_name'), 'valid');
            checking_el_valid($('#newteam_description'), 'valid');
            checking_el_valid($("#newteam_participants"), 'valid');
        }
    });


    /*
     *  Create select2 for newteam form
    */
    $('#newteam_participants').select2({
        language: 'ru',
        templateResult: render_image_for_select2
    });


    /*
     *   Btn Submit newteam form
     *   including validation via inputmask
    */
    $("#newteam").submit(function() {
        var stat_1, stat_2, stat_3;

        stat_1 = checking_el_valid($('#newteam_name'), '');
        stat_2 = checking_el_valid($('#newteam_description'), '');
        stat_3 = checking_el_valid($("#newteam_participants"), '');

        if ( !stat_1 || !stat_2 || !stat_3) {
            vp.notification.notify({
                type: 'danger',
                message: 'Пожалуйста, проверьте правильность введенных данных.',
                time: 3
            });
            return false;
        }
    });


    /*
     * On change Input Field and Textarea Field
    */
    $('body').on('blur', 'input[type="text"], textarea', function(){
        checking_el_valid($(this));
    });


    /*
     * Change Input[file] BtnText when file is selected
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
        card = this.closest('.card');
        id = card.getAttribute('id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        about = $.trim(document.getElementById('description_' + id).innerHTML);
        part = $.trim(document.getElementById('participants_' + id).innerHTML);

        //  Fill modal information
        modal_name.value = name;
        modal_description.innerHTML = about;
        modal_part.innerHTML = part + parts_not_distributed;

        // get identity
        list = id.split('_');
        modal_id.value = +list[1];

        // initialize select2
        $("#editteam_part").select2({
            language: 'ru',
            templateResult: render_image_for_select2
        });

        // initialize textarea_resize
        $($("editteam_description")).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        // initialize modal
        $("#editteam_modal").modal({
            backdrop: 'static',
            keyboard: false
        });

    });


    /*
     *  Cansel Edit in Modal Form
    */
    $('button[data-dismiss]').click(function(){
        modal_name.value = "";
        modal_description.innerHTML = "";
        modal_part.innerHTML = "";
        modal_id.value = "";
        $("#editteam_part").select2("destroy");
    });


    /*
     *   Save Modification in Modal Form
    */
    $('#editteam_modal').submit(function(){
        var form = $(this).closest('.modal'),
            stat_1 = checking_el_valid($("#editteam_name"), ''),
            stat_2 = checking_el_valid($("#editteam_description"), ''),
            stat_3 = checking_el_valid($("#editteam_part"), '');

        if ( !stat_1 || !stat_2 || !stat_3) {
            vp.notification.notify({
                type: 'danger',
                message: 'Пожалуйста, проверьте правильность введенных данных.',
                time: 3
            });
            return false;
        }
    });


    /*
     *  Delete Team
    */
    $('body').on('click', '.delete', function(){

        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var teamPk = $('#team_' + dataPk).get(0),
            eventPk = $('#event_id').val();

        var card = this.closest('.card'),
            id = card.getAttribute('id'),
            part = $.trim(document.getElementById('participants_' + id).innerHTML);


        vp.notification.notify({
            type: 'confirm',
            size: 'large',
            showCancelButton: true,
            confirmText: "Да, удалить команду",
            cancelText: "Нет, отмена",
            message: '<h3 class="text--default">Вы уверены, что хотите удалить команду?</h3>' +
            '<p>Удалив команду, Вы не сможете её восстановить!</p>',
            confirm: removeTeam
        });


        function removeTeam() {

            var ajaxData = {
                url: protocol + '//' + hostname + '/teams/delete/' + dataPk,
                data: {},
                success: function (callback) {

                    $("#newteam_participants").select2("destroy");
                    $("#newteam_participants").html(part.replace(new RegExp('selected', 'g'), '') + parts_not_distributed);
                    $("#newteam_participants").select2({
                        language: 'ru',
                        templateResult: render_image_for_select2
                    });

                    teamPk.remove();

                    vp.notification.notify({
                        type: 'alert',
                        status: 'success',
                        message: 'Команда успешно удалена',
                        time: 3
                    });
                },
                error: function (callback) {
                    console.log("Error has occured in deleting team");

                    vp.notification.notify({
                        type: 'alert',
                        status: 'warning',
                        message: 'Во время удаления произошла ошибка, попробуйте удалить команду снова',
                        time: 3
                    });
                }
            };

            vp.ajax.send(ajaxData);

        }

    });


    /*
     *    Function for Rendering Image for select2 elements
    */
    function render_image_for_select2 (el) {
        if (!el.id) {
            return el.text;
        }
        var $el = $(
            '<span class="select2-results__withlogo"><img src="/" class="select2-results__logo" ' + imagePath + el.element.dataset.logo + '> <span class="select2-results__text">' + el.text + '</span></span>'
        );
        return $el;
    };


    /*
     *   Function for Checking on Valid newteam Form
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
