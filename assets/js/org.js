$(function () {
  $('[data-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
  });

  var urlPage = location.href;

  var settings = /setting/;
  var active_org_set_tab = urlPage.match(settings);
  if (active_org_set_tab) {
    $('.org-nav a:nth-child(1)').removeClass('active');
    $('.org-nav a:nth-child(2)').addClass('active');
  } else {
    $('.org-nav a:nth-child(2)').removeClass('active');
    $('.org-nav a:nth-child(1)').addClass('active'); 
  }

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





  $(".newUser").click(function(){
    $(".newUser").css("display","none");
    $(".newUserForm").css("display","block");
  });
  
  $("#canselnewUser").on("click", function(){
    $(".newUser").css("display","block");
    $(".newUserForm").css("display","none");
    $('form[name=newUserForm]').trigger('reset');
    $(".eventsToUser").select2("val", "");
  });
  

  $('input[type="tel"]').inputmask('+7 (999) 999-9999');
  $(".eventsToUser").select2({language: "ru"});




  $('#table-curent-application').dataTable({
    /*'paging': true,
    'ordering':  true,
    'searching': true,
    'info': true,
    'scrollX': true,
    oLanguage:{
      oPaginate:{
        sNext:"<em class='fa fa-angle-right' style='font-size:1.2em'></em>",
        sPrevious:"<em class='fa fa-angle-left' style='font-size:1.2em'></em>"
      },
      sEmptyTable:"Вы не создали ещё мероприятия. Нажмите в левом меня на 'Создать мероприятие'",
      sInfo:"Показано _START_-_END_  из _TOTAL_ мероприятий",
      sInfoEmpty:"Показано 0 мероприятий",
      sInfoFiltered:"(отсортировано из _MAX_ мероприятий)",
      sLengthMenu:"Показано _MENU_ мероприятий",
      sLoadingRecords:"Загружается...",
      sProcessing:"Обрабатывается...",
      sSearch:"Введите для поиска:",
      sZeroRecords:"Мероприятия не найдены"
    },
    columnDefs: [ 
      { 'targets' : 'no-sort', 'orderable': false },
      { 'targets': 'datetime','sType': 'de_datetime' }
    ]*/
  /*  columnDefs: [
      {
        targets: [ 0, 1, 2 ],
        className: 'mdl-data-table__cell--non-numeric'
      }
    ]*/
  });

});