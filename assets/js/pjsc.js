$(document).ready (function() {
/* START PARTICIPANT */
	var participant_list_counter = $(".participant-list li").length;
	/* ADD PARTICIPANT */
	$('#add-participant-btn').on("click", function(){
 		var name = $("#name-participant").val();
 		if (name != '') {
    		participant_list_counter++;
    		var temp = "<li><div class='panel panel-default' style='border-color:#5d9cec;'><div id='participant_" + participant_list_counter + "' role='tab' class='panel-heading'><h4 class='panel-title'>" + name + "<a type='button' class='pull-right delete-participant' title='Удалить участника' id='delete-participant_" + participant_list_counter + "'><em class='fa fa-times'></em></a></h4></div><div class='panel-body'> <div class='col-md-6 btn_area'><textarea style='resize: none;' name='participant_description_" + participant_list_counter + "' placeholder='Описание участника, его достижения и др.' class='form-control error' aria-required='true' maxlength='1000' rows='6' required></textarea><input type='hidden' name='participant_name_" + participant_list_counter + "' value='"+ name +"'></div><div class='col-md-3 btn_area text-center'><label>Выберите фотографию участника</label><br><small>допустимые форматы jpeg,png,gif</small><div class='btn_area'><input type='file' id='participant_photo_" + participant_list_counter + "' name='participant_photo_" + participant_list_counter + "' tabindex='-1' class='logo-input change'><label for='participant_photo_" + participant_list_counter + "' class='btn btn-default fileinput-button'><span class='fa fa-folder-open'></span><span class='buttonText'> Выбрать фото</span></label></div></div><div class='col-md-3 btn_area text-center'><img id='participant_preview_" + participant_list_counter + "' src='../../assets/img/user/no-user.png' class='pronwe_boxShadow pronwe_border-1px logo-preview'></div></div></div></li>";
    		$('.participant-list').append(temp);
    		$("#name-participant").val('');
 		}
 		if (participant_list_counter > 0) {
    		$('.btn-submit-participant').prop('disabled', false);
 		}
	});
	/* DELITE PARTICIPANT */
	$('.participant-list').on('click', '.delete-participant', function(){
 		var number = $(this).attr('id');
 		number = number.substr(number.lastIndexOf('_')+1,number.length);
 		var i;
 		for(i=parseInt(number)+1; i<=participant_list_counter; i++)
 		{
    		var liElem = $('.participant-list li:nth-child('+i+')');
    		var setHTML = liElem.html();
    		setHTML = setHTML.replace("id=\"participant_"+i+"\"","id=\"participant_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"name_"+i+"\"","id=\"name_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"delete-participant_"+i+"\"","id=\"delete-participant_"+(i-1)+"\"");
    		setHTML = setHTML.replace("name=\"participant_description_"+i+"\"","name=\"participant_description_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"participant_photo_"+i+"\"","id=\"participant_photo_"+(i-1)+"\"");
    		setHTML = setHTML.replace("name=\"participant_photo_"+i+"\"","name=\"participant_photo_"+(i-1)+"\"");
    		setHTML = setHTML.replace("for=\"participant_photo_"+i+"\"","for=\"participant_photo_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"participant_preview_"+i+"\"","id=\"participant_preview_"+(i-1)+"\"");
    		liElem.html(setHTML);
 		}
 		participant_list_counter--;
 		$('.participant-list li').remove(':nth-child(' + number + ')');
 		if (participant_list_counter == 0) {
    		$('.btn-submit-participant').prop('disabled', true);
 		}
	});
	/* SELECT PARTICIPANT PHOTO*/
	function readURL1(input) {
        if (input.files && input.files[0]) {
        	var number = $(input).attr('id');
	 		number = number.substr(number.lastIndexOf('_')+1,number.length);
            var type   = ['image/gif','image/jpg','image/jpeg','image/png'];
            var width  = 1024;
            var height = 768;
            var size   = 525000; // bytes
            var file   = input.files[0];
            function errType () {
                alert('Error type ...');
                input.value = '';
            }
            function errSize () {
                alert('Error size ...');
                input.value = '';
            }
            function errWidth() {
                alert('Error width ...');
                input.value = '';
            }
            function errHeight() {
                alert('Error height ...');
                input.value = '';
            }
            if (type.indexOf(file.type) == -1) {
                errType ();
                return false;
            } else if (file.size > size) {
                errSize();
                return false;
            } else if (file.width < width) {
                errWidth();
                return false;
            } else if (file.height < height) {
                errHeight();
                return false;
            } else {
                var reader = new FileReader();            
                    reader.onload = function (e) {
                        $('#participant_preview_'+number).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
            }
        }
    }
    $('.panel-body').on('change','.change',function(){
       	readURL1(this);
    });
/* END PARTICIPANT */

/* START JUDGE */
	/* ADD JUDGE */
	var judge_list_counter = $(".judge-list li").length;
	$('#add-judge-btn').on("click", function(){
	 	var name = $("#name-judge").val();
	 	if (name != '') {
	    	judge_list_counter++;
	    	var temp = "<li><div class='panel panel-default' style='border-color:#5d9cec;'><div id='judge_" + judge_list_counter + "' role='tab' class='panel-heading'><h4 class='panel-title'>" + name + "<a type='button' class='pull-right delete-judge' title='Удалить члена жюри' id='delete-judge_" + judge_list_counter + "'><em class='fa fa-times'></em></a></h4></div><div class='panel-body'> <div class='col-md-6 btn_area'><input name='judge_email_" + judge_list_counter + "' type='email' placeholder='Укажите e-mail члена жюри' class='form-control btn_area' required><input type='hidden' name='judgename_" + judge_list_counter + "' value='"+ name +"'><input name='judge_status_" + judge_list_counter + "' type='text' placeholder='Укажите кем является член жюри' class='form-control btn_area' required></div><div class='col-md-3 btn_area text-center'><label>Выберите фотографию жюри</label><br><small>допустимые форматы jpeg,png,gif</small><div class='btn_area'><input type='file' id='judge_photo_" + judge_list_counter + "' name='judge_photo_" + judge_list_counter + "' tabindex='-1' class='logo-input change'><label for='judge_photo_" + judge_list_counter + "' class='btn btn-default fileinput-button'><span class='fa fa-folder-open'></span><span class='buttonText'> Выбрать фото</span></label></div></div><div class='col-md-3 btn_area text-center'><img id='judge_preview_" + judge_list_counter + "' src='../../assets/img/user/no-user.png' class='pronwe_boxShadow pronwe_border-1px logo-preview'></div></div></div></li>";
	    	$('.judge-list').append(temp);
	    	$("#name-judge").val('');
	 	}
	 	if (judge_list_counter > 0) {
		    $('.btn-submit-judge').prop('disabled', false);
	 	}
	});
	/* DELITE JUDGE */
	$('.judge-list').on('click', '.delete-judge', function(){
		var number = $(this).attr('id');
	 	number = number.substr(number.lastIndexOf('_')+1,number.length);
	 	var i;
	 	for(i=parseInt(number)+1; i<=judge_list_counter; i++)
	 	{
		    var liElem = $('.judge-list li:nth-child('+i+')');
	    	var setHTML = liElem.html();
	    	setHTML = setHTML.replace("id=\"judge_"+i+"\"","id=\"judge_"+(i-1)+"\"");
	    	setHTML = setHTML.replace("id=\"judge_name_"+i+"\"","id=\"judge_name_"+(i-1)+"\"");
	    	setHTML = setHTML.replace("id=\"delete-judge_"+i+"\"","id=\"delete-judge_"+(i-1)+"\"");
	    	setHTML = setHTML.replace("name=\"judge_status_"+i+"\"","name=\"judge_status_"+(i-1)+"\""); //
	    	setHTML = setHTML.replace("name=\"judge_email_"+i+"\"","name=\"judge_email_"+(i-1)+"\"");
	    	setHTML = setHTML.replace("name=\"judge_photo_"+i+"\"","name=\"judge_photo_"+(i-1)+"\"");
	    	setHTML = setHTML.replace("id=\"judge_photo_"+i+"\"","id=\"judge_photo_"+(i-1)+"\"");
    		setHTML = setHTML.replace("for=\"judge_photo_"+i+"\"","for=\"judge_photo_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"judge_preview_"+i+"\"","id=\"judge_preview_"+(i-1)+"\"");
	    	liElem.html(setHTML);
	 	}
	 	judge_list_counter--;
	 	$('.judge-list li').remove(':nth-child(' + number + ')');
	 	if (judge_list_counter == 0) {
    		$('.btn-submit-judge').prop('disabled', true);
 		}
	});
	/* SELECT JUDGE PHOTO*/
	function readURL2(input) {
        if (input.files && input.files[0]) {
        	var number = $(input).attr('id');
	 		number = number.substr(number.lastIndexOf('_')+1,number.length);
            var type   = ['image/gif','image/jpg','image/jpeg','image/png'];
            var width  = 1024;
            var height = 768;
            var size   = 525000; // bytes
            var file   = input.files[0];
            function errType () {
                alert('Error type ...');
                input.value = '';
            }
            function errSize () {
                alert('Error size ...');
                input.value = '';
            }
            function errWidth() {
                alert('Error width ...');
                input.value = '';
            }
            function errHeight() {
                alert('Error height ...');
                input.value = '';
            }
            if (type.indexOf(file.type) == -1) {
                errType ();
                return false;
            } else if (file.size > size) {
                errSize();
                return false;
            } else if (file.width < width) {
                errWidth();
                return false;
            } else if (file.height < height) {
                errHeight();
                return false;
            } else {
                var reader = new FileReader();            
                    reader.onload = function (e) {
                        $('#judge_preview_'+number).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
            }
        }
    }
    $('.panel-body').on('change','.change', function(){
       	readURL2(this);
    });
/* END JUDGE */

/* START STAGE */
	/* ADD STAGE */
	var stage_list_counter = $(".stage-list li").length;
	$('#add-stage-btn').on("click", function(){
 		var name = $("#name-stage").val();
 		if (name != '') {
    		stage_list_counter++;
    		var temp = "<li><div class='panel panel-default' style='border-color:#5d9cec;'><div id='stage_" + stage_list_counter + "' role='tab' class='panel-heading'><h4 class='panel-title'><a id='stage_name_" + stage_list_counter + "'>" + name + "</a><a type='button' class='pull-right delete-stage' title='Удалить этап' id='delete-stage_" + stage_list_counter + "'><em class='fa fa-times'></em></a></h4></div><div id='stage_description_" + stage_list_counter + "'><div class='panel-body'><input type='hidden' name='stage_name_" + stage_list_counter + "' value='"+ name +"'><textarea name='stage_description_" + stage_list_counter + "' rows='4' type='text' maxlength='1000' style='resize: none;' placeholder='Описание этапа' class='form-control' required></textarea><ul class='criterion-list_" + stage_list_counter + " row'><!-- criterions --><fieldset class='btn_area'></fieldset><fieldset id='criterion_"+stage_list_counter+"_1' class='row' ><div class='col-md-6 btn_area'><input type='text' name='criterion-name_"+stage_list_counter+"_1' placeholder='Название критерия' class='form-control' maxlength='500' required></div><div class='col-xs-10 col-sm-10 col-md-5 btn_area'><input type='number' placeholder='Максимальный балл' class='form-control' name='criterion-maxscore_"+stage_list_counter+"_1' required></div><div class='col-md-1 col-xs-2 btn_area'><a type='button' id='btn-add-criterion_"+stage_list_counter+"' class='btn-add-criterion btn btn-primary'><i class='fa fa-plus'></i></a></div></fieldset></ul></div></div></li>";
    		$('.stage-list').append(temp);
    		$("#name-stage").val('');
 		}
 		if (stage_list_counter > 0) {
    		$('.btn-submit-stage').prop('disabled', false);
 		}
	});
	/* DELITE STAGE */
	$('.stage-list').on('click', '.delete-stage', function(){
 		var number = $(this).attr('id');
 		number = number.substr(number.lastIndexOf('_')+1,number.length);
 		var i;
 		for(i=parseInt(number)+1; i<=stage_list_counter; i++)
 		{
    		var liElem = $('.stage-list li:nth-child('+i+')');
    		var setHTML = liElem.html();
    		setHTML = setHTML.replace("id=\"stage_"+i+"\"","id=\"stage_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"stage_name_"+i+"\"","id=\"stage_name_"+(i-1)+"\"");
    		setHTML = setHTML.replace("href=\"#stage_description_"+i+"\"","href=\"#stage_description_"+(i-1)+"\""); 
    		setHTML = setHTML.replace("aria-controls=\"stage_description_"+i+"\"","aria-controls=\"stage_description_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"delete-stage_"+i+"\"","id=\"delete-stage_"+(i-1)+"\"");
    		setHTML = setHTML.replace("id=\"stage_description_"+i+"\"","id=\"stage_description_"+(i-1)+"\"");
    		setHTML = setHTML.replace("name=\"stage_description_"+i+"\"","name=\"stage_description_"+(i-1)+"\"");
    		liElem.html(setHTML);
 		}
 		stage_list_counter--;
 		$('.stage-list li').remove(':nth-child(' + number + ')');
 		if (stage_list_counter == 0) {
		    $('.btn-submit-stage').prop('disabled', true);
	 	}
	});
	/* ADD CRITERION */
	$('.stage-list').on('click','.btn-add-criterion', function (){
		var snumber = $(this).attr('id');
 		snumber = snumber.substr(snumber.lastIndexOf('_')+1,snumber.length);
 		var criterion_list_counter = $(".criterion-list_"+snumber+" fieldset").length - 1;
		criterion_list_counter++;
		var temp = "<fieldset id='criterion_"+snumber+"_"+criterion_list_counter+"' class='row'><div class='col-md-6 btn_area'><input type='text' name='criterion-name_"+snumber+"_"+ criterion_list_counter +"' placeholder='Название критерия' class='form-control' maxlength='500' required></div><div class='col-xs-10 col-sm-10 col-md-5 btn_area'><input type='number' placeholder='Максимальный балл' class='form-control' name='criterion-maxscore_"+snumber+"_"+ criterion_list_counter +"' required></div><div class='col-md-1 col-xs-2 btn_area'><a type='button' class='btn btn-danger delete-criterion' id='delete-criterion_"+snumber+"_"+ criterion_list_counter +"'><i class='fa fa-times'></i></a></div></fieldset>";
		$('.criterion-list_'+snumber).append(temp);
	});
	/* DELETE CRITERION */
	$('.stage-list').on('click', '.delete-criterion', function(){
		var str = $(this).attr('id');
		str = str.substr(str.lastIndexOf('on_')+3,str.length);
		var stage_number = str.substr(0,str.indexOf('_'));
		var criterion_number = str.substr(str.lastIndexOf('_')+1,str.length);
		var stage = $('.stage-list li:nth-child('+ stage_number +')');
		var stageHTML = stage.html();
		
		criterion_number = parseInt(criterion_number);
		//alert(stageHTML);

		var idDeletedCriteria = stageHTML.indexOf('id=\"criterion_'+stage_number+'_'+criterion_number) - 15;
		var DeletedSubs = stageHTML.substr(stageHTML.indexOf('<fieldset', idDeletedCriteria),stageHTML.indexOf('</fieldset', idDeletedCriteria)+11-stageHTML.indexOf('<fieldset', idDeletedCriteria));
		stageHTML = stageHTML.replace(DeletedSubs,'');		

		var criterionIncCounter = 1;
		while(stageHTML.indexOf('id=\"criterion_'+stage_number+'_'+(criterion_number+criterionIncCounter)) >= 0)
		{
			stageHTML = stageHTML.replace('id=\"criterion_'+stage_number+'_'+(criterion_number+criterionIncCounter),'id=\"criterion_'+stage_number+'_'+(criterion_number+criterionIncCounter-1));
			stageHTML = stageHTML.replace('name=\"criterion-name_'+stage_number+'_'+(criterion_number+criterionIncCounter), 'name=\"criterion-name_'+stage_number+'_'+(criterion_number+criterionIncCounter-1));
			stageHTML = stageHTML.replace('name=\"criterion-maxscore_'+stage_number+'_'+(criterion_number+criterionIncCounter), 'name=\"criterion-maxscore_'+stage_number+'_'+(criterion_number+criterionIncCounter-1));
			stageHTML = stageHTML.replace('id=\"delete-criterion_'+stage_number+'_'+(criterion_number+criterionIncCounter), 'id=\"delete-criterion_'+stage_number+'_'+(criterion_number+criterionIncCounter-1));
			criterionIncCounter++;
		}
		stage.html(stageHTML);
	});
	/* END STAGE */


	$("#main-info").click(function(){
		$("#moreeventinfo").removeClass("in");
		$("#main-info-save").prop("disabled",false);
	});
	$("#extra-info").click(function(){
		$("#eventinfo").removeClass("in");
		$("#main-info-save").prop("disabled",true);
	});



	/* EDIT MAIN EVENT INFO */
   
	$.fn.editableform.buttons =
		'<button type="submit" class="btn btn-success btn-sm editable-submit">'+
	    	'<i class="fa fa-fw fa-check"></i>'+
		'</button>'+
		'<button type="button" class="btn btn-default btn-sm editable-cancel">'+
	    	'<i class="fa fa-fw fa-times"></i>'+
		'</button>';

	//defaults
	$.fn.editable.defaults.url = '/Ajax/Editable';
	$.fn.editable.defaults.mode = 'inline';

	var url = location.protocol+'//'+location.hostname+'/pronwe/';

	$('.editable').editable({
		url: url+'/updateEventsSubstance/updateeventinfo/',
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

	$('#input-event-status').editable({
		url: url+'/updateEventsSubstance/updateeventinfo/',
		type: 'select',
		name: 'input-event-status',
		emptytext: 'Не заполнено',
		source: [
			{value: 'Международное мероприятие', text: 'Международное мероприятие'},
			{value: 'Всероссийское мероприятие', text: 'Всероссийское мероприятие'},
			{value: 'Региональное мероприятие', text: 'Региональное мероприятие'},
			{value: 'Городское мероприятие', text: 'Городское мероприятие'},
			{value: 'Университетское мероприятие', text: 'Университетское мероприятие'},
			{value: 'Школьное мероприятие', text: 'Школьное мероприятие'}
		],
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
    
	moment.lang('ru');

    $('#input-event-city').editable({
		url: url+'/updateEventsSubstance/updateeventinfo/',
		type: 'select',
		name: 'input-event-status',
		emptytext: 'Не заполнено',
		source: [
			{value: 'Санкт-Петербург', text: 'Санкт-Петербург'},
			{value: 'Москва', text: 'Москва'},
		],
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

	$('#input-event-type').editable({
		url: url+'/updateEventsSubstance/updateeventinfo/',
		type: 'select',
		name: 'input-event-status',
		emptytext: 'Не заполнено',
		source: [
			{value: 'Оценивание участников по нескольким критериям на каждом этапе', text: 'Оценивание участников по нескольким критериям на каждом этапе'},
			{value: 'Оценивание участников по одному критерию на каждом этапе', text: 'Оценивание участников по одному критерию на каждом этапе'},
		],
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

	function readURL(input) {
        if (input.files && input.files[0]) {
            var type   = ['image/gif','image/jpg','image/jpeg','image/png'];
            var width  = 1024;
            var height = 768;
            var size   = 525000; // bytes
            var file   = input.files[0];
            function errType () {
                alert('Error type ...');
                input.value = '';
            }
            function errSize () {
                alert('Error size ...');
                input.value = '';
            }
            function errWidth() {
                alert('Error width ...');
                input.value = '';
            }
            function errHeight() {
                alert('Error height ...');
                input.value = '';
            }
            if (type.indexOf(file.type) == -1) {
                errType ();
                //return false;
            } else if (file.size > size) {
                errSize();
                //return false;
            } else if (file.width < width) {
                errWidth();
                //return false;
            } else if (file.height < height) {
                errHeight();
                //return false;
            } else {
                var reader = new FileReader();            
                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
            }
        }
    }
    $("#choose-image").change(function(){
       	readURL(this);
    });
    



    /* PARTICIPANT EDITABLE */
	$('.editable-part').editable({
		url: url+'/updateEventsSubstance/updateparticipant/',
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
	/* JUDGE EDITABLE */
	$('.editable-judge').editable({
		url: url+'/updateEventsSubstance/updatejudge/',
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
	/* STAGE EDITABLE */
	$('.editable-stage').editable({
		url: url+'/updateEventsSubstance/updatestage/',
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
	/* CRITERION EDITABLE */
	$('.editable-criterion').editable({
		url: url+'/updateEventsSubstance/updatecriteria/',
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

});

$(document).ready( function() {
	$(".icon-remove").on('click', function() {

		if ( !confirm('Вы уверены?'))
			return false;

		var id = $(this).parent().attr('id');
		var list = id.split('_');

		var substance = list[0];
		var identif = list[1];

		var url = location.protocol+'//'+location.hostname+'/pronwe/';
		$.ajax({
			url: url + '/updateEventsSubstance/deleteEventsSubstance/',
			type: "POST",
			data: {
				'substance': substance,
				'id': identif,
			},
			success: function(data, config){

				if (substance == 'delstage') {
					window.location.reload();
				}
				else {
					$('#' + id).closest('tr').hide();
				}

			},
			error: function(data, config) {
				console.log(data);
			}
		});
	});
});



