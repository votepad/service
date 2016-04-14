$(document).ready(function() {
	
	/*добавляе при не авторизованных юзерах*/
	$('aside ul').prepend("<li class='user-block'><div class='user-block-picture'><img src='../assets/img/user/no-user.png' width='150' height='150' class='img-thumbnail img-circle'></div><div class='user-block-info'><span class='user-block-name'>Добро пожаловать!<br> Пожалуйста, <a href='//pronwe.ru/auth' class='pronwe_Link-small'>войдите в аккаунт</a></span></div></li>");
	$('aside ul li:not(:first-child)').css('display','none');
});