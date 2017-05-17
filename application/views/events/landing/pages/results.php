<div class="section__wrapper">

    <section id="eventResult" class="container">

        <h1 class="text-brand m-t-50 text-center">
            Результаты мероприятия
        </h1>

        <? if(count($event->contests) == 0): ?>

            <h2 class="text-brand m-t-50 text-center text--default">
                К сожалению, организатор не создал сценарий.
            </h2>

        <? else: ?>

            <? foreach ($event->contests as $contestKey => $contest): ?>

                <? if ($contest->max_score > 0) : ?>

                    <div id="contest_<?= $contestKey; ?>" class="m-t-50 clear_fix">

                        <h2 class="text-brand"><?= $contest->name; ?></h2>

                        <div class="contest-description">
                            <?= $contest->description; ?>
                        </div>

                        <div class="contest-body">

                            <? if (count($contest->stages) > 1) : ?>

                                <ul class="stage-header">

                                    <li class="stage-header__item active" data-toggle="tabs" data-btnGroup="stage_<?= $contestKey; ?>" data-block="totalResults" >Итоговый результат</li>

                                    <? foreach ($contest->stages as $stageKey => $stage): ?>

                                        <? if($stage->max_score > 0) :?>

                                            <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_<?= $contestKey; ?>" data-block="stage_<?= $contestKey . '_' . $stageKey; ?>"><?= $stage->name; ?></li>

                                        <? endif; ?>

                                    <? endforeach; ?>

                                </ul>

                            <? endif; ?>

                            <ul id="totalResults" class="members" data-blockGroup="stage_<?= $contestKey; ?>">

                                <? switch ($contest->mode) {
                                    case 1:
                                        $mode = "participants";
                                        break;
                                    case 2:
                                        $mode = "teams";
                                        break;
                                }

                                foreach ($event->members[$mode] as $memberKey => $member):

                                    $data = array(
                                        'member'    => $member,
                                        'memberKey' => $memberKey,
                                        'mode'      => $mode,
                                        'max_score' => $contest->max_score
                                    );

                                    if ($contest->max_score > 0) :

                                        echo View::factory('events/landing/blocks/member', $data);

                                    endif;

                                endforeach;?>

                            </ul>

                            <? if (count($contest->stages) > 1) : ?>

                                <? foreach ($contest->stages as $stageKey => $stage): ?>

                                    <ul id="stage_<?= $contestKey . '_' . $stageKey; ?>" data-blockGroup="stage_<?= $contestKey; ?>" class="members hide">

                                        <? foreach ($event->members[$mode] as $memberKey => $member):

                                            $data = array(
                                                'member'    => $member,
                                                'memberKey' => $memberKey,
                                                'mode'      => $mode,
                                                'max_score' => $stage->max_score
                                            );

                                            if ($stage->max_score > 0) :

                                                echo View::factory('events/landing/blocks/member', $data);

                                            endif;

                                        endforeach;?>

                                    </ul>

                                <? endforeach; ?>

                            <? endif; ?>

                        </div>

                    </div>

                <? endif;?>

            <? endforeach; ?>

        <? endif; ?>

    </section>

</div>