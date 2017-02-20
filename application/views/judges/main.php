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
  	</nav>

  	<nav class="nav-left">
  	</nav>

    <section>
        <?=$main_section; ?>
    </section>


  </body>
</html>
