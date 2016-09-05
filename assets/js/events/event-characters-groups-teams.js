var array_groups = [
	// подгрузка аяксом изменения об группах из БД
	{"group_name": "Группа 1", "group_about":""},
	{"group_name": "Группа 2", "group_about":""},
];
// при каждом добавлении группы обновлять массив groups_name
var groups_name = new Array();
for (var i = 0; i < array_groups.length; i++){
	groups_name.push(array_groups[i].group_name)
}
var array_participants = [
	// подгрузка аяксом изменения об участниках из БД
	{"part_group":"Группа 1", "part_name":"Федя Иванов", "part_about": ".."},
];
var charecters_groups_settings = {
	data: array_groups,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [200,400],
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
	colWidths: [150, 200, 300],
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
