$().ready (function() {

	/*   JUDGES   */

	var array_judges = [
		{'judge_name': 'Иванов Иван Иванович', 'judge_role':'главный жюри', 'judge_email':'email1@ya.ru', 'judge_password':'11111', 'judge_send_mail':'true'},
	];

	var judge_name_validator = function (value, callback) {
		if (value.split(/[\s\.\?]+/).length == 3) {
			callback(true);
		}
		else {
			callback(false);
		}
	};

	var judge_email_validator = function (value, callback) {
		if (/.+@.+/.test(value)) {
			callback(true);
		}
		else {
			callback(false);
		}
	};

	var judges_settings = {
		data: array_judges,
		minSpareRows: 1,
		rowHeaders: true,
		stretchH: 'all',
		colWidths: [200,120,130,90,148],
		colHeaders: ['ФИО жюри', 'Роль', 'E-mail', 'Пароль', 'Прислать приглашение'],
		columns: [
			{ data:'judge_name', validator: judge_name_validator, allowInvalid: true },
			{ data:'judge_role', },
			{ data:'judge_email', validator: judge_email_validator, allowInvalid: true },
			{ data:'judge_password', type: 'password', editor: false, hashLength: 10},
			{ data:'judge_send_mail', type: 'checkbox', className: 'htCenter' },
		],
		afterChange: function (changes, source) {
			if (source !== 'loadData') {
				// отправка данных о жюри
				console.log(JSON.stringify(changes));
			}
		},
	};

	$('#judges').handsontable(judges_settings);



	/*   WHOM VOTE   */

	var charecters = {'participants':false, 'groups':false, 'teams':false};

	var show_whom_vote = function(){
		charecters.participants = false; charecters.teams = false;
		if ( $('label[for=participants_onoffswitch]').hasClass('checked') ) { charecters.participants = true; }
		if ( $('label[for=groups_onoffswitch]').hasClass('checked') ) { charecters.groups = true; }
		if ( $('label[for=teams_onoffswitch]').hasClass('checked') ) { charecters.teams = true; }

		$('.characters_preview').empty();

		var temp = '';
		if (charecters.participants == true && charecters.teams == false) { temp = temp + '<div class="participants"><div class="participant clearfix"><div class="label"><i class="fa fa-user" aria-hidden="true"></i><span>Участник №1</span></div></div><div class="participant clearfix"><div class="label"><i class="fa fa-user" aria-hidden="true"></i><span>Участник №2</span></div></div><div class="participant clearfix"><div class="label"><i class="fa fa-user" aria-hidden="true"></i><span>Участник №3</span></div></div></div>'; $('#groups_onoffswitch').prop('disabled','disabled'); $('label[for=groups_onoffswitch]').removeClass('checked').parent().children('.onoffswitch-checkbox').prop('checked',false); charecters.groups = false;}
		else if (charecters.participants == false && charecters.teams == true) { temp = temp + '<div class="teams"><div class="team clearfix"><div class="label"><span class="icon-crowd-of-users"></span><span>Команда №1</span></div></div><div class="team clearfix"><div class="label"><span class="icon-crowd-of-users"></span><span>Команда №2</span></div></div><div class="team clearfix"><div class="label"><span class="icon-crowd-of-users"></span><span>Команда №3</span></div></div></div>'; $('#groups_onoffswitch').prop('disabled','disabled'); $('label[for=groups_onoffswitch]').removeClass('checked').parent().children('.onoffswitch-checkbox').prop('checked',false); charecters.groups = false;}
		else if (charecters.participants == true  && charecters.teams == true) { temp = temp + '<div class="teams"><div class="team clearfix"><div class="label"><span>Команда №1</span></div><div class="split-blocks"></div><div class="body"><i class="fa fa-user team1" aria-hidden="true"></i><i class="fa fa-user team1" aria-hidden="true"></i></div></div><div class="team clearfix"><div class="label"><span>Команда №2</span></div><div class="split-blocks"></div><div class="body"><i class="fa fa-user team2" aria-hidden="true"></i><i class="fa fa-user team2" aria-hidden="true"></i></div></div><div class="team clearfix"><div class="label"><span>Команда №3</span></div><div class="split-blocks"></div><div class="body"><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-user" aria-hidden="true"></i></div></div></div>'; $('#groups_onoffswitch').removeAttr('disabled'); }
		if ( charecters.groups == true ) { temp = temp + '<legend></legend><div class="groups"><div class="group clearfix"><div class="label"><span>Группа №1</span></div><div class="split-blocks"></div><div class="body"><i class="fa fa-user team2" aria-hidden="true"></i><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-user team1" aria-hidden="true"></i></div></div><div class="group clearfix"><div class="label"><span>Группа №2</span></div><div class="split-blocks"></div><div class="body"><i class="fa fa-user team1" aria-hidden="true"></i><i class="fa fa-user team2" aria-hidden="true"></i><i class="fa fa-user" aria-hidden="true"></i></div></div></div>'; }
		if (temp == '') { temp = 'Что-то нужно нарисовать или вставить картинку, чтобы было понятно, что нужно выбирать справа. <br>Ещё есть идея, нарисовать картинку: "К сожалению, Вы не выбрали ничего"'; }
		$('.characters_preview').append(temp);
	}

	show_whom_vote();

	$('.onoffswitch-label').click(function() {
		if ( $(this).parent().children('.onoffswitch-checkbox').attr('disabled') == 'disabled') {
			return false;
		} else {
			if ( $(this).hasClass('checked') ) {
				$(this).removeClass('checked');
			} else {
				$(this).addClass('checked');
			}
			show_whom_vote();
		}
	});

	$('.whom_vote').change(function(){
		if ( $('button',this).attr('type') != "submit" ) {
			$(this).append('<button type="submit" class="md-btn md-btn-md md-btn-success">Сохранить</button>');
		}
	});

});
