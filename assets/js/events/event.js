$().ready (function() {
	$('#eventshortdesc').keyup(function(){
		$('#shortdesc_max_length').text(parseInt(170-$('#eventshortdesc').val().length));
	});
	$("#responsible_persons").select2({language: "ru"}); 
  /*$("#canselnewUser").on("click", function(){
    $(".newUser").css("display","block");
    $(".newUserForm").css("display","none");
    $('form[name=newUserForm]').trigger('reset');
    $("#responsible_persons").select2("val", "");
  });*/
});