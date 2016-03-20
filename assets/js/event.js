$.validate();
$("#input-event-description").restrictLength( $("#pres-max-length") );

$('input[type=submit]').on('click',function(){
	var file = $('input[type=file]').val();
	if(file == ''){
		$("#update-photo").removeClass("btn-primary").addClass("btn-danger");
	}
	else{
		$("#update-photo").removeClass("btn-danger").addClass("btn-primary");
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