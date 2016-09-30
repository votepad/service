$(document).ready(function(){

  $('.vk').hover(function(){$('.vk i').css("color","#4c75a3");}, function(){$('.vk i').css("color","#656565");});
  $('.facebook').hover(function(){$('.facebook i').css("color","#3b5998");}, function(){$('.facebook i').css("color","#656565");});
  $('.twitter').hover(function(){$('.twitter i').css("color","#35b0ed");}, function(){$('.twitter i').css("color","#656565");});
  /* add likes */
  $('.fav').on('click', function(){
    if ( $("i", this).hasClass('active') ) {
      $("i", this).removeClass('active');
    }
    else {
      $("i", this).addClass('active');
    }
  });

  /*   CREATE EVENTS ARRAY  */
  var k = $('.event-group').length; // number of events
  var events = new Array();
  function Event(el,name,time,type,hidden){
    this.el = el;
    this.name = name;
    this.time = time;
    this.type = type;
    this.hidden = hidden;
  }
  $('.event-group').each(function(){
    events[$(this).index()] = new Event($(this), $(this).find('.event_name_search').text().toLowerCase(),$(this).find('.event_time_search').text(),$(this).find('.event_type_search').text(), false);
  });
  countEvents(k);

  var type = '';
  /*  SEARCHING BY NAMES  */
  $('.search-block').on('keyup', 'input[name="event_name"]', function(){
    searching();
  });


  /*  SEARCHING BY TYPES */
  $('.select_btn_list[name="event_type"] li').click( function(){
    type = $(this).text();
    $('.select_btn_list[name="event_type"] li').each(function(){$(this).removeClass('active');})
    $(this).addClass('active');
    searching();
  });


  /*  SORTING  */
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


  /*  DISPLAY EVENTS  */
  function showEvents(){
    $('#events_list').empty();
    k = 0;
    for(var i =0; i < events.length; i++){
      if ( events[i].hidden != true ) {
        $('#events_list').append(events[i].el);
        k++;
      }
    }
    countEvents(k);
  };


  /*  FUNCTIONS  */
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
    if (x == 0 || x >= 5 && x <= 9) { $('#count_events').empty().append('К сожалению, мероприятия не найдены'); }
    if (x == 1) { $('#count_events').empty().append('Отображено ' + val + ' мероприятие'); }
    if (x >= 2 && x <= 4) { $('#count_events').empty().append('Отображено ' + val + ' мероприятия'); }
  }

  function searching(){
    console.log(type);
    if ( $('input[name="event_name"]').val() == '' && type == '' ) {
      for(var i =0; i < events.length; i++){
        events[i].hidden = false;
      }
      showEvents();
    } else if ( $('input[name="event_name"]').val() != '' && type == '' ) {
      for(var i =0; i < events.length; i++){
        if ( events[i].name.match($('input[name="event_name"]').val().toLowerCase()) ) {
          events[i].hidden = false;
        } else {
          events[i].hidden = true;
        }
      }
      showEvents();
    } else if ( $('input[name="event_name"]').val() == '' && type != '' ) {
      for(var i =0; i < events.length; i++){
        if (events[i].type != true) {
          if ( type == events[i].type ) {
            events[i].hidden = false;
          } else {
            events[i].hidden = true;
          }
        }
      }
      showEvents();
    } else {
      for(var i =0; i < events.length; i++){
        if ( type == events[i].type && events[i].name.match($('input[name="event_name"]').val().toLowerCase()) ) {
          events[i].hidden = false;
        } else {
          events[i].hidden = true;
        }
      }
      showEvents();
    }
  }
});
