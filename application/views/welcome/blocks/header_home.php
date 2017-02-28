<header class="header header-home">
    <div class="header-wrapper clear_fix">
        <div class="header_menu-btn-icon left">
            <button id="OpenMobileHeader" class="header_button">
                <i></i><i></i><i></i>
            </button>
        </div>
        <a href="/" class="header_text header_text-logo">VotePad</a>
        <ul class="header-menu">
            <!--<li class="header-list">
                <a href="/features" class="btn btn_hollow">
                    О продукте
                </a>
            </li>-->
            <li class="header-list">
                <a href="/#events" class="btn btn_hollow toEvents">
                    Мероприятия
                </a>
            </li>
        </ul>
        <div class="pull-right header-list header-btn">
            <a class="btn btn_hollow" data-toggle="modal" data-target="#auth_modal">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                Вход
            </a>
        </div>
        <div class="pull-right header-list header-btn">
            <a class="btn_empty" data-toggle="modal" data-target="#registr_modal">
                Регистрация
            </a>
        </div>
    </div>
</header>
<div id="HeaderMobile" class="header-mobile">
    <ul class="header-menu-mobile header-menu-mobile-home clear_fix">
        <!--<li class="header-list">
            <a href="/features" class="btn btn_hollow">
                Возможности
            </a>
        </li>-->
        <li class="header-list">
            <a class="btn btn_hollow askquestion">
                Связь с командой
            </a>
        </li>
        <li class="header-list">
            <a href="/#events" class="btn btn_hollow" onclick="$('.mobile-close').click();$('.toEvents').click();">
                Мероприятия
            </a>
        </li>
    </ul>
    <div class="header-btn-mobile">
        <a class="btn btn_hollow" data-toggle="modal" data-target="#auth_modal">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
            Вход
        </a>
    </div>
    <div class="header-btn-mobile">
        <a class="btn btn_primary publish">Опубликовать мероприятие</a>
    </div>
</div>
