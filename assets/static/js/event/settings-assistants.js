var id, name, assistant_block, message, link, ajaxData,
    deleteBtns = document.getElementsByClassName('deletebtn'),
    acceptBtns = document.getElementsByClassName('acceptbtn'),
    cancelBtns = document.getElementsByClassName('cancelbtn'),
    eventId      = document.getElementById('event_id').value;

/**
 * Add EventListener for btns
 */
if (document.getElementById('inviteBtn') != null );
document.getElementById('inviteBtn').addEventListener('click', invite, false);

for (var i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener('click', removeCoworker, false);
}

for (var i = 0; i < acceptBtns.length; i++) {
    acceptBtns[i].addEventListener('click', addAssistant, false);
}

for (var i = 0; i < cancelBtns.length; i++) {
    cancelBtns[i].addEventListener('click', rejectAssistant, false);
}


/**
 * Invite new Co-Worker
 */
function invite(event) {
    link = event.target.dataset.href;

    vp.notification.notify({
        type: 'confirm',
        size: 'large',
        confirmText: "Готово",
        message: '<h3 class="text--default">Сообщите ссылку людям, которые смогут стать вашими помощниками мероприятия!</h3>' +
        '<p id="copyText" style="cursor:copy; margin:20px auto; text-decoration:underline; word-wrap:break-word; color:#008DA7">' + link + '</p>'+
        '<p>Не забудьте подтвердить их в "Новых заявках"</p>'
    });

    document.getElementById('copyText').addEventListener('click', copy, false);

}

function copy() {
    selectText('copyText');
    notify('Ссылка скопирована','success');
}

function selectText(containerid) {
    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().removeAllRanges();
        range.select().createTextRange();
        document.execCommand("Copy");
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
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

    vp.notification.notify({
        type: 'confirm',
        size: 'large',
        showCancelButton: true,
        confirmText: "Исключить",
        message: '<h3 class="text--default">Вы уверены, что хотите исключить ' + name + ' из организации?</h3>',
        confirm: removeAssistant
    });

    function removeAssistant() {

        assistant_block = document.getElementById('assistant_id'+id);

        /**
         * Send ajax request for deleted
         */
        ajaxData = {
            url: '/event/'+eventId+'/assistant/remove/'+id,
            beforeSend: function(callback) {
                addWhirl(assistant_block);
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.code == '57') {
                    notify('Помощник успешно удалён!','success');
                    assistant_block.remove();
                    document.getElementById('countAssistans').innerHTML = parseInt(document.getElementById('countAssistans').innerHTML) - 1;
                } else {
                    notify('Во время удаления возникла ошибка. Попробуйте ещё раз.','danger');
                    removeWhirl(assistant_block);
                    return;
                }
            },
            error: function(callback) {
                console.log(callback);
                notify('Во время удаления возникла ошибка. Попробуйте ещё раз.','danger');
                removeWhirl(assistant_block);
            }
        };

        vp.ajax.send(ajaxData);

    }

}



/**
 * Accept assistant's request
 */
function addAssistant(event) {
    id = event.target.dataset.id;
    assistant_block = document.getElementById('assistant_id'+id);

    /**
     * Send ajax request for accept assistant's request
     */
    ajaxData = {
        url: '/event/'+eventId+'/assistant/add/'+id,
        beforeSend: function(callback) {
            addWhirl(assistant_block);
        },
        success: function(response) {
            response = JSON.parse(response);
            if (response.code == '56') {
                notify('Заявка принята!','success');
                event.target.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка принята</div>';
                removeWhirl(assistant_block);
            } else {
                notify('Произошла ошибка. Попробуйте снова','warning');
                removeWhirl(assistant_block);
                return;
            }
        },
        error: function(callback) {
            console.log(callback);
            notify('Произошла ошибка. Попробуйте снова','warning');
            removeWhirl(assistant_block);
        }
    };

    vp.ajax.send(ajaxData);

}



/**
 * Cansel assistant's request
 */
function rejectAssistant(event) {
    id = event.target.dataset.id;
    assistant_block = document.getElementById('assistant_id'+id);

    /**
     * Send ajax request for cansel assistant's request
     */
    ajaxData = {
        url: '/event/'+eventId+'/assistant/reject/'+id,
        beforeSend: function(callback) {
            addWhirl(assistant_block);
        },
        success: function(response) {
            response = JSON.parse(response);
            if (response.code == '58') {
                notify('Заявка отклонкна!','success');
                event.target.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка отклонена</div>';
                removeWhirl(assistant_block);
            } else {
                notify('Произошла ошибка. Попробуйте снова','warning');
                removeWhirl(assistant_block);
                return;
            }
        },
        error: function(callback) {
            console.log(callback);
            notify('Произошла ошибка. Попробуйте снова','warning');
            removeWhirl(assistant_block);
        }
    };

    vp.ajax.send(ajaxData);

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
function notify(message,status) {

    vp.notification.notify({
        type: status,
        message: message,
        time: 3
    });

}
