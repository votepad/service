<ul class="jumbotron__nav-list jumbotron__nav--org-list">

    <? foreach ($btns as $key => $btn) : ?>
        <li class="jumbotron__nav-item jumbotron__nav--org-item">
            <a class="jumbotron__nav-btn <?= $active == $key ? 'active' : '' ?>" href="<?= $btn['uri']; ?>">
                <?= $btn['name']; ?>
            </a>
        </li>
    <?endforeach;?>

</ul>
