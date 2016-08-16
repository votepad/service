$().ready (function() {
	$('[data-toggle="tooltip"]').tooltip();
	
	$('.end-date').hover(function(){
		$('#'+$(this).attr('aria-describedby')).css('width', '120px').css('top','-31px').css('left','86.7031px');
	});

	$('#shortdesc_max_length').text(parseInt(170-$('#eventshortdesc').val().length));
	$('#eventshortdesc').keyup(function(){
		$('#shortdesc_max_length').text(parseInt(170-$('#eventshortdesc').val().length));
	});
	$('#event_main_info').validate({
		errorClass: "error-input",
		rules: {
			eventname: "required",
			eventsite: "required",
			eventshortdesc: "required",
			eventstart: "required",
			eventend: "required",
			eventstatus: "required",
			eventcity: "required",
			email: {
				required: true,
				email: true
			},
			confirmrools: "required"
		},
		messages: {
			eventname: "Пожалуйста, введите название мероприятия.",
			eventsite: "Пожалуйста, введите адрес мероприятия",
			eventshortdesc: "Пожалуйста, расскажите кратко о своём мероприятии.",
			eventstart: "Пожалуйста, введите дату начала мероприятия.",
			eventend: "Пожалуйста, введите дату завершения мероприятия.",
			eventstatus: "Пожалуйста, выберите статус мероприятия.",
			eventcity: "Пожалуйста, выберите город, в котором пройдет мероприятие.",
			email: {
				required: "Пожалуйста, введите адрес электронной почты.",
				email: "Пожалуйста, проверьте правильность ввода адреса электронной почты."
			},
			confirmrools: "Пожалуйста, прочитайте и согласитесь с правилами."
		},
	});

});