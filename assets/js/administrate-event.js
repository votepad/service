(function(window, document, $, undefined){

  $(function(){

    $('.panel')
      .on('panel.refresh', function(e, panel){

        // perform any action when a .panel triggers a the refresh event
        setTimeout(function(){

          // when the action is done, just remove the spinner class
          panel.removeSpinner();
      
        }, 3000);

      })
      .on('hide.bs.collapse', function(event){

        console.log('Panel Collapse Hide');

      })
      .on('show.bs.collapse', function(event){

        console.log('Panel Collapse Show');

      })
      .on('panel.remove', function(event, panel, deferred){
        console.log('Removing panel');
        // Call resolve() to continue removing the panel
        // perform checks to avoid removing panel if some user action is required
        deferred.resolve();
      })
      .on('panel.removed', function(event, panel){

        console.log('Removed panel');

      });



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

  });

})(window, document, window.jQuery);