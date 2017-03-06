$(document).ready(function(){

    var url = location.protocol + '//' + location.hostname;

    // BlockStages
    $("button[id='openStage']").click( function() {
      $(this).removeClass('btn-default').addClass('disabled').css('background-color' ,'#24b145').css('border-color','#1f9c3d').css('color','#fff').css('opacity','1').text('Доступ открыт').prop('disabled',true);
        var stage = $(this).closest("td").attr('id');

        $.ajax({
            url: url + '/block/',
            type: "POST",
            data: {
                stage: stage,
            },
            success: function(data, config) {
                console.log(data);
            },
            error: function(data, config) {
                console.log(data);
            }
        });
    });

    function isOpen(id) {
      var result;
      $.ajax({
          url: url + '/block/getBlocked',
          type: "POST",
          data: {
              stage: id,
          },
          success: function(data, config) {
              result = parseInt(data);
              console.log(result);
          },
          async: false,
      });
      return result;
    }
    
    var x = $('.btn-open').length;
    for (var i = 0; i < x; i++) {
      var stage_id = $(".btn-open-"+i).parents("td").attr('id');  
      var blocked = isOpen(stage_id);
      if (blocked == 0) {
        $(".btn-open-"+i).removeClass('btn-default').addClass('disabled').css('background-color' ,'#24b145').css('border-color','#1f9c3d').css('color','#fff').css('opacity','1').text('Доступ открыт');
      }
    }
   
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

  $('.scoreinfo').on('click', function(){
        var s = $(this).attr("value");
        var stage, criterion, judge, participant;

        stage = s.substr(0,s.indexOf('-'));
        s = s.substr(stage.length+1,s.length);

        //criterion = s.substr(0,s.indexOf('-'));
        //s = s.substr(criterion.length+1,s.length);

        judge = s.substr(0,s.indexOf('-'));
        s = s.substr(judge.length+1,s.length);

        participant = s;

        $.ajax({
            url: url+'/getCriteasWithScores/',
            type: "POST",
            data: {
                id_stage: stage,
                id_judge: judge,
                id_participant: participant,
            },
            success: function(data, config) {
                var result = JSON.parse(data);

                document.getElementById('criteriasWithScores').innerHTML = '';

                for(var i = 0; i < result.length; i++)
                {
                    var tr  = document.createElement('tr');
                    var td1 = document.createElement('td');
                    var td2 = document.createElement('td');
                    td2.setAttribute('class', 'text-center');

                    td1.appendChild( document.createTextNode(result[i].name) );
                    td2.appendChild( document.createTextNode(result[i].score) );

                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    document.getElementById('criteriasWithScores').appendChild(tr);
                }

                $('#CriteriaScore').modal();
                $("body").removeClass('modal-open');
            },
        })
    
  });

  /* CACHE TABS */
    $("#tabs").tabs({
        active   : $.cookie('activetab'),
        activate : function( event, ui ){
            $.cookie( 'activetab', ui.newTab.index(),{
                expires : 10
            });
        }
    });
});