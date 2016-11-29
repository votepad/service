$(document).ready(function() {

    /*
     *  Vars
    */
    var
        url = "http://pronwe/assets/img/user",
        edit = document.getElementById('edit'),
        save = document.getElementById('save'),
        table = document.getElementById('participants'),
        partisipants_settings,
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
            data:'part_avatar',
            readOnly: true,
            className: 'htCenter',
            renderer: imageRenderer
        },
        {
            data:'part_name',
            readOnly: true,
        },
        {
            data:'part_description',
            readOnly: true,
        },
        {
            data:'part_email',
            readOnly: true,
        },
        {
            data:'part_sendresult',
            type: 'checkbox',
            className: 'htCenter',
            readOnly: true,
        },
    ];


    column_edited = [
        {
            data:'part_avatar',
            editor: false,
            renderer:imageRenderer
        },
        {
            data:'part_name',
            readOnly: false,
            validator: function (value, callback) {
                if ( /[^A-Za-z0-9А-Яа-я ]/.test(value) || value == "" ) {
                    callback(false);
                } else {
                    callback(true);
                }
            }
        },
        {
            data:'part_description',
            readOnly: false,
            validator: function (value, callback) {
                if ( /[^A-Za-z0-9А-Яа-я#№!.,:;-_ ]/.test(value) ) {
                    callback(false);
                } else {
                    callback(true);
                }
            }
        },
        {
            data: 'part_email',
            validator: function (value, callback) {
                if (/.+@.+/.test(value) || value == null || value == '') {
                    callback(true);
                }
                else {
                    callback(false);
                }
            }
        },
        {
            data: 'part_sendresult',
            type: 'checkbox',
            className: 'htCenter',
        }
    ];



    /*
     * Get array of participants from DB
    */
     var array_participants = [
         {
             "part_avatar": "",
             "part_name":"выв",
             "part_description": "",
             "part_email": "example@ya.ru",
             "part_sendresult": true
         },
     ];


     /*
      *  Handsontable settings
     */
     partisipants_settings = {
         data: array_participants,
		 rowHeaders: true,
		 fillHandle: false,
         rowHeights: 72,
		 colHeaders: ['Фото', 'Фамилия Имя', 'Об участнике', 'E-mail', '<i class="icon-rating"></i> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <i class="fa fa-envelope-o" aria-hidden="true"></i>'],
         columns: column_disabled,
     };


    /*
     *  Create Handsontable
    */
    hot = new Handsontable(table, partisipants_settings);



    /*
	 *  Create title for column's headers
	*/

    $('body').on('mouseenter', '.relative', function(){
        $(this).attr('title', $(this).children('.colHeader').text());
        if ($(this).attr('title') == "  ") {
            $(this).attr('title', 'Отправить резултаты на e-mail');
        }
	});



    /*
     *  Edit participants
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
     *  Checking on empty FIO cell
    */
    hot.addHook('afterValidate', function(isValid, value, row, prop, source){
        if ( prop != 'part_name' && hot.getDataAtCell(row, 1) === null ) {
            hot.setDataAtCell(row, 1, "");
        }
    });


    /*
     *  Save participants
    */
    Handsontable.Dom.addEvent(save, 'click', function(el) {

        hot.validateCells(function(valid){

            if ( valid == true ) {

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
                array_participants = [];

                $.each(hot.getData(), function(rowKey, object) {
                    if (!hot.isEmptyRow(rowKey)) array_participants[rowKey] = object;
                });

                console.log(JSON.stringify(array_participants));

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
            if (hot.isEmptyRow(i)) {
                hot.alter('remove_row', i);
            }
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
                 colWidths: [80,200,200,200,80]
             });

             document.getElementById('participants').style.overflowX = "auto";
             document.getElementById('participants').style.height = "inherit";

         } else {

             hot.updateSettings({
                 stretchH: 'all',
                 colWidths: function(index){
                     var width = parseInt(document.body.clientWidth);

                     // desctop width for columns
                     // 0.7  (section.width = 70%)
                     // 220  (60 - width of first column, 80 - width of second and last columns)
                     if (width > 992)
                         width = width * 0.7 - 210;

                     // tablet width for columns
                     else if (width <= 992 && width > 680)
                        width = width - 210;

                     if (index == 0)
                         return 80;

                     if (index == 1)
                         return width * 0.3;

                     if (index == 2)
                         return width * 0.4;

                     if (index == 3)
                         return width * 0.3;

                     if (index == 4)
                         return 80;

                 }
             });
         }
     }


    /*
     *  Settings for image renderer
    */

    function imageRenderer (instance, td, row, col, prop, value, cellProperties) {

        var img = document.createElement('IMG');

        Handsontable.Dom.empty(td);

        img.className = "table-photo-logo";

        if (value != null && value != "")
            img.src = url + value;
        else
            img.src = url + "/no-user.png";

        td.appendChild(img);


       /*
        *   Change Image  -  update with ajax
        */
        Handsontable.Dom.addEvent(img, 'click', function (e){
            console.log(col+ " " +row +" change image" );
        });

        return td;
    }

});
