$('.columns-area').append('<div class="panel panel-default"><div class="panel-heading">Группы</div><div class="panel-body"><div id="table_groups"></div></div></div><div class="panel panel-default"><div class="panel-heading">Команды</div><div class="panel-body"><div id="table_teams"></div></div></div>')

/*   ARRAYS   */

var array_groups = [
	// подгрузка аяксом изменения об группах из БД
	{"group_name": "Группа 1", "group_about":""},
	{"group_name": "Группа 2", "group_about":""},
];
var array_teams = [
	// подгрузка аяксом изменения об участниках из БД
	{"team_group":"Группа 1", "team_name":"team 1", "team_about": ".."},
];

/*  GET NAME FOR SELECT  */

// при каждом добавлении группы обновлять массив groups_name
var groups_name = new Array();
for (var i = 0; i < array_groups.length; i++){
	groups_name.push(array_groups[i].group_name)
}

/*   SETTINGS   */

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
var charecters_taems_settings = {
	data: array_teams,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [188, 200, 300],
	colHeaders: ["Название группы", "Название команды", "Описание команды"],
	columns: [
		{ data:"team_group", editor: 'select', selectOptions: groups_name },
		{ data:"team_name" },
		{ data:"team_about" },
	],
	afterChange: function (changes, source) {
		if (source !== "loadData") {
			// отправка аяксом изменения об участниках
			console.log(JSON.stringify(changes));
		}
	},
};

$("#table_teams").handsontable(charecters_taems_settings);
$("#table_groups").handsontable(charecters_groups_settings);
