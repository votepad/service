var editor_judges, editor_participants, editor_groups, editor_teams, editor_participants_groups, editor_participants_teams, editor_groups_teams, editor_participants_groups_teams;

$().ready (function() {
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
			build_vote_charecters_ID($(this).parent().attr('id'));
		}
	});

	var vote_charecters_ID;
	function build_vote_charecters_ID(id){
		if (vote_charecters_ID == undefined) {
			vote_charecters_ID = id;
		}
		else{
			vote_charecters_ID = vote_charecters_ID + '_' + id
		}
	}

	$('table').each(function(){
		console.log($(this).attr('id').substr(6, this.length));

		if ($(this).attr('id').substr(6, this.length) != vote_charecters_ID && $(this).attr('id').substr(6, this.length) != 'judges') {
			$(this).parent().parent().remove();
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
				label: "Фотография",
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
				label: "Логотип",
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
				label: "Логотип",
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
	var table_groups = $('#table_teams').DataTable( {
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

	$('#table_judges_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_participants_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_groups_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
	$('#table_teams_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
});
