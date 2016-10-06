<? foreach($menus as $key => $value) : ?>
    <? if ($user->hasPrivillege($key)) : ?>
        <a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/' . $key); ?>">
            <?=$value; ?>
            <div class="active-link"></div>
        </a>
    <? endif; ?>
<? endforeach; ?>