$().ready(function(){
  $('body').on('click','#add_number',function(){
    $('body').append('<div id="modal_number" class="modal fade" tabindex="-1" role="dialog"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"><div class="modal-header"><button type="button" id="cansel_number" class="close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Введите число</h4></div><div class="modal-body"><input id="number" type="number" class="form-control"></div><div class="modal-footer"><button id="save_number" type="button" class="md-btn md-btn-success">ОК</button></div></div></div></div>');
    $('#modal_number').modal({
      keyboard: false,
      backdrop: 'static'
    });
    $('#modal_number').modal('show');
  });

  $('body').on('click','#cansel_number',function(){
    $('#modal_number').modal('hide');
    $('#modal_number').remove();
  });

  var change_height = function () {
    var height = $(window).height();
    $('.right-column .block .panel-body').css('height', height - 45 + "px");
  };
  change_height();

  $(window).resize(function() {
    change_height();
  });

  var hide_open_formulas = function () {
    var width = $(window).width() + 17;
    if (width < 769 && $('.right-column').hasClass('fixed-right-column')) {
      $('#creating_formulas').parent().children('.panel-heading').attr('data-target','#creating_formulas').attr('aria-controls','creating_formulas').tooltip({placement:'left',title:"Скрыть/показать"});
    }
    else {
      $('#creating_formulas').parent().children('.panel-heading').removeAttr('data-target').removeAttr('aria-controls').tooltip("destroy");
    }
  };
  hide_open_formulas();

  $(window).scroll(function() {
    var top = $(document).scrollTop();
    var block_pos = $('.columns-area').offset();
    if (top >= block_pos.top) $('.right-column').addClass('fixed-right-column');
    else $('.right-column').removeClass('fixed-right-column');
    hide_open_formulas();
  });

  $('#edit_formulas').click(function(){
    $(this).parent().append('<button id="save_formulas" type="button" class="md-btn md-btn-sm md-btn-success">Сохранить</button>');
    $(this).remove();
    $('ul.form-control').each(function(){
      $(this).removeAttr('disabled');
    });
    create_sortable_el();

  });
  $('body').on('click','#save_formulas',function(){
    $('ul.form-control').each(function(){
        var ul = $(this);
        var id = $(ul).attr('id');
        var formula = '';
        $('li', this).each(function(){
          formula = formula + $(this).attr('value');
        });
        console.log("id:  ", id, "     formula:   ", formula);
    });
    //window.location.replace(window.location);
  });


  $('body').on('click','#save_number',function(){
    var num = $('#number').val();
    if (num != '') {
      $('#numbers_list').append('<li class="inline item" value="' + num + '">' + num + '</li>');
      $('#modal_number').modal('hide');
      $('#modal_number').remove();
    }
  });

  $('.input-group').mouseenter(function() {
    if ($('ul',this).attr('disabled') != "disabled") {
        $('.clear',this).css('display','block');
    }
  });
  $('.input-group').mouseleave (function() {
    $('.clear',this).css('display','none');
  });
  $('.clear').click(function(){
    $(this).parent().children('ul').empty();
  });

  var create_sortable_el = function(){
    Sortable.create(numbers_list, {
      group: {
        name: "numbers_list",
        pull: "clone",
        put: false
      },
      sort: false,
      animation: 200,
    });
    Sortable.create(math_list, {
      group: {
        name: "math_list",
        pull: "clone",
        put: false
      },
      sort: false,
      animation: 200,
    });
    Sortable.create(stages, {
      group: {
        name: "stages",
        pull: "clone",
        put: false
      },
      sort: false,
      animation: 200,
    });
    Sortable.create(criterions, {
      group: {
        name: "criterions",
        pull: "clone",
        put: false
      },
      sort: false,
      animation: 200,
    });
    Sortable.create(participants, {
      group: {
        name: "participants",
        pull: "clone",
        put: false
      },
      sort: false,
      animation: 200,
    });
    Sortable.create(groups, {
      group: {
        name: "groups",
        pull: "clone",
        put: false
      },
      sort: false,
      animation: 200,
    });



    /*  competition 1  */
    Sortable.create(competition_participant_1, {
      group: {
        name: competition_participant_1,
        pull: true,
        put: ['numbers_list','math_list','stages']
      },
      animation: 200,
    });
    Sortable.create(competition_group_1, {
      group: {
        name: competition_group_1,
        pull: true,
        put: ['numbers_list','math_list','stages']
      },
      animation: 200,
    });

    /*  stage 1  */
    Sortable.create(stage_participant_1_1, {
      group: {
        name: stage_participant_1_1,
        pull: true,
        put: ['numbers_list','math_list','participants','criterions']
      },
      animation: 200,
    });
    Sortable.create(stage_group_1_1, {
      group: {
        name: stage_group_1_1,
        pull: true,
        put: ['numbers_list','math_list','participants','criterions']
      },
      animation: 200,
    });

    /*  stage 2  */
    Sortable.create(stage_participant_1_2, {
      group: {
        name: stage_participant_1_2,
        pull: true,
        put: ['numbers_list','math_list','groups','criterions']
      },
      animation: 200,
    });
    Sortable.create(stage_group_1_2, {
      group: {
        name: stage_group_1_2,
        pull: true,
        put: ['numbers_list','math_list','groups','']
      },
      animation: 200,
    });
  };


});
