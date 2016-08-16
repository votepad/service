$().ready (function() {
	var check = function() {
		if ($('#event_about').children().length == 0) {
			$('#no_event_about').css('display','block');
			$('#event_about').css('display','none');
		} else if ($('#event_about').children().length == 1) {
			if ($('#event_about').children().html() == "<br>") {
				$('#no_event_about').css('display','block');
				$('#event_about').css('display','none');
			}
		} else{
			$('#no_event_about').css('display','none');
			$('#event_about').css('display','block');
		}
	}
	check();
	$('#edit_event_about').click(function(){
		check();
		$('#no_event_about').css('display','none');
		$('#event_about').summernote({
			focus: true,
			lang: 'ru-RU',
			height: 300,
			placeholder: "Расскажите основную информацию об мероприятии...",
			toolbar: [
				['style note-para', ['style','bold', 'italic', 'underline','paragraph']],
				['font note-fontsize note-height', ['ul', 'ol','superscript', 'subscript', 'hr', 'fontsize', 'height']],
				['color', ['color']],
				['insert', ['table', 'link', 'picture', 'video']],
				['fullscreen', ['undo','redo','fullscreen','codeview']]
			]
		});
		$('button').each(function() {
			if ( $(this).hasClass('btn-primary') ) {
				$(this).removeClass('btn-primary').addClass('md-btn md-btn-success');
			}
		});
		$('#edit_event_about').css('display','none');
		$('.note-toolbar').append('<div class="note-btn-group btn-group"><button id="save_event_about" class="note-btn btn btn-default btn-sm" tabindex="-1" title="Сохранить изменения"><i class="fa fa-floppy-o" aria-hidden="true" style="padding-right: 3px;"></i>  Сохранить</button></div>');
	});

	$('.columns-area').on('click', '#save_event_about', function(){
		/* update page */	
		$('#event_about').summernote('destroy');
		$('#edit_event_about').css('display','block');
		check();
	});
});