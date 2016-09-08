$('.columns-area').append('<div class="panel panel-default"><div class="panel-heading">Команды</div><div class="panel-body"><div id="table_teams"></div></div></div>')

/*   ARRAYS   */

var array_teams = [
	// подгрузка аяксом изменения об командах из БД
	{"team_name": "team 1", "team_about":"11"},
	{"team_name": "team 2", "team_about":"22"},
];

/*   SETTINGS   */

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

$("#table_teams").handsontable(charecters_teams_settings);
