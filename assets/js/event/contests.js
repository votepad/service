$(document).ready(function() {

    /*
     *  Create Tooltips
    */
     $('[data-toggle="tooltip"]').tooltip()

    /*
     *  Vars
    */

    var url = "",
        card, id, name, description, judges, formula_input, formula_area,
        drop_block_new = document.getElementById('newcontest_drop'),
        drop_block_edit = document.getElementById('editcontest_drop')
        droparea_new = document.getElementById('newcontest_droparea').innerHTML,
        droparea_edit = document.getElementById('editcontest_droparea').innerHTML,
        modal_name = document.getElementById('editcontest_name'),
        modal_description = document.getElementById('editcontest_description'),
        modal_judges = document.getElementById('editcontest_judges');
        modal_formula_input = document.getElementById('editcontest_formula'),
        modal_formula_area = document.getElementById('editcontest_formula_area'),
        all_judges = document.getElementById('newcontest_judges').getElementsByTagName('option');


    /*
     *  Open newcontest form
    */
    $('#newcontest').click(function() {
        $(this).addClass('open');
    });
    $('#newcontest_name').focus(function() {
        $('#newcontest').addClass('open');
    });



    /*
     *  Close newcontest form if inputs are empty
    */
    $('body').click(function(event) {
        if ( ! $(event.target).closest("#newcontest").is('#newcontest') && $('#newcontest_name').val() == "" && $('#newcontest_description').val() == ""
                && $("#newcontest_judges").closest('.input-field').find('.select2-selection__rendered .select2-selection__choice').length == 0
                && $("#newcontest_formula_area li").length == 0)
        {
            $('#newcontest').removeClass('open');
            checking_el_valid($('#newcontest_name'), 'valid');
            checking_el_valid($("#newcontest_description"), 'valid');
            checking_el_valid($("#newcontest_judges"), 'valid');
            document.getElementById('newcontest_formula_area').className = "dragable-inputarea";
        }
    });


    /*
     *  Create select2 for newcontest form
    */
    var $judges = $('#newcontest_judges').select2({
        language: 'ru',
    });
    var judges_val = [];

    $('#newcontest_judges option').each(function(){
        judges_val.push($(this).val())
    });


    /*
     *  Select all judges
    */
    $("#allJudges").on("click", function () {
        if ( document.getElementById("allJudges").checked == true) {
            $judges.val(judges_val).trigger("change");
            document.getElementById("newcontest_judges").disabled = true;
        } else{
            $judges.val("").trigger("change");
            document.getElementById("newcontest_judges").disabled = false;
        }
    });


    /*
     *  Working with formula in newcontest form
    */
    var new_sortable_id = ['newcontest_formula_area','newcontest_coeff','newcontest_math','newcontest_criterias','newcontest_droparea'];
	[{
        sort: true,
        pull: true,
        put: true
    },{
        sort: false,
		pull: 'clone',
		put: false
	}, {
        sort: false,
        pull: 'clone',
		put: false
	}, {
        sort: false,
        pull: 'clone',
		put: false
	}, {
        sort: false,
        pull: false,
		put: true
	}].forEach(function (groupOpts, i) {
       Sortable.create(document.getElementById(new_sortable_id[i]), {
           name: 'newcontest_formula_area',
           animation: 150,
           group: groupOpts,
           onStart: function (evt) {
               drop_block_new.className = "drop open";
               document.getElementById('newcontest_formula_area').className = "dragable-inputarea focus";
           },
           onEnd: function (evt) {
               drop_block_new.className = "drop";
               document.getElementById('newcontest_droparea').innerHTML = droparea_new;
               document.getElementById('newcontest_formula_area').className = "dragable-inputarea";
               if ( document.getElementById('newcontest_formula_area').childNodes.length == 0) {
                   document.getElementById('newcontest_formula_area').className = "dragable-inputarea invalid";
               }
           },
       });
	});


    /*
     *   Btn Submit newcontest form
     *   including validation via inputmask
    */
    $('#create_contest').click(function() {
        var form = $(this).closest('form'),
            stat_1, stat_2, stat_3, stat_4
            formula_val = [];

        // add value to input for formula
        $('#newcontest_formula_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_val.push(data.val);
        });

        stat_1 = checking_el_valid($('#newcontest_name'), '');
        stat_2 = checking_el_valid($("#newcontest_description"), '');
        stat_3 = checking_el_valid($("#newcontest_judges"), '');

        if (formula_val.length == 0) {
            document.getElementById('newcontest_formula_area').className = "dragable-inputarea invalid"
            stat_4 = false;
        } else {
            document.getElementById('newcontest_formula').value = JSON.stringify(formula_val);
            stat_4 = true;
        }

        if ( stat_1 == true && stat_2 == true && stat_3 == true && stat_4 == true ) {
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
    $('body').on('blur', 'input[type="text"], textarea', function(){
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
     *  Generate Modal Form for changing information about contest
    */
    $('.edit').click(function(){
        card = this.closest('.card');
        id = card.getAttribute('id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        description = $.trim(document.getElementById('description_' + id).innerHTML);
        judges = document.getElementById('judges_' + id).getElementsByTagName('option');
        formula_input = document.getElementById('formula_input_' + id).value;
        formula_area = $.trim(document.getElementById('formula_area_' + id).innerHTML);

        html_judges = check_free_judges(all_judges, judges);

        //  Fill modal information
        modal_name.value = name;
        modal_description.innerHTML = description;
        modal_judges.innerHTML = html_judges;
        modal_formula_input.value = formula_input;
        modal_formula_area.innerHTML = formula_area;

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


    /*
     *  Working with formula in modal form
    */
    var editcontest_sortable_id = ['editcontest_formula_area','editcontest_coeff','editcontest_math','editcontest_criterias','editcontest_droparea'];
	[{
        sort: true,
        pull: true,
        put: true
    },{
        sort: false,
		pull: 'clone',
		put: false
	}, {
        sort: false,
        pull: 'clone',
		put: false
	}, {
        sort: false,
        pull: 'clone',
		put: false
	}, {
        sort: false,
        pull: false,
		put: true
	}].forEach(function (groupOpts, i) {
       Sortable.create(document.getElementById(editcontest_sortable_id[i]), {
           name: 'editcontest_formula',
           animation: 150,
           group: groupOpts,
           onStart: function (evt) {
               drop_block_edit.className = "drop open";
               document.getElementById('editcontest_formula_area').className = "dragable-inputarea focus";
           },
           onEnd: function (evt) {
               drop_block_edit.className = "drop";
               document.getElementById('editcontest_droparea').innerHTML = droparea_edit;
               document.getElementById('editcontest_formula_area').className = "dragable-inputarea";
               if ( document.getElementById('editcontest_formula_area').childNodes.length == 0) {
                   document.getElementById('editcontest_formula_area').className = "dragable-inputarea invalid";
               }
           },
       });
	});


    /*
     *  Cansel Edit in Modal Form
    */
    $('button[data-dismiss]').click(function(){
        modal_name.value = "";
        modal_description.innerHTML = "";
        modal_judges.innerHTML = "";
        modal_formula_input.value = "";
        modal_formula_area.innerHTML = "";
        $("#editcontest_judges").select2("destroy");
    });


    /*
     *   Save Modification in Modal Form
    */
    $('#update_info').click(function(){
        var form = $('#editcontest_modal'),
            stat_1 = checking_el_valid($('#editcontest_name'),''),
            stat_2 = checking_el_valid($('#editcontest_description'),''),
            stat_3 = checking_el_valid($('#editcontest_judges'),''),
            stat_4, formula_val = [];

        /* add value to input for formula */
        $('#editcontest_formula_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_val.push(data.val);
        });

        if (formula_val.length == 0) {
            document.getElementById('editcontest_formula_area').className = "dragable-inputarea invalid"
            stat_4 = false;
        } else {
            modal_formula_input.value = JSON.stringify(formula_val);
            stat_4 = true;
        }

        if ( stat_1 == true && stat_2 == true && stat_3 == true && stat_4 == true) {
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
     *  Delete contest
    */
    $('.delete').click(function(){
        /** Information about action */
        var activeAction = $(this).get(0),
            dataPk = activeAction.dataset.pk;

        var contestPk = $('#contest_' + dataPk).get(0),
            eventPk = $('#event_id').val();

        swal({
            customClass: "delete-block",
            animation: false,
            title: 'Вы уверены, что хотите удалить конкурс?',
            text: "Удалив клнкурс, Вы не сможете его восстановить!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Да, удалить клнкурс',
            cancelButtonText: 'Нет, отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                url : '/contests/delete/' + eventPk + '/' + dataPk,
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
     *    Function for Rendering Image for select2 elements
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

});


/*
 * Add coeff to coeff_arrays while editing formula
*/
function addcoeff(id_array) {
    swal({
        customClass: "coeff-area",
        animation: false,
        width: 300,
        title: 'Введите коэффицент',
        inputPlaceholder: "0.5",
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Добавить',
        cancelButtonText: 'Отмена',
        inputValidator: function (val) {
            var number_arr = new RegExp("[^0-9.]");
            return new Promise(function (resolve, reject) {
                if ( ! number_arr.test(val) && val ) {
                    resolve()
                } else {
                    reject('Вы ввели не число!')
                }
            })
        }
    }).then(function (number) {
        var el = document.createElement('li');
        el.className = "item dark";
        el.dataset.val = "coeff_" + number;
        el.innerHTML = number;
        id_array.appendChild(el);
    });
}
