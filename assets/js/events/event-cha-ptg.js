$('.columns-area').append('<div class="panel panel-default"><div class="panel-heading">Группы</div><div class="panel-body"><div id="table_groups"></div></div></div><div class="panel panel-default"><div class="panel-heading">Команды</div><div class="panel-body"><div id="table_teams"></div></div></div><div class="panel panel-default"><div class="panel-heading">Участники</div><div class="panel-body"><div id="table_participants"></div></div></div>')

/*  ARRAYS  */

var array_groups = [
	// подгрузка аяксом изменения об группах из БД
	{"group_name": "Группа 1", "group_about":""},
	{"group_name": "Группа 2", "group_about":""},
];
var array_teams = [
	// подгрузка аяксом изменения об командах из БД
	{"team_name": "team 1", "team_about":"11"},
	{"team_name": "team 2", "team_about":"22"},
];
var array_participants = [
	// подгрузка аяксом изменения об участниках из БД
	{"part_group":"Группа 1", "part_team":"team 1", "part_name":"Федя Иванов", "part_about": ".."},
];

/*  GET NAME FOR SELECT  */

// при каждом добавлении группы обновлять массив groups_name
var groups_name = new Array();
for (var i = 0; i < array_groups.length; i++){
	groups_name.push(array_groups[i].group_name)
}
// при каждом добавлении группы обновлять массив teams_name
var teams_name = new Array();
for (var i = 0; i < array_teams.length; i++){
	teams_name.push(array_teams[i].team_name)
}

/*  SETTINGS   */

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
var charecters_teams_settings = {
	data: array_teams,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [288,400],
	colHeaders: ["Название команды", "Описание команды"],
	columns: [
		{ data:"team_name" },
		{ data:"team_about" },
	],
	afterChange: function (changes, source) {
		if (source !== "loadData") {
			// отправка аяксом изменения об командах
			console.log(JSON.stringify(changes));
		}
	},
};
var charecters_partisipants_settings = {
	data: array_participants,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [100, 100, 188, 300],
	colHeaders: ["Название группы", "Название команды", "ФИО участника", "Описание участника"],
	columns: [
		{ data:"part_group", editor: 'select', selectOptions: groups_name },
		{ data:"part_team", editor: 'select', selectOptions: teams_name },
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
$("#table_teams").handsontable(charecters_teams_settings);
$("#table_groups").handsontable(charecters_groups_settings);
