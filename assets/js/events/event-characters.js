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
		colWidths: [200,100,80,50,70],
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
				// отправка данных 
				console.log(JSON.stringify(changes));
			}
		},
	};

	var jusdes_hot = new Handsontable(document.getElementById('judges'), judges_settings);

	var create_charecters_partisipants = function() {};
	/*   WHOM VOTE   */
	var charecters = {'participants':true, 'groups':false, 'teams':false};
	var create_charecters_body = function(){
		var temp = '';
		if (charecters.teams == true) { temp = temp + '<div class="form-group" id="table_teams"></div>';  }
		if (charecters.groups == true) { temp = temp + '<div class="form-group" id="table_groups"></div>'; }
		if (charecters.participants == true) { temp = temp + '<div class="form-group" id="table_participants"></div>'; create_charecters_partisipants(); }
		$('#panel_p_g_t').append(temp);
	};
	create_charecters_body();
	$('.whom_vote').on('click', '.md-btn', function(){
		var id = $(this).closest('.col-xs-4').attr('id');
		if ( $(this).hasClass('checked') ) {
			if ( id == 'participants') { charecters.participants = false } else if ( id == 'groups') {charecters.groups = false} else {charecters.teams = false}
			$('input',this).attr('checked',false);
			$(this).removeClass('checked');
			console.log(charecters);
			$('#panel_p_g_t').empty();
		create_charecters_body();
			return false;
		} else{
			if ( id == 'participants') { charecters.participants = true } else if ( id == 'groups') {charecters.groups = true} else {charecters.teams = true}
			$('input',this).attr('checked',true);
			$(this).addClass('checked');
			console.log(charecters);
			$('#panel_p_g_t').empty();
			create_charecters_body();
			return false;
		}
	});


	/*  CHARECTERS  */
		
	create_charecters_partisipants = function() {
		var array_participants = [
			{'part_team': 'Команда 1', 'part_group':'Группа 1', 'part_name':'Федя Иванов'},
		];

		var charecters_settings = {
			data: array_participants,
			minSpareRows: 1,
			rowHeaders: true,
			stretchH: 'all',
			colWidths: [200,100,80,50,70],
			colHeaders: ['ФИО участника'],
			columns: [
				{ data:'part_name' },
			],
			afterChange: function (changes, source) {
				if (source !== 'loadData') {
					// отправка данных 
					console.log(JSON.stringify(changes));
				}
			},
		};
	
		var carecters_hot = new Handsontable(document.getElementById('table_participants'), charecters_settings);
	};
	create_charecters_partisipants();


/*var d = ['Kia', 'Nissan', 'Toyota', 'Honda'];

	var container = document.getElementById("example1"),
  hot1;

hot1 = new Handsontable(container, {
  data: [
    ['2008', 'Nissan', 11],
    ['2009', 'Honda', 11],
    ['2010', 'Kia', 15]
  ],
  colHeaders: true,
  contextMenu: false,
  columns: [
    {},
    {
      editor: 'select',
      selectOptions: d
    },
    {}
  ]
});

$('#222').click(function(){
	d.push("kek");
});*/
	/*
	$('.checking_p_g_t').click(function(){
		if( $(this).hasClass('select') ) {
			$(this).removeClass('select');
			return false;
		} else{
			$(this).addClass('select');
			return false;
		}
	});
	$('.checking_p_g_t').each(function(){
		if ($('input', this).attr('checked') == 'checked') {
			$(this).addClass('select');
			//build_vote_charecters_ID($(this).parent().attr('id'));
		}
	});

	editor_judges = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_judges",
		fields: [ {
				label: "ФИО жюри",
				name: "judge_name"
			}, {
				label: "E-mail:",
				name: "judge_email"
			}, {
				label: "Должность",
				name: "judge_position"
			}, {
				label: "Фотография",
				name: "judge_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать нового жюри",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информация о жюри",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить жюри",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d жюри?",
					1: "Вы уверены, что хотите удалить 1 жюри?"
				}
			}
		}
	});
	editor_participants = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_participants",
		fields: [ {
				label: "ФИО участника",
				name: "participant_name"
			}, {
				label: "Описание участника",
				name: "participant_desc",
				type: "textarea"
			}, {
				label: "Фотография участника ",
				name: "participant_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать нового участника",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информация об участнике",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить участника",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d участников?",
					1: "Вы уверены, что хотите удалить 1 участника?"
				}
			}
		}
	});
	editor_groups = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_groups",
		fields: [ {
				label: "Название группы",
				name: "group_name"
			}, {
				label: "Описание группы",
				name: "group_desc",
				type: "textarea"
			}, {
				label: "Логотип группы",
				name: "group_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать новую группу",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информацию о группе",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить группу",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d групп?",
					1: "Вы уверены, что хотите удалить 1 группу?"
				}
			}
		}
	});
	editor_teams = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_teams",
		fields: [ {
				label: "Название команды",
				name: "team_name"
			}, {
				label: "Описание команды",
				name: "team_desc",
				type: "textarea"
			}, {
				label: "Логотип команды",
				name: "team_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать новую команду",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информацию о команде",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить команду",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d команд?",
					1: "Вы уверены, что хотите удалить 1 команду?"
				}
			}
		}
	});
	editor_participants_groups = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_participants_groups",
		fields: [ {
				label: "ФИО участника",
				name: "participant_name"
			}, {
				label: "Группа",
				name: "participant_group",
				type: "select"
			}, {
				label: "Описание участника",
				name: "participant_desc",
				type: "textarea"
			}, {
				label: "Фотография участника",
				name: "participant_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать нового участника",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информацию об участнике",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить участника",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d участников?",
					1: "Вы уверены, что хотите удалить 1 участника?"
				}
			}
		}
	});
	editor_participants_teams = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_participants_teams",
		fields: [ {
				label: "ФИО участника",
				name: "participant_name"
			}, {
				label: "Команда",
				name: "participant_team",
				type: "select"
			}, {
				label: "Описание участника",
				name: "participant_desc",
				type: "textarea"
			}, {
				label: "Фотография участника",
				name: "participant_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать нового участника",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информацию об участнике",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить участника",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d участников?",
					1: "Вы уверены, что хотите удалить 1 участника?"
				}
			}
		}
	});
	editor_groups_teams = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#table_groups_teams",
		fields: [ {
				label: "Название группы",
				name: "group_name"
			}, {
				label: "Команда",
				name: "group_team",
				type: "select"
			}, {
				label: "Описание группы",
				name: "group_desc",
				type: "textarea"
			}, {
				label: "Логотип группы",
				name: "group_avatar",
				type: "upload",
				display: function ( file_id ) {
					return '<img class="" src="'+table.file( 'files', file_id ).web_path+'"/>';
				},
				clearText: "Clear",
				noImageText: 'Не выбрано'
			}
		],
		i18n: {
			create: {
				title:  "Создать новой группы",
				submit: "Создать"
			},
			edit: {
				title: "Изменить информацию о группе",
				submit: "Изменить"
			},
			remove: {
				title:  "Удалить группу",
				submit: "Удалить",
				confirm: {
					_: "Вы уверены, что хотите удалить %d групп?",
					1: "Вы уверены, что хотите удалить 1 группу?"
				}
			}
		}
	});

	var table_judges = $('#table_judges').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент жюри не создано",
			sInfo:"Всего _MAX_ жюри",
			sInfoEmpty:"Всего _MAX_ жюри",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, жюри не найдено, попробуйте изменить поиск или добавьте нового жюри."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "judge_name" },
			{ data: "judge_email" },
			{ data: "judge_position" },
			{
				data: "judge_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_judges.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Фотография жюри"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_judges, text:"Создать"},
			{ extend: "edit",   editor: editor_judges, text:"Редактировать"},
			{ extend: "remove", editor: editor_judges, text:"Удалить" },
		]
	});			
	var table_participants = $('#table_participants').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент участники не созданы",
			sInfo:"Всего _MAX_ участников",
			sInfoEmpty:"Всего _MAX_ участников",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, участники не найдены, попробуйте изменить поиск или добавьте нового участника."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "participant_name" },
			{ data: "participant_desc" },
			{
				data: "participant_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_participants.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Фотография участника"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_participants, text:"Создать"},
			{ extend: "edit",   editor: editor_participants, text:"Редактировать"},
			{ extend: "remove", editor: editor_participants, text:"Удалить" },
		]
	});
	var table_groups = $('#table_groups').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент группы не созданы",
			sInfo:"Всего _MAX_ групп",
			sInfoEmpty:"Всего _MAX_ групп",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, группы не найдены, попробуйте изменить поиск или добавьте новую группу."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "group_name" },
			{ data: "group_desc" },
			{
				data: "group_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_groups.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Логотип группы"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_groups, text:"Создать"},
			{ extend: "edit",   editor: editor_groups, text:"Редактировать"},
			{ extend: "remove", editor: editor_groups, text:"Удалить" },
		]
	});
	var table_teams = $('#table_teams').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент команды не созданы",
			sInfo:"Всего _MAX_ команд",
			sInfoEmpty:"Всего _MAX_ команд",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, команды не найдены, попробуйте изменить поиск или добавьте новую команду."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "team_name" },
			{ data: "team_desc" },
			{
				data: "team_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_groups.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Логотип команды"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_teams, text:"Создать"},
			{ extend: "edit",   editor: editor_teams, text:"Редактировать"},
			{ extend: "remove", editor: editor_teams, text:"Удалить" },
		]
	});
	var table_participants_groups = $('#table_participants_groups').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент участники не созданы",
			sInfo:"Всего _MAX_ участников",
			sInfoEmpty:"Всего _MAX_ участников",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, участники не найдены, попробуйте изменить поиск или добавьте нового участника."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "participant_name" },
			{ data: "participant_group" },
			{ data: "participant_desc" },
			{
				data: "participant_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_participants.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Фотография участника"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_participants_groups, text:"Создать"},
			{ extend: "edit",   editor: editor_participants_groups, text:"Редактировать"},
			{ extend: "remove", editor: editor_participants_groups, text:"Удалить" },
		]
	});
	var table_participants_teams = $('#table_participants_teams').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент участники не созданы",
			sInfo:"Всего _MAX_ участников",
			sInfoEmpty:"Всего _MAX_ участников",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, участники не найдены, попробуйте изменить поиск или добавьте нового участника."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "participant_name" },
			{ data: "participant_team" },
			{ data: "participant_desc" },
			{
				data: "participant_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_participants.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Фотография участника"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_participants_teams, text:"Создать"},
			{ extend: "edit",   editor: editor_participants_teams, text:"Редактировать"},
			{ extend: "remove", editor: editor_participants_teams, text:"Удалить" },
		]
	});
	var table_groups_teams = $('#table_groups_teams').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент группы не созданы",
			sInfo:"Всего _MAX_ групп",
			sInfoEmpty:"Всего _MAX_ групп",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, группы не найдены, попробуйте изменить поиск или добавьте новую группу."
		},
		columnDefs: [ 
			{ 'targets' : 'no-sort', 'orderable': false }
		],
		//ajax: "../php/upload.php",
		columns: [
			{ data: "group_name" },
			{ data: "group_team" },
			{ data: "group_desc" },
			{
				data: "group_avatar",
				render: function ( file_id ) {
					return file_id ?
						'<img src="'+table_participants.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
				title: "Логотип группы"
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor_groups_teams, text:"Создать"},
			{ extend: "edit",   editor: editor_groups_teams, text:"Редактировать"},
			{ extend: "remove", editor: editor_groups_teams, text:"Удалить" },
		]
	});


	$('#table_judges_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_participants_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_groups_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_teams_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_participants_groups_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_participants_teams_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_groups_teams_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');*/
});
