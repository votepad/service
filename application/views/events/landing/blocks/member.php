<li class="member">

    <span class="member__name"><?= $member->name; ?></span>

    <div class="member__logo">

        <? switch ($mode) {
            case "participants":
                echo '<img src="' . URL::site('uploads/participants/' . $member->photo ) .'" alt="Participant Image" class="member__img">';
                break;
            case "teams":
                echo '<img src="' . URL::site('uploads/teams/' . $member->logo ) .'" alt="Team Logo" class="member__img">';
                break;
        }?>

        <div class="member__position"><?= $memberKey + 1; ?></div>

    </div>

    <div class="member__rating-area">

        <div class="member__rating-bar" style="width: <?= $score / $max_score * 100; ?>%">

            <span class="member__bar"><?= $score . '/' . $max_score; ?></span>

        </div>

    </div>

</li>