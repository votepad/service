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
            vp.notification.notify({
                type: 'alert',
                status: 'danger',
                message: 'Проверьте правильность введенных данных!',
                time: 3
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

		 $('#form_newevent input, textarea').each(function(){
			 id = $(this).attr('id');
			 if (isFormInvalid == false && id != undefined && $(this).attr('type') != 'hidden') {
				 isFormInvalid = isElementInvalid($(this), 'submit');

				 if (isFormInvalid == true) {
					 if ( $(this).attr('id') == "confirmrools" ) {
                         vp.notification.notify({
                             type: 'alert',
                             status: 'danger',
                             message: 'Вы не согласились с правилами, пожалуйста, прочитайте и согласитесь',
                             time: 3
                         });
					 } else {
                         vp.notification.notify({
                             type: 'alert',
                             status: 'danger',
                             message: 'У вас ошибка при вводе "' + $('#' + id + ' + label').text().toLowerCase() + '"',
                             time: 3
                         });
					 }
				 }
			 }
		 });

		 if ( isFormInvalid ) {
		 	return;
		 } else {
			 $("#site").inputmask('remove');
		 }
	 });




	/**
	* Change step
	* Show/hide Next|Previous|Submit btns
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


		if ( translateX < 0 && translateX > -200 ) {
			$('#btnnext').removeClass('displaynone');
			$('#btnprevious').removeClass('displaynone');
		} else if ( translateX == -200 ) {
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
        } else {
            currentStep = 3;
            currentStepElement = ['input','input','input'];
        }

        currentStepBlock = $('#step' + currentStep);
        var tmpnum = 0;

        for (var i = 0; i < currentStepElement.length; i++) {
            currentStepBlock.find(currentStepElement[i]).each(function(){
                if ( isElementInvalid($(this), 'check') )
                    tmpnum++;
            })
        }

        if (tmpnum == 0) {
            return true;
        } else {
            return false;
        }

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

            var $this = $(this),
				website = $("#site").inputmask('unmaskedvalue'),
				host = window.location.origin;

            /*
			 **  Checking event website in DB
			 */
			var ajaxData = {
                url: host + '/event/check/' + website,
                type: "POST",
                beforeSend: function () {

                },
                success: function (response) {

                    if ( response === "false") {
                        isElementInvalid($this, "valid");
                    }
                    else {
                        if ( ! $(this).parent().children('span').hasClass('error-block') ) {
                            vp.notification.notify({
                                type: 'alert',
                                status: 'danger',
                                message: 'К сожалению, такой адрес мероприятия занят. Пожалуйста, введите другой',
                                time: 3
                            });
                        }
                        isElementInvalid($this, "invalid");
                    }

                },
				error: function (callback) {
					console.log(callback);
                }
			};

			vp.ajax.send(ajaxData);

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

    $("#desc").on('keydown', function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode == 13) {
            e.preventDefault();
        }
    });

    $("#desc").on('fucus, blur', function(e){
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


    $("#address").inputmask({
        mask: '*{1,200}',
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


	$('#confirmrools').click(function(){
		if ( $(this).prop('checked') == true)
      		isElementInvalid($(this), "valid");
    	else
      		isElementInvalid($(this), "invalid");
  	});

});
