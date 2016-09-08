$('.columns-area').append('<div class="panel panel-default"><div class="panel-heading">Команды</div><div class="panel-body"><div id="table_teams"></div></div></div><div class="panel panel-default"><div class="panel-heading">Участники</div><div class="panel-body"><div id="table_participants"></div></div></div>')

/*  ARRAYS   */

var array_teams = [
	// подгрузка аяксом изменения об командах из БД
	{"team_name": "team 1", "team_about":"11"},
	{"team_name": "team 2", "team_about":"22"},
];
var array_participants = [
	// подгрузка аяксом изменения об участниках из БД
	{"part_team":"team 1", "part_name":"Федя Иванов", "part_about": ".."},
];

/*  GET NAME FOR SELECT  */

// при каждом добавлении группы обновлять массив teams_name
var teams_name = new Array();
for (var i = 0; i < array_teams.length; i++){
	teams_name.push(array_teams[i].team_name)
}

/*  SETTINGS  */

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
	colWidths: [188, 200, 300],
	colHeaders: ["Название команды", "ФИО участника", "Описание участника"],
	columns: [
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
