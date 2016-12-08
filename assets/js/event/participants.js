$(document).ready(function() {

    /*
     *  Vars
     */
    var
        url = "http://pronwe/assets/img/user",
        edit = document.getElementById('edit'),
        save = document.getElementById('save'),
        table = document.getElementById('participants'),
        idEvent = 15,
        get_array = [],
        hot_array = [],
        output_array = [],
        deleted_elements = [],
        dataToSave,
        hot_settings,
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
            data:'photo',
            readOnly: true,
            className: 'htCenter',
            renderer: imageRenderer
        },
        {
            data:'name',
            readOnly: true,
        },
        {
            data:'about',
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
            data:'photo',
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
            data:'about',
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
     * Get data from DB
    */
    $.when(

        $.ajax({
            url : '/participants/get/' + idEvent,
            type: "POST",
            success: function(data, response) {
                hot_array = JSON.parse(data);
                get_array = JSON.parse(data);
                hot.loadData(hot_array);
            },
            error: function(response) {
                console.log("Something wrong");
            },
        })

    ).then(function(){

        document.getElementById('preloader').remove();
        checking_on_empty_table('save');
        calculateSize();

    });




     /*
      *  Handsontable settings
     */
     hot_settings = {
         data: hot_array,
		 rowHeaders: true,
		 fillHandle: false,
         rowHeights: 72,
		 colHeaders: ['Фото', 'Фамилия Имя', 'Об участнике', 'E-mail', '<i class="icon-rating"></i> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <i class="fa fa-envelope-o" aria-hidden="true"></i>'],
         columns: column_disabled,
     };


    /*
     *  Create Handsontable
    */
    hot = new Handsontable(table, hot_settings);



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
        }
        return;
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


                // delete last row if it's empty
                if (hot.isEmptyRow(hot.countRows() - 1) && hot.countRows() != 1) {
                    hot.alter('remove_row', hot.countRows() - 1);
                }

                /*
                 *  Update Data via Ajax
                */
                if ( ! checking_on_empty_table('save') ) {

                    for (var i = 0; i < get_array.length; i++) {

                        // add to output_array only deleted element from get_array
                        if ( $.inArray(get_array[i]['id'], deleted_elements) != -1 ) {
                            get_array[i]['status'] = "delete";
                            output_array.push(get_array[i]);
                        }

                        else {

                            for (var j = 0; j < hot_array.length; j++) {

                                // add to output_array only inserted only new element
                                if ( hot_array[j]['id'] == null ) {
                                    if ( ! find_output_el (hot_array[j]) ) {
                                        hot_array[j]['status'] = "insert";
                                        output_array.push(hot_array[j]);
                                    }
                                }

                                // add to output_array only edited element from get_array
                                else if ( get_array[i]['id'] == hot_array[j]['id']  ) {
                                    if ( ! is_similar (get_array[i], hot_array[j]) ) {
                                        hot_array[j]['status'] = "update";
                                        output_array.push(hot_array[j]);
                                    }
                                }

                            }

                        }

                    }

                    dataToSave = JSON.stringify(output_array);


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
                            // Do some action
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



    hot.addHook('afterChange', function(changes, source) {

        for (var i = 0; i < hot.countRows(); i++) {

            if ( hot.isEmptyRow(i) ||
                (hot.getDataAtCell(i, 1) == "" && hot.getDataAtCell(i, 2) == "" &&  hot.getDataAtCell(i, 3) == "" && hot.getDataAtCell(i, 4) != null) ||
                (hot.getDataAtCell(i, 0) == null && hot.getDataAtCell(i, 1) == null && hot.getDataAtCell(i, 2) == null && hot.getDataAtCell(i, 3) == null && hot.getDataAtCell(i, 4) != null ) )
            {
                // add id of deleted element
                if ( hot_array[i]['id'] != null ) {
                    deleted_elements.push(hot_array[i]['id']);
                }
                hot.alter('remove_row', i);
            }
        }
        return;
    });





    /*
     *  Find element in output_array
     *  in   @element
     *  return true || false
    */
    function find_output_el(element) {

        for (var i = 0; i < output_array.length; i++) {
            if (output_array[i]['status'] == "insert") {
                if (element['name'] == output_array[i]['name'] && element['photo'] == output_array[i]['photo'] &&
                    element['about'] == output_array[i]['about'] && element['email'] == output_array[i]['email'] &&
                    element['sendresult'] == output_array[i]['sendresult'])
                {
                    return true;
                }
            }
        }

        return false;

    }



    /*
     *  Compare two arrays
     *  in   @array1, @array2
     *  return true || false
    */
    function is_similar (array1, array2) {

        if (array1['name'] == array2['name'] && array1['photo'] == array2['photo'] &&
            array1['about'] == array2['about'] && array1['email'] == array2['email'] &&
            array1['sendresult'] == array2['sendresult'])
        {
            return true;
        }

        return false;

    }



    /*
     * Checking Table on existing one empty row
     * if empty row - hide table -> open info
     * if exist row - open table -> hide info
    */
    function checking_on_empty_table(action) {
        if (hot.isEmptyRow(0) && action == "save" ) {
            $('#participants').removeClass('displayblock').addClass('displaynone');
            $('#table_wrapper').append('<div id="no_participants" class="text-center"><h4>Участники ещё не созданы, для создания списка участников нажмите на иконку <i class="fa fa-edit" aria-hidden="true"></i></h4></div>');
            return true;
        } else {
            $('#participants').removeClass('displaynone').addClass('displayblock');
            $('#no_participants').remove();
            return false;
        }
    }



     /*
      *  Calculate columns size on resize window
     */
     Handsontable.Dom.addEvent(window, 'resize', calculateSize);



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
