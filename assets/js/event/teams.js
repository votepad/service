$(document).ready(function() {

    var url = "http://pronwe/assets/img/user";

    $('#team_name-0').focus(function() {
        $(this).closest('.block').addClass('open');
    });

    $('#team_name-0').blur(function() {
        if ($(this).val() == "") {
            $(this).closest('.block').removeClass('open');
        }
    });

    $('.participants_in_team').select2({
        language: 'ru',
        templateResult: formatState
    });

    function formatState (state) {
        console.log(state);
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span class="select2-results__withlogo"><img src="' + url + '/' + state.element.value.toLowerCase() + '" class="select2-results__logo" /> <span class="select2-results__text">' + state.text + '</span></span>'
        );
        return $state;
    };

});

    /*
     *  Vars
    *
    var
        url = "http://pronwe/assets/img/user",
        edit = document.getElementById('edit'),
        save = document.getElementById('save'),
        table = document.getElementById('teams'),
        teams_settings,
        column_disabled,
        column_edited,
        hot,
        data_valid = true;


    /*
     *  Columns Settings
     *
     *  column_disabled - when users are not allowed to edit cells in table
     *  column_edited - when users can edit cells in table
    *

    column_disabled = [
        {
            data:'team_avatar',
            readOnly: true,
            className: 'htCenter',
            renderer: imageRenderer
        },
        {
            data:'team_name',
            readOnly: true,
        },
        {
            data:'team_description',
            readOnly: true,
        },
    ];


    column_edited = [
        {
            data:'team_avatar',
            editor: false,
            renderer:imageRenderer
        },
        {
            data:'team_name',
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
            data:'team_description',
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
     * Get array of teams from DB
    *
     var array_teams = [
         {
             "team_avatar": "",
             "team_name":"выв",
             "team_description": ""
         },
         {
             "team_avatar": "",
             "team_name":"выв",
             "team_description": ""
         },
     ];


     /*
      *  Handsontable settings
     *
     teams_settings = {
         data: array_teams,
		 rowHeaders: true,
		 fillHandle: false,
		 stretchH: 'all',
		 colHeaders: ['Логотип', 'Название команды', 'О команде'],
         columns: column_disabled,
         removeRowPlugin: true,
         colWidths: function(index){
             var width = parseInt(document.body.clientWidth);

             if (width > 992)
                 width = width * 0.7 - 110;

             else if (width < 992)
                width = width * 0.9 - 120;


             if (index == 0)
                 return 60;

             if (index == 1)
                 return width * 0.3;

             if (index == 2)
                 return width * 0.5;

         }
     };


    /*
     *  Create Handsontable
    *
    hot = new Handsontable(table, teams_settings);



    /*
	 *  Create title for column's headers
	*

    $('body').on('mouseenter', '.relative', function(){
        $(this).attr('title', $(this).children('.colHeader').text());
	});



    /*
     *  Edit teams
    *

    Handsontable.Dom.addEvent(edit, 'click', function() {

        save.className = "pull-right displayblock";
        edit.className = "displaynone";

        hot.updateSettings({
            minSpareRows: 1,
            removeRowPlugin: true,
            columns: column_edited
        });
    });



    /*
     *  Save teams
     *

    Handsontable.Dom.addEvent(save, 'click', function(el) {

        if ( data_valid == true ) {

            edit.className = "pull-right displayblock";
            save.className = "displaynone";


            hot.updateSettings({
                minSpareRows: 0,
                removeRowPlugin: false,
                columns: column_disabled
            });


            // delete last row if it's empty
            // if it's empty => show no user
            if (hot.isEmptyRow(hot.countRows() - 1) && hot.countRows() != 1) {
                hot.alter('remove_row', hot.countRows() - 1);
            }

            /*
             *  Data for Ajax updating
            *
            array_teams = [];

            $.each(hot.getData(), function(rowKey, object) {
                if (!hot.isEmptyRow(rowKey)) array_teams[rowKey] = object;
            });

            console.log(JSON.stringify(array_teams));

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
     *
     hot.addHook('afterChange', function() {

         for (var i = 0; i < hot.countRows(); i++) {
             if (hot.isEmptyRow(i)) {
                 hot.alter('remove_row', i);
             }
         }

     });



    /*
     *  Settings for image renderer
    *

    function imageRenderer (instance, td, row, col, prop, value, cellProperties) {

        var img = document.createElement('IMG');

        Handsontable.Dom.empty(td);

        img.className = "table-photo-logo";

        if (value != null && value != "")
            img.src = url + value;
        else
            img.src = url + "/no-team.png";

        td.appendChild(img);


       /*
        *   Change Image  -  update with ajax
        *
        Handsontable.Dom.addEvent(img, 'click', function (e){
            console.log(col+ " " +row +" change team image" );
        });

        return td;
    }

});*/
