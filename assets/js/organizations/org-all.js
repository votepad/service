$(document).ready(function(){

  /**
   * Show description of event
   */
  $('body').on('click', '.event_card', function (e) {

    if ($(this).find('> .event_card-reveal').length) {

      if ( $(e.target).is($('.event_card .event_card-reveal .pointer')) ) {

        $this = $(e.target).closest('.event_card');
        $this.find('.event_card-reveal').animateCss('fadeOutDown');
        $this.find('.event_card-reveal').wait(500).removeClass('fadeOutDown animated').css('display', 'none');

      } else if ( $(e.target).is($('.event_card .event_card-title .pointer')) || $(e.target).is($('.event_card .event_card-image')) ) {

        $this = $(e.target).closest('.event_card');
        $this.find('.event_card-reveal').css('display','block').animateCss('fadeInUp');

      }

    }
  });

  /**
   *
   * @type {*|jQuery}
   */
  var k = $('.event_wrapper').length; // number of events
  var events = new Array();
  var type = '';

  function Event(el,name,time,type,hidden){
    this.el = el;
    this.name = name;
    this.time = time;
    this.type = type;
    this.hidden = hidden;
  }

  $('.event_wrapper').each(function(){

    var eventNameSearch = $(this).find('.event_name_search'),
        eventTimeSearch = $(this).find('.event_time_search'),
        eventTypeSearch = $(this).find('.event_type_search');

    events[$(this).index()] = new Event($(this), eventName.text().toLowerCase(), eventTimeSearch.text(), eventTypeSearch.text(), false);

    var date = toDate(eventTimeSearch.text());
    eventTimeSearch.empty().append(date);

  });

  countEvents(k);

  function toDate(temp) {
    var date = new Date(temp);

  var options = {
    day: 'numeric',
    month: 'long',

    weekday: 'long',
    timezone: 'UTC',
    hour: 'numeric',
    minute: 'numeric',
  };

    return date.toLocaleString("ru", {weekday: 'long', day: 'numeric', month: 'long'}) + ' ' + date.getFullYear() + ' в ' + date.toLocaleString("ru", {hour: 'numeric', minute: 'numeric'});  
  }

  /**
   *  SEARCHING EVENT BY NAME
   */
  $('.search-block').on('keyup', 'input[name="event_name"]', function(){
    searching();
  });


  /**
   * SEARCHING EVENT BY TYPE
   */
  $('.select_btn_list[name="event_type"] li').click( function(){

    type = $(this).text();
    $('.select_btn_list[name="event_type"] li').each(function(){$(this).removeClass('active');})
    $(this).addClass('active');
    searching();

  });


  /**
   *  SORTING EVENTS ARRAY
   */
  $('.select_btn_list[name="event_sort"] li').click( function(){

    $('.select_btn_list[name="event_sort"] li').each(function(){$(this).removeClass('active');})

    $(this).addClass('active');

    if ( $(this).text() == "Название мероприятия" ) {
      events.sort(eventSortName);
    } else if ( $(this).text() == "Дата начала мероприятия" ) {
      events.sort(eventSortDate);
    }

    showEvents();

  });


  /**
   * DISPLAY EVENTS
   */
  function showEvents(){

    $('#events_list').empty();
    k = 0;
    for(var i = 0; i < events.length; i++){
      if ( events[i].hidden != true ) {
        $('#events_list').append(events[i].el);
        k++;
      }
    }
    countEvents(k);

  };

  /**
   * FUNCTIONS FOR EVENT
   */
  function eventSortName(eventA, eventB) {

    if (eventA.name < eventB.name) return -1;
    if (eventA.name > eventB.name) return 1;

  };

  function eventSortDate(eventA, eventB) {

    if (eventA.time < eventB.time) return 1;
    if (eventA.time > eventB.time) return -1;

  };

  function countEvents(val){

    var x = val.toString().substr(val.length - 1, val.length);
    if (x == 0 || x >= 5 && x <= 9) {

      $('#count_events').empty().append('К сожалению, мероприятия не найдены');

    } else if (x == 1) {

      $('#count_events').empty().append('Отображено ' + val + ' мероприятие');

    } else if (x >= 2 && x <= 4) {

      $('#count_events').empty().append('Отображено ' + val + ' мероприятия');

    }
  }

  function searching(){

    var eventsCount = event.length,
        eventName   = $('input[name="event_name"]').val(),
        i;

    for(i = 0; i < eventsCount; i++){

      if ( eventName == '' && type == '' ) {

        events[i].hidden = false;

      } else if ( eventName != '' && type == '' ) {

          if ( events[i].name.match(eventName.toLowerCase()) ) {

            events[i].hidden = false;

          } else {

            events[i].hidden = true;
          }

      } else if ( eventName == '' && type != '' ) {

          if (events[i].type != true) {

            if ( type == events[i].type ) {

              events[i].hidden = false;

            } else {

              events[i].hidden = true;

            }
          }
      } else {

          if ( type == events[i].type && events[i].name.match(eventName.toLowerCase()) ) {

            events[i].hidden = false;

          } else {

            events[i].hidden = true;

          }
      }

    }

    showEvents();
  }


});
