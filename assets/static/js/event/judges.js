$(document).ready(function() {


    /**
     *  Vars
     */
    var pathToImg = window.location.pathname + "//" + window.location.host + "/uploads/participants/",
        edit = document.getElementById('edit'),
        save = document.getElementById('save'),
        table = document.getElementById('judges'),
        idEvent = $('#id_event').val(),
        get_array = [],
        hot_array = [],
        output_array = [],
        deleted_elements = [],
        dataToSave,
        hot_settings,
        column_disabled,
        column_edited,
        hot;


    /**
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
			data:'password',
            readOnly: false,
            validator: function (value, callback) {
                if ( /[^A-Za-z0-9]/.test(value) || value == "" ) {
					callback(false);
                } else {
					callback(true);
                }
            },
		}
    ];


    /**
     * Get Judges data from DB
     */
    $.when(

        $.ajax({
            url : '/judges/get/' + idEvent,
            type: "POST",
            success: function(data) {
                if ( data == 'null' ){
                    hot_array = [];
                    get_array = [];
                } else {
                    get_array = JSON.parse(data);
                    hot_array = JSON.parse(data);
                }
                hot.loadData(hot_array);
            },
            error: function(response) {
                console.log("Error while getting elements: " + response);
            },
        })

    ).then(function(){

        document.getElementById('preloader').remove();
        checking_on_empty_table('save');
        calculateSize();
        edit.className = "pull-right displayblock";

    });



    /**
     * Handsontable settings
     */
    hot_settings = {
         data: hot_array,
		 rowHeaders: true,
		 fillHandle: false,
		 colHeaders: ['Фамилия Имя Отчество', 'Пароль'],
         columns: column_disabled,
     };


    /**
     *  Create Handsontable
     */
    hot = new Handsontable(table, hot_settings);


    /**
     * Edit judges
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


    /**
     *  Save judges
     */
    Handsontable.Dom.addEvent(save, 'click', function(el) {

        output_array = [];
        hot.validateCells(function(valid){

            if ( password_is_same() ){
                $.notify({
                    message: 'Пороли у предстовителей жюри должны быть разными!'
                },{
                    type: 'danger'
                });

            } else if ( valid == true) {

                table.classList.add('whirl');
                save.className = "displaynone";

                hot.updateSettings({
                    minSpareRows: 0,
                    columns: column_disabled
                });

                // delete last row if it's empty
                if (hot.isEmptyRow(hot.countRows() - 1) ) {
                    hot.alter('remove_row', hot.countRows() - 1);
                }


                // when judges NOT existed
                if ( get_array.length == 0 ) {

                    // when you don't add any judges
                    if (hot_array.length == 0 ) {

                        checking_on_empty_table('save');

                    } else {

                        // add to output_array only inserted new element
                        for (var j = 0; j < hot_array.length; j++) {
                            hot_array[j]['status'] = "insert";
                            output_array.push(hot_array[j]);
                        }

                    }

                // when judges existed
                } else {

                    for (var i = 0; i < get_array.length; i++) {

                        // add to output_array only deleted element from get_array
                        if ( $.inArray(get_array[i]['id'], deleted_elements) != -1 ) {
                            get_array[i]['status'] = "delete";
                            output_array.push(get_array[i]);
                        }

                        else {

                            for (var j = 0; j < hot_array.length; j++) {

                                // add to output_array only inserted new element
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
                                    } else {
                                        output_array.push(hot_array[j]);
                                    }
                                }

                            }

                        }

                    }

                }


                if (output_array.length == 0 ) {

                    table.classList.remove('whirl');
                    edit.className = "pull-right displayblock";

                } else {

                    dataToSave = JSON.stringify(output_array);


                    /**
                     *  Send information to DB
                     */
                    $.ajax({
                        url : '/judges/save/' + idEvent,
                        type: "POST",
                        data: {
                            list: dataToSave
                        },
                        success: function(response) {
                            //console.log(response);
                            // if true - success updating
                            // else    - some problems
                            if (response) {
                                $.notify({
                                    message: 'Инфомация о представителях жюри успешно обновлена.'
                                },{
                                    type: 'success'
                                });

                                get_array = JSON.parse(response);
                                hot_array = JSON.parse(response);

                                hot.loadData(hot_array);
                                checking_on_empty_table("save");
                                table.classList.remove('whirl');
                                edit.className = "pull-right displayblock";

                            } else {
                                $.notify({
                                    message: 'Что-то пошло не так... Данные не сохранены.'
                                },{
                                    type: 'warning'
                                });
                                hot.updateSettings({
                                    minSpareRows: 1,
                                    columns: column_edited
                                });

                                save.className = "pull-right displayblock";
                                table.classList.remove('whirl');

                            }
                        },
                        error: function(response) {
                            console.log("Error while ajax sending");
                        }
                    });

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


    /**
     * Remove empty rows while editing
     */
     hot.addHook('afterChange', function() {

         for (var i = 0; i < hot.countRows(); i++) {

             if ( hot.isEmptyRow(i) ) {
                 // add id of deleted element
                 if ( hot_array[i]['id'] != null ) {
                     deleted_elements.push(hot_array[i]['id']);
                 }
                 hot.alter('remove_row', i);
             }

         }
         return;
     });


    /**
     * Find element in output_array
     * @param element
     * @returns {boolean}
     */
    function find_output_el(element) {
        for (var i = 0; i < output_array.length; i++) {
            if (output_array[i]['status'] == "insert") {
                if (element['name'] == output_array[i]['name'] && element['password'] == output_array[i]['password'])  {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Compare two arrays
     * @param array1
     * @param array2
     * @returns {boolean}
     */
    function is_similar (array1, array2) {
        if (array1['name'] == array2['name'] && array1['password'] == array2['password']) {
            return true;
        }
        return false;
    };


     /**
      * Checking Table on existing one empty row
      *
      * if empty row - hide table -> open info
      * if exist row - open table -> hide info
      */
     function checking_on_empty_table(action) {
         if (hot.isEmptyRow(0) && action == "save" ) {
             table.classList.remove('displayblock');
             table.classList.add('displaynone');
             $('#table_wrapper').append('<div id="no_judges" class="text-center"><h4>Представитили жюри ещё не созданы, для создания списка жюри нажмите на иконку <i class="fa fa-edit" aria-hidden="true"></i></h4></div>');
             return true;
         } else {
             table.classList.remove('displaynone');
             table.classList.add('displayblock');
             $('#no_judges').remove();
             return false;
         }
     }


    /**
     * Calculate columns size on resize window
     */
    Handsontable.Dom.addEvent(window, 'resize', calculateSize);


     /**
      *  Calculate columns size for table
      *  versions: mobile (<680px),  table(<992px) and  desctop (>992px)
      */
     function calculateSize() {

         // mobile settings
         if (window.innerWidth <= 680) {
             hot.updateSettings({
                 stretchH: 'none',
                 colWidths: [340,220]
             });

             document.getElementById('judges').style.overflowX = "auto";
             document.getElementById('judges').style.height = "inherit";

         } else {

             hot.updateSettings({
                 stretchH: 'all',
                 colWidths: function(index) {
                     var width = parseInt(document.body.clientWidth)+17;

                     // desctop width for columns
                     // 50 - width of first column
                     if (width > 992)
                         width = width * 0.8 - 60;

                     // tablet width for columns
                     else if (width <= 992 && width > 680)
                        width = width * 0.9 - 60;

                     if (index == 0)
                         return width * 0.6;

                     if (index == 1)
                         return width * 0.4;

                 }
             });
         }
     }


    /**
     * Checking on empty FIO cell
     */
    hot.addHook('afterValidate', function(isValid, value, row, prop, source){
        if ( prop != 'name' && hot.getDataAtCell(row, 0) === null ) {
            hot.setDataAtCell(row, 0, "");
        }
        return;
    });


    /**
     * Checking on similar password
     * @returns {boolean}
     */
     function password_is_same() {
         for (var i = 0; i < hot_array.length - 1; i++) {
             for (var j = 1 + i; j < hot_array.length; j++) {
                 if (hot_array[i]['password'] == hot_array[j]['password'])
                    return true;
             }
         }
         return false;
     }




     /**
       * Create EventID view
       */
     var ArrEventID = $('#eventCode').attr('data-id').split(''),
         OutEventID = '<div class="eventCode-list">';
     for (var i = 0; i < ArrEventID.length; i++) {
         OutEventID = OutEventID + '<span class="eventCode-item">' + ArrEventID[i] + '</span>';
     }
     OutEventID += '</div>'
     $('#eventCode').append(OutEventID);

});
