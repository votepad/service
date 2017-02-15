<!DOCTYPE html>
<html lang="ru">
<head>
    <title> <?=$title; ?> </title>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />

    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/welcome.css">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/welcome.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>

</head>

 <body>
    <?=$header; ?>

    <?=$section; ?>

    <footer class="footer">
         <div class="footer_wrapper">
             <div class="footer_block clearfix">
                 <div class="nav-addition pull-right">
                     <!--<a href="/features" class="footer_btn footer_btn-light">О продукте</a>-->
                     <a class="footer_btn footer_btn-light askquestion">Связь с командой</a>
                     <!--<a href="#" class="footer_btn footer_btn-light">Вопросы</a>-->
                 </div>
                <div class="logo">
                    <span class="logo-icon icon-leadership"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    <a href="/" class="logo-name">Votepad</a>
                    <span class="logo-text">Автоматизированный подсчёт</span>
                    <span class="logo-text">результатов голосования</span>
                </div>
                <div class="nav-main">
                    <a href="/#events" class="footer_btn toEvents">Мероприятия</a>
                    <!--<a href="#" class="footer_btn">Организации</a>-->
                </div>
            </div>
            <div role="separator" class="divider"></div>
            <div class="footer_block">
                <div class="footer_icons">
                    <a href="//vk.com/votepad" class="vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <!--<a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
                    <a href="//twitter.com/votepadevent" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <span>— подписывайтесь!</span>
                </div>
                <span class="copyright pull-right">© 2016-2017  "Votepad.ru"</span>
                <!--<a href="mailto:team@votepad.ru" class="email footer_btn footer_btn-light pull-right">team@votepad.ru</a>-->
            </div>
        </div>
    </footer>

    <div id="toTop" class="toTop">
        <i class="fa fa-4x fa-angle-double-up" aria-hidden="true"></i>
    </div>
</body>

</html>
