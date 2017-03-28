<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

<h3 class="page-header">
    Список сотрудников
</h3>

<div class="block" >
    <ul class="tabs tabs_header clear_fix">
        <li id="">
            <a data-ui="tabs" aria-controls="assistants" class="tab tab--active">Состоят в организации
                <span id="" class="tab_count">0</span>
            </a>
        </li>
        
        <li id="">
            <a data-ui="tabs" aria-controls="newAssistants" class="tab">Новые заявки
                <span class="tab_count">5</span>
            </a>
        </li>
        
        <button data-href="http://votepad.ru/event/1/invite" id="inviteBtn" class="btn btn_primary tab_btn">Пригласить</button>
    </ul>
    <div class="tabs_content clear_fix">

        <div id="assistants" class="tab_block tab_block--active">
            
                <div id="assistant_id1" class="coworker_row col-xs-12 col-md-6">
                    <div class="coworker_photo_wrap">
                        <a class="coworker_photo" href="">
                            <img class="coworker_photo_img" alt="Co-worker" src="">
                        </a>
                    </div>
                    <div class="coworker_info">
                        <div class="coworker_field coworker_field-title">
                            <a href="/user/1">FIO</a>
                        </div>
                        <div class="coworker_field coworker_field-contact">
                            <span>email</span>
                            <span>phone</span>
                        </div>
                        
                        <div class="coworker_controls clear_fix">
                            <button data-id="1" data-name="FI" class="btn btn_default deletebtn">Исключить</button>
                        </div>
                        
                    </div>
                </div>

        </div>

        
        <div id="newAssistants" class="tab_block">

            
            <div id="assistant_id2" class="coworker_row col-xs-12 col-md-6">
                <div class="coworker_photo_wrap">
                    <a class="coworker_photo" href="">
                        <img class="coworker_photo_img" alt="Co-worker" src="">
                    </a>
                </div>
                <div class="coworker_info">
                    <div class="coworker_field coworker_field-title">
                        <a href="/user/2">FIO 2</a>
                    </div>
                    <div class="coworker_field coworker_field-contact">
                        <span>email</span>
                        <span>phone</span>
                    </div>
                    <div class="coworker_controls clear_fix">
                        <button data-id="2>" class="btn btn_primary acceptbtn">Принять заявку</button>
                        <button data-id="2" class="btn btn_text cancelbtn">Отклонить</button>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>

<!-- modules -->
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/tabs.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/ajax.js"></script>
<script type="text/javascript">
    tabs.init();
</script>
