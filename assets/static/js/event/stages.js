$(document).ready(function() {


    formula.create(document.getElementById('formula_stage_1'), {
        'mode': "print",
        'allItems': document.getElementById('allCriterias').dataset.items,
        'curItems': document.getElementById('Criterias_Stage1').dataset.items
    });

    formula.create(document.getElementById('formula_newstage'), {
        'allItems': document.getElementById('allCriterias').dataset.items
    });

    /*
     *  Vars
    */

    var url = "",
        card, id, name, description, part, team, group, formula_input, formula_area,

        droparea_edit = document.getElementById('editstage_droparea').innerHTML,
        modal_name = document.getElementById('editstage_name'),
        modal_description = document.getElementById('editstage_description'),
        modal_members = document.getElementById('editstage_members'),
        modal_formula_input = document.getElementById('editstage_formula'),
        modal_formula_area = document.getElementById('editstage_formula_area'),
        parts_not_distributed = document.getElementById('newstage_participants').innerHTML,
        teams_not_distributed = document.getElementById('newstage_teams').innerHTML,
        groups_not_distributed = document.getElementById('newstage_groups').innerHTML;


    /*
     *  Open newstage form
    */
    $('#newstage').click(function() {
        $(this).addClass('open');
    });
    $('#newstage_name').focus(function() {
        $('#newstage').addClass('open');
    });



    /*
     *  Close newstage form if inputs are empty
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
            document.getElementById('newstage_formula_area').className = "dragable-inputarea";
        }
    });


    /*
     *  Create select2 for newstage form
    */
    var select2Parts = $('#newstage_participants').select2({
        language: 'ru',
        templateResult: render_image_for_select2
    }),
    select2Teams = $('#newstage_teams').select2({
        language: 'ru',
        templateResult: render_image_for_select2
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

    /*
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


    /*
     *  Select all parts
    */
    $("#allParts").on("click", function () {
        if ( document.getElementById("allParts").checked == true) {
            select2Parts.val(select2Parts_val).trigger("change");
            document.getElementById("newstage_participants").disabled = true;
        } else{
            select2Parts.val("").trigger("change");
            document.getElementById("newstage_participants").disabled = false;
        }
    });

    /*
     *  Select all teams
    */
    $("#allTeams").on("click", function () {
        if ( document.getElementById("allTeams").checked == true) {
            select2Teams.val(select2Teams_val).trigger("change");
            document.getElementById("newstage_teams").disabled = true;
        } else{
            select2Teams.val("").trigger("change");
            document.getElementById("newstage_teams").disabled = false;
        }
    });

    /*
     *  Select all groups
    */
    $("#allGroups").on("click", function () {
        if ( document.getElementById("allGroups").checked == true) {
            select2Groups.val(select2Groups_val).trigger("change");
            document.getElementById("newstage_groups").disabled = true;
        } else{
            select2Groups.val("").trigger("change");
            document.getElementById("newstage_groups").disabled = false;
        }
    });



    /*
     *   Btn Submit newstage form
     *   including validation via inputmask
    */
    $('#create_stage').click(function() {
        var form = $(this).closest('form'),
            stat_1, stat_2, stat_3, stat_4
            formula_val = [];

        /* add value to input for formula */
        $('#newstage_formula_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_val.push(data.val);
        });

        stat_1 = checking_el_valid($('#newstage_name'), '');
        stat_2 = checking_el_valid($('#newstage_description'), '');

        if (formula_val.length == 0) {
            document.getElementById('newstage_formula_area').className = "dragable-inputarea invalid"
            stat_3 = false;
        } else {
            document.getElementById('newstage_formula').value = JSON.stringify(formula_val);
            stat_3 = true;
        }

        if ( ! $("#show_participants").hasClass("displaynone") ) {
            stat_4 = checking_el_valid($("#newstage_participants"), '');
        } else if ( ! $("#show_teams").hasClass("displaynone") ) {
            stat_4 = checking_el_valid($("#newstage_teams"), '');
        } else {
            stat_4 = checking_el_valid($("#newstage_groups"), '');
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
     *  Generate Modal Form for changing information about stage
    */
    $('.edit').click(function(){
        card = this.closest('.card');
        id = card.getAttribute('id');
        name = $.trim(document.getElementById('name_' + id).innerHTML);
        description = $.trim(document.getElementById('description_' + id).innerHTML);
        part = $.trim(document.getElementById('participants_' + id).innerHTML);
        team = $.trim(document.getElementById('teams_' + id).innerHTML);
        group = $.trim(document.getElementById('groups_' + id).innerHTML);
        formula_input = document.getElementById('formula_input_' + id).value;
        formula_area = $.trim(document.getElementById('formula_area_' + id).innerHTML);

        //  Fill modal information
        modal_name.value = name;
        modal_description.innerHTML = description;
        if ( part == "" && team == "" ) {
            modal_members.innerHTML = group + groups_not_distributed;
        } else if ( part == "" && group == "" ) {
            modal_members.innerHTML = team + teams_not_distributed;
        } else {
            modal_members.innerHTML = part + parts_not_distributed;
        }
        modal_formula_input.value = formula_input;
        modal_formula_area.innerHTML = formula_area;

        // initialize select2
        if ( part == "" && team == "" ) {
            $("#editstage_members").select2({
                language: 'ru'
            });
        } else {
            $("#editstage_members").select2({
                language: 'ru',
                templateResult: render_image_for_select2
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


    /*
     *  Working with formula in modal form
    */
    var editstage_sortable_id = ['editstage_formula_area','editstage_coeff','editstage_math','editstage_criterias','editstage_droparea'],
            editstage_drop_block = document.getElementById('editstage_drop');
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
       Sortable.create(document.getElementById(editstage_sortable_id[i]), {
           name: 'editstage_formula',
           animation: 150,
           group: groupOpts,
           onStart: function (evt) {
               editstage_drop_block.className = "drop open";
               document.getElementById('editstage_formula_area').className = "dragable-inputarea focus";
           },
           onEnd: function (evt) {
               editstage_drop_block.className = "drop";
               document.getElementById('editstage_droparea').innerHTML = droparea_edit;
               document.getElementById('editstage_formula_area').className = "dragable-inputarea";
               if ( document.getElementById('editstage_formula_area').childNodes.length == 0) {
                   document.getElementById('editstage_formula_area').className = "dragable-inputarea invalid";
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
        modal_members.innerHTML = "";
        modal_formula_input.value = "";
        modal_formula_area.innerHTML = "";
        $("#editstage_members").select2("destroy");
    });


    /*
     *   Save Modification in Modal Form
    */
    $('#update_info').click(function(){
        var form = $('#editstage_modal'),
            stat_1 = checking_el_valid($('#editstage_name'),''),
            stat_2 = checking_el_valid($('#editstage_description'),''),
            stat_3 = checking_el_valid($('#editstage_members'),''),
            stat_4, formula_val = [];

        /* add value to input for formula */
        $('#editstage_formula_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_val.push(data.val);
        });

        if (formula_val.length == 0) {
            document.getElementById('editstage_formula_area').className = "dragable-inputarea invalid"
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
     *  Delete stage
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
                url : '/stages/delete/' + eventPk + '/' + dataPk,
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
     *   Function for Checking on Valid newstage Form
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
