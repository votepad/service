<?
    function comparator($a, $b) {
        return ($b["score"] > $a["score"] ? 1 : -1);
    }
?>


<div class="section__content mt-50 mb-50 pl-20 pr-20">
    <h1 class="text-brand fs-2 mb-10 text-center">
        Результаты мероприятия
    </h1>

    <div class="section__header">

        <? if (!empty($event->members["participants"])): ?>
            <div class="section__header-link section__header-link--active" data-toggle="tabs" data-area="participantsResults" data-tabsgroup="results">
                Индивидуальный результат
            </div>
        <? endif; ?>

        <? if (!empty($event->members["teams"])): ?>
            <div class="section__header-link <?= empty($event->members["participants"]) ? 'section__header-link--active' : ''; ?>" data-toggle="tabs" data-area="teamsResults" data-tabsgroup="results">
                Командный результат
            </div>
        <? endif; ?>

    </div>

    <div class="section__wrapper">

        <? if (!empty($event->members["participants"])): ?>

            <div id="participantsResults">

                <? foreach ($event->results['participants']->contests as $contestKey => $contest): ?>

                    <h1 class="text-brand fs-1_8 mb-10">
                        <?= $contest->name; ?>
                    </h1>

                    <h2 class="section__text">
                        <?= $contest->description; ?>
                        <? if ($contest->publish == 0) : ?>
                            <br>
                            <label class="label label--danger">не опубликован</label>
                        <? endif; ?>
                    </h2>

                    <div class="section__header">
                        <? foreach ($contest->stages as $stageKey => $stage): ?>
                            <div class="section__header-link section__header-link--small <?= $stageKey == 0 ? 'section__header-link--active' : ''; ?>" data-toggle="tabs" data-area="participantsContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" data-tabsgroup="participantsContest<?= $contest->id; ?>">
                                <?= $stage->name; ?>
                            </div>
                        <? endforeach; ?>
                        <div class="section__header-link section__header-link--small" data-toggle="tabs" data-area="participantsContest<?= $contest->id; ?>StageAll" data-tabsgroup="participantsContest<?= $contest->id; ?>">
                            Итого
                        </div>
                    </div>

                    <div class="section__wrapper">

                        <? foreach ($contest->stages as $stageKey => $stage): ?>

                            <div id="participantsContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="<?= $stageKey == 0 ? '' : 'hide'; ?>">

                                <h2 class="section__text section__text--center">
                                    <?= $stage->description; ?>
                                    <? if ($stage->publish == 0) : ?>
                                        <br>
                                        <label class="label label--danger">не опубликован</label>
                                    <? endif; ?>
                                </h2>

                                <? if (!empty($event->members["participants"])): ?>

                                <div class="members">
                                    <?

                                        $sorted_members = array();

                                        foreach ($event->members["participants"] as $member) {

                                            if (!empty($event->scores["participants"][$member->id]['overall'][$contest->id][$stage->id])) {

                                                $score = floatval($event->scores["participants"][$member->id]['overall'][$contest->id][$stage->id]);

                                            } else {

                                                $score = 0;

                                            }


                                            $data = array(
                                                'member'          => $member,
                                                'mode'            => "participants",
                                                'score'           => $stage->publish == TRUE ? $score : 0,
                                                'member_position' => 0,
                                                'maxScore'        => $stage->maxScore
                                            );

                                            array_push($sorted_members, $data);

                                        }

                                        usort($sorted_members, "comparator");

                                        foreach ($sorted_members as $member_position => $member) {

                                            $member["member_position"] = $member_position;
                                            echo View::factory('event-landing/blocks/member', $member);

                                        }

                                    ?>
                                </div>

                            <? endif; ?>

                            </div>

                        <? endforeach; ?>


                        <div class="hide" id="participantsContest<?= $contest->id; ?>StageAll">

                            <h2 class="section__text section__text--center">
                                Итоговый балл за конкурс
                                <? if ($contest->publish == 0) : ?>
                                    <br>
                                    <label class="label label--danger">не опубликован</label>
                                <? endif; ?>
                            </h2>

                            <? if (!empty($event->members["participants"])): ?>

                               <div class="members">
                                <?

                                    $sorted_members = array();

                                    foreach ($event->members["participants"] as $member) {

                                        if (!empty($event->scores["participants"][$member->id]['overall'][$contest->id]['total']) && $contest->publish == TRUE) {

                                            $score = floatval($event->scores["participants"][$member->id]['overall'][$contest->id]['total']);

                                        } else {

                                            $score = 0;

                                        }


                                        $data = array(
                                            'member'          => $member,
                                            'mode'            => "participants",
                                            'score'           => $contest->publish == TRUE ? $score : 0,
                                            'member_position' => 0,
                                            'maxScore'        => $contest->maxScore
                                        );

                                        array_push($sorted_members, $data);

                                    }

                                    usort($sorted_members, "comparator");

                                    foreach ($sorted_members as $member_position => $member) {

                                        $member["member_position"] = $member_position;
                                        echo View::factory('event-landing/blocks/member', $member);

                                    }

                                ?>
                            </div>

                            <? endif; ?>

                        </div>

                    </div>

                <? endforeach; ?>

            </div>

        <? endif; ?>


        <? if (!empty($event->members["teams"])): ?>

            <div id="teamsResults" class="<?= empty($event->members["participants"]) ? '' : 'hide'; ?>">

                <? foreach ($event->results['teams']->contests as $contestKey => $contest): ?>

                    <h1 class="text-brand fs-1_8 mb-10">
                        <?= $contest->name; ?>
                    </h1>

                    <h2 class="section__text">
                        <?= $contest->description; ?>
                        <? if ($contest->publish == 0) : ?>
                            <br>
                            <label class="label label--danger">не опубликован</label>
                        <? endif; ?>
                    </h2>

                    <div class="section__header">
                        <? foreach ($contest->stages as $stageKey => $stage): ?>
                            <div class="section__header-link section__header-link--small <?= $stageKey == 0 ? 'section__header-link--active' : ''; ?>" data-toggle="tabs" data-area="teamsContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" data-tabsgroup="teamsContest<?= $contest->id; ?>">
                                <?= $stage->name; ?>
                            </div>
                        <? endforeach; ?>
                        <div class="section__header-link section__header-link--small" data-toggle="tabs" data-area="teamsContest<?= $contest->id; ?>StageAll" data-tabsgroup="teamsContest<?= $contest->id; ?>">
                            Итого
                        </div>
                    </div>

                    <div class="section__wrapper">

                        <? foreach ($contest->stages as $stageKey => $stage): ?>

                            <div class="<?= $stageKey == 0 ? '' : 'hide'; ?>" id="teamsContest<?= $contest->id; ?>Stage<?= $stage->id; ?>">

                                <h2 class="section__text section__text--center">
                                    <?= $stage->description; ?>
                                    <? if ($stage->publish == 0) : ?>
                                        <br>
                                        <label class="label label--danger">не опубликован</label>
                                    <? endif; ?>
                                </h2>

                                <? if (!empty($event->members["teams"])): ?>

                                <div class="members">
                                    <?

                                        $sorted_members = array();

                                        foreach ($event->members["teams"] as $member) {

                                            if (!empty($event->scores["teams"][$member->id]['overall'][$contest->id][$stage->id])) {

                                                $score = floatval($event->scores["teams"][$member->id]['overall'][$contest->id][$stage->id]);

                                            } else {

                                                $score = 0;

                                            }


                                            $data = array(
                                                'member'          => $member,
                                                'mode'            => "teams",
                                                'score'           => $stage->publish == TRUE ? $score : 0,
                                                'member_position' => 0,
                                                'maxScore'        => $stage->maxScore
                                            );

                                            array_push($sorted_members, $data);

                                        }

                                        usort($sorted_members, "comparator");

                                        foreach ($sorted_members as $member_position => $member) {

                                            $member["member_position"] = $member_position;
                                            echo View::factory('event-landing/blocks/member', $member);

                                        }

                                    ?>
                                </div>

                            <? endif; ?>

                            </div>

                        <? endforeach; ?>

                        <div class="hide" id="teamsContest<?= $contest->id; ?>StageAll">

                            <h2 class="section__text section__text--center">
                                Итоговый балл за конкурс
                                <? if ($contest->publish == 0) : ?>
                                    <br>
                                    <label class="label label--danger">не опубликован</label>
                                <? endif; ?>
                            </h2>

                            <? if (!empty($event->members["teams"])): ?>

                                <div class="members">
                                    <?

                                        $sorted_members = array();

                                        foreach ($event->members["teams"] as $member) {

                                            if (!empty($event->scores["teams"][$member->id]['overall'][$contest->id]['total']) && $contest->publish == TRUE) {

                                                $score = floatval($event->scores["teams"][$member->id]['overall'][$contest->id]['total']);

                                            } else {

                                                $score = 0;

                                            }


                                            $data = array(
                                                'member'          => $member,
                                                'mode'            => "teams",
                                                'score'           => $contest->publish == TRUE ? $score : 0,
                                                'member_position' => 0,
                                                'maxScore'        => $contest->maxScore
                                            );

                                            array_push($sorted_members, $data);

                                        }

                                        usort($sorted_members, "comparator");

                                        foreach ($sorted_members as $member_position => $member) {

                                            $member["member_position"] = $member_position;
                                            echo View::factory('event-landing/blocks/member', $member);

                                        }

                                    ?>
                                </div>

                            <? endif; ?>

                        </div>

                    </div>

                <? endforeach; ?>

            </div>

        <? endif; ?>

    </div>


</div>
