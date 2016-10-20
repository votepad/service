$().ready (function() {
	$('#eventshortdesc').keyup(function(){
		$('#shortdesc_max_length').text(parseInt(170-$('#eventshortdesc').val().length));
	});
	$("#responsible_persons").select2({language: "ru"});

	$('#new_event').validate({
		errorClass: "error-input",
		rules: {
			event_name: "required",
			event_site: {
				required: true,
				maxlength: 25
			},
			event_shortdesc: "required",
			eventstart: "required",
			eventend: "required",
			event_status: "required",
			event_city: "required",
			responsible_persons: "required",
			event_email: {
				required: true,
				email: true
			},
			confirmrools: "required"
		},
		messages: {
			event_name: "Пожалуйста, введите название мероприятия.",
			event_site: {
				required: "Пожалуйста, введите адрес мероприятия",
				maxlength: "Максимальная длина адреса страницы равна 25"
			},
			event_shortdesc: "Пожалуйста, расскажите кратко о своём мероприятии.",
			eventstart: "Пожалуйста, введите дату начала мероприятия.",
			eventend: "Пожалуйста, введите дату завершения мероприятия.",
			event_status: "Пожалуйста, выберите статус мероприятия.",
			event_city: "Пожалуйста, выберите город, в котором пройдет мероприятие.",
			responsible_persons: "Пожалуйста, выберите ответственного(ых) за мероприятия.",
			event_email: {
				required: "Пожалуйста, введите адрес электронной почты.",
				email: "Пожалуйста, проверьте правильность ввода адреса электронной почты."
			},
			confirmrools: "Пожалуйста, прочитайте и согласитесь с правилами."
		},
	});

	$("#eventsite").keyup(function(){
		$("#eventsite").val(checkingsim($("#eventsite").val()));
	});
	$("#eventname").keyup(function(){
		$("#eventsite").val(checkingsim($("#eventname").val()));
	});

	var checkingsim = function(str){
		var replacer = {"а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"e","ж":"zh","з":"z","и":"i","й":"y","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"kh","ц":"ts","ч":"ch","ш":"sh","щ":"shch","ъ":"ie","ы":"y","ь":"","э":"e","ю":"iu","я":"ya","a":"a","b":"b","c":"c","d":"d","e":"e","f":"f","g":"g","h":"h","i":"i","j":"j","k":"k","l":"l","m":"m","n":"n","o":"o","p":"p","q":"q","r":"r","s":"s","t":"t","u":"u","v":"v","w":"w","x":"x","y":"y","z":"z","-":"-","1":"1","2":"2","3":"3","4":"4","5":"5","6":"6","7":"7","8":"8","9":"9","0":"0"," ":"-"};
		if (str != undefined) {
			for (var i = 0; i < str.length; i++) {
				if (replacer [ str[i].toLowerCase() ] != undefined){
					replace = replacer [ str[i].toLowerCase() ];
					str = str.replace(str[i], replace);
				}
			}
			str = str.toLowerCase().replace(/[^-0-9a-z]/gim,'').replace(/-{2,}/gim, '-');
			return str;
		}
	};
});
