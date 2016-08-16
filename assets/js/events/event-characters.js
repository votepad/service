var editor; // use a global for the submit and return data rendering in the examples

$().ready (function() {
	editor = new $.fn.dataTable.Editor( {
		//ajax: "../php/upload.php",
		table: "#judges",
		fields: [ {
				label: "ФИО",
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
		]
	} );

	var table = $('#judges').DataTable( {
		dom: 'Bfrtip',
		paging: false,
		scrollY: '50vh',
		scrollCollapse: true,
		searching: true,
		fixedHeader: true,
		oLanguage:{
			sEmptyTable:"На данный момент жюри не создано",
			sInfo:"",
			sInfoEmpty:"",
			sInfoFiltered:"",
			sLengthMenu:"",
			sLoadingRecords:"Загружается...",
			sProcessing:"Обрабатывается...",
			sSearch:"Введите для поиска:",
			sZeroRecords:"К сожалению, жюри не найдено, попробуйте изменить поиск или добавьте его"
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
						'<img src="'+table.file( 'files', file_id ).web_path+'"/>' :
						null;
				},
				defaultContent: "Не выбрано",
			}
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor },
			{ extend: "edit",   editor: editor },
			{ extend: "remove", editor: editor }
		]
	});
	$('#judges_wrapper .row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-xs-6');
});
