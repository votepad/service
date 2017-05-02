<?
    $btns = array(
        0 => array(
            'uri' => URL::site('organization/' . $id . '/settings/main'),
            'name' => "Об организации",
            'flag' => URL::site('organization/' . $id . '/settings/main') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
        1 => array(
            'uri' => URL::site('organization/' . $id . '/settings/team'),
            'name' => "Сотрудники",
            'flag' => URL::site('organization/' . $id . '/settings/team') == $_SERVER['REQUEST_URI'] ? 'active'  : ''
        ),
    );
?>


<ul class="jumbotron__nav-list jumbotron__nav--org-list">

    <? foreach ($btns as $btn): ?>
        <li class="jumbotron__nav-item jumbotron__nav--org-item">
            <a class="jumbotron__nav-btn <?= $btn['flag']; ?>" href="<?= $btn['uri']; ?>">
                <?= $btn['name']; ?>
            </a>
        </li>
    <?endforeach;?>

</ul>
