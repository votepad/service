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
        hot;

    /*
     *  Columns Settings
     *
     *  column_disabled - when users are not allowed to edit cells in table
     *  column_edited - when users can edit cells in table
    */

    column_disabled = [
        {
			data:'name',
            readOnly: true,
        },
        {
            data:'login',
            readOnly: true,
        },
        {
            data:'password',
            readOnly: true,
        },
    ];


    column_edited = [
        {
			data:'name',
            readOnly: false,
            validator: function (value, callback) {
                if ( /[^A-Za-z0-9А-Яа-я ]/.test(value) || value == "") {
					callback(false);
                } else {
					callback(true);
                }
            },
        },
        {
			data:'login',
			editor: false,
        },
		{
			data:'password',
            type: 'password',
			editor: false,
		}
    ];


    /*
     * get_array_judges - array of judges from DB
     * array_judges - equal to get_array_judges on load data from DB
     * handsontable worhing only with array_judges
     *
     * status = none | insert | update
    */
     var get_array_judges = [
		 {
			 "name": "Иванов Иван Иванович",
			 "login": "ifmo-mister-1",
			 "password": "dff6asdl7",
             "status": "none"
		 },
	 ];

     var array_judges = [
         {
			 "name": "Иванов Иван Иванович",
			 "login": "ifmo-mister-1",
			 "password": "dff6asdl7",
             "status": "none"
		 },
	 ];


     /*
      *  Handsontable settings
     */
     judges_settings = {
         data: array_judges,
		 rowHeaders: true,
		 fillHandle: false,
		 colHeaders: ['Фамилия Имя Отчество', 'Логин', 'Пароль'],
         columns: column_disabled,
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

        checking_on_empty_table('edit');

        hot.updateSettings({
            minSpareRows: 1,
            columns: column_edited
        });

    });


    /*
     *  Save judges
    */
    Handsontable.Dom.addEvent(save, 'click', function(el) {

        hot.validateCells(function(valid) {

            if ( valid == true) {

                edit.className = "pull-right displayblock";
                save.className = "displaynone";

                var is_empty_table = checking_on_empty_table('save');

                hot.updateSettings({
                    minSpareRows: 0,
                    columns: column_disabled
                });


                /* delete last row if it's empty  */
                if (hot.isEmptyRow(hot.countRows() - 1) && hot.countRows() != 1) {
                    hot.alter('remove_row', hot.countRows() - 1);
                }

                /*
                 *  Update Data via Ajax
                */
                if ( ! is_empty_table ) {

                    for (var i = 0; i < array_judges.length; i++) {

                        if ( i >= get_array_judges.length ) {
                            array_judges[i].status = "insert";
                        } else if ( get_array_judges[i].name != array_judges[i].name ) {
                            array_judges[i].status = "update";
                        } else {
                            array_judges[i].status = "none";
                        }

                    }

                    console.log(JSON.stringify(array_judges));
                }

            } else {

                $.notify({
                	message: 'Пожалуйста, проверьте правильность введенных данных.'
                },{
                	type: 'danger'
                });

            }

        });

    });


    /*
     *   Remove empty rows while editing
    */
     hot.addHook('afterChange', function() {

         for (var i = 0; i < hot.countRows(); i++) {
             if ( hot.isEmptyRow(i) ) {
                 hot.alter('remove_row', i);
             }
         }

     });


     /*
      * Checking Table on existing one empty row
      * if empty row - hide table -> open info
      * if exist row - open table -> hide info
     */
     function checking_on_empty_table(action) {
         if (hot.isEmptyRow(0) && action == "save" ) {
             $('#judges').css('display', 'none');
             $('#table_wrapper').append('<div id="no_judges" class="text-center"><h4>Представитили жюри ещё не созданы, для создания списка жюри нажмите на иконку <i class="fa fa-edit" aria-hidden="true"></i></h4></div>');
             return true;
         } else {
             $('#judges').css('display', 'block');
             $('#no_judges').remove();
             return false;
         }
     }



     /*
      *  After Validate Add Login And Password
     */
     hot.addHook('afterValidate', function(isValid, value, row, prop, source) {

         if (isValid && value != null) {

             hot.setDataAtCell(row, 1, orgpage + '-' + eventpage + '-' + parseInt(row + 1));
             hot.setDataAtCell(row, 2, 'generated');

         } else {

             hot.setDataAtCell(row, 1, '');
             hot.setDataAtCell(row, 2, '');

         }

     });


     /*
      *  Calculate columns size on resize window
     */
     Handsontable.Dom.addEvent(window, 'resize', calculateSize);


     /*
      *  Calculate columns size on page loading
     */
     calculateSize();


     /*
      *  Calculate columns size for table
      *  versions: mobile (<680px),  table(<992px) and  desctop (>992px)
     */
     function calculateSize() {

         // mobile settings
         if (window.innerWidth <= 680) {
             hot.updateSettings({
                 stretchH: 'none',
                 colWidths: [250,180,130]
             });

             document.getElementById('judges').style.overflowX = "auto";
             document.getElementById('judges').style.height = "inherit";

         } else {

             hot.updateSettings({
                 stretchH: 'all',
                 colWidths: function(index) {
                     var width = parseInt(document.body.clientWidth);

                     // desctop width for columns
                     // 0.7  (section.width = 70%)
                     // 60 - width of first column
                     if (width > 992)
                         width = width * 0.8 - 50;

                     // tablet width for columns
                     else if (width <= 992 && width > 680)
                        width = width * 0.9 - 50;

                     if (index == 0)
                         return width * 0.5;

                     if (index == 1)
                         return width * 0.25;

                     if (index == 2)
                         return width * 0.25;

                 }
             });
         }
     }

});
