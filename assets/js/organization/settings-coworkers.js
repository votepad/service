tabs.init()

var id, name, coworker_block, message, link,
    deleteBtns = document.getElementsByClassName('deletebtn'),
    acceptBtns = document.getElementsByClassName('acceptbtn'),
    cancelBtns = document.getElementsByClassName('cancelbtn');

/**
 * Add EventListener for btns
 */
document.getElementById('inviteBtn').addEventListener('click', invite, false);
for (var i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener('click', deletecoworker, false);
}
for (var i = 0; i < acceptBtns.length; i++) {
    acceptBtns[i].addEventListener('click', acceptrequest, false);
}
for (var i = 0; i < cancelBtns.length; i++) {
    cancelBtns[i].addEventListener('click', cancelrequest, false);
}


/**
 *
 */
function invite() {
    link = this.dataset.href;

    swal({
        html:   '<p>Сообщите вашим коллегам ссылку, по которой они смогу подать заявку на вступление в организацию!</p>' +
                '<p id="copyText" style="cursor:copy; margin:20px auto; font-size:.8em; text-decoration:underline; color:#008DA7">' + link + '</p>'+
                '<p>Не забудьте подтвердить "Новые заявки"</p>',
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
function deletecoworker() {
    id = this.dataset.id;
    name = this.dataset.name;

    swal({
    	text: "Вы уверены что хотите исклюсить " + name + " из организации?",
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
         $.ajax({
             url: "",
             type: 'POST',
             data: {
                 id : id
             },
             beforeSend: function(callback) {
                 addWhirl(coworker_block);
             },
             success: function(response) {

                 if (response.code != '40') {
                     notify("errorDelete");
                     removeWhirl(coworker_block);
                     return;
                 }

                 notify("successDelete");
                 coworker_block.remove();

             },
             error: function(callback) {
                 console.log(callback);
                 notify("errorDelete");
                 removeWhirl(coworker_block);
             }
    	 });

    }, function(){
        console.log('cancel deleting co-worker');
    })

}



/**
 * Accept co-worker's request
 */
function acceptrequest() {
    id = this.dataset.id;
    coworker_block = document.getElementById('coworker_id'+id);

    /**
     * Send ajax request for accept co-worker's request
     */
     $.ajax({
         url: "",
         type: 'POST',
         data: {
             id : id
         },
         beforeSend: function(callback) {
             addWhirl(coworker_block);
         },
         success: function(response) {

             if (response.code != '40') {
                 notify("errorAccept");
                 removeWhirl(coworker_block);
                 return;
             }

             notify("successAccept");
             this.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка принята</div>';

         },
         error: function(callback) {
             console.log(callback);
             notify("errorAccept");
             removeWhirl(coworker_block);
         }
     });


}



/**
 * Cansel co-worker's request
 */
function cancelrequest() {
    id = this.dataset.id;
    coworker_block = document.getElementById('coworker_id'+id);

    /**
     * Send ajax request for cansel co-worker's request
     */
     $.ajax({
         url: "",
         type: 'POST',
         data: {
             id : id
         },
         beforeSend: function(callback) {
             addWhirl(coworker_block);
         },
         success: function(response) {

             if (response.code != '40') {
                 notify("errorCansel");
                 removeWhirl(coworker_block);
                 return;
             }

             notify("successCansel");
             this.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка отклонена</div>';

         },
         error: function(callback) {
             console.log(callback);
             notify("errorCansel");
             removeWhirl(coworker_block);
         }
     });


}







/**
 * Remove || Add 'whirl'
 */
var temp;
function addWhirl(block) {
    block.className += " whirl";
}
function removeWhirl(block) {
    temp = block.className.replace(" whirl", "");
    block.className = temp;
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
