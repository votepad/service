$(document).ready(function(){
  $(".newUser").click(function(){
    $(".newUser").css("display","none");
    $(".newUserForm").css("display","block");
  });
  $(".eventsToUser").select2({language: "ru"}); 
  $("#canselnewUser").on("click", function(){
    $(".newUser").css("display","block");
    $(".newUserForm").css("display","none");
    $('form[name=newUserForm]').trigger('reset');
    $(".eventsToUser").select2("val", "");
  });
});