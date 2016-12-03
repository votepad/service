<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/teams.js"></script>

<h3 class="page-header">Список команд</h3>

<form class="form form_collapse" id="new_team">
    <div class="form_body">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="input-field">
                    <input id="name-0" type="text" name="name" autocomplete="off">
                    <label for="name-0">Введите название команды</label>
                </div>
            </div>
            <div class="row hidden">
                <div class="input-field">
                    <textarea id="description-0" name="description"></textarea>
                    <label for="description-0">Расскажите о команде</label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row hidden">
                <div class="input-field">
                    <select name="participants" id="participants-0" multiple="" class="participants_in_team">
                        <option value="01.jpg">участник 1</option>
                        <option value="02.jpg">участник 2</option>
                    </select>
                    <label for="participants-0">Состав команды</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit hidden clear_fix">
        <label class="btn btn_default btn_labeled col-xs-12 col-sm-auto" for="logo-0">
            <span class="btn_label">
                <i class="fa fa-paperclip" aria-hidden="true"></i>
            </span>
        	<span class="btn_text">Выбрать логотип</span>
            <input id="logo-0" type="file" name="logo" accept="image/*">
        </label>
        <button id="create_team" type="button" class="btn btn_primary col-xs-12 col-sm-auto pull-right">
        	Создать команду
        </button>
    </div>
</form>



<div class="row row-col">
    <div class="col-xs-12">
        <div class="card clear_fix" action="" id="team-1">
            <div class="card_image" id="logo_team-1">
                <img src="<?=$assets; ?>img/logo_1x1.png" alt="">
            </div>
            <div class="card_title">
                <div class="card_title-text" id="name_team-1">
                    Команда под номером 1
                </div>
                <div class="card_title-dropdown">
                    <div id="create_team" role="button" class="card_title-dropdown-icon">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </div>
                    <div class="card_title-dropdown-menu">
                        <a class="card_title-dropdown-item edit">
                            Изменить информацию
                        </a>
                        <a class="card_title-dropdown-item delete">
                            Удалить команду
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_content">
                <div class="card_content-text">
                    <i><u>О команде:</u></i>
                    <span id="description_team-1">Мерзнуть в Петербург я приехал с теплого Казахстана, а именно из города яблок - Алматы. О себе говорить не люблю, или скорее даже не могу. Но все же попробую.
С самого детства и на протяжении уже 8 лет играю в шахматы и занимаюсь плаванием. В данный момент осваиваю гитару. К сожалению, раньше я никогда не держал музыкальные инструменты в руках, да и со слухом у меня проблемы, но аккорд am я ставить научился.
Всегда стремлюсь попробовать что-то новое и интересное, не люблю сидеть сложа руки. Считаю, что самое главное в жизни - это твои родные и близкие. Люблю слушать музыку, и утро мое обычно начинается не с кофе, а с хорошего гитарного риффа группы «Deep Purple».
Придя на "Мистер ИТМО", я надеюсь на новые знакомства и открытие чего-то нового или же интересного в себе.</span>
                </div>
                <p class="card_content-text">
                    <i><u>Состав команды:</u></i>
                    <span id="participants_team-1">
                        <option value="01.jpg" selected="">Фамилия Имя Отчество участника 1</option>
                        <option value="02.jpg">Фамилия Имя Отчество участника 2</option>
                        <option value="03.jpg" selected="">Фамилия Имя Отчество участника 3</option>
                        <option value="04.jpg">Фамилия Имя Отчество участника 4</option>
                        <option value="05.jpg">Фамилия Имя Отчество участника 5</option>
                        <option value="06.jpg">Фамилия Имя Отчество участника 6</option>
                        <option value="07.jpg" selected="">Фамилия Имя Отчество участника 7</option>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
