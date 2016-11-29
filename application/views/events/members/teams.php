<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/teams.js"></script>

<h3 class="page-header">Список команд</h3>

<form class="form form_collapse" id="new_team">
    <div class="form_body">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="input-field">
                    <input id="team_name-0" type="text" name="" value="">
                    <label for="team_name-0">Введите название команды</label>
                </div>
            </div>
            <div class="row hidden">
                <div class="input-field">
                    <textarea id="team_description-0"></textarea>
                    <label for="team_description-0">Расскажите о команде</label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row hidden">
                <div class="input-field">
                    <select name="" id="team_participants-0" multiple="" class="participants_in_team">
                        <option value="01.jpg">участник 1</option>
                        <option value="02.jpg">участник 2</option>
                    </select>
                    <label for="team_participants-0">Состав команды</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit hidden clear_fix">
        <label class="btn btn_default col-xs-12 col-sm-5 col-md-3" for="team_logo">
            <input id="team_logo-0" type="file" name="" value="">
        	Выбрать логотип
        </label>
        <button type="" class="btn btn_primary col-xs-12 col-sm-5 col-sm-offset-2 col-md-3 col-md-offset-6">
        	Создать команду
        </button>
    </div>
</form>



<div class="row row-col">
    <div class="col-xs-12">
        <div class="card clear_fix" action="" method="post">
            <div class="card_image" id="team_logo-1">
                <img src="<?=$assets; ?>img/logo_1x1.png" alt="">
            </div>
            <div class="card_title">
                <div class="card_title-text" id="team_name-1">
                    Команда под номером 1
                </div>
                <div class="card_title-dropdown">
                    <div role="button" class="card_title-dropdown-icon">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </div>
                    <div class="card_title-dropdown-menu">
                        <a class="card_title-dropdown-item">
                            Изменить информацию
                        </a>
                        <a class="card_title-dropdown-item">
                            Удалить команду
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_content">
                <div class="card_content-text">
                    <i><u>О команде:</u></i>
                    <span id="team_description-1">
Мерзнуть в Петербург я приехал с теплого Казахстана, а именно из города яблок - Алматы. О себе говорить не люблю, или скорее даже не могу. Но все же попробую.
С самого детства и на протяжении уже 8 лет играю в шахматы и занимаюсь плаванием. В данный момент осваиваю гитару. К сожалению, раньше я никогда не держал музыкальные инструменты в руках, да и со слухом у меня проблемы, но аккорд am я ставить научился.
Всегда стремлюсь попробовать что-то новое и интересное, не люблю сидеть сложа руки. Считаю, что самое главное в жизни - это твои родные и близкие. Люблю слушать музыку, и утро мое обычно начинается не с кофе, а с хорошего гитарного риффа группы «Deep Purple».
Придя на "Мистер ИТМО", я надеюсь на новые знакомства и открытие чего-то нового или же интересного в себе.
                    </span>
                </div>
                <p class="card_content-text">
                    <i><u>Состав команды:</u></i>
                    <span  id="team_participants-1">
                        <option value="01.jpg">Фамилия Имя Отчество участника 1</option>
                        <option value="02.jpg">Фамилия Имя Отчество участника 2</option>
                        <option value="03.jpg">Фамилия Имя Отчество участника 3</option>
                        <option value="04.jpg">Фамилия Имя Отчество участника 4</option>
                        <option value="05.jpg">Фамилия Имя Отчество участника 5</option>
                        <option value="06.jpg">Фамилия Имя Отчество участника 6</option>
                        <option value="07.jpg">Фамилия Имя Отчество участника 7</option>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
