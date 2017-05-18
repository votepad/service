$(document).ready(function() {


    /** Printing Formula on existed stages */
    $('.formula-print').each(function () {

        formula.create(document.getElementById(this.id), {
            mode: "print",
            curItems: this.dataset.items
        });

    });

    /** Formula on creating new stage */
    var newContestFormula = formula.create(document.getElementById('new_formula'), {
        mode: "create",
        allItems: document.getElementById('allStages').dataset.items,
        itemsType: "new_mode"
    });



    /**
     * Vars
     */
    var url = "",
        card, id, name, description, judges, formulaItems, mode,
        modal_form        = document.getElementById('edit_modal'),
        modal_name        = document.getElementById('edit_name'),
        modal_description = document.getElementById('edit_description'),
        modal_mode        = document.getElementsByClassName('edit_mode'),
        modal_judges      = document.getElementById('edit_judges'),
        modal_formula     = document.getElementById('edit_formula'),
        edit_formula      = null,
        all_judges = getOptions(document.getElementById('new_judges'));



    /**
     * Open new form
     */
    $('#newcontest').click(function() {
        $(this).addClass('open');
    });
    $('#new_name').focus(function() {
        $('#newcontest').addClass('open');
    });



    /**
     * Close new form if inputs are empty
     */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newcontest").is('#newcontest') && $('#new_name').val() == "" && $('#new_description').val() == ""
                && $("#new_judges").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#new_formula .formula__list li").length == 0)
        {
            $('#newcontest').removeClass('open');
            checking_el_valid($('#new_name'), 'valid');
            checking_el_valid($("#new_description"), 'valid');
            checking_el_valid($("#new_judges"), 'valid');
            $('#new_formula').removeClass('formula--error');
        }
    });



    /**
     * Create select2 for new form
     */
    var $judges = $('#new_judges').select2({
        language: 'ru',
    });
    var judges_val = [];

    $('#new_judges option').each(function(){
        judges_val.push($(this).val())
    });


    /**
     * Select all judges
     */
    $("#allJudges").on("click", function () {
        if ( document.getElementById("allJudges").checked == true) {
            $judges.val(judges_val).trigger("change");
        } else{
            $judges.val("").trigger("change");
        }
    });



    /**
     * Submit new form
     */
    $('#newcontest').submit(function() {
        var stat_1 = false,
            stat_3 = false,
            stat_4 = false;

        $(this).addClass('whirl');

        stat_1 = checking_el_valid($('#new_name'), '');
        stat_3 = checking_el_valid($("#new_judges"), '');

        if (newContestFormula.toJSON() && newContestFormula.validate()) {
            $('#new_formula').removeClass('formula--error');
            stat_4 = true;
        } else {
            $('#new_formula').addClass('formula--error');
            stat_4 = false;
        }

        if ( !stat_1 || !stat_3 || !stat_4 ) {
            vp.notification.notify({
                type: 'danger',
                message: 'Пожалуйста, проверьте правильность введенных данных.',
                time: 3
            });
            $(this).removeClass('whirl');
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
     * Generate Modal Form for changing information about contest
     */
    $('.edit').click(function(){
        card         = this.closest('.card');
        id           = card.getAttribute('data-id');
        name         = $.trim(document.getElementById('name_' + id).innerHTML);
        description  = $.trim(document.getElementById('description_' + id).innerHTML);
        mode         = document.getElementById('mode_' + id).innerHTML;
        judges       = getOptions(document.getElementById('judges_' + id));
        formulaItems = document.getElementById('formula_' + id).dataset.items;

        //  Fill modal information
        modal_form.action = '/contests/edit/' + card.dataset.id;
        modal_name.value = name;
        modal_description.innerHTML = description;
        modal_judges.innerHTML = setEditedOption(all_judges, judges);
        modal_mode[mode - 1].click();

        // initialize select2
        $("#edit_judges").select2({
            language: 'ru',
        });

        // initialize textarea_resize
        $(modal_description).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        edit_formula = formula.create(modal_formula, {
            mode: "edit",
            allItems: document.getElementById('allStages').dataset.items,
            curItems: formulaItems,
            itemsType: "edit_mode"
        });

        // initialize modal
        $("#edit_modal").modal({
            backdrop: 'static',
            keyboard: false
        });

    });


    /**
     * Cancel Edit in Modal Form
     */
    $('button[data-dismiss]').click(function(){
        modal_name.value = "";
        modal_description.innerHTML = "";
        modal_judges.innerHTML = "";
        edit_formula.destroy();
        edit_formula = null;
        $("#edit_judges").select2("destroy");
    });


    /**
     * Update edited form
    */
    $('#edit_modal').submit(function(){
        var stat_1 = checking_el_valid($('#edit_name'),''),
            stat_3 = checking_el_valid($('#edit_judges'),''),
            stat_4 = null;

        if (edit_formula.toJSON() && edit_formula.validate()) {
            modal_formula.classList.remove('formula--error');
            stat_4 = true;
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
     * Delete contest
     */
    $('.delete').click(function(){
        /** Information about action */
        var dataPk = $(this).get(0).dataset.pk,
            contestPk = $('#contest_' + dataPk).get(0);

        vp.notification.notify({
            type: 'confirm',
            size: "large",
            showCancelButton: true,
            confirmText: "Да, удалить конкурс",
            cancelText: "Нет, отмена",
            message: '<h3 class="text--default">Вы уверены, что хотите удалить конкурс?</h3>' +
                     '<p>Удалив конкурс, Вы не сможете его восстановить!</p>',
            confirm: removeContest
        });

        function removeContest() {

            var ajaxData = {
                url: '/contests/delete/' + dataPk,
                success: function (callback) {

                    contestPk.remove();

                    vp.notification.notify({
                        type: 'success',
                        message: 'Конкурс успешно удален',
                        time: 3
                    });
                },
                error: function (callback) {
                    console.log("Error has occured in deleting contest");

                    vp.notification.notify({
                        type: 'warning',
                        message: 'Во время удаления произошла ошибка, попробуйте удалить конкурс снова',
                        time: 3
                    });
                }
            };

            vp.ajax.send(ajaxData);

        }

    });



    /*
     *   Function for Checking on Valid new Form
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