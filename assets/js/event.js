$(document).ready (function() {  
   $.validate();   
   $("#input-event-description").restrictLength( $("#pres-max-length") );
   moment.lang('ru');
   $('#input-event-start').combodate({
      format:'YYYY-MM-DD HH:mm',
      viewformat:'D MMM YYYY в HH:mm',
      template: 'D - MMM - YYYY          в           HH : mm',   
      minYear: 2016,
      maxYear: 2026,
      minuteStep: 10,
      customClass: 'form-control-2 btn_area1'
   
   });
   $('#input-event-end').combodate({
      format:'YYYY-MM-DD HH:mm',
      viewformat:'D MMM YYYY в HH:mm',
      template: 'D - MMM - YYYY          в           HH : mm',   
      minYear: 2016,
      maxYear: 2026,
      minuteStep: 10,
      customClass: 'form-control-1 btn_area1'
   });


   $('input[type=submit]').on('click', function(){
   	var file = $('input[type=file]').val();
   	if(file == ''){
   		$("#update-photo").parent().removeClass("btn-primary").addClass("btn-danger");
         if($('#input-event-name').val() == '') {$('#input-event-name').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-name').removeClass('error-border').addClass('success-border')}
         if($('#input-event-description').val() == '') {$('#input-event-description').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-description').removeClass('error-border').addClass('success-border')}
         if($('#input-event-status').val() == '') {$('#input-event-status').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-status').removeClass('error-border').addClass('success-border')}
         if($('#input-event-end').val() == '') {$('.form-control-1').removeClass('success-border').addClass('error-border')}
            else{$('.form-control-1').removeClass('error-border').addClass('success-border')}
         if($('#input-event-start').val() == '') {$('.form-control-2').removeClass('success-border').addClass('error-border')}
            else{$('.form-control-2').removeClass('error-border').addClass('success-border')}
         if($('#input-event-city').val() == '') {$('#input-event-city').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-city').removeClass('error-border').addClass('success-border')}
         if($('#input-event-type').val() == '') {$('#input-event-type').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-type').removeClass('error-border').addClass('success-border')}
   	}
   	else{
   		$("#update-photo").parent().removeClass("btn-danger").addClass("btn-primary");
   	}
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
         if($('#input-event-name').val() == '') {$('#input-event-name').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-name').removeClass('error-border').addClass('success-border')}
         if($('#input-event-description').val() == '') {$('#input-event-description').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-description').removeClass('error-border').addClass('success-border')}
         if($('#input-event-status').val() == '') {$('#input-event-status').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-status').removeClass('error-border').addClass('success-border')}
         if($('#input-event-end').val() == '') {$('.form-control-1').removeClass('success-border').addClass('error-border')}
            else{$('.form-control-1').removeClass('error-border').addClass('success-border')}
         if($('#input-event-start').val() == '') {$('.form-control-2').removeClass('success-border').addClass('error-border')}
            else{$('.form-control-2').removeClass('error-border').addClass('success-border')}
         if($('#input-event-city').val() == '') {$('#input-event-city').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-city').removeClass('error-border').addClass('success-border')}
         if($('#input-event-type').val() == '') {$('#input-event-type').removeClass('success-border').addClass('error-border')}
            else{$('#input-event-type').removeClass('error-border').addClass('success-border')}
      }
   });
   
   var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-width'     : {width:"95%"}
   }
   for (var selector in config) {
      $(selector).chosen(config[selector]);
   }
   $(".chosen-container-multi").on("click", function() {
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){$('.chosen-choices').css('border-color','#27c24c');}
         else{$('.chosen-choices').css('border-color','rgb(185, 74, 72)');}
   });
   $(".chosen-container-multi").focusout(function() {
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){$('.chosen-choices').css('border-color','#27c24c');}
         else{$('.chosen-choices').css('border-color','rgb(185, 74, 72)');}
   });
   

   $('#input-event-start').on('change',function(){
   if($('#input-event-start').val() == '') {$('.form-control-2').removeClass('success-border').addClass('error-border')}
      else{$('.form-control-2').removeClass('error-border').addClass('success-border')}   
   })
   $('#input-event-end').on('change',function(){
   if($('#input-event-end').val() == '') {$('.form-control-1').removeClass('success-border').addClass('error-border')}
      else{$('.form-control-1').removeClass('error-border').addClass('success-border')}
   });
});