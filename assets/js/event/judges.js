window.onload = function() {

	/*
	 * Get array of judges from DB
	 */
	var array_judges = [
		{
			'judge_name': 'Иванов Иван Иванович',
			'judge_login':'sda',
			'judge_password':'1111111',
			'judge_send_mail':'true',
			'judge_email':'email1@ya.ru'
		},
	];

	var judges_settings = {
		data: array_judges,
		minSpareRows: 1,
		rowHeaders: true,
		headerTooltips: true,
		fillHandle: false,
		stretchH: 'all',
	    colWidths: [20,10,10,15,15],
		colHeaders: ['ФИО', 'Логин', 'Пароль', 'Приглашение по e-mail', 'E-mail'],
		columns: [
			{
				data:'judge_name',
				validator: function (value, callback) {
					if ( (value.split(/[\s\.\?]+/).length >= 2) && ! (/[^A-Za-z0-9А-Яа-я ]/.test(value)) ) {
						callback(true);
					} else {
						callback(false);
					}
				}
			},
			{
				data:'judge_login',
				validator: function (value, callback) {
					if ( /[^A-Za-z0-9]/.test(value) ) {
						 callback(false);
					} else {
						callback(true);
					}
				}
			},
			{
				data:'judge_password',
				type: 'password',
				editor: false,
				hashLength: 10
			},
			{
				data:'judge_send_mail',
				type: 'checkbox',
				className: 'htCenter'
			},
			{
				data:'judge_email',
				allowInvalid: true,
				validator: function (value, callback) {
					if ( (/.+@.+/.test(value)) && !(/[^A-Za-z0-9@._-]/.test(value)) ) {
						callback(true);
					} else {
						callback(false);
					}
				},
			},
		],
		afterChange: function (changes, source) {
			if (source !== 'loadData') {
				// отправка данных о жюри
				console.log(JSON.stringify(changes));
			}
		},
	};

	var hot = new Handsontable(document.getElementById('judges'), judges_settings);

	/*
	 *  Create title for headers
	 */

	$('body').on('mouseenter', '.relative', function(){
		$(this).attr('title', $(this).children('.colHeader').text());
	});



}
