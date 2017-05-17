$(document).ready(function() {


    /** Printing Formula on existed stages */
    $('.formula-print').each(function () {

        formula.create(document.getElementById(this.id), {
            mode: "print",
            curItems: this.dataset.items
        });

    });

    /** Formula on creating new stage */
    var newStageFormula = formula.create(document.getElementById('new_formula'), {
        mode: "create",
        allItems: document.getElementById('allCriterias').dataset.items
    });
    

    /**
     * Vars
     */
    var urlImgPart = window.location.protocol + '//' + window.location.host + '/uploads/participants/',
        urlImgTeam = window.location.protocol + '//' + window.location.host + '/uploads/teams/',
        card, id, name, description, part, team, formulaItems,

        modal_form          = document.getElementById('edit_modal'),
        modal_id            = document.getElementById('edit_id'),
        modal_name          = document.getElementById('edit_name'),
        modal_description   = document.getElementById('edit_description'),
        modal_members       = document.getElementById('edit_members'),
        modal_formula       = document.getElementById('edit_formula'),
        edit_formula        = null,

        all_parts = getOptions(document.getElementById('new_participants')),
        all_teams = getOptions(document.getElementById('new_teams'));



    /**
     * Open new form
     */
    $('#newstage').click(function() {
        $(this).addClass('open');
    });
    $('#new_name').focus(function() {
        $('#newstage').addClass('open');
    });



    /**
     * Close new form if inputs are empty
     */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newstage").is('#newstage') && $('#new_name').val() == "" && $('#new_description').val() == ""
                && $("#new_participants").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#new_team").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#new_groups").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#new_formula_area li").length == 0)
        {
            $('#newstage').removeClass('open');
            checking_el_valid($('#new_name'), 'valid');
            checking_el_valid($('#new_description'), 'valid');
            checking_el_valid($("#new_participants"), 'valid');
            checking_el_valid($("#new_team"), 'valid');
            checking_el_valid($("#new_groups"), 'valid');
        }
    });


    /**
     * Create select2 for new form
     */
    var select2Parts = $('#new_participants').select2({
        language: 'ru',
        templateResult: renderPartImg
    }),
    select2Teams = $('#new_teams').select2({
        language: 'ru',
        templateResult: renderTeamImg
    }),

    select2Parts_val = [],
    select2Teams_val = [];

    $('#new_participants option').each(function(){
        select2Parts_val.push($(this).val());
    });
    $('#new_teams option').each(function(){
        select2Teams_val.push($(this).val());
    });


    /**
     * change stage members in new form
     */
    $("#part").click(function(){
        $("#show_participants").removeClass("displaynone");
        $("#show_teams").addClass("displaynone");
        $("#allParts").parent().removeClass("displaynone");
        $("#allTeams").parent().addClass("displaynone");
        select2Teams.val(null).trigger("change");
    });

    $("#team").click(function(){
        $("#show_teams").removeClass("displaynone");
        $("#show_participants").addClass("displaynone");
        $("#allTeams").parent().removeClass("displaynone");
        $("#allParts").parent().addClass("displaynone");
        select2Parts.val(null).trigger("change");
    });

    /** Select all parts  on new stage */
    $("#allParts").on("click", function () {
        if ( document.getElementById("allParts").checked === true) {
            select2Parts.val(select2Parts_val).trigger("change");
        } else{
            select2Parts.val("").trigger("change");
        }
    });

    /** Select all teams on new stage */
    $("#allTeams").on("click", function () {
        if ( document.getElementById("allTeams").checked === true) {
            select2Teams.val(select2Teams_val).trigger("change");
        } else{
            select2Teams.val("").trigger("change");
        }
    });


    /**
     * Submit new stage form including validation
     */
    $('#newstage').submit(function() {

        var stat_1, stat_3, stat_4;

        stat_1 = checking_el_valid($('#new_name'), '');

        if (newStageFormula.toJSON()) {
            $('#new_formula').removeClass('formula--error');
            stat_3 = true;
        } else {
            $('#new_formula').addClass('formula--error');
            stat_3 = false;
        }

        if ( ! $("#show_participants").hasClass("displaynone") ) {
            stat_4 = checking_el_valid($("#new_participants"), '');
        } else if ( ! $("#show_teams").hasClass("displaynone") ) {
            stat_4 = checking_el_valid($("#new_teams"), '');
        }

        if ( !stat_1 || !stat_3 || !stat_4 ) {

            vp.notification.notify({
                type: 'danger',
                message: 'Пожалуйста, проверьте правильность введенных данных.',
                time: 3
            });

            return false;
        }

    });



    /**
     * On change Input Field
     */
    $('body').on('blur', 'input[type="text"]', function(){
        checking_el_valid($(this));
    });
    


    /**
     * Generate Modal Form for changing information about stage
     */
    $('.edit').click(function(){
        card = this.closest('.card');
        id = card.getAttribute('data-id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        description = $.trim(document.getElementById('description_' + id).innerHTML);
        part = getOptions(document.getElementById('participants_' + id));
        team = getOptions(document.getElementById('teams_' + id));
        formulaItems = document.getElementById('formula_' + id).dataset.items;

        //  Fill modal information
        modal_form.setAttribute('action', '/stages/edit/' + card.dataset.id);
        modal_id.value   = card.dataset.id;
        modal_name.value = name;
        modal_description.innerHTML = description;

        if ( part === null  ) {
            modal_members.innerHTML = setEditedOption(all_teams, team);
            $("#edit_members").select2({
                language: 'ru',
                templateResult: renderTeamImg
            });
        } else {
            modal_members.innerHTML = setEditedOption(all_parts, part);
            $("#edit_members").select2({
                language: 'ru',
                templateResult: renderPartImg
            });
        }

        // initialize textarea_resize
        $(modal_description).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        edit_formula = formula.create(modal_formula, {
            mode: "edit",
            allItems: document.getElementById('allCriterias').dataset.items,
            curItems: formulaItems
        });

        // initialize modal
        $("#edit_modal").modal({
            backdrop: 'static',
            keyboard: false
        });

    });


    /**
     * Cancel Edit - close modal form
     */
    $('button[data-dismiss]').click(function(){
        modal_name.value = "";
        modal_description.innerHTML = "";
        modal_members.innerHTML = "";
        edit_formula.destroy();
        edit_formula = null;
        $("#edit_members").select2("destroy");
    });



    /**
     * Update Stage
     */
    $('#edit_modal').submit(function(){
        var stat_1 = checking_el_valid($('#edit_name'),''),
            stat_3 = checking_el_valid($('#edit_members'),''),
            stat_4 = null;

        if (edit_formula.toJSON()) {
            modal_formula.classList.remove('formula--error');
            stat_4 = false;
        } else {
            modal_formula.classList.add('formula--error');
            stat_4 = false;
        }

        if ( !stat_1 || !stat_3 || !stat_4 ) {
            vp.notification.notify({
                type: 'danger',
                message: 'Пожалуйста, проверьте правильность введенных данных.',
                time: 3
            });
            return false;
        }
    });


    /**
     * Delete stage
     */
    $('.delete').click(function(){
        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var stagePk = $('#stage_' + dataPk).get(0);


        vp.notification.notify({
            type: 'confirm',
            size: 'large',
            showCancelButton: true,
            confirmText: "Да, удалить этап",
            cancelText: "Нет, отмена",
            message: '<h3 class="text--default">Вы уверены, что хотите удалить этап?</h3>' +
            '<p>Удалив этап, Вы не сможете его восстановить!</p>',
            confirm: removeStage
        });


        function removeStage() {

            var ajaxData = {
                url : '/stages/delete/' + dataPk,
                success : function(callback) {

                    stagePk.remove();

                    vp.notification.notify({
                        type: 'success',
                        message: 'Этап успешно удален',
                        time: 3
                    });
                },
                error : function(callback) {
                    console.log("Error has occured in deleting stage");

                    vp.notification.notify({
                        type: 'warning',
                        message: 'Во время удаления произошла ошибка, попробуйте удалить этап снова',
                        time: 3
                    });
                }
            };

            vp.ajax.send(ajaxData);

        }

    });




    /** Rendering Image for select2 Participant */
    function renderPartImg (el) {
        if (!el.id) {
            return el.text;
        }
        var $el = $(
            '<span class="select2-results__withlogo"><img src="' + urlImgPart + el.element.dataset.logo + '" class="select2-results__logo" /> <span class="select2-results__text">' + el.text + '</span></span>'
        );
        return $el;
    }

    /** Rendering Image for select2 Teams */
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
     * Checking on Validation
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


    /** get options from select2 */
    function getOptions(element) {
        if (element == null)
            return null;

        var arr = [], option;

        for (var i = 0; i < element.childElementCount; i++) {
            option = {
                name: element.children[i].innerHTML,
                value: element.children[i].value,
                logo: element.children[i].dataset.logo,
                selected: element.children[i].hasAttribute('selected')
            };
            arr.push(option);
        }
        return arr;
    }


    function setEditedOption(arr1,arr2) {
        var out = "", outarr = [];

        for (var i =0; i < arr1.length; i++) {
            outarr.push(arr1[i]);
            for (var j = 0; j < arr2.length; j++) {
                if (arr1[i].value == arr2[j].value) {
                    outarr.pop();
                }
            }
        }
        for (var i =0; i < outarr.length; i++) {
            out += '<option value="' + outarr[i].value + '" data-logo="' + outarr[i].logo + '">' + outarr[i].name + '</option>';
        }

        for (var i =0; i < arr2.length; i++) {
            out += '<option value="' + arr2[i].value + '" data-logo="' + arr2[i].logo + '" selected="">' + arr2[i].name + '</option>';
        }

        return out;
    }

});