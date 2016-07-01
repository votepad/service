$(function() {
	
	$('#showReg').on('click', function(){
		$('#signin').css('display','none');
		$('#signup').css('display','block');
	});
	$('#ReshowReg').on('click', function(){
		$('#signin').css('display','block');
		$('#signup').css('display','none');
	});
	$('#showReset').on('click', function(){
		$('#signin').css('display','none');
		$('#reset').css('display','block');
	});
	$('#ReshowReset').on('click', function(){
		$('#signin').css('display','block');
		$('#reset').css('display','none');
	});

	$('#confirm_password').on('change', function() {
		var conf = $(this).val();
		var pass = $('#password1').val();

		if (conf == pass && pass.length > 5)
		{	
			$(this).css('background-color', 'rgba(0, 200, 0, 0.3)');
			$('#password1').css('background-color', 'rgba(0, 200, 0, 0.3)');
			$('#signup-button').prop('disabled',false);
		}
		else 
		{
			$(this).css('background-color', 'rgba(200, 0, 0, 0.3)');
			$('#password1').css('background-color', 'rgba(200, 0, 0, 0.3)');
			$('#signup-button').prop('disabled',true);
		}
	});

	$('#password1').on('change', function() {
		var conf = $('#confirm_password').val();
		var pass = $(this).val();

		if (conf == pass && conf.length > 5)
		{	
			$('#confirm_password').css('background-color', 'rgba(0, 200, 0, 0.3)');
			$('#password1').css('background-color', 'rgba(0, 200, 0, 0.3)');
			$('#signup-button').prop('disabled',false);
		}
		else 
		{
			$('#confirm_password').css('background-color', 'rgba(200, 0, 0, 0.3)');
			$('#password1').css('background-color', 'rgba(200, 0, 0, 0.3)');
			$('#signup-button').prop('disabled',true);
		}
	});
});