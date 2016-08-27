$().ready (function() {

	/* COMPETITIONS */

	/* NEW COMPETITION */
	$('#competition_about').keyup(function(){
		$('#competition_about_max_length').text(parseInt(2000-$('#competition_about').val().length));
	});
	$('#new_competition_form').validate({
		errorClass: "error-input",
		rules: {
			competition_name: "required",
			competition_about: "required",
		},
		messages: {
			competition_name: "Пожалуйста, введите название конкурса.",
			competition_about: "Пожалуйста, расскажите о конкурсе.",
		}
	});

	/* EDIT EXISTED COMPETITION */
	$('.panel').on('click', '.edit_competition', function(){
		if ( $('body').find('#edit_competition_form').length == 0 ) {
			$('body').append('<form class="modal fade" id="edit_competition_form" tabindex="-1" role="dialog" aria-labelledby="edit_competition_form"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" id="edit_competition_form_close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Изменение информации о конкурсе</h4></div><div class="modal-body"><div class="form-group"><label class="control-label">Название конкурса</label><div><input name="competition_name" class="form-control input-sm" value="' + $(this).parent().parent().find('strong').text() + '" required></div></div><div class="form-group"><label class="control-label">Описание</label><div><textarea name="competition_about" class="form-control input-sm" rows="3" maxlength="2000" required>' + $(this).parent().parent().parent().children('.panel-body').children('.form-group').first().find('div').text() + '</textarea></div></div></div><div class="modal-footer"><button type="button" id="edit_competition_form_close" class="md-btn md-btn-default" data-dismiss="modal" style="margin-right:15px">Отмена</button><button id="edit_competition_form_submit" type="button" class="md-btn md-btn-success">Обновить</button></div></div></div></form>');
		}
		$('#edit_competition_form').modal({backdrop:'static',keyboard: false},'show');
	});

	/* CANSEL EDIT EXISTED COMPETITION */
	$('body').on('click', '#edit_competition_form_close', function(){
		$('#edit_competition_form').remove();
	});
	

	/* SAVE EXISTED COMPETITION */
	$('body').on('click', '#edit_competition_form_submit', function(){
		var form = $('#edit_competition_form');
		$('.form-control', form).each(function(){
			console.log($(this).val());
			if ( $(this).val() == '' && ! $(this).hasClass('error-input') ) {
				$(this).addClass('error-input').parent().append('<label class="error-input">Не заполнено</label>');
				$(form).addClass('invalid');
			}
		});
		if ( ! $(form).hasClass('invalid') ) {
			form[0].submit();
		}
	});
	$('body').on('blur', '#edit_competition_form .form-control', function(){
		if ( $(this).val() != '' ) {
			$(this).removeClass('error-input').parent().children('.error-input').remove();
			$(form).removeClass('invalid');
		} else{
			$(this).addClass('error-input').parent().append('<label class="error-input">Не заполнено</label>');
			$(form).addClass('invalid');
		}
	});
	
	/* DELETE EXISTED COMPETITION */
	$('.delete_competition').click(function(){

	});

	/*********************************************************************************************************************************************************/

	/* STAGES*/

	/* NEW STAGE */
	$('#add_stage').click(function(){
		var next_stage = parseInt($(this).parent().parent().children('.stages').children('li').length) + 1;
		var stage = '<li><form class="panel panel-default panel-sm"><div class="panel-heading"><span>Этап №' + next_stage + '.</span><strong class="inline"><input type="text" name="stage_name_' + next_stage + '" class="form-control input-sm" style="width:250px; display:inline-block" placeholder="Введите название этапа" required></strong><div class="pull-right"><button type="button" class="save">Сохранить</button></div></div><div class="panel-body"><div class="form-group"><label>Об этапе</label><textarea name="stage_about_' + next_stage + '" class="form-control input-sm" rows="3" maxlength="2000"></textarea></div><div class="form-group"><label for="competition_judges_select_' + next_stage + '">Представители жюри</label><select name="competition_judges_select_' + next_stage + '" id="competition_judges_select_' + next_stage + '" class="form-control competition_judges_select input-sm" multiple="multiple" required>' + get_stage_judges() + '</select><span class="help-block" style="margin-bottom: 2px">Выберите жюри, которые смогут оценивать данный конкурс</span></div><div class="form-group"><label for="competition_charecter_' + next_stage + '">Жюри будут оценивать</label><select id="competition_charecter_' + next_stage + '" name="competition_charecter_' + next_stage + '" class="form-control input-sm" required><option></option>' + get_stage_charackters() + '</select></div><div class="form-group"><label>Критерии</label><table class="table table-bordered table-hover stage_criterions" cellspacing="0" width="100%"><thead><tr><th>#</th><th>Название критерия</th><th>Полное описание</th><th>Максимальный балл</th><th>Минимальный балл</th><th class="text-center"><button class="add_criterion" type="button" data-toggle="tooltip" data-placement="top" title="Добавить критерий"><i class="fa fa-plus" aria-hidden="true"></i></button></th></tr></thead><tbody><tr><th>1</th><th><input type="text" name="criterion_name_' + next_stage + '_1" class="form-control input-sm"></th><th><textarea name="criterion_desc_' + next_stage + '_1" class="form-control input-sm" style="resize:none"></textarea></th><th><input type="number" step="1" name="criterion_max_' + next_stage + '_1" class="form-control input-sm"></th><th><input type="number" step="1" name="criterion_min_' + next_stage + '_1" class="form-control input-sm"></th><th><button class="delete_criterion" type="button" title="Удалить"><i class="fa fa-trash" aria-hidden="true"></i></button></th></tr></tbody></table><span class="ctiterion_total"></span></div></div></form></li>';
		$(this).parent().parent().children('.stages').append(stage);
		$(".competition_judges_select").select2({language: "ru"});
	});

	/* EDIT EXISTED STAGE */
	$('.stages').on('click', '.edit', function(){
		$(this).css('display','none');
		var form = $(this).parent().parent().parent();
		var id = $(form).children('.panel-heading').children('a').children('div').children('span').text().replace(/[^0-9]/gim,'');
		var elements = $('.for_edit_form', form).length;
		var data_array = new Array(elements), i = 0;
		$('.for_edit_form', form).each(function(){
			data_array[i] = new Array($(this).attr('name'), $(this).text()); 
			i++;
		});
		var stage = '<li><form class="panel panel-default panel-sm"><div class="panel-heading"><span>Этап №' + id + '.</span><strong class="inline"><input type="text" name="' + data_array[0][0] + '" class="form-control input-sm" style="width:250px; display:inline-block" value="' + data_array[0][1] + '" required></strong><div class="pull-right"><button type="button" class="save">Сохранить</button><button type="button" class="delete">Удалить</button></div></div><div class="panel-body"><div class="form-group"><label>Об этапе</label><textarea name="' + data_array[1][0] + '" class="form-control input-sm" rows="3" maxlength="2000">' + data_array[1][1] + '</textarea></div><div class="form-group"><label for="' + data_array[2][0] + '">Представители жюри</label><select name="' + data_array[2][0] + '" id="' + data_array[2][0] + '" class="form-control competition_judges_select input-sm" multiple="multiple" required>' + get_stage_judges(data_array[2][1]) + '</select><span class="help-block" style="margin-bottom: 2px">Выберите жюри, которые смогут оценивать данный конкурс</span></div><div class="form-group"><label for="' + data_array[3][0] + '">Жюри будут оценивать</label><select id="' + data_array[3][0] + '" name="' + data_array[3][0] + '" class="form-control input-sm" required>' + get_stage_charackters(data_array[3][1]) +'</select></div><div class="form-group"><label>Критерии</label><table class="table table-bordered table-hover stage_criterions" cellspacing="0" width="100%"><thead><tr><th>#</th><th>Название критерия</th><th>Полное описание</th><th>Максимальный балл</th><th>Минимальный балл</th><th class="text-center"><button class="add_criterion" type="button" data-toggle="tooltip" data-placement="top" title="Добавить критерий"><i class="fa fa-plus" aria-hidden="true"></i></button></th></tr></thead><tbody class="add_rows"></tbody></table><span class="ctiterion_total"></span></div></div></form></li>';
		$('.stages li:nth-child(' + id + ')').empty().append(stage);
		for(var i = 0; i < (elements-4)/4; i++){			
			$('.add_rows').append('<tr><th>' + (i+1) + '</th><th><input type="text" name="' + data_array[4+i*4][0] + '" class="form-control input-sm" value="' + data_array[4+i*4][1] + '"></th><th><textarea name="' + data_array[5+i*4][0] + '" class="form-control input-sm">' + data_array[5+i*4][1] + '</textarea></th><th><input type="number" step="1" name="' + data_array[6+i*4][0] + '" class="form-control input-sm" value="' + data_array[6+i*4][1] + '"></th><th><input type="number" step="1" name="' + data_array[7+i*4][0] + '" class="form-control input-sm" value="' + data_array[7+i*4][1] + '"></th><th><button class="delete_criterion" type="button" title="Удалить"><i class="fa fa-trash" aria-hidden="true"></i></button></th></tr>');
		}
		$(".competition_judges_select").select2({language: "ru"});
	});

	/* SAVE NEW/EXISTED STAGE */
	$('.stages').on('click', '.save', function(){
		var form = $(this).parent().parent().parent();
		$(form).removeClass('novalid');
		var id = $(form).children('.panel-heading').children('span').text().replace(/[^0-9]/gim,'');
		$('.input-sm', form).each(function(){
			$(this).removeClass('error-input');
			$(this).parent().children('.error').remove();
			if ($(this).val() == '') {
				if ( ! $(form).hasClass('novalid')) { $(form).addClass('novalid'); }
				$(this).addClass('error-input');
				$(this).parent().append('<label class="error-input error" for="' + $(this).attr('name') + '">Не заполнено</label>');
			}
		});
		if ( $('.select2-selection__choice', form).length < 2) {
			if ( ! $(form).hasClass('novalid')) { $(form).addClass('novalid'); }
			$('.select2-selection--multiple', form).addClass('error-input');
			$('#competition_judges_select_'+ id).parent().children('.error').remove();
			$('#competition_judges_select_'+ id).parent().append('<label class="error-input error" for="' + $(this).attr('name') + '">Выберите не менее 2х жюри</label>');
		} else{
			$('.select2-selection--multiple', form).removeClass('error-input');
			$('#competition_judges_select_'+ id).parent().children('.error').remove();
		}
		if ( ! $(form).hasClass('novalid')) {
			form[0].submit();
		} else {
			$(form).find('.error-input').first().focus();
		}
	});

	/* DELETE EXISTED STAGE */
	$('.delete').click(function(){

	});

	/*********************************************************************************************************************************************************/
	
	/* CRITERIONS */

	/* ADD CRITERION */
	$('.stages').on('click', '.add_criterion', function(){
		var table = $(this).parent().parent().parent().parent();
		var id = $(table).parent().parent().parent().children('.panel-heading').children('span').text().replace(/[^0-9]/gim,'');
		var tr_len = parseInt($(table).children('tbody').children('tr').length) + 1;
		var temp = "<tr><th>" + tr_len +"</th><th><input type='text' name='criterion_name_" + id + "_" + tr_len + "' class='form-control input-sm'></th><th><textarea name='criterion_desc_" + id + "_" + tr_len + "' class='form-control input-sm' style='resize:none'></textarea></th><th><input type='number' step='1' name='criterion_max_" + id + "_" + tr_len + "' class='form-control input-sm'></th><th><input type='number' step='1' name='criterion_min_" + id + "_" + tr_len + "' class='form-control input-sm'></th><th><button class='delete_criterion' type='button' title='Удалить'><i class='fa fa-trash' aria-hidden='true'></i></button></th></tr>";
		$(table).children('tbody').append(temp);
		$(table).parent().children('.ctiterion_total').text(count_criterions($('tbody tr', table).length));
	});

	/* DELETE CRITERION */
	$('.stages').on('click', '.delete_criterion', function(){
		var table = $(this).parent().parent().parent().parent();
		var id = $(table).parent().parent().parent().children('.panel-heading').children('span').text().replace(/[^0-9]/gim,'');
		var tr_len = parseInt($(table).children('tbody').children('tr').length);
		var tr_cur = parseInt($(this).parent().parent().index()) + 1;
		var name, desc, max, min;
		console.log();
		for (var i = tr_cur; i < tr_len; i++){
			name = $("input[name=criterion_name_" + id + "_" + (i+1) + "]").val();
			desc = $("textarea[name=criterion_desc_" + id + "_" + (i+1) + "]").val();
			max = $("input[name=criterion_max_" + id + "_" + (i+1) + "]").val();
			min = $("input[name=criterion_min_" + id + "_" + (i+1) + "]").val();
			$("input[name=criterion_name_" + id + "_" + i + "]").val(name);
			$("textarea[name=criterion_desc_" + id + "_" + i + "]").val(desc);
			$("input[name=criterion_max_" + id + "_" + i + "]").val(max);
			$("input[name=criterion_min_" + id + "_" + i + "]").val(min);
		}
		$(table).children('tbody').children('tr:last-child').remove();
		$(table).parent().children('.ctiterion_total').text(count_criterions($('tbody tr', table).length));
	});

	/*********************************************************************************************************************************************************/
	
	/* FUNCTIONS */

	function count_criterions(item){
		if (item == 0) {return "Всего 0 критерев"} else
		if (item == 1) {return "Всего 1 критерий"} else
		if (item > 1) {return "Всего " + item + " критерия(ев)"}
	};
	$('.table').each(function(){
		$(this).parent().children('.ctiterion_total').text(count_criterions($('tbody tr', this).length));
	});
	function checking_selected_element(index){ if (index == -1) { return ''; } else{ return 'selected'; } }
	function get_stage_judges(str){
		// в массив judges поместить жюри, созданных для данного мероприятия (id - вставляются в value)
		var judges = [{'id':'1','name':'Жюри 1'},{'id':'2','name':'Жюри 2'},{'id':'3','name':'Жюри 3'}];
		if (str == undefined) {
			//жюри не выбраны
			var temp = '';
			for(var i = 0; i < judges.length; i++){
				temp = temp + '<option value="' + judges[i].id + '">' + judges[i].name + '</option>';
			}
			return temp;
		} else {
			//жюри выбраны
			var select_judges = str.split(', ');
			var temp = '';
			for(var i = 0; i < judges.length; i++){
				temp = temp + '<option value="' + judges[i].id + '"' + checking_selected_element(select_judges.indexOf(judges[i].name)) + '>' + judges[i].name + '</option>';
			}
			return temp;
		}
	}
	function get_stage_charackters(str){
		// в массив charackters поместить участников/группы/команды, которых можно выбрать для оценивания (выбираются на странице charecters)
		var charackters = [{'id':'1','name':'участников'},{'id':'2','name':'групп'},{'id':'3', 'name':'комманд'}];
		if (str == undefined) {
			//действующие лица не выбраны
			var temp = '';
			for(var i = 0; i < charackters.length; i++){
				temp = temp + '<option value="' + charackters[i].id + '">' + charackters[i].name + '</option>';
			}
			return temp;
		} else {
			//действующие лица выбраны
			var temp = '';
			for(var i = 0; i < charackters.length; i++){
				temp = temp + '<option value="' + charackters[i].id + '"' + checking_selected_element(str.indexOf(charackters[i].name)) + '>' + charackters[i].name + '</option>';
			}
			return temp;	
		}
	}

	/*********************************************************************************************************************************************************/

	/* VALIDATION */
	
	$('.stages').on('blur', '.input-sm', function(){
		if ( $(this).val() != '' ) {
			$(this).removeClass('error-input');
			$(this).parent().children('.error').remove();
		} else{
			$(this).addClass('error-input');
			if ( ! $(this).parent().children('label').hasClass('error') ) {
				$(this).parent().append('<label class="error-input error" for="' + $(this).attr('name') + '">Не заполнено</label>');
			}
		}
	});
	$('.stages').on('blur', '.select2-search__field', function(){
		if ( $(this).parent().parent().children('.select2-selection__choice').length >= 2 ) {
			$(this).parent().parent().parent().removeClass('error-input');
			$(this).parent().parent().parent().parent().parent().parent().children('.error').remove();	
		} else{
			$(this).parent().parent().parent().addClass('error-input');
			$(this).parent().parent().parent().parent().parent().parent().children('.error').remove();
			$(this).parent().parent().parent().parent().parent().parent().append('<label class="error-input error" for="' + $(this).attr('name') + '">Выберите не менее 2х жюри</label>');	
		}
	});
});