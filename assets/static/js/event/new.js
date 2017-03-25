$(document).ready(function() {

	/**
	* Vars
	*/
	var url = window.location.href.split('/')[0]+"//"+window.location.href.split('/')[2],
		translateX = 0,
		currentStep,
		currentStepBlock,
		currentStepElement = [],
		progressWidth = 100,
		elements = [
			{
				proc: "20",
				name:"event_name",
				flag: false
			},
	    	{
				proc: "15",
				name:"event_site",
				flag: false
			},
	    	{
				proc: "20",
				name:"event_desc",
				flag: false
			},
	    	{
				proc: "10",
				name:"datestartWidget",
				flag: false
			},
	    	{
				proc: "10",
				name:"dateendWidget",
				flag: false
			},
		    {
				proc: "15",
				name:"address",
				flag: false
			},
		    {
				proc: "10",
				name:"confirmrools",
				flag: false
			}
		];



	/**
	* Next Step
	*/
	$('#btnnext').click(function () {

		if ( !isStepDone(translateX) ) {
			$.notify({
				message: 'Проверьте правильность введенных данных!'
			},{
				type: 'danger'
			});
			return;
		}

		changeStep('next');

	});



	/**
	* Previous step
	*/
	$('#btnprevious').click(function () {

		changeStep('previous');

	});



	/**
	* Submit form
	*/
	 $('#btnsubmit').click(function () {

/*		 var isFormInvalid = false, id;
		 $('.form_newevent input, textarea').each(function(){
			 id = $(this).attr('id');
			 if (isFormInvalid == false && id != undefined && $(this).attr('type') != 'hidden') {
				 isFormInvalid = isElementInvalid($(this), 'submit')

				 if (isFormInvalid == true) {
					 if ( $(this).attr('id') == "confirmrools" ) {
						 $.notify({
							message: 'Вы не согласились с правилами, пожалуйста, прочитайте и согласитесь'
						 },{
							type: 'danger'
						 });
					 } else {
						 $.notify({
							message: 'У вас ошибка при вводе "' + $('#' + id + ' + label').text().toLowerCase() + '"'
						 },{
							type: 'danger'
						 });
					 }
				 }
			 }
		 });

		 if ( isFormInvalid == false ) {
			 $("#event_site").inputmask('remove');*/
			 $('.form_newevent')[0].submit();
		 //}
	 });



	/**
	* Change step
	*/
	function changeStep(direction) {

		if (direction == 'next') {
			translateX -= 100;
		} else if (direction == 'previous') {
			translateX += 100;
		}

		$('.form_newevent_body-wrapper-item').each(function(){
			$(this).css('transform', 'translateX(' + translateX + '%)').css('-webkit-transform','translateX(' + translateX + '%)');
		})


		if ( translateX < 0 && translateX > -300 ) {
			$('#btnnext').removeClass('displaynone');
			$('#btnprevious').removeClass('displaynone');
		} else if ( translateX == -300 ) {
			$('#btnnext').addClass('displaynone');
		} else if ( translateX == 0 ) {
			$('#btnprevious').addClass('displaynone');
		}
	}



	/**
	* Checking does all field are compleated on step
	*/
	function isStepDone(translateX) {

		if (translateX == 0) {
			currentStep = 1;
			currentStepElement = ['input','input'];
		} else if (translateX == -100){
			currentStep = 2;
			currentStepElement = ['textarea','select'];
		} else if (translateX == -200){
			currentStep = 3;
			currentStepElement = ['input','input','textarea'];
		} else {
			currentStep = 4;
		}

		currentStepBlock = $('#step' + currentStep);
		var tmpnum = 0;

		for (var i = 0; i < currentStepElement.length; i++) {
			currentStepBlock.find(currentStepElement[i]).each(function(){
				if ( isElementInvalid($(this), 'check') )
					tmpnum++;
			})
		}


		if (tmpnum == 0)
			return true;
		else
			return false;

	}



	/**
	* Searching Elements in `elements` array
	*/
	function findElement(name) {
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].name == name) {
				return i;
			}
		}
	}



	/**
	* Changing flag of elements progress + add/remove invalid class
	*/
	function isElementInvalid($el, status) {

		var i = findElement($el.attr('name'));

		if (status == "valid") {

			$el.removeClass('invalid');
			if ( elements[i].flag == false ) {
				elements[i].flag = true;
				//changeProgress(elements[i].proc, 'add');
			}

		} else if ( status == "invalid" ) {

			$el.addClass('invalid');
			if ( elements[i].flag == true ) {
				elements[i].flag = false;
				//changeProgress(elements[i].proc, 'remove');
			}

		} else if ( status == "check" ) {

			if ( $el.val() == '' ) {
				$el.addClass('invalid');
				return true;
			} else{
				$el.removeClass('invalid');
				return false;
			}

		} else if ( status == "submit" ) {

			if ( elements[i].flag == false ) {
				$el.addClass('invalid');
				return true;
			} else {
				$el.removeClass('invalid');
				return false;
			}

		}

	}



	/**
	* Change Progress Width
	*/
	function changeProgress(proc, ind) {

		if ( ind == 'add' ) {
			progressWidth = progressWidth + parseInt(proc);
		} else {
			progressWidth = progressWidth - parseInt(proc);
		}

		$('.form_newevent_progress-wrapper').css('width', progressWidth + '%');

		if ( progressWidth == 100) {
			$('#btnsubmit').removeClass('displaynone');
		} else {
			$('#btnsubmit').addClass('displaynone');
		}
	}
    $('#btnsubmit').removeClass('displaynone');


	/**
  	* Validate Elements
	* - inputmask
	* - datetimepicker
	* - select2
  	*

	$("#event_name").inputmask({
	    mask: '*{1,60}',
	    definitions: {
			'*': {
	        	validator: "[a-zA-Z0-9а-яА-Я№ ]",
	      	}
	    },
	    showMaskOnHover: false,
	    showMaskOnFocus: true,
	    oncomplete: function(){
			isElementInvalid($(this), "valid");
	    },
	    onincomplete: function(){
			isElementInvalid($(this), "invalid");
	    }
  	});


	var temp = [],
		orgwebsite = $('#event_site').attr('data-orgwebsite'), // current organization website
		maskorgwebsite, // for event_site
		allowedDatetime = new RegExp("[^a-zA-Zа-яА-Я0-9: ]"); // for datetimepicker

	// add '\\' to each symbol in organization website to have no conflicts in inputmask
	for (var i = 0; i < orgwebsite.length; i++) {
		temp[i] = "\\" + orgwebsite[i];
	}

	maskorgwebsite = temp.join().replace(/,/gi,"");

	$("#event_site").inputmask({
		mask: "\\http://vote\\p\\a\\d.ru/" + maskorgwebsite + "/a{4,20}",
		definitions: {
      		'a': {
        		validator: "[a-z0-9]",
      		}
    	},
    	showMaskOnHover: false,
    	showMaskOnFocus: true,
    	clearIncomplete: true,
		oncomplete: function(){
			var $this = $(this),
				website = $("#event_site").inputmask('unmaskedvalue');

				/*
				**  Checking event website in DB
				*
			$.when(
				$.ajax({
					url: url + '/events/check/' + website,
					type: "POST",
					data: {
						website: website
					}
				})
			).then(function( data) {
				if ( data == "false") {
                    isElementInvalid($this, "valid");
                }
                else {
                    if ( ! $this.parent().children('span').hasClass('error-block') ) {
                        $.notify({
                            message: 'К сожалению, Вы уже создавали мероприятие с таким названием.'
                        },{
                            type: 'danger'
                        });
                    }
                    isElementInvalid($this, "invalid");
                }
			});
		},
    	onincomplete: function(){
			isElementInvalid($(this), "invalid");
    	}
  	});


	/*$("#event_desc").inputmask({
		mask: '*{1,300}',
		definitions: {
			'*': {
				validator: "[a-zA-Z0-9а-яА-Я- @№#%*()[]|/\"\'.,?!",
			}
		},
		showMaskOnHover: false,
		showMaskOnFocus: false,
		oncomplete: function(){
			isElementInvalid($(this), "valid");
		},
		onincomplete: function(){
			isElementInvalid($(this), "invalid");
		}
	});*


	$('#datestartWidget').datetimepicker({
		language: "ru",
		format: "dd MM yyyy - hh:ii",
		linkField: "datestart",
		linkFormat: "yyyy-mm-ddThh:ii",
		fontAwesome: true,
		weekStart: 1,
		autoclose: true,
		minuteStep: 5
	}).on('changeDate', function(ev){
		if ( allowedDatetime.test($(this)) || $(this).val() != "" ) {
			isElementInvalid($(this), "valid");
		} else {
			isElementInvalid($(this), "invalid");
		}
	});


	$('#dateendWidget').datetimepicker({
		language: "ru",
		format: "dd MM yyyy - hh:ii",
		linkField: "dateend",
		linkFormat: "yyyy-mm-ddThh:ii",
		fontAwesome: true,
		weekStart: 1,
		autoclose: true,
		minuteStep: 5
	}).on('changeDate', function(ev){
		if ( allowedDatetime.test($(this)) || $(this).val() != "" ) {
			isElementInvalid($(this), "valid");
		} else {
			isElementInvalid($(this), "invalid");
		}
	});


	$("#keywords").select2({
	  	tags: true,
		language: "ru"
	});

	$("#users").select2({
		language: "ru"
	});


	$("#address").inputmask({
		mask: '*{1,200}',
		definitions: {
			'*': {
				validator: "[а-яА-Я0-9.,/-№ ]",
			}
		},
		showMaskOnHover: false,
		showMaskOnFocus: true,
		oncomplete: function(){
			isElementInvalid($(this), "valid");
		},
		onincomplete: function(){
			isElementInvalid($(this), "invalid");
		}
	});


	$('#confirmrools').click(function(){
		if ( $(this).prop('checked') == true)
      		isElementInvalid($(this), "valid");
    	else
      		isElementInvalid($(this), "invalid");
  	});
*/
});
