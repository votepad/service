$(document).ready(function() {


    /** Printing Formula on existed stages */
    $('.formula-print').each(function () {

        formula.create(document.getElementById(this.id), {
            mode: "print",
            allItems: document.getElementById('allStages').dataset.items,
            curItems: this.dataset.items
        });

    });

    /** Formula on creating new stage */
    var newContestFormula = formula.create(document.getElementById('newcontest_formula'), {
        mode: "create",
        allItems: document.getElementById('allStages').dataset.items
    });



    /**
     * Vars
     */
    var url = "",
        card, id, name, description, judges,
        modal_form = document.getElementById('editcontest_modal'),
        modal_name = document.getElementById('editcontest_name'),
        modal_description = document.getElementById('editcontest_description'),
        modal_judges = document.getElementById('editcontest_judges'),
        all_judges = getOptions(document.getElementById('newcontest_judges'));



    /**
     * Open newcontest form
     */
    $('#newcontest').click(function() {
        $(this).addClass('open');
    });
    $('#newcontest_name').focus(function() {
        $('#newcontest').addClass('open');
    });



    /**
     * Close newcontest form if inputs are empty
     */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newcontest").is('#newcontest') && $('#newcontest_name').val() == "" && $('#newcontest_description').val() == ""
                && $("#newcontest_judges").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#newcontest_formula .formula__list li").length == 0)
        {
            $('#newcontest').removeClass('open');
            checking_el_valid($('#newcontest_name'), 'valid');
            checking_el_valid($("#newcontest_description"), 'valid');
            checking_el_valid($("#newcontest_judges"), 'valid');
            $('#newcontest_formula').removeClass('formula--error');
        }
    });



    /**
     * Create select2 for newcontest form
     */
    var $judges = $('#newcontest_judges').select2({
        language: 'ru',
    });
    var judges_val = [];

    $('#newcontest_judges option').each(function(){
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
     * Submit newcontest form
     */
    $('#newcontest').submit(function() {

        var stat_1, stat_2, stat_3, stat_4;

        stat_1 = checking_el_valid($('#newcontest_name'), '');
        stat_2 = checking_el_valid($("#newcontest_description"), '');
        stat_3 = checking_el_valid($("#newcontest_judges"), '');

        if (newContestFormula.toJSON() == "[]") {
            $('#newcontest_formula').addClass('formula--error');
            stat_4 = false;
        } else {
            $('#newcontest_formula').removeClass('formula--error');
            stat_4 = true;
        }

        if ( !stat_1 || !stat_2 || !stat_3 || !stat_4 ) {
            $.notify({
                message: 'Пожалуйста, проверьте правильность введенных данных.'
            },{
                type: 'danger'
            });
            return false;
        }
    });


    /**
     * On change Input Field
     */
    $('body').on('blur', 'input[type="text"], textarea', function(){
        checking_el_valid($(this));
    });



    /**
     * Generate Modal Form for changing information about contest
     */
    $('.edit').click(function(){
        card = this.closest('.card');
        id = card.getAttribute('id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        description = $.trim(document.getElementById('description_' + id).innerHTML);
        judges = getOptions(document.getElementById('judges_' + id));


        //  Fill modal information
        modal_form.action = '/contests/edit/' + card.dataset.id;
        modal_name.value = name;
        modal_description.innerHTML = description;
        modal_judges.innerHTML = setEditedOption(all_judges, judges);

        // initialize select2
        $("#editcontest_judges").select2({
            language: 'ru',
        });

        // initialize textarea_resize
        $(modal_description).on('init keyup focus', function(){
            textarea_resize($(this));
        });

        // initialize modal
        $("#editcontest_modal").modal({
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
        $("#editcontest_judges").select2("destroy");
    });


    /**
     * Update edited form
    */
    $('#editcontest_modal').submit(function(){
        var stat_1 = checking_el_valid($('#editcontest_name'),''),
            stat_2 = checking_el_valid($('#editcontest_description'),''),
            stat_3 = checking_el_valid($('#editcontest_judges'),''),
            stat_4 = true;


        if ( !stat_1 || !stat_2 || !stat_3 || !stat_4 ) {
            $.notify({
                message: 'Пожалуйста, проверьте правильность введенных данных.'
            },{
                type: 'danger'
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

        swal({
            customClass: "delete-block",
            animation: false,
            title: 'Вы уверены, что хотите удалить конкурс?',
            text: "Удалив конкурс, Вы не сможете его восстановить!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Да, удалить конкурс',
            cancelButtonText: 'Нет, отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                url : '/contests/delete/' + dataPk,
                data : {},
                success : function(callback) {

                    contestPk.remove();

                    swal({
                        width: 300,
                        customClass: "delete-block",
                        animation: false,
                        title: 'Удалено!',
                        text: 'Конкурс был удален.',
                        type: 'success',
                        confirmButtonText: 'Готово',
                        confirmButtonClass: 'btn btn_primary',
                        buttonsStyling: false
                    })
                },
                error : function(callback) {
                    console.log("Error has occured in deleting contest");
                    swal({
                        width: 300,
                        customClass: "delete-block",
                        animation: false,
                        title: 'Ошибка!',
                        text: 'Во время удаления произошла ошибка, попробуйте удалить конкурс снова.',
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
     *   Function for Checking on Valid newcontest Form
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