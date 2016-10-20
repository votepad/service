$('.columns-area').append('<div class="panel panel-default"><div class="panel-heading">Группы</div><div class="panel-body"><div id="table_groups"></div></div></div><div class="panel panel-default"><div class="panel-heading">Участники</div><div class="panel-body"><div id="table_participants"></div></div></div>')

/*  ARRAYS  */

var array_groups = [
	// подгрузка аяксом изменения об группах из БД
	{"group_name": "Группа 1", "group_about":""},
	{"group_name": "Группа 2", "group_about":""},
];
var array_participants = [
	// подгрузка аяксом изменения об участниках из БД
	{"part_group":"Группа 1", "part_name":"Федя Иванов", "part_about": ".."},
];

/*  GET NAME FOR SELECT  */

// при каждом добавлении группы обновлять массив groups_name
var groups_name = new Array();
for (var i = 0; i < array_groups.length; i++){
	groups_name.push(array_groups[i].group_name)
}

/*  SETTINGS  */

var charecters_groups_settings = {
	data: array_groups,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [288,400],
	colHeaders: ["Название группы", "Описание группы"],
	columns: [
		{ data:"group_name" },
		{ data:"group_about" },
	],
	afterChange: function (changes, source) {
		if (source !== "loadData") {
			// отправка аяксом изменения об группах
			console.log(JSON.stringify(changes));
		}
	},
};
var charecters_partisipants_settings = {
	data: array_participants,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [188, 200, 300],
	colHeaders: ["Название группы", "ФИО участника", "Описание участника"],
	columns: [
		{ data:"part_group", editor: 'select', selectOptions: groups_name },
		{ data:"part_name" },
		{ data:"part_about" },
	],
	afterChange: function (changes, source) {
		if (source !== "loadData") {
			// отправка аяксом изменения об участниках
			console.log(JSON.stringify(changes));
		}
	},
};

$("#table_participants").handsontable(charecters_partisipants_settings);
$("#table_groups").handsontable(charecters_groups_settings);
