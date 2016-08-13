$().ready (function() {
	$('#eventshortdesc').keyup(function(){
		$('#shortdesc_max_length').text(parseInt(170-$('#eventshortdesc').val().length));
	});
	$("#responsible_persons").select2({language: "ru"});  

	$('#eventdesc').parent().css('text-align','left');
	$('#eventdesc').summernote({
		lang: 'ru-RU',
		height: 250,
		placeholder: "Расскажите основную информацию об мероприятии...",
		toolbar: [
			['style note-para', ['bold', 'italic', 'underline','paragraph']],
			['font note-fontsize note-height', ['ul', 'ol','superscript', 'subscript', 'hr', 'fontsize', 'height']],
			['color', ['color']],
			['insert', ['table', 'link', 'picture', 'video']],
			['fullscreen', ['fullscreen','codeview']]
		]
	});
	$('button').each(function() {
		if ( $(this).hasClass('btn-primary') ) {
			$(this).removeClass('btn-primary').addClass('md-btn md-btn-success');
		}
	});
	$('#event_step1').validate({
		errorClass: "error-input",
		rules: {
			eventname: "required",
			//eventstart: "required",
			//eventend: "required",
			//eventstatus: "required",
			//eventcity: "required",
			responsible_persons: "required",
			email: {
				required: true,
				email: true
			},
			confirmrools: "required"
		},
		messages: {
			eventname: "Пожалуйста, введите название мероприятия.",
			eventstart: "Пожалуйста, введите дату начала мероприятия.",
			eventend: "Пожалуйста, введите дату завершения мероприятия.",
			eventstatus: "Пожалуйста, выберите статус мероприятия.",
			eventcity: "Пожалуйста, выберите город, в котором пройдет мероприятие.",
			responsible_persons: "Пожалуйста, выберите ответственного(ых) за мероприятия.",
			email: {
				required: "Пожалуйста, введите адрес электронной почты.",
				email: "Пожалуйста, проверьте правильность ввода адреса электронной почты."
			},
			confirmrools: "Пожалуйста, прочитайте и согласитесь с правилами."
		},
	});

	$('#event_step1_cansel').click(function(){
		// go to previous page
		alert('cansel');
	});
	$('#event_step1_draft').click(function(){
		//save as draft
		$('#event_step1').submit();
	});
	$('#event_step1_next').click(function(){
		//save
		$('#event_step1').submit();
	});
	$('#event_delete').click(function(){
		//delete
		alert('delete');
	});
});