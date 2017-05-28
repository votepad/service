<?
    function comparator($a, $b) {
        return ($b["score"] > $a["score"] ? 1 : -1);
    }
?>

<div class="section__wrapper">

    <section id="eventResult" class="container">

        <h1 class="text-brand m-t-50 text-center">
            Результаты мероприятия
        </h1>

        <? if(count($event->contests) == 0): ?>

            <h2 class="text-brand m-t-50 text-center text--default">
                На данный момент актуальные результаты отсутствуют.
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

                                $sorted_members = array();

                                foreach ($event->members[$mode] as $memberKey => $member) {

                                    if (!empty($event->scores[$member->id]['overall'][$contest->id])) {
                                        $score = floatval($event->scores[$member->id]['overall'][$contest->id]['total']);
                                    } else {
                                        $score = 0;
                                    }

                                    // TODO вычесть из `score` баллы за те этапы, которые не опубликованы

                                    $data = array(
                                        'member'          => $member,
                                        'member_position' => 0,
                                        'mode'            => $mode,
                                        'score'           => $contest->is_publish ? $score : 0,
                                        'max_score'       => $contest->max_score
                                    );

                                    array_push($sorted_members, $data);

                                }

                                usort($sorted_members, "comparator");


                                foreach ($sorted_members as $member_position => $member) {

                                    if ($contest->max_score > 0) {

                                        $member["member_position"] = $member_position;
                                        echo View::factory('events/landing/blocks/member', $member);

                                    }

                                }

                                ?>

                            </ul>

                            <? if (count($contest->stages) > 1) : ?>

                                <? foreach ($contest->stages as $stageKey => $stage): ?>

                                    <ul id="stage_<?= $contestKey . '_' . $stageKey; ?>" data-blockGroup="stage_<?= $contestKey; ?>" class="members hide">

                                        <?
                                            $sorted_members = array();

                                            foreach ($event->members[$mode] as $memberKey => $member) {

                                                if (!empty($event->scores[$member->id]['overall'][$contest->id][$stage->id])) {
                                                    $score = floatval($event->scores[$member->id]['overall'][$contest->id][$stage->id]);
                                                } else {
                                                    $score = 0;
                                                }

                                                $data = array(
                                                    'member'          => $member,
                                                    'member_position' => 0,
                                                    'mode'            => $mode,
                                                    'score'           => $stage->is_publish ? $score : 0,
                                                    'max_score'       => $stage->max_score
                                                );

                                                array_push($sorted_members, $data);

                                            }

                                            usort($sorted_members, "comparator");


                                            foreach ($sorted_members as $member_position => $member) {

                                                if ($stage->max_score > 0) {

                                                    $member["member_position"] = $member_position;
                                                    echo View::factory('events/landing/blocks/member', $member);

                                                }

                                            }

                                        ?>

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