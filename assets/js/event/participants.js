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
                if ( /[^A-Za-z0-9А-Яа-я ]/.test(value) || value == "") {
                    data_valid = false;
                    callback(false);
                } else {
                    data_valid = true;
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
    ];



    /*
     * Get array of participants from DB
    */
     var array_participants = [
         {
             "part_avatar": "",
             "part_name":"выв",
             "part_description": ""
         },
         {
             "part_avatar": "",
             "part_name":"выв",
             "part_description": ""
         },
     ];


     /*
      *  Handsontable settings
     */
     partisipants_settings = {
         data: array_participants,
		 rowHeaders: true,
		 fillHandle: false,
		 stretchH: 'all',
		 colHeaders: ['Фото', 'Фамилия Имя', 'Об участнике'],
         columns: column_disabled,
         colWidths: function(index){
             var width = parseInt(document.body.clientWidth);

             if (width > 992)
                 width = width * 0.7 - 50;

             else if (width < 992)
                width = width * 0.9 - 60;


             if (index == 0)
                 return width * 0.2;

             if (index == 1)
                 return width * 0.3;

             if (index == 2)
                 return width * 0.5;

         }
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
     *  Save participants
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
