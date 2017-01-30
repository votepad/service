<!DOCTYPE html>
<html lang="ru">
<head>
    <title> <?=$title; ?> </title>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/welcome.css">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/welcome.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>

</head>

 <body>
     <?=$header; ?>
     
     <?=$section; ?>

</body>

</html>
