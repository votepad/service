<div class="member">

    <div class="member__name"><?= $member->name; ?></div>

    <div class="member__logo">

        <img src="<?= URL::site('uploads/' . $mode . '/b_' . $member->logo); ?>" alt="Member Logo" class="member__img">

        <div class="member__position"><?= $member_position + 1; ?></div>

    </div>

    <div class="member__rating-area">

        <div class="member__rating-bar" style="width: <?= str_replace(',','.',$score / $maxScore * 100); ?>%">

            <span class="member__bar"><?= str_replace(',','.',$score . '/' . $maxScore); ?></span>

        </div>

    </div>

</div>