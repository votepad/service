

<ul class="jumbotron_nav-list jumbotron_nav-settings-list">

    <? foreach($menus as $key => $value) : ?>
        <? if ($user->hasPrivillege($key)) : ?>

            <li class="jumbotron_nav-item jumbotron_nav-settings-item">
                <a class="jumbotron_nav-btn" href="<?=URL::site('organization/' . $id . '/settings/' . $key); ?>">
                    <?=$value; ?>
                </a>
            </li>

        <? endif; ?>
    <? endforeach; ?>

</ul>
