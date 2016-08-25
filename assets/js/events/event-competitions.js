$().ready (function() {

	$('#competition_about').keyup(function(){
		$('#competition_about_max_length').text(parseInt(2000-$('#competition_about').val().length));
	});

	
	$('#new_competition_form').validate({
		errorClass: "error-input",
		rules: {
			competition_name: "required",
		},
		messages: {
			competition_name: "Пожалуйста, введите название конкурса.",
		}
	});
	function count_criterions(item){
		if (item == 0) {return "Всего 0 критерев"} else
		if (item == 1) {return "Всего 1 критерий"} else
		if (item > 1) {return "Всего " + item + " критерия(ев)"}
	};
	$('.table').each(function(){
		$(this).parent().children('.ctiterion_total').text(count_criterions($('tbody tr', this).length));
	});

	$('#add_stage').click(function(){		
		var next_stage = parseInt($(this).parent().parent().children('.stages').children('li').length) + 1;
		var stage = '<li><form class="panel panel-default panel-sm"><div class="panel-heading"><span>Этап №' + next_stage + '.</span><strong><input type="text" name="stage_name_' + next_stage + '" class="form-control input-sm" style="width:250px; display:inline-block" placeholder="Введите название этапа" required></strong></div><div class="panel-body"><div class="form-group"><label>Об этапе</label><textarea name="stage_about_' + next_stage + '" class="form-control input-sm" rows="3" maxlength="2000"></textarea></div><div class="form-group"><label for="competition_judges_select_' + next_stage + '">Представители жюри</label><select name="competition_judges_select_' + next_stage + '" id="competition_judges_select_' + next_stage + '" class="form-control competition_judges_select input-sm" multiple="multiple" required><option value="">Жюри 1</option><option value="">Жюри 2</option><option value="">Жюри 6</option></select><span class="help-block" style="margin-bottom: 2px">Выберите жюри, которые смогут оценивать данный конкурс</span></div><div class="form-group"><label for="competition_charecter_' + next_stage + '">Жюри будут оценивать</label><select id="competition_charecter_' + next_stage + '" name="competition_charecter_' + next_stage + '" class="form-control input-sm" required><option></option><option>участников</option><option>групп</option><option>комманд</option></select></div><div class="form-group"><label>Критерии</label><table class="table table-bordered table-hover stage_criterions" cellspacing="0" width="100%"><thead><tr><th>#</th><th>Название критерия</th><th>Полное описание</th><th>Максимальный балл</th><th>Минимальный балл</th><th class="text-center"><button class="add_criterion" type="button" data-toggle="tooltip" data-placement="top" title="Добавить критерий"><i class="fa fa-plus" aria-hidden="true"></i></button></th></tr></thead><tbody><tr><th>1</th><th><input type="text" name="criterion_name_' + next_stage + '_1" class="form-control input-sm"></th><th><textarea name="criterion_desc_' + next_stage + '_1" class="form-control input-sm" style="resize:none"></textarea></th><th><input type="number" step="1" name="criterion_max_' + next_stage + '_1" class="form-control input-sm"></th><th><input type="number" step="1" name="criterion_min_' + next_stage + '_1" class="form-control input-sm"></th><th><button class="delete_criterion" type="button" title="Удалить"><i class="fa fa-trash" aria-hidden="true"></i></button></th></tr></tbody></table><span class="ctiterion_total"></span></div><div class="form-group pull-right"><button type="button" class="md-btn md-btn-lg md-btn-success new_stage_submit" style="padding: 5px 50px">Создать этап</button></div></div></form></li>';
		$(this).parent().parent().children('.stages').append(stage);
		$(".competition_judges_select").select2({language: "ru"}); 
	});
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
	$('.stages').on('click', '.new_stage_submit', function(){
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
			$(form).submit();
		}
	});
	$('.stages').on('click', '.add_criterion', function(){
		var table = $(this).parent().parent().parent().parent();
		var id = $(table).parent().parent().parent().children('.panel-heading').children('span').text().replace(/[^0-9]/gim,'');
		var tr_len = parseInt($(table).children('tbody').children('tr').length) + 1;
		var temp = "<tr><th>" + tr_len +"</th><th><input type='text' name='criterion_name_" + id + "_" + tr_len + "' class='form-control input-sm'></th><th><textarea name='criterion_desc_" + id + "_" + tr_len + "' class='form-control input-sm' style='resize:none'></textarea></th><th><input type='number' step='1' name='criterion_max_" + id + "_" + tr_len + "' class='form-control input-sm'></th><th><input type='number' step='1' name='criterion_min_" + id + "_" + tr_len + "' class='form-control input-sm'></th><th><button class='delete_criterion' type='button' title='Удалить'><i class='fa fa-trash' aria-hidden='true'></i></button></th></tr>";
		$(table).children('tbody').append(temp);
		$(table).parent().children('.ctiterion_total').text(count_criterions($('tbody tr', table).length));
	});
	$('.stages').on('click', '.delete_criterion', function(){
		var table = $(this).parent().parent().parent().parent();
		var id = $(table).parent().parent().parent().children('.panel-heading').children('span').text().replace(/[^0-9]/gim,'');
		var tr_len = parseInt($(table).children('tbody').children('tr').length);
		var tr_cur = parseInt($(this).parent().parent().index()) + 1;
		var name, desc, max, min;
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

	$.fn.editableform.buttons =
		'<button type="submit" class="md-btn md-btn-success md-btn-sm editable-submit">'+
	    	'<i class="fa fa-fw fa-check"></i>'+
		'</button>'+
		'<button type="button" class="md-btn md-btn-default md-btn-sm editable-cancel">'+
	    	'<i class="fa fa-fw fa-times"></i>'+
		'</button>';

	$.fn.editable.defaults.mode = 'inline';

	$('.editable').editable({
		url: '',
		emptytext: 'Не заполнено',
		ajaxOptions: {
		  dataType: 'json'
		},
		success: function(data, config) {
			console.log(data);
		},
		error: function(data) {
			console.log(data);
		},
		validate: function(value) {
			if($.trim(value) === '') return 'Заполните поле';
		}
	});
	$('.judges').editable({
		url: '',
		emptytext: 'Не заполнено',
		autotext : 'always',
		ajaxOptions: {
		  dataType: 'json'
		},
		source: [
			{id: '1', text: 'жюри 1'},
			{id: '2', text: 'жюри 2'},
			{id: '3', text: 'жюри 3'}
		],
		select2: {
			multiple: true,
			minimumInputLength: 1,
			allowClear: true,
		},
		success: function(data, config) {
			console.log(data);
		},
		error: function(data) {
			console.log(data);
		},
		validate: function(value) {
			if($.trim(value) === '') return 'Заполните поле';
		}
	});
});
