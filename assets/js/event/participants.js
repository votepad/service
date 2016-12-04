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
            data:'avatar',
            readOnly: true,
            className: 'htCenter',
            renderer: imageRenderer
        },
        {
            data:'name',
            readOnly: true,
        },
        {
            data:'description',
            readOnly: true,
        },
        {
            data:'email',
            readOnly: true,
        },
        {
            data:'sendresult',
            type: 'checkbox',
            className: 'htCenter',
            readOnly: true,
        },
    ];


    column_edited = [
        {
            data:'avatar',
            editor: false,
            renderer:imageRenderer
        },
        {
            data:'name',
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
            data:'description',
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
            data: 'email',
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
            data: 'sendresult',
            type: 'checkbox',
            className: 'htCenter',
        }
    ];



    /*
     * get_array_participants - array of participants from DB
     * array_participants - equal to get_array_participants on load data from DB
     * handsontable worhing only with array_participants
     *
     * status = none | insert | update
    */
     var get_array_participants = [
         {
             "avatar": "",
             "name":"выв",
             "description": "",
             "email": "example@ya.ru",
             "sendresult": true,
             "status": "none"
         },
     ];
     var array_participants = [
         {
             "avatar": "",
             "name":"выв",
             "description": "",
             "email": "example@ya.ru",
             "sendresult": true,
             "status": "none"
         },
     ];;



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

        checking_on_empty_table('edit');

        hot.updateSettings({
            minSpareRows: 1,
            columns: column_edited
        });

    });



    /*
     *  Checking on empty FIO cell
    */
    hot.addHook('afterValidate', function(isValid, value, row, prop, source){
        if ( prop != 'name' && hot.getDataAtCell(row, 1) === null ) {
            hot.setDataAtCell(row, 1, "");
            return;
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

                var is_empty_table = checking_on_empty_table('save');

                hot.updateSettings({
                    minSpareRows: 0,
                    columns: column_disabled
                });


                /* delete last row if it's empty */
                if (hot.isEmptyRow(hot.countRows() - 1) && hot.countRows() != 1) {
                    hot.alter('remove_row', hot.countRows() - 1);
                }

                /*
                 *  Update Data via Ajax
                */
                if ( ! is_empty_table ) {

                    for (var i = 0; i < array_participants.length; i++) {

                        if ( i >= get_array_participants.length ) {
                            array_participants[i].status = "insert";
                        } else if ( get_array_participants[i].avatar != array_participants[i].avatar ||
                                    get_array_participants[i].name != array_participants[i].name ||
                                    get_array_participants[i].description != array_participants[i].description ||
                                    get_array_participants[i].email != array_participants[i].email ||
                                    get_array_participants[i].sendresult != array_participants[i].sendresult )
                        {
                            array_participants[i].status = "update";
                        } else {
                            array_participants[i].status = "none";
                        }

                    }

                    var dataToSave = JSON.stringify(array_participants),
                        idEvent = 15;

                    /**
                     * Reloads page after success callback
                     */
                    $.ajax({
                        url : '/participants/add/' + idEvent,
                        type: "POST",
                        data: {
                            list: dataToSave
                        },
                        success: function(response) {
                            if (response == 'false') {
                                window.location.reload();
                            }
                        },
                        error: function(response) {
                            console.log("Something wrong");
                        },
                        sendBefore: function() {
                            /** Do some action */
                        }
                    })
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
    hot.addHook('afterChange', function(changes, source) {

        for (var i = 0; i < hot.countRows(); i++) {
            if ( hot.isEmptyRow(i) ||
                (hot.getDataAtCell(i, 1) == "" && hot.getDataAtCell(i, 2) == "" &&  hot.getDataAtCell(i, 3) == "" && hot.getDataAtCell(i, 4) != null) ||
                (hot.getDataAtCell(i, 0) == null && hot.getDataAtCell(i, 1) == null && hot.getDataAtCell(i, 2) == null && hot.getDataAtCell(i, 3) == null && hot.getDataAtCell(i, 4) != null ) )
            {
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
            $('#participants').css('display', 'none');
            $('#table_wrapper').append('<div id="no_participants" class="text-center"><h4>Участники ещё не созданы, для создания списка участников нажмите на иконку <i class="fa fa-edit" aria-hidden="true"></i></h4></div>');
            return true;
        } else {
            $('#participants').css('display', 'block');
            $('#no_participants').remove();
            return false;
        }
    }


    /*
     *   Call function on running page
    */
    checking_on_empty_table('save');



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
