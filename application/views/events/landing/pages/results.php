<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">

<div class="section__wrapper">

    <div class="jumbotron-landing valign">
        <div class="container" style="z-index: 2">
            <a href="<?=URL::site('event/' . $event->id); ?>" class="jumbotron-landing__title"><?=$event->name; ?></a>
        </div>
        <div class="jumbotron-filter"></div>

        <div class="parallax">
            <img id="" src="/uploads/events/branding/<?=$event->branding; ?>">
        </div>

    </div>

    <section id="eventResult" class="container">
        <h1 class="text-brand m-t-50 text-center">
            Результаты мероприятия
        </h1>


        <? foreach ($event->contests as $i => $contest): ?>
        <!-- CONTEST START -->
        <div id="contest_<?= $i; ?>" class="m-t-50 clear_fix">
            <h2 class="text-brand"><?= $contest->name; ?></h2>
            <div class="contest-description">
                <?= $contest->description; ?>
                <br>
                <?= $contest->name; ?>проходит в <?= count($contest->stages); ?> этапа.
            </div>

            <div class="contest-body">

                <ul class="stage-header">

                    <? foreach ($event->contests[$i]->stages as $j => $stage): ?>
                        <li class="stage-header__item <? echo $j == 0 ? 'active' : '' ?>" data-toggle="tabs" data-btnGroup="stage_<?= $i; ?>" data-block="stage_<?= $i . '_' . $j; ?>"><?= $stage->name; ?></li>
                    <? endforeach; ?>

                </ul>


                <? foreach ($event->contests[$i]->stages as $j => $stage): ?>
                <!-- STAGE START -->
                <ul id="stage_<?= $i . '_' . $j; ?>" data-blockGroup="stage_<?= $i; ?>" class="stage-body <? echo $j != 0 ? 'hide' : '' ?>">

                    <? foreach ($event->contests[$i]->stages[$j]->member as $k => $member): ?>

                        <li class="member col-xs-12 col-md-4 col-lg-3">
                            <div class="member__area">
                                <span class="member__name"><?= $member->name; ?></span>
                                <div class="member__logo">
                                    <? switch ($stage->mode) {
                                        case 1:
                                            echo '<img src="' . URL::site('uploads/participants/' . $member->photo ) .'" alt="Participant Image" class="member__img">';
                                            break;
                                        case 2:
                                            echo '<img src="' . URL::site('uploads/teams/' . $member->logo ) .'" alt="Team Logo" class="member__img">';
                                            break;
                                        case 3:
                                            echo '<img src="' . URL::site('uploads/groups/' . $member->logo ) .'" alt="Group Logo" class="member__img">';
                                            break;
                                        }
                                    ?>
                                    <div class="member__position"><?= $k + 1; ?></div>
                                </div>
                                <div class="member__rating-area">
                                    <div data-pk="2" class="member__rating-bar" style="width:50%">
                                        <span class="member__bar">10/20</span>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <? endforeach;?>

                </ul>

                <!-- STAGE END -->
                <? endforeach; ?>

            </div>
        </div>
        <!-- CONTEST END -->
        <? endforeach; ?>

    </section>

</div>