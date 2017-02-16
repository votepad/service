$(document).ready(function() {

    /*
     *  Vars
    */
    var url = "",
        card, id, name, description, parts, teams,
        parts_not_distributed = document.getElementById('newgroup_participants').innerHTML,
        teams_not_distributed = document.getElementById('newgroup_teams').innerHTML,
        modal_name = document.getElementById('editgroup_name'),
        modal_description = document.getElementById('editgroup_description'),
        modal_members = document.getElementById('editgroup_members'),
        all_parts = document.getElementById('newgroup_participants').getElementsByTagName('option'),
        all_teams = document.getElementById('newgroup_teams').getElementsByTagName('option');


    /*
     *  Open newgroup form
    */
    $('#newgroup').click(function() {
        $(this).addClass('open');
    });
    $('#newgroup_name').focus(function() {
        $('#newgroup').addClass('open');
    });


    /*
     *  Close newgroup form if inputs are empty
    */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newgroup").is('#newgroup') && $('#newgroup_name').val() == "" && $('#newgroup_description').val() == ""
                && $("#newgroup_participants").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#newgroup_teams").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0)
        {
            $('#newgroup').removeClass('open');
            checking_el_valid($('#newgroup_name'), 'valid');
            checking_el_valid($('#newgroup_description'), 'valid');
            checking_el_valid($("#newgroup_participants"), 'valid');
            checking_el_valid($("#newgroup_teams"), 'valid');
        }
    });


    /*
     *  Create select2 for newgroup form
    */
    $('.elements_in_group').select2({
        language: 'ru',
        templateResult: render_image_for_select2
    });


    /*
     * change group members
    */
    $("#team").click(function(){
        $("#show_teams").removeClass("displaynone");
        $("#show_participants").addClass("displaynone");
        $("#newgroup_participants").val(null).trigger("change");
    });
    $("#part").click(function(){
        $("#show_participants").removeClass("displaynone");
        $("#show_teams").addClass("displaynone");
        $("#newgroup_teams").val(null).trigger("change");
    });


    /*
     *   Btn Submit newgroup form
     *   including validation via inputmask
    */
    $('#create_group').click(function() {
        var form = $(this).closest('form'),
            stat_1, stat_2, stat_3;

        stat_1 = checking_el_valid($('#newgroup_name'), '');
        stat_2 = checking_el_valid($('#newgroup_description'), '');
        if ( ! $("#show_participants").hasClass("displaynone") ) {
            stat_3 = checking_el_valid($("#newgroup_participants"), '');
        } else {
            stat_3 = checking_el_valid($("#newgroup_teams"), '');
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
     * On change Input Field and Textarea Field
    */
    $('body').on('blur', 'input[type="text"], textarea', function(){
        checking_el_valid($(this),'');
    });


    /*
     * On load Add hidden class on long text in card_content-text
    */
    $('.card').each(function () {
        var first = $('.card_content-text:nth-child(1)', this),
            second = $('.card_content-text:nth-child(2)', this);

        if (first.height() > 64) {
            first.addClass('card_height-4em').append('<div class="card_content-text-hidden" title="Показать полностью"></div>');
        }
        if (second.height() > 48) {
            second.addClass('card_height-3em').append('<div class="card_content-text-hidden" title="Показать полностью"></div>');
        }
    });


    /*
     *   Generate Modal Form for changing information about group
    */
    $('.edit').click(function(){
        card = this.closest('.card');
        id = card.getAttribute('id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        description = $.trim(document.getElementById('description_' + id).innerHTML);


        //  Fill modal information
        modal_name.value = name;
        modal_description.innerHTML = description;

        if ( document.getElementById('teams_' + id) != null) {
            teams = document.getElementById('teams_' + id).getElementsByTagName('option');
            modal_members.innerHTML = check_free_judges(all_teams, teams);
        } else {
            parts = document.getElementById('participants_' + id).getElementsByTagName('option');
            modal_members.innerHTML = check_free_judges(all_parts, parts);
        }

        // initialize select2
        $("#editgroup_members").select2({
            language: 'ru',
            templateResult: render_image_for_select2
        });

        // initialize textarea_resize
        $($("editgroup_description")).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        // initialize modal
        $("#editgroup_modal").modal({
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
        modal_members.innerHTML = "";
        $("#editgroup_members").select2("destroy");
    });

    /*
     *   Save Modification in Modal Form
    */
    $('body').on('click', '#update-info', function(){
        var form = $(this).closest('.modal'),
            stat_1 = checking_el_valid($("#editgroup_name"),''),
            stat_2 = checking_el_valid($("#editgroup_description"),''),
            stat_3 = checking_el_valid($("#editgroup_members"),'');

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
     *  Delete group
    */
    $('.delete').click(function(){

        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var groupPk = $('#group_' + dataPk).get(0);

        swal({
            customClass: "delete-block",
            animation: false,
            title: 'Вы уверены, что хотите удалить группу?',
            text: "Удалив группу, Вы не сможете её восстановить!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Да, удалить группу',
            cancelButtonText: 'Нет, отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                url : '/group/delete/' + dataPk,
                success : function(callback) {

                    swal({
                        width: 300,
                        customClass: "delete-block",
                        animation: false,
                        title: 'Удалено!',
                        text: 'Группа была удалена.',
                        type: 'success',
                        confirmButtonText: 'Готово',
                        confirmButtonClass: 'btn btn_primary',
                        buttonsStyling: false
                    });

                    window.location.reload();
                },
                error : function(callback) {

                    swal({
                        width: 300,
                        customClass: "delete-block",
                        animation: false,
                        title: 'Ошибка!',
                        text: 'Во время удаления произошла ошибка, попробуйте удалить группу снова.',
                        type: 'error',
                        confirmButtonText: 'Закрыть',
                        confirmButtonClass: 'btn btn_primary',
                        buttonsStyling: false
                    })
                }
            })

        });

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
     *   Function for Checking on Valid newgroup Form
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


    /*
    *    Function for Checking Two select2 Arrays
   */
   function check_free_judges (arr1, arr2) {
       var string = "";
       for (var i = 0; i < arr1.length; i++) {
           for (var j = 0; j < arr2.length; j++) {
               if (arr1[i].value == arr2[j].value) {
                   arr1[i].setAttribute('selected', true);
               }
           }
           string += arr1[i].outerHTML;
       }
       return string;
   };

});
