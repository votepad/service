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

  $('body').on('click','#save_number',function(){
    var num = $('#number').val();
    if (num != '') {
      $('#numbers_list').append('<li class="inline item" value="' + num + '">' + num + '</li>');
      $('#modal_number').modal('hide');
      $('#modal_number').remove();
    }
  });

  $('.input-group').mouseenter(function() {
    $('.clear',this).css('display','block');
  });
  $('.input-group').mouseleave (function() {
    $('.clear',this).css('display','none');
  });
  $('.clear').click(function(){
    $(this).parent().children('ul').empty();
  });


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
      put: ['numbers_list','math_list','groups','criterions']
    },
    animation: 200,
  });


});
