<? foreach($menus as $key => $value) : ?>
    <? if ($user->hasPrivillege($key)) : ?>
        <a class="" href="<?=URL::site('organization/' . $id . '/settings/' . $key); ?>">
            <?=$value; ?>
        </a>
    <? endif; ?>
<? endforeach; ?>
