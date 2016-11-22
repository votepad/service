$(document).ready(function() {


    /*
     *  Vars
    */
    var
        //url = "http://pronwe/assets/",
        orgpage = window.location.pathname.split("/")[1],
        eventpage = window.location.pathname.split("/")[2],
        edit = document.getElementById('edit'),
        save = document.getElementById('save'),
        table = document.getElementById('judges'),
        judges_settings,
        column_disabled,
        column_edited,
        hot,
        data_valid = true;

    /*
     *  Columns Settings
     *
     *  column_disabled - when users are not allowed to edit cells in table
     *  column_edited - when users can edit cells in table
    */

    column_disabled = [
        {
			data:'judge_name',
            readOnly: true,
        },
        {
            data:'judge_login',
            readOnly: true,
        },
        {
            data:'judge_password',
            readOnly: true,
        },
    ];


    column_edited = [
        {
			data:'judge_name',
            readOnly: false,
            validator: function (value, callback) {
                if ( /[^A-Za-z0-9А-Яа-я ]/.test(value) || value == "") {
					data_valid = false;
					callback(false);
                } else {
					data_valid = true;
					callback(true);
                }
            },
        },
        {
			data:'judge_login',
			editor: false,
        },
		{
			data:'judge_password',
            type: 'password',
			editor: false,
		}
    ];


    /*
     * Get array of judges from DB
    */
     var array_judges = [
		 {
			 'judge_name': 'Иванов Иван Иванович',
			 'judge_login':'ifmo-mister-1',
			 'judge_password':'password10',
		 },
	 ];


     /*
      *  Handsontable settings
     */
     judges_settings = {
         data: array_judges,
		 rowHeaders: true,
		 fillHandle: false,
		 stretchH: 'all',
		 colHeaders: ['Фамилия Имя Отчество', 'Логин', 'Пароль'],
         columns: column_disabled,
         colWidths: function(index){
             var width = parseInt(document.body.clientWidth);

             if (width > 992)
                 width = width * 0.7 - 50;

             else if (width < 992)
                width = width * 0.9 - 60;


             if (index == 0)
                 return width * 0.5;

             if (index == 1)
                 return width * 0.25;

             if (index == 2)
                 return width * 0.25;

         }
     };


    /*
     *  Create Handsontable
    */
    hot = new Handsontable(table, judges_settings);



    /*
	 *  Create title for column's headers
	*/

    $('body').on('mouseenter', '.relative', function(){
        $(this).attr('title', $(this).children('.colHeader').text());
	});



    /*
     *  Edit judges
    */

    Handsontable.Dom.addEvent(edit, 'click', function() {

        save.className = "pull-right displayblock";
        edit.className = "displaynone";

        hot.updateSettings({
            minSpareRows: 1,
            columns: column_edited
        });
    });



    /*
     *  Save judges
     */

    Handsontable.Dom.addEvent(save, 'click', function(el) {

        if ( data_valid == true ) {

            edit.className = "pull-right displayblock";
            save.className = "displaynone";


            hot.updateSettings({
                minSpareRows: 0,
                columns: column_disabled
            });


            /* delete last row if it's empty  */
            /* if it's empty => show no user */
            if (hot.isEmptyRow(hot.countRows() - 1) && hot.countRows() != 1) {
                hot.alter('remove_row', hot.countRows() - 1);
            }

            /*
             *  Data for Ajax updating
            */
            array_judges = [];

            $.each(hot.getData(), function(rowKey, object) {
                if (!hot.isEmptyRow(rowKey)) array_judges[rowKey] = object;
            });

            console.log(JSON.stringify(array_judges));

        } else {

            $.notify({
            	message: 'Пожалуйста, проверьте правильность введенных данных.'
            },{
            	type: 'danger'
            });

        }

    });


    /*
     *   Remove empty rows while editing
     */
     hot.addHook('afterChange', function() {

         for (var i = 0; i < hot.countRows(); i++) {
             if (hot.isEmptyRow(i)) {
                 hot.alter('remove_row', i);
             }
         }

     });


     /*
      *  After Validate Add Login And Password
     */
     hot.addHook('afterValidate', function(isValid, value, row, prop, source) {

         if (isValid) {

             hot.setDataAtCell(row, 1, orgpage + '-' + eventpage + '-' + parseInt(row + 1));
             hot.setDataAtCell(row, 2, '**********');
         } else {
             hot.setDataAtCell(row, 1, '');
             hot.setDataAtCell(row, 2, '');

         }
     });

});
