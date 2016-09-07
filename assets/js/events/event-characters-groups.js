var array_groups = [
	// подгрузка аяксом изменения об группах из БД
	{"group_name": "Группа 1", "group_about":""},
	{"group_name": "Группа 2", "group_about":""},
];

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

$("#table_groups").handsontable(charecters_groups_settings);
