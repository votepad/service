$(function() {

	/*
	**  Default Setting Input Areas
	*/
	var orgname = $('#event_site').attr('data-orgname');//.replace(/[a-z0-9-]/gi,"\\");
	var temp = [];// = orgname + orgname; var t = 0;
	for (var i = 0; i < orgname.length; i++) {
		temp[i] = "\\" + orgname[i];
	}
	var maskorgname = temp.join().replace(/,/gi,"");

	$("#keywords").select2({
		placeholder: "Введите слово",
	  tags: true,
		language: "ru"
	});
	$('#datestart').datetimepicker({
		locale: "ru",
		useCurrent: false,
		stepping: 5,
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down",
			previous: 'fa fa-arrow-left',
			next: 'fa fa-arrow-right',
 		},
		tooltips: {
	    selectMonth: 'Выбрать месяц',
	    prevMonth: 'Предыдущий месяц',
	    nextMonth: 'Следующий месяц',
	    selectYear: 'Выбрать год',
	    prevYear: 'Предыдущий год',
	    nextYear: 'Следующий год',
	    selectDecade: 'Выбрать десятилетие',
	    prevDecade: 'Предыдущее десятилетие',
	    nextDecade: 'Следующие десятилетие',
	    prevCentury: 'Предыдущий век',
	    nextCentury: 'Следующий век',
      pickHour: 'Выбрать час',
      incrementHour: 'Прибавить час',
      decrementHour: 'Убавить час',
      pickMinute: 'Выбрать минуту',
      incrementMinute: 'Увеличить на 5 минут',
      decrementMinute: 'Уменьшить на 5 минут',
      selectTime: ''
		}
	});
	$('#dateend').datetimepicker({
		locale: "ru",
		useCurrent: false,
		stepping: 5,
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down",
			previous: 'fa fa-arrow-left',
			next: 'fa fa-arrow-right',
		},
		tooltips: {
			selectMonth: 'Выбрать месяц',
			prevMonth: 'Предыдущий месяц',
			nextMonth: 'Следующий месяц',
			selectYear: 'Выбрать год',
			prevYear: 'Предыдущий год',
			nextYear: 'Следующий год',
			selectDecade: 'Выбрать десятилетие',
			prevDecade: 'Предыдущее десятилетие',
			nextDecade: 'Следующие десятилетие',
			prevCentury: 'Предыдущий век',
			nextCentury: 'Следующий век',
			pickHour: 'Выбрать час',
			incrementHour: 'Прибавить час',
			decrementHour: 'Убавить час',
			pickMinute: 'Выбрать минуту',
			incrementMinute: 'Увеличить на 5 минут',
			decrementMinute: 'Уменьшить на 5 минут',
			selectTime: ''
		}
	});
	$('#address').on('click focus', function () {
		var modal = '<div class="modal" id="map_modal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"><i id="map_loader" style="margin: 15% 40%;line-height: 200px;"class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><div id="map"></div></div></div></div></div>';
		$('body').append(modal);
		$('#map_modal').animateCss('fadeIn');
		$('#map_modal').modal({
			keyboard: false,
			backdrop: false,
			show: true
		});
		ymaps.ready(createMap);
	});
	$("#users").select2({language: "ru"});

	/*
	**  Elements for working with Progress Bar
	*/

	var form_el = [
    {label: "Название мероприятия", proc: "20", name:"event_name", flag: false},
    {label: "Страница мероприятия", proc: "15", name:"event_site", flag: false},
    {label: "Раскажите о мероприятии", proc: "20", name:"event_desc", flag: false},
    {label: "Ключевые слова", proc: "0", name:"event_keywords", flag: false},
    {label: "Дата начала", proc: "10", name:"datestart", flag: false},
    {label: "Дата завершения", proc: "10", name:"dateend", flag: false},
    {label: "Адрес", proc: "15", name:"address", flag: false},
		{label: "Ответственные лица", proc: "0", name:"users", flag: false},
    {label: "confirmrools", proc: "10", name:"confirmrools", flag: false},
  ];


  /*
  **  Find Element in Array
  */

  function find_el(name) {
    for (var i = 0; i < form_el.length; i++) {
      if (form_el[i].name == name) {
        return i;
      }
    }
  }


  /*
  **  Checking Vilid for Progress Bar
  */

  function checking_el_valid($el, status) {
    var el_num = find_el($el.attr('name'));
    if (status == "valid" ) {
      $el.removeClass('invalid');
      if ( form_el[el_num].flag == false ) {
        form_el[el_num].flag = true;
        add_progress_bar(form_el[el_num].proc);
      }
    } else if ( status == "invalid" ) {
      $el.addClass('invalid');
      if ( form_el[el_num].flag == true ) {
        form_el[el_num].flag = false;
        remove_progress_bar(form_el[el_num].proc);
      }
    }
  }


  /*
  **  Progress Bar
  */

  var width = 0;
  function add_progress_bar(num) {
    width = width + parseInt(num);
    $('.pb_newevent span').empty().append(width + "%");
    $('.pb_wrapper').css('width', width + '%');
  }
  function remove_progress_bar(num) {
    width = width - parseInt(num);
    $('.pb_newevent span').empty().append(width + "%");
    $('.pb_wrapper').css('width', width + '%');
  }


  /*
  **  Next Step
  */

  $('#btnnext').click(function () {
    var $step = $(this).closest('.block').find('.step.displayblock');
    var $invalid = false;

    $('.input-area', $step).each(function() {
      if ( $(this).val() == "" ) {
        $(this).addClass('invalid');
        $invalid = true;
      }
      if ( $(this).hasClass('invalid') )
        $invalid = true;
    });

    if ( $invalid == false ) {
      // hide current
      $step.animateCss('fadeOutLeft');
      $step.removeClass('displayblock').wait(800).addClass('displaynone').removeClass('fadeOutLeft animated');

      // show next
      $step.next().removeClass('displaynone').addClass('displayblock').animateCss('fadeInRight');
      $step.next().wait(800).removeClass('fadeInRight animated')

      // checking last element
      if ( $step.next().index() == $('.step').length - 1 ) {
        $('#btnnext').removeClass('displayblock').addClass('displaynone');
        $('#btnsubmit').removeClass('displaynone').addClass('displayblock');
      } else {
        $('#btnprevious').removeClass('displaynone').addClass('displayblock');
      }
    }

  });


  /*
  **  Previous Step
  */

  $('#btnprevious').click(function () {
    var $step = $(this).closest('.block').find('.step.displayblock');

    // hide current
    $step.animateCss('fadeOutRight');
    $step.removeClass('displayblock').wait(800).addClass('displaynone').removeClass('fadeOutRight animated');

    // show previous
    $step.prev().removeClass('displaynone').addClass('displayblock').animateCss('fadeInLeft');
    $step.prev().wait(800).removeClass('fadeInLeft animated');

    // checking first element
    if ( $step.prev().index() == 0 ) {
      $('#btnprevious').removeClass('displayblock').addClass('displaynone');
    } else {
      $('#btnsubmit').removeClass('displayblock').addClass('displaynone');
      $('#btnnext').removeClass('displaynone').addClass('displayblock');
    }

  });


  /*
  **  Submit Form
  */

  $('#btnsubmit').click(function () {
    var $step = $(this).closest('.block').find('.step.displayblock');
    var $invalid = false;

    $('.input-area', $step).each(function() {
      if ( $(this).val() == "" ) {
        $(this).addClass('invalid');
        $invalid = true;
      }
      if ( $(this).attr('type') == 'checkbox' && $(this).prop('checked') == false ) {
        $(this).addClass('invalid');
        $invalid = true;
      }
      if ( $(this).hasClass('invalid') )
        $invalid = true;
    });

    if ( $invalid == false ) {
      document.forms[0].submit();
    }
  });

	/*
  **  Validate Elements
  */

  $("#event_name").inputmask({
    mask: '*{1,60}',
    definitions: {
      '*': {
        validator: "[a-zA-Z0-9а-яА-Я№ ]",
      }
    },
    showMaskOnHover: false,
    showMaskOnFocus: false,
    oncomplete: function(){
      checking_el_valid($(this), "valid");
    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });

  $("#event_site").inputmask({
		mask: "\\http://nwe.ru/" + maskorgname+ '/a{4,20}',
    definitions: {
      'a': {
        validator: "[a-z0-9-]",
      }
    },
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true,
    oncomplete: function(){
      if ( check_event_site_in_DB($(this).val()) == true) {
          $(this).parent().children('.help-block').css('display', 'block');
          $(this).parent().children('.error-input').remove();
          checking_el_valid($(this), "valid");
      }
      else {
        $(this).parent().children('.help-block').css('display', 'none');
        if ( ! $(this).parent().children('span').hasClass('error-input')) {
            $(this).parent().append('<span class="error-input">К сожалению, такая страница занята. Пожалуйста, придумайте другой адрес.</span>');
        }
        checking_el_valid($(this), "invalid");
      }
    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });
  $("#event_site").blur(function(){
    var str = $(this).inputmask('unmaskedvalue').replace(/-{2,}/gim, '-').replace('-','');

    if ( str.substr(str.length-1, str.length) == '-')
      str = str.substr(0, str.length-1);

    if (str.length >= 4){
      $(this).val(str);
    } else {
      $(this).val('');
      $(this).addClass('invalid');
    }
  });

	$("#event_desc").inputmask({
		mask: '*{1,200}',
		definitions: {
			'*': {
				validator: "[a-zA-Z0-9а-яА-Я-!@#%*()[]|/:;''.,№?_ ]",
			}
		},
		showMaskOnHover: false,
		showMaskOnFocus: false,
		oncomplete: function(){
			checking_el_valid($(this), "valid");
		},
		onincomplete: function(){
			checking_el_valid($(this), "invalid");
		}
	});

	$("#datestart").inputmask({
		mask: '*{1,16}',
		definitions: {
			'*': {
				validator: "[0-9.: ]",
			}
		},
		showMaskOnHover: false,
		showMaskOnFocus: false,
		oncomplete: function(){
			checking_el_valid($(this), "valid");
		},
		onincomplete: function(){
			checking_el_valid($(this), "invalid");
		}
	});
	$("#datestart").blur(function(){
    if ($(this).val() != "")
			checking_el_valid($(this), "valid");
		else
			checking_el_valid($(this), "invalid");
  });


	$("#dateend").inputmask({
		mask: '*{1,16}',
		definitions: {
			'*': {
				validator: "[0-9.: ]",
			}
		},
		showMaskOnHover: false,
		showMaskOnFocus: false,
		oncomplete: function(){
			checking_el_valid($(this), "valid");
		},
		onincomplete: function(){
			checking_el_valid($(this), "invalid");
		}
	});
	$("#dateend").blur(function(){
    if ($(this).val() != "")
			checking_el_valid($(this), "valid");
		else
			checking_el_valid($(this), "invalid");
  });

	$("#address").inputmask({
		mask: '*{1,200}',
		definitions: {
			'*': {
				validator: "[а-яА-Я0-9.,/№ ]",
			}
		},
		showMaskOnHover: false,
		showMaskOnFocus: false,
		oncomplete: function(){
			checking_el_valid($(this), "valid");
		},
		onincomplete: function(){
			checking_el_valid($(this), "invalid");
		}
	});
	$("#address").change(function(){
    if ($(this).val() != "")
			checking_el_valid($(this), "valid");
		else
			checking_el_valid($(this), "invalid");
  });
	$('#confirmrools').click(function(){
    if ( $(this).prop('checked') == true) {
      checking_el_valid($(this), "valid");
    } else {
      checking_el_valid($(this), "invalid");
    }
  });


	




	/*
  **  Checking organization site in DB
  */
  function check_event_site_in_DB(site){
		var sitesInDB = "http://nwe.ru/" + orgname + "/qqqqq";
    if (site == sitesInDB) {
      return false;
    } else {
      return true;
    }
  }



	/*
	** Creating Map
	*/

	function createMap() {
		$('#map_loader').remove();
		$('#map').css('display','block');

		// Создание карты
		var map = new ymaps.Map('map', {
			center: [55.751574, 37.573856],
			zoom: 10,
			controls: ['zoomControl']
	 });

	 // Экземпляр элемента управления «поиск по карте» с установленной опцией поиска по организациям.
	var searchControl = new ymaps.control.SearchControl({
			options: {
					provider: 'yandex#search'
			}
	});
	map.controls.add(searchControl);






	// Создаем собственный класс.
  var addressControlClass = function (options) {
      addressControlClass.superclass.constructor.call(this, options);
      this._$content = null;
      this._geocoderDeferred = null;
  };
  // И наследуем его от collection.Item.
  ymaps.util.augment(addressControlClass, ymaps.collection.Item, {
      onAddToMap: function (map) {
          addressControlClass.superclass.onAddToMap.call(this, map);
          this._lastCenter = null;
					this.getParent().getChildElement(this).then(this._onAddBtn, this);
					this.getParent().getChildElement(this).then(this._onGetChildElement, this);
      },

      onRemoveFromMap: function (oldMap) {
          this._lastCenter = null;
          if (this._$content) {
              this._$content.remove();
              this._mapEventGroup.removeAll();
          }
          addressControlClass.superclass.onRemoveFromMap.call(this, oldMap);
      },

      _onGetChildElement: function (parentDomContainer) {
          // Создаем HTML-элемент с текстом.
          this._$content = $('<div class="addressControl"></div>').appendTo(parentDomContainer);
          this._mapEventGroup = this.getMap().events.group();
          // Запрашиваем данные после изменения положения карты.
          this._mapEventGroup.add('boundschange', this._createRequest, this);
          // Сразу же запрашиваем название места.
          this._createRequest();
      },

			_onAddBtn: function (parentDomContainer) {
          this._$content = $('<a id="saveMapBtn" class="btn btn-map btn-default" style="margin-right:10px">Сохранить</a>').appendTo(parentDomContainer);
					this._$content = $('<a id="closeMapBtn" class="btn btn-map btn-default" style="margin-left:10px">Закрыть</a>').appendTo(parentDomContainer);
      },

      _createRequest: function() {
          var lastCenter = this._lastCenter = this.getMap().getCenter().join(',');
					// Запрашиваем информацию о месте по координатам центра карты.
          ymaps.geocode(this._lastCenter, {
              // Указываем, что ответ должен быть в формате JSON.
              json: true,
              // Устанавливаем лимит на кол-во записей в ответе.
              results: 1
          }).then(function (result) {
                  // Будем обрабатывать только ответ от последнего запроса.
                  if (lastCenter == this._lastCenter) {
                      this._onServerResponse(result);
                  }
              }, this);
      },

      _onServerResponse: function (result) {
          // Данные от сервера были получены и теперь их необходимо отобразить.
          // Описание ответа в формате JSON.
          var members = result.GeoObjectCollection.featureMember,
              geoObjectData = (members && members.length) ? members[0].GeoObject : null;
          if (geoObjectData) {
              this._$content.text(geoObjectData.metaDataProperty.GeocoderMetaData.text);
          }
      }
    });


    var addressControl = new addressControlClass();

    map.controls.add(addressControl, {
        float: 'none',
        position: {
            top: 10,
            right: 10
        }
    });
 }

 // Сохранить адрес
 $('body').on('click', '#saveMapBtn', function () {
	 $('#address').val($('.addressControl').text());
	 $('#map_modal').modal('hide').remove();
	 checking_el_valid($('#address'), "valid");
 });

 // Закрыть карту
 $('body').on('click', '#closeMapBtn', function () {
	 $('#map_modal').modal('hide').remove();
 });


});
