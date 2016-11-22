<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <!-- =============== VENDOR STYLES ===============-->
  	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
  	<link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css">


    <!-- =============== VENDOR SCRIPTS ===============-->
  	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
  	<script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>
  </head>
  <body>
    <header class="header">
        <div class="header_wrapper">
            <div class="header_menu-collapse-btn">
                <button id="open_leftnav" class="header_button">
                    <i class="fa fa-bars header_icon" aria-hidden="true"></i>
                </button>
            </div>
            <div class="header_logo">NWE</div>
            <div class="header_menu">
                <?=$top; ?>
            </div>
            <div class="header_dropdown dropdown">
                <a id="open_usermenu" class="header_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="header_text">Николай</span>
                    <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-menu pull-right" aria-labelledby="open_usermenu">
                    <li class="nav_item">
                        <a href="#" class="nav_link">
                            <i class="fa fa-cubes nav_icon header_icon" aria-hidden="true"></i>
                            Мои мероприятия
                        </a>
                    </li>
                    <li class="nav_item">
                        <a href="#" class="nav_link">
                            <i class="fa fa-user nav_icon header_icon" aria-hidden="true"></i>
                            Профиль
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li class="nav_item">
                        <a href="#" class="nav_link">
                            <i class="fa fa-sign-out nav_icon header_icon" aria-hidden="true"></i>
                            Выйти
                        </a>
                    </li>
               </ul>
      		</div>
        </div>
  	</header>


    <nav class="navleft">
        <?=$leftnav; ?>
  	</nav>


    <section>
        <?=$main_section; ?>
    </section>


  </body>
</html>
