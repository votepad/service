<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="<?=$description; ?>">
    <meta name="keywords" content="<?=$keywords; ?>!">
    <link rel="icon" href="<?=$assets; ?>img/favicon.png" type="image/png">
    <title><?=$title; ?></title>

    <!-- =============== VENDOR STYLES ===============-->
<? foreach($css as $styles): ?>
    <link rel="stylesheet" href="<?=$assets;?><?=$styles;?>">
<? endforeach;?>

    <!-- =============== VENDOR SCRIPTS ===============-->
<? foreach ($js as $scripts): ?>
    <script src="<?=$assets.$scripts; ?>"></script>
<? endforeach; ?>

</head>
<body>

    <!-- MAIN SECTION -->
    <?=$section; ?>
    <!-- END SECTION -->

</body>

</html>