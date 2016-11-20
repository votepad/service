<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?=$title; ?></title>

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
    <header class="header-top-fixed">
        <div class="header-top-fixed-collapsemenu">
            <button id="open_leftnav">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
  		<div class="header-top-fixed-logo">NWE</div>
  		<ul class="header-top-fixed-menu">
  			<li class="sm-displaynone">
                <a href="#">Мои мероприятия</a>
            </li>
  			<li class="dropdown">
                <a id="open_usermenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Николай
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
  			   </a>
               <ul class="dropdown-menu pull-right" aria-labelledby="open_usermenu">
                   <li>
                       <a href="#">
                           <i class="fa fa-user" aria-hidden="true"></i>
                           Профиль
                       </a>
                   </li>
                   <li class="divider"></li>
                   <li>
                       <a href="#">
                           <i class="fa fa-sign-out" aria-hidden="true"></i>
                           Выйти
                       </a>
                   </li>
               </ul>
            </li>
  		</ul>
  	</header>
  	<nav class="nav-top">
  		<ul class="nav-top-links">
            <li class="">
                <a href="<?=URL::site('ui'); ?>">Main</a>
            </li>
            <li class="">
                <a href="<?=URL::site('ui/typography'); ?>">Typography</a>
            </li>
            <li class="">
                <a href="<?=URL::site('ui/blocks'); ?>">Blocks</a>
            </li>
            <li class="">
                <a href="<?=URL::site('ui/forms'); ?>">Forms</a>
            </li>
            <li class="">
                <a href="<?=URL::site('ui/buttons'); ?>">Buttons</a>
            </li>
            <li class="">
                <a href="<?=URL::site('ui/tables'); ?>">Tables</a>
            </li>
  		</ul>
  	</nav>
  	<nav class="nav-left">
  		<ul class="nav-left-links">
            <li class="lg-displaynone">
                <a href="#">Мои мероприятия</a>
            </li>
            <li class="divider lg-displaynone"></li>
  			<li>
                <a href="">
                    Avatar
                </a>
            </li>
  			<li>
                <a href="">

                    Description
                </a>
            </li>
  		</ul>
  	</nav>


    <section>
        <?=$main_section; ?>
    </section>

    <footer></footer>

  </body>
</html>
