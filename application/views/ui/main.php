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
    <div class="fixed_top">
  		<div class="company_logo">NWE</div>
  		<ul class="menu">
  			<li><a href="#">Settings</a></li>
  			<li><a href="#">Organisations</a></li>
  			<li><a href="#">Events</a></li>
  		</ul>
  	</div>
  	<div class="topbar">
  		<ul class="menu">
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
  		</ul>
  	</div>
  	<div class="settings-menu">
  		<ul>
  			<li><a href="">Avatar</a></li>
  			<li><a href="">Description</a></li>
  			<li><a href="">Security</a></li>
  		</ul>
  	</div>


    <div class="content">
      <?=$main_section; ?>
    </div>


  </body>
</html>
