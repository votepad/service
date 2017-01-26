$(document).ready(function() {

    /*
     *  Create Tooltips
    */
     $('[data-toggle="tooltip"]').tooltip()

    /*
     *  Vars
    */

    var url = "",
        droparea_text = document.getElementById('result_droparea_part').innerHTML,
        contest_part = $.trim(document.getElementById('result_contest_part').innerHTML),
        contest_team = $.trim(document.getElementById('result_contest_team').innerHTML),
        contest_group = $.trim(document.getElementById('result_contest_group').innerHTML);



    /*
     * Delete results input field, if there has not elements
    */

    // if participants not exist -> delete block
    if (contest_part == "") {
        document.getElementById('result_part').remove();
    }
    // if teams not exist -> delete block
    if (contest_team == "") {
        document.getElementById('result_team').remove();
    }
    // if groups not exist -> delete block
    if (contest_group == "") {
        document.getElementById('result_group').remove();
    }
    if (contest_part == "" && contest_team == "" && contest_group == "") {
        document.getElementById('showVideo').className = "block";
    }


    /*
     *  Working with formula for PART result
    */
    var sortable_id_part = ['result_droparea_part','result_formula_part_area','result_contest_part','result_math_part','result_coeff_part'],
        drop_block_part = document.getElementById('result_drop_part');
	[
        {
            name: 'result_formula_part_area',
            sort: false,
            pull: false,
    		put: true
    	},{
            name: 'result_formula_part_area',
            sort: true,
            pull: true,
            put: true
        },{
            name: 'result_formula_part_area',
            sort: false,
    		pull: 'clone',
    		put: false
    	},{
            name: 'result_formula_part_area',
            sort: false,
            pull: 'clone',
    		put: false
    	},{
            name: 'result_formula_part_area',
            sort: false,
            pull: 'clone',
    		put: false
        }
    ].forEach(function (groupOpts, i) {
       Sortable.create(document.getElementById(sortable_id_part[i]), {
           animation: 150,
           group: groupOpts,
           onStart: function (evt) {
               drop_block_part.className = "drop open";
               document.getElementById('result_formula_part_area').className = "dragable-inputarea focus";
           },
           onEnd: function (evt) {
               drop_block_part.className = "drop";
               document.getElementById('result_droparea_part').innerHTML = droparea_text;
               document.getElementById('result_formula_part_area').className = "dragable-inputarea";
               if ( document.getElementById('result_formula_part_area').childNodes.length == 0) {
                   document.getElementById('result_formula_part_area').className = "dragable-inputarea invalid";
               }
           },
       });
	});



    /*
     *  Working with formula for TEAM result
    */
    var sortable_id_team = ['result_droparea_team','result_formula_team_area','result_contest_team','result_math_team','result_coeff_team'],
        drop_block_team = document.getElementById('result_drop_team');
	[
        {
            name: 'result_formula_team_area',
            sort: false,
            pull: false,
            put: true
    	},{
            name: 'result_formula_team_area',
            sort: true,
            pull: true,
            put: true
        },{
            name: 'result_formula_team_area',
            sort: false,
            pull: 'clone',
            put: false
    	},{
            name: 'result_formula_team_area',
            sort: false,
            pull: 'clone',
            put: false
    	},{
            name: 'result_formula_team_area',
            sort: false,
            pull: 'clone',
            put: false
    	}
    ].forEach(function (groupOpts, i) {
       Sortable.create(document.getElementById(sortable_id_team[i]), {
           animation: 150,
           group: groupOpts,
           onStart: function (evt) {
               drop_block_team.className = "drop open";
               document.getElementById('result_formula_team_area').className = "dragable-inputarea focus";
           },
           onEnd: function (evt) {
               drop_block_team.className = "drop";
               document.getElementById('result_droparea_team').innerHTML = droparea_text;
               document.getElementById('result_formula_team_area').className = "dragable-inputarea";
               if ( document.getElementById('result_formula_team_area').childNodes.length == 0) {
                   document.getElementById('result_formula_team_area').className = "dragable-inputarea invalid";
               }
           },
       });
	});



    /*
     *  Working with formula for GROUP result
    */
    var sortable_id_group = ['result_droparea_group','result_formula_group_area','result_contest_group','result_math_group','result_coeff_group'],
        drop_block_group = document.getElementById('result_drop_group');
	[
        {
            name: 'result_formula_group_area',
            sort: false,
            pull: false,
            put: true
    	},{
            name: 'result_formula_group_area',
            sort: true,
            pull: true,
            put: true
        },{
            name: 'result_formula_group_area',
            sort: false,
            pull: 'clone',
            put: false
    	},{
            name: 'result_formula_group_area',
            sort: false,
            pull: 'clone',
            put: false
    	},{
            name: 'result_formula_group_area',
            sort: false,
            pull: 'clone',
            put: false
    	}
    ].forEach(function (groupOpts, i) {
       Sortable.create(document.getElementById(sortable_id_group[i]), {
           animation: 150,
           group: groupOpts,
           onStart: function (evt) {
               drop_block_group.className = "drop open";
               document.getElementById('result_formula_group_area').className = "dragable-inputarea focus";
           },
           onEnd: function (evt) {
               drop_block_group.className = "drop";
               document.getElementById('result_droparea_group').innerHTML = droparea_text;
               document.getElementById('result_formula_group_area').className = "dragable-inputarea";
               if ( document.getElementById('result_formula_group_area').childNodes.length == 0) {
                   document.getElementById('result_formula_group_area').className = "dragable-inputarea invalid";
               }
           },
       });
	});



    /*
     *   Btn Submit result form
    */
    $('#update').click(function() {
        var form = $(this).closest('form'),
            stat_1, stat_2, stat_3,
            formula_part_val = [],
            formula_team_val = [],
            formula_group_val = [];

        // add value to input for formula - PART
        $('#result_formula_part_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_part_val.push(data.val);
        });

        if (formula_part_val.length == 0) {
            document.getElementById('result_formula_part_area').className = "dragable-inputarea invalid"
            stat_1 = false;
        } else {
            document.getElementById('result_formula_part').value = JSON.stringify(formula_part_val);
            stat_1 = true;
        }


        // add value to input for formula - TEAM
        $('#result_formula_team_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_team_val.push(data.val);
        });

        if (formula_team_val.length == 0) {
            document.getElementById('result_formula_team_area').className = "dragable-inputarea invalid"
            stat_2 = false;
        } else {
            document.getElementById('result_formula_team').value = JSON.stringify(formula_team_val);
            stat_2 = true;
        }


        // add value to input for formula - TEAM
        $('#result_formula_group_area .item').each(function(i){
            var data = $(this)[0].dataset;
            formula_group_val.push(data.val);
        });

        if (formula_group_val.length == 0) {
            document.getElementById('result_formula_group_area').className = "dragable-inputarea invalid"
            stat_3 = false;
        } else {
            document.getElementById('result_formula_group').value = JSON.stringify(formula_group_val);
            stat_3 = true;
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
