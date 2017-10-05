<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ошибка <?= $code; ?>. Неверный запрос</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="/assets/vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
        <link rel="stylesheet" href="/assets/frontend/bundles/vp.min.css?v=<?= filemtime("assets/frontend/bundles/vp.min.css") ?>">
        <script type="text/javascript" src="/assets/frontend/bundles/vp.min.js?v=<?= filemtime("assets/frontend/bundles/vp.min.js") ?>"></script>
        <script type="text/javascript">
            function ready() {
                vp.modal.init();
                vp.notification.createHolder();
            }
            document.addEventListener('DOMContentLoaded', ready)
        </script>

	</head>
	<body class="">
        <div class="wrapper display-flex">
            <div class="text-center m-auto">
                <h1 class="text-brand fs-5 mt-0 mb-15">Votepad</h1>
                <p class="fs-1_5"><span class="text-bold">Ошибка <?= $code; ?>.</span> <?= $message; ?></p>
                <div class="mt-15">
                    <a href="/" class="link mr-15">Главная</a>
                    <a class="link mr-15" onclick="window.history.back()">Назад</a>
                    <? if ( $code == 401 ): ?>
                        <a class="link" data-toggle="modal" data-area="auth_modal"> Войти </a>
                        <?= View::factory('globalblocks/auth_modal'); ?>
                    <? endif; ?>
                </div>
            </div>
        </div>

	</body>
</html>
