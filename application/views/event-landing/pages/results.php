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
            <div class="section__header-link" data-toggle="tabs" data-area="teamsResults" data-tabsgroup="results">
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

                            <? if (!empty($event->members["participants"])): ?>

                                <div class="members <?= $stageKey == 0 ? '' : 'hide'; ?>" id="participantsContest<?= $contest->id; ?>Stage<?= $stage->id; ?>">
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

                        <? endforeach; ?>

                        <? if (!empty($event->members["participants"])): ?>

                            <div class="members hide" id="participantsContest<?= $contest->id; ?>StageAll">
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

                <? endforeach; ?>

            </div>

        <? endif; ?>


        <? if (!empty($event->members["teams"])): ?>

            <div class="hide" id="teamsResults">

                <? foreach ($event->results['teams']->contests as $contestKey => $contest): ?>

                    <h1 class="text-brand fs-1_8 mb-10">
                        <?= $contest->name; ?>
                    </h1>

                    <h2 class="section__text">
                        <?= $contest->description; ?>
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

                            <? if (!empty($event->members["teams"])): ?>

                                <div class="members <?= $stageKey == 0 ? '' : 'hide'; ?>" id="teamsContest<?= $contest->id; ?>Stage<?= $stage->id; ?>">
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

                        <? endforeach; ?>

                        <? if (!empty($event->members["teams"])): ?>

                            <div class="members hide" id="teamsContest<?= $contest->id; ?>StageAll">
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

                <? endforeach; ?>

            </div>

        <? endif; ?>

    </div>


</div>
