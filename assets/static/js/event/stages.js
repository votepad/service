$(document).ready(function() {


    $('.formula-print').each(function () {

        formula.create(document.getElementById(this.id), {
            mode: "print",
            allItems: document.getElementById('allCriterias').dataset.items,
            curItems: this.dataset.items
        });

    });


    var newStageFormula = formula.create(document.getElementById('formula_newstage'), {
        mode: "create",
        allItems: document.getElementById('allCriterias').dataset.items
    });
    

    /**
     * Vars
     */
    var urlImgPart = window.location.protocol + '//' + window.location.host + '/uploads/participants/',
        urlImgTeam = window.location.protocol + '//' + window.location.host + '/uploads/teams/',
        card, id, name, description, part, team, group,
        modal_form = document.forms.stageModal,
        modal_name = document.getElementById('editstage_name'),
        modal_description = document.getElementById('editstage_description'),
        modal_members = document.getElementById('editstage_members'),
        parts_not_distributed = document.getElementById('newstage_participants').innerHTML,
        teams_not_distributed = document.getElementById('newstage_teams').innerHTML;



    /**
     * Open newstage form
     */
    $('#newstage').click(function() {
        $(this).addClass('open');
    });
    $('#newstage_name').focus(function() {
        $('#newstage').addClass('open');
    });



    /**
     * Close newstage form if inputs are empty
     */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newstage").is('#newstage') && $('#newstage_name').val() == "" && $('#newstage_description').val() == ""
                && $("#newstage_participants").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#newstage_team").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#newstage_groups").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#newstage_formula_area li").length == 0)
        {
            $('#newstage').removeClass('open');
            checking_el_valid($('#newstage_name'), 'valid');
            checking_el_valid($('#newstage_description'), 'valid');
            checking_el_valid($("#newstage_participants"), 'valid');
            checking_el_valid($("#newstage_team"), 'valid');
            checking_el_valid($("#newstage_groups"), 'valid');
        }
    });


    /**
     * Create select2 for newstage form
     */
    var select2Parts = $('#newstage_participants').select2({
        language: 'ru',
        templateResult: renderPartImg
    }),
    select2Teams = $('#newstage_teams').select2({
        language: 'ru',
        templateResult: renderTeamImg
    }),
    select2Groups = $("#newstage_groups").select2({
        language: 'ru',
    }),
    select2Parts_val = [],
    select2Teams_val = [],
    select2Groups_val = [];

    $('#newstage_participants option').each(function(){
        select2Parts_val.push($(this).val());
    });
    $('#newstage_teams option').each(function(){
        select2Teams_val.push($(this).val());
    });
    $('#newstage_groups option').each(function(){
        select2Groups_val.push($(this).val());
    });

    /**
     * change stage members in newstage form
     */
    $("#part").click(function(){
        $("#show_participants").removeClass("displaynone");
        $("#show_teams").addClass("displaynone");
        $("#show_groups").addClass("displaynone");
        $("#allParts").parent().removeClass("displaynone");
        $("#allTeams").parent().addClass("displaynone");
        $("#allGroups").parent().addClass("displaynone");
        select2Teams.val(null).trigger("change");
        select2Groups.val(null).trigger("change");
    });

    $("#team").click(function(){
        $("#show_teams").removeClass("displaynone");
        $("#show_participants").addClass("displaynone");
        $("#show_groups").addClass("displaynone");
        $("#allTeams").parent().removeClass("displaynone");
        $("#allParts").parent().addClass("displaynone");
        $("#allGroups").parent().addClass("displaynone");
        select2Parts.val(null).trigger("change");
        select2Groups.val(null).trigger("change");
    });

    $("#group").click(function(){
        $("#show_groups").removeClass("displaynone");
        $("#show_participants").addClass("displaynone");
        $("#show_teams").addClass("displaynone");
        $("#allGroups").parent().removeClass("displaynone");
        $("#allParts").parent().addClass("displaynone");
        $("#allTeams").parent().addClass("displaynone");
        select2Parts.val(null).trigger("change");
        select2Teams.val(null).trigger("change");
    });


    /**
     * Select all parts
     */
    $("#allParts").on("click", function () {
        if ( document.getElementById("allParts").checked == true) {
            select2Parts.val(select2Parts_val).trigger("change");
        } else{
            select2Parts.val("").trigger("change");
        }
    });

    /**
     * Select all teams
     */
    $("#allTeams").on("click", function () {
        if ( document.getElementById("allTeams").checked == true) {
            select2Teams.val(select2Teams_val).trigger("change");
        } else{
            select2Teams.val("").trigger("change");
        }
    });

    /**
     * Select all groups
     */
    $("#allGroups").on("click", function () {
        if ( document.getElementById("allGroups").checked == true) {
            select2Groups.val(select2Groups_val).trigger("change");
        } else{
            select2Groups.val("").trigger("change");
        }
    });



    /**
     * Btn Submit newstage form including validation
     */
    $('#newstage').submit(function() {
/*        var stat_1, stat_2, stat_3, stat_4;

        stat_1 = checking_el_valid($('#newstage_name'), '');
        stat_2 = checking_el_valid($('#newstage_description'), '');

        if (newStageFormula.toJSON() == "[]") {
            $('#formula_newstage').addClass('formula--error');
            stat_3 = false;
        } else {
            $('#formula_newstage').removeClass('formula--error');
        }

        if ( ! $("#show_participants").hasClass("displaynone") ) {
            stat_4 = checking_el_valid($("#newstage_participants"), '');
        } else if ( ! $("#show_teams").hasClass("displaynone") ) {
            stat_4 = checking_el_valid($("#newstage_teams"), '');
        } else {
            stat_4 = checking_el_valid($("#newstage_groups"), '');
        }

        if ( stat_1 == false || stat_2 == false || stat_3 == false || stat_4 == false ) {
            $.notify({
                message: 'Пожалуйста, проверьте правильность введенных данных.'
            }, {
                type: 'danger'
            });
            return false;
        }
*/
    });



    /**
     * On change Input Field
     */
    $('body').on('blur', 'input[type="text"], textarea', function(){
        checking_el_valid($(this));
    });
    


    /**
     * Generate Modal Form for changing information about stage
     */
    $('.edit').click(function(){
        card = this.closest('.card');
        id = card.getAttribute('id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        description = $.trim(document.getElementById('description_' + id).innerHTML);
        part = document.getElementById('participants_' + id) ? $.trim(document.getElementById('participants_' + id).innerHTML) : '';
        team = document.getElementById('teams_' + id) ? $.trim(document.getElementById('teams_' + id).innerHTML) : '';
        //group = $.trim(document.getElementById('groups_' + id).innerHTML);

        //  Fill modal information
        modal_form.setAttribute('action', '/stages/edit/' + card.dataset.id);
        modal_name.value = name;
        modal_description.innerHTML = description;
        if ( part == "" && team == "" ) {
            //modal_members.innerHTML = group + groups_not_distributed;
        } else if ( part == "" && group == "" ) {
            modal_members.innerHTML = team + teams_not_distributed;
        } else {
            modal_members.innerHTML = part + parts_not_distributed;
        }


        // initialize select2
        if ( part == "" && team == "" ) {
            $("#editstage_members").select2({
                language: 'ru'
            });
        } else if ( part == "" && group == "" ) {
            $("#editstage_members").select2({
                language: 'ru',
                templateResult: renderTeamImg
            });
        } else {
            $("#editstage_members").select2({
                language: 'ru',
                templateResult: renderPartImg
            });
        }

        // initialize textarea_resize
        $(modal_description).on('init keyup focus', function(){
            textarea_resize($(this));
        });


        // initialize modal
        $("#editstage_modal").modal({
            backdrop: 'static',
            keyboard: false
        });

    });


    /**
     * Cansel Edit in Modal Form
     */
    $('button[data-dismiss]').click(function(){
        modal_name.value = "";
        modal_description.innerHTML = "";
        modal_members.innerHTML = "";
        $("#editstage_members").select2("destroy");
    });


    /**
     * Save Modification in Modal Form
     */
    $('#editstage_modal').submit(function(){
        var stat_1 = checking_el_valid($('#editstage_name'),''),
            stat_2 = checking_el_valid($('#editstage_description'),''),
            stat_3 = checking_el_valid($('#editstage_members'),''),
            stat_4;


        if (true) {

        } else {

        }

        if ( !stat_1 || !stat_2 || !stat_3 || !stat_4 ) {
            $.notify({
                message: 'Пожалуйста, проверьте правильность введенных данных.'
            },{
                type: 'danger'
            });
            //return false;
        }
    });


    /**
     * Delete stage
     */
    $('.delete').click(function(){
        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var stagePk = $('#stage_' + dataPk).get(0),
            eventPk = $('#event_id').val();

        swal({
            customClass: "delete-block",
            animation: false,
            title: 'Вы уверены, что хотите удалить этап?',
            text: "Удалив этап, Вы не сможете его восстановить!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Да, удалить этап',
            cancelButtonText: 'Нет, отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                url : '/stages/delete/' + dataPk,
                data : {},
                success : function(callback) {

                    stagePk.remove();

                    swal({
                        width: 300,
                        customClass: "delete-block",
                        animation: false,
                        title: 'Удалено!',
                        text: 'Этап был удален.',
                        type: 'success',
                        confirmButtonText: 'Готово',
                        confirmButtonClass: 'btn btn_primary',
                        buttonsStyling: false
                    })
                },
                error : function(callback) {
                    console.log("Error has occured in deleting stage");
                    swal({
                        width: 300,
                        customClass: "delete-block",
                        animation: false,
                        title: 'Ошибка!',
                        text: 'Во время удаления произошла ошибка, попробуйте удалить этап снова.',
                        type: 'error',
                        confirmButtonText: 'Закрыть',
                        confirmButtonClass: 'btn btn_primary',
                        buttonsStyling: false
                    })
                }
            })

        });

    });




    /**
     * Function for Rendering Image for select2 elements
     */
    function renderPartImg (el) {
        if (!el.id) {
            return el.text;
        }
        var $el = $(
            '<span class="select2-results__withlogo"><img src="' + urlImgPart + el.element.dataset.logo + '" class="select2-results__logo" /> <span class="select2-results__text">' + el.text + '</span></span>'
        );
        return $el;
    }

    function renderTeamImg (el) {
        if (!el.id) {
            return el.text;
        }
        var $el = $(
            '<span class="select2-results__withlogo"><img src="' + urlImgTeam + el.element.dataset.logo + '" class="select2-results__logo" /> <span class="select2-results__text">' + el.text + '</span></span>'
        );
        return $el;
    }


    /**
     * Function for Checking on Valid newstage Form
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