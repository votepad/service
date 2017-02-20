$(document).ready(function(){
	
	$('.site_description').fadeIn(850,function(){
			$('#enter_button').fadeIn(850);
		});
	
	$(".news-item p").each(function(){	
			
		var max_short_news_length = 200;
		var n = $(this).html().length;
		
		if ( n > max_short_news_length ) // отсекаем длинный текст новости
		{
			var content = $(this).html().substr(0,max_short_news_length);
			content+='...';
			$(this).html(content);
		}
	});
	
});

$('#sort_type, #sort_city').change(function(){
	$('#sort').submit();
});