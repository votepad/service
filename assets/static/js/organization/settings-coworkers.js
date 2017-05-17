$(document).ready(function(){
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

        vp.notification.notify({
            type: 'confirm',
            size: 'large',
            confirmText: "Готово",
            message: '<h3 class="text--default">Сообщите вашим коллегам ссылку, по которой они смогу вступить в организацию!</h3>' +
            '<p id="copyText" style="cursor:copy; margin:20px auto; font-size:.8em; text-decoration:underline; color:#008DA7">' + link + '</p>'+
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
            confirm: removeMember
        });


        function removeMember() {

            coworker_block = document.getElementById('coworker_id'+id);

            ajaxData = {
                url: '/organization/'+orgId+'/member/remove/'+id,
                beforeSend: function(callback) {
                    addWhirl(coworker_block);
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.code == '47') {
                        notify('Сотрудник успешно удалён','success');
                        coworker_block.remove();
                        document.getElementById('countCowerkers').innerHTML = parseInt(document.getElementById('countCowerkers').innerHTML) - 1;
                    } else {
                        notify('Во время удаления возникла ошибка. Попробуйте ещё раз.','danger');
                        removeWhirl(coworker_block);
                    }
                },
                error: function(callback) {
                    console.log(callback);
                    notify('Во время удаления возникла ошибка. Попробуйте ещё раз.','danger');
                    removeWhirl(coworker_block);
                }
            };

            vp.ajax.send(ajaxData);


        }

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
                     notify('Заявка принята!','success');
                     event.target.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка принята</div>';
                     removeWhirl(coworker_block);
                 } else {
                     notify('Произошла ошибка, попробуйте снова','danger');
                     removeWhirl(coworker_block);
                     return;
                 }
             },
             error: function(callback) {
                 console.log(callback);
                 notify('Произошла ошибка, попробуйте снова','danger');
                 removeWhirl(coworker_block);
             }
         };

         vp.ajax.send(ajaxData);

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
                    notify('Заявка отклонкна!','success');
                    event.target.parentElement.innerHTML = '<div class="coworker_field" style="color:#008DA7">Заявка отклонена</div>';
                    removeWhirl(coworker_block);
                } else {
                    notify('Произошла ошибка, попробуйте снова','danger');
                    removeWhirl(coworker_block);
                    return;
                }
            },
            error: function(callback) {
                console.log(callback);
                notify('Произошла ошибка, попробуйте снова','danger');
                removeWhirl(coworker_block);
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
    function notify(message, status) {

        vp.notification.notify({
            type: status,
            message: message,
            time: 3
        });

    }
});