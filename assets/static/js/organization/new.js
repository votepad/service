$(document).ready(function() {

    /**
    * Vars
    */
    var url = window.location.href.split('/')[0]+"//"+window.location.href.split('/')[2],
        translateX = 0,
        currentStep,
        currentStepBlock,
        currentStepElement = 'input',
        progressWidth = 0,
        elements = [
            {
                proc: "30",
                name: "org_name",
                flag: false
            },
            {
                proc: "20",
                name: "org_site",
                flag: false
            },
            {
                proc: "20",
                name: "org_description",
                flag: false
            },
            {
                proc: "15",
                name: "official_org_site",
                flag: false
            },
            {
                proc: "15",
                name:"confirmrools",
                flag: false
            },
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

         var isFormInvalid = false, id;
         $('.form_neworg input, textarea').each(function(){
             id = $(this).attr('id');
             if (isFormInvalid == false) {
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
             $("#org_site").inputmask('remove');
             $('.form_neworg')[0].submit();
         }

    });



    /**
    * Show/hide Next|Previous|Submit btns
    */
    function changeStep(direction) {

        if (direction == 'next') {
			translateX -= 100;
		} else if (direction == 'previous') {
			translateX += 100;
		}

		$('.form_neworg_body-wrapper-item').each(function(){
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
    * Checking does all field are compleated
    */
    function isStepDone(translateX) {

        if (translateX == 0) {
            currentStep = 1;
        } else if (translateX == -100){
            currentStep = 2;
            currentStepElement = 'textarea';
        } else {
            currentStep = 3;
        }

        currentStepBlock = $('#step' + currentStep);

        var tmpnum = 0;

        currentStepBlock.find(currentStepElement).each(function(){
            if ( isElementInvalid($(this), 'check') )
                tmpnum++;
        })

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

        if (status == "valid" ) {

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

        $('.form_neworg_progress-wrapper').css('width', progressWidth + '%');

        if ( progressWidth == 100) {
            $('#btnsubmit').removeClass('displaynone');
        } else {
            $('#btnsubmit').addClass('displaynone');
        }
    }



    /*
    **  Validate Elements
    */

    $("#org_name").inputmask({
        mask: '*{1,60}',
        definitions: {
            '*': {
                validator: "[a-zA-Z0-9а-яА-Я№\"' ]",
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


    $("#org_site").inputmask({
        mask: '\\http://vote\\p\\a\\d.ru/*{4,20}',
        definitions: {
            '*': {
                validator: "[a-z0-9]",
            }
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        clearIncomplete: true,
        oncomplete: function(){
            var $this = $(this),
                website = $("#org_site").inputmask('unmaskedvalue');

            /*
            **  Checking organization website in DB
            */
            $.when(
                $.ajax({
                    url: url + '/organization/checkwebsite/' + website,
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
                            message: 'К сожалению, такой адрес организации занят. Пожалуйста, придумайте другой адрес'
                        },{
                            type: 'danger'
                        });
                    }
                    isElementInvalid($this, "invalid");
                }
            });
        },
        onincomplete: function(){
            $("#org_site").closest('.input-field').find('.counter').text('');
            isElementInvalid($(this), "invalid");
        }
    });

    var allowedDescSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№\" ]");

    $("#org_description").on('keydown', function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode == 13) {
            e.preventDefault();
        }
    });

    $("#org_description").on('fucus, blur', function(e){
        if ( $(this).val() != "" && $(this).val().length > 1 && $(this).val().length < parseInt($(this).attr('length')) && ! allowedDescSymbols.test($(this).val()) ) {
            isElementInvalid($(this), "valid");
        } else {
            isElementInvalid($(this), "invalid");
        }
    });


    $("#official_org_site").inputmask({
        mask: '[\\http]|[\\http\\s]://*{2,}.a{2,}',
        definitions: {
            '*': {
                validator: "[a-zA-Zа-яА-Я0-9-]",
            },
            'a': {
                validator: "[a-zA-Zа-яА-Я0-9-_.!*'()@&=+$/?#]",
            },
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
        positionCaretOnClick: "none",
        oncomplete: function(){
            isElementInvalid($(this), "valid");
        },
        onincomplete: function(){
            isElementInvalid($(this), "invalid");
        }
    });

    $('#confirmrools').click(function(){
        if ( $(this).prop('checked') == true) {
            isElementInvalid($(this), "valid");
        } else {
            isElementInvalid($(this), "invalid");
        }
    });


});
