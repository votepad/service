<div class="footer__container">
    <div class="clear-fix container">
        <div class="footer__block">
            <span class="footer__brand-icon icon-leadership">
                <span class="footer__text path1 fl_l"></span>
                <span class="path2 fl_l"></span>
                <span class="path3 fl_l"></span>
                <span class="path4 fl_l"></span>
                <span class="footer__text path5 fl_l"></span>
            </span>
            <a href="<?=URL::base(); ?>" class="footer__text footer__brand">Votepad</a>
            <div class="footer__text">Автоматизированный подсчёт</div>
            <div class="footer__text">результатов голосования</div>
        </div>
        <div class="footer__block footer__social">
            <a href="//vk.com/votepad" class="footer__social-link vk"><i class="footer__social-icon fa fa-vk" aria-hidden="true"></i></a>
            <a href="//twitter.com/votepadevent" class="footer__social-link tw"><i class="footer__social-icon fa fa-twitter" aria-hidden="true"></i></a>
            <br><a href="mailto:<?= getenv('SUPPORT_EMAIL'); ?>" class="footer__email footer__text footer__link"><?= getenv('SUPPORT_EMAIL'); ?></a>
        </div>
    </div>
</div>