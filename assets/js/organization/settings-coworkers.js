tabs.init()

var id, name, coworker_block, message, link, ajaxData,
    deleteBtns = document.getElementsByClassName('deletebtn'),
    acceptBtns = document.getElementsByClassName('acceptbtn'),
    cancelBtns = document.getElementsByClassName('cancelbtn'),
    orgId      = document.getElementById('org_id').value;

/**
 * Add EventListener for btns
 */
if (document.getElementById('inviteBtn') != null );
    document.getElementById('inviteBtn').addEventListener('click', invite, false);

for (var i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener('click', removeCoworker, false);
}

for (var i = 0; i < acceptBtns.length; i++) {
    acceptBtns[i].addEventListener('click', addCoworker, false);
}

for (var i = 0; i < cancelBtns.length; i++) {
    cancelBtns[i].addEventListener('click', rejectCoworker, false);
}


/**
 * Invite new Co-Worker
 */
function invite(event) {
    link = event.target.dataset.href;

    swal({
        html:   '<p>Сообщите вашим коллегам ссылку, по которой они смогу вступить в организацию!</p>' +
                '<p id="copyText" style="cursor:copy; margin:20px auto; font-size:.8em; text-decoration:underline; color:#008DA7">' + link + '</p>'+
                '<p>Не забудьте подтвердить их в "Новых заявках"</p>',
    	confirmButtonText: 'Готово',
    	confirmButtonClass: 'btn btn_primary',
    	buttonsStyling: false
    });

    document.getElementById('copyText').addEventListener('click', copy, false);

}

function copy() {
    selectText('copyText');
    notify("successCopy");
}

function selectText(containerid) {
    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("Copy");
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("Copy");
    }
}





/**
 * Delete Co-worker
 */
function removeCoworker(event) {
    id = event.target.dataset.id;
    name = event.target.dataset.name;

    swal({
    	text: "Вы уверены, что хотите исключить " + name + " из организации?",
    	showCancelButton: true,
    	confirmButtonText: 'Исключить',
    	cancelButtonText: 'Отмена',
    	confirmButtonClass: 'btn btn_primary',
    	cancelButtonClass: 'btn btn_default',
    	buttonsStyling: false
    }).then(function () {

        coworker_block = document.getElementById('coworker_id'+id);

    	/**
         * Send ajax request for deleted
         */
         ajaxData = {
             url: '/organization/'+orgId+'/member/remove/'+id,
             beforeSend: function(callback) {
                 addWhirl(coworker_block);
             },
             success: function(response) {
                 response = JSON.parse(response);
                 if (response.code == '47') {
                     notify("successDelete");
                     coworker_block.remove();
                     document.getElementById('countCowerkers').innerHTML = parseInt(document.getElementById('countCowerkers').innerHTML) - 1;
                 } else {
                     notify("errorDelete");
                     removeWhirl(coworker_block);
                     return;
                 }
             },
             error: function(callback) {
                 console.log(callback);
                 notify("errorDelete");
                 removeWhirl(coworker_block);
             }
         };

         ajax.send(ajaxData);

     });

}



/**
 * Accept co-worker's request
 */
function addCoworker(event) {
    id = event.target.dataset.id;
    coworker_block = document.getElementById('coworker_id'+id);

    /**
     * Send ajax request for accept co-worker's request
     */
     ajaxData = {
         url: '/organization/'+orgId+'/member/add/'+id,
         beforeSend: function(callback) {
             addWhirl(coworker_block);
         },
         success: function(response) {
             response = JSON.parse(response);
             if (response.code == '46') {
                 notify("successAccept");
                 event.target.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка принята</div>';
                 removeWhirl(coworker_block);
             } else {
                 notify("errorAccept");
                 removeWhirl(coworker_block);
                 return;
             }
         },
         error: function(callback) {
             console.log(callback);
             notify("errorAccept");
             removeWhirl(coworker_block);
         }
     };

     ajax.send(ajaxData);

}



/**
 * Cansel co-worker's request
 */
function rejectCoworker(event) {
    id = event.target.dataset.id;
    coworker_block = document.getElementById('coworker_id'+id);

    /**
     * Send ajax request for cansel co-worker's request
     */
    ajaxData = {
        url: '/organization/'+orgId+'/member/reject/'+id,
        beforeSend: function(callback) {
            addWhirl(coworker_block);
        },
        success: function(response) {
            response = JSON.parse(response);
            if (response.code == '48') {
                notify("successCansel");
                event.target.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка отклонена</div>';
                removeWhirl(coworker_block);
            } else {
                notify("errorCansel");
                removeWhirl(coworker_block);
                return;
            }
        },
        error: function(callback) {
            console.log(callback);
            notify("errorCansel");
            removeWhirl(coworker_block);
        }
    };

    ajax.send(ajaxData);

}




/**
 * Remove || Add 'whirl'
 */
function addWhirl(block) {
    block.classList.add("whirl");
}
function removeWhirl(block) {
    block.classList.remove("whirl");
}



/**
 * Notify Frontend Fields
 */
function notify(field) {

    switch (field) {

        case "successDelete":
            message = 'Сотрудник успешно удалён!';
            type = 'success'
            break;
        case "errorDelete":
            message = 'Во время удаления возникла ошибка. Попробуйте ещё раз.';
            type = 'danger'
            break;
        case "successAccept":
            message = 'Заявка принята!';
            type = 'success'
            break;
        case "successCansel":
            message = 'Заявка отклонкна!';
            type = 'success'
            break;
        case "successCopy":
            message = 'Ссылка скопирована';
            type = 'success'
            break;

        default:
            message = 'Произошла ошибка. Попробуйте снова';
            type = 'warning'
    }

    $.notify({
        message: message
    },
    {
        type: type
    });

}
