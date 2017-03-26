$(document).ready(function() {

	/**
	* Vars
	*/
	var url = window.location.href.split('/')[0]+"//"+window.location.href.split('/')[2],
		translateX = 0,
		currentStep,
		currentStepBlock,
		currentStepElement = [],
		progressWidth = 0,
		elements = [
			{
				proc: "20",
				name:"name",
				flag: false
			},
	    	{
				proc: "15",
				name:"site",
				flag: false
			},
	    	{
				proc: "20",
				name:"desc",
				flag: false
			},
	    	{
				proc: "10",
				name:"start",
				flag: false
			},
	    	{
				proc: "10",
				name:"end",
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
	 $('#form_newevent').submit(function () {

		 var isFormInvalid = false, id;

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

		 if ( isFormInvalid ) {
		 	return
		 } else {
			 $("#site").inputmask('remove');
		 }
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
		});


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
				changeProgress(elements[i].proc, 'add');
			}

		} else if ( status == "invalid" ) {

			$el.addClass('invalid');
			if ( elements[i].flag == true ) {
				elements[i].flag = false;
				changeProgress(elements[i].proc, 'remove');
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
	* - select2
  	*/

	$("#name").inputmask({
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



	$("#site").inputmask({
		mask: "\\http://vote\\p\\a\\d.ru/a{4,20}",
		definitions: {
      		'a': {
        		validator: "[a-z0-9]",
      		}
    	},
    	showMaskOnHover: false,
    	showMaskOnFocus: true,
    	clearIncomplete: true,
		oncomplete: function(){
            isElementInvalid($(this), "valid");
		},
    	onincomplete: function(){
			isElementInvalid($(this), "invalid");
    	}
  	});

    $("#keywords").select2({
        tags: true,
        tokenSeparators: [',', ' ', ';', '.'],
    });

    var allowedDescSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№\" ]");

    $("#desc, #address").on('keydown', function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode == 13) {
            e.preventDefault();
        }
    });

    $("#desc, #address").on('fucus, blur', function(e){
        if ( $(this).val() != "" && $(this).val().length > 1 && $(this).val().length < parseInt($(this).attr('length')) && ! allowedDescSymbols.test($(this).val()) ) {
            isElementInvalid($(this), "valid");
        } else {
            isElementInvalid($(this), "invalid");
        }
    });


    $('#start, #end').on('blur',function () {
		if ($(this).val() == "") {
            isElementInvalid($(this), "invalid");
		} else {
            isElementInvalid($(this), "valid");
		}
    });


	$('#confirmrools').click(function(){
		if ( $(this).prop('checked') == true)
      		isElementInvalid($(this), "valid");
    	else
      		isElementInvalid($(this), "invalid");
  	});

});
