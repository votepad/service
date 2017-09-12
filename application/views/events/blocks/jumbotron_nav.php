<ul class="jumbotron__nav-list list-style--none clear-fix">

    <? foreach ($btns as $key => $btn) : ?>
        <li class="col-sm-<?=12/count($btns) ?> jumbotron__nav-item">
            <a class="jumbotron__nav-btn <?= $active == $key ? 'active' : '' ?>" href="<?=$btn['uri']; ?>">
                <?=$btn['name']; ?>
            </a>
        </li>
    <? endforeach; ?>

</ul>
