var array_participants = [
	// подгрузка аяксом изменения об участниках из БД
	{"part_name":"Федя Иванов", "part_about": ".."},
];

var charecters_partisipants_settings = {
	data: array_participants,
	minSpareRows: 1,
	rowHeaders: true,
	stretchH: "all",
	colWidths: [200,400],
	colHeaders: ["ФИО участника", "Описание участника"],
	columns: [
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