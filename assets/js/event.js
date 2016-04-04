$(document).ready (function() {
   
   $.validate({
      modules : 'date'
   });
   $("#input-event-description").restrictLength( $("#pres-max-length") );

   $('input[type=submit]').on('click',function(){
   	var file = $('input[type=file]').val();
   	if(file == ''){
   		$("#update-photo").parent().removeClass("btn-primary").addClass("btn-danger");
   	}
   	else{
   		$("#update-photo").parent().removeClass("btn-danger").addClass("btn-primary");
   	};
   	if($("li.active-result").hasClass("result-selected") == true){
    	   $('.chosen-single').css('border-color','#27c24c');
   	}
   	else{
   		$('.chosen-single').css('border-color','rgb(185, 74, 72)');
   	};
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
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
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
      }
   });
   $(".chosen-container-multi").focusout(function() {
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
      }
   });
   $('.chosen-container-single').click(function(){
   	if($("li.active-result").hasClass("result-selected") == true){
   		$('.chosen-single').css('border-color','#27c24c');
   	}
   	else{
   		$('.chosen-single').css('border-color','rgb(185, 74, 72)');
   	}
   });
});
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(a){a.formUtils.addValidator({name:"time",validatorFunction:function(a){if(null===a.match(/^(\d{2}):(\d{2})$/))return!1;var b=parseInt(a.split(":")[0],10),c=parseInt(a.split(":")[1],10);return!(b>23||c>59)},errorMessage:"",errorMessageKey:"badTime"}),a.formUtils.addValidator({name:"birthdate",validatorFunction:function(b,c,d){var e="yyyy-mm-dd";c.valAttr("format")?e=c.valAttr("format"):"undefined"!=typeof d.dateFormat&&(e=d.dateFormat);var f=a.formUtils.parseDate(b,e);if(!f)return!1;var g=new Date,h=g.getFullYear(),i=f[0],j=f[1],k=f[2];if(i===h){var l=g.getMonth()+1;if(j===l){var m=g.getDate();return m>=k}return l>j}return h>i&&i>h-124},errorMessage:"",errorMessageKey:"badDate"})}(a)});