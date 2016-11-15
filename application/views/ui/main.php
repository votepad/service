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
  	<script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>
  </head>
  <body>
    <header class="header-top-fixed">
  		<div class="header-top-fixed-logo">NWE</div>
  		<ul class="header-top-fixed-menu">
  			<li><a href="#">Settings</a></li>
  			<li><a href="#">Organisations</a></li>
  			<li><a href="#">Events</a></li>
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
  			<li><a href="">Avatar</a></li>
  			<li><a href="">Description</a></li>
  			<li><a href="">Security</a></li>
  		</ul>
  	</nav>


    <section>
        <?=$main_section; ?>
    </section>


  </body>
</html>
