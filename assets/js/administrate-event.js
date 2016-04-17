$(document).ready(function(){

  /* SWEETALERT STRAT AGAIN */
  $("#start-again").on("click",function(){
    swal({   
      title:"Вы уверены?",
      text:"Если вы поддтвердите, то все данные об оценивание удалятся. У вас не будет возможности восстановить их.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText:"Да, удалить всё!",
      cancelButtonText:"Нет, отменить!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, 
    function(isConfirm){   
      if (isConfirm) {     
        swal("Удалено!","Все данные о результатах удалены.", "success");
      }else{
        swal("Отменено!","Ваши данные остались в сохранности.","error");
      } 
    });
  });

  /* SWEETALERT STRAT AGAIN */
  $("#download").on("click",function(){
    swal({
        title: "Экспорт результатов",
        text: "<label class='col-xs-6 control-label' style='padding-top:10px'>Выберите формат:</label><div class='col-xs-6'><select name='downloading-format' class='btn-area form-control'><option>PDF</option><option>Exel</option><select></div>",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#27c24c",
        confirmButtonText: "Скачать",
        cancelButtonText: "Отменить",
        closeOnConfirm: false
      }, 
      function(){
        swal( "Успешно!", "Проверьте файл в папке 'Закгрузки'", "success" );
    });
  });

  $('.btn-open').click(function(){
    $(this).removeClass('btn-default').addClass('disabled').css('background-color' ,'#24b145').css('border-color','#1f9c3d').css('color','#fff').css('opacity','1').text('Доступ открыт');
  });
});