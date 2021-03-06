<div class="event-info clear-fix">

    <div class="event-info__block event-info__block--border">
        <i class="fa fa-clock-o event-info__icon" aria-hidden="true"></i>
        <div class="event-info__h1">
            <?= Methods_Time::getEventLeftTime($event->dt_start, $event->dt_end); ?>
        </div>
        <div class="event-info__h2">
            <?= strftime('с %d %b %Y %H:%M', strtotime($event->dt_start)); ?>
            <br>---------------<br>
            <?= strftime('по %d %b %Y %H:%M', strtotime($event->dt_end)); ?>
        </div>
    </div>

    <div class="event-info__block event-info__block--border">
        <i class="fa fa-map-marker event-info__icon" aria-hidden="true"></i>
        <div class="event-info__h1">
            <?= $event->address; ?>
        </div>
    </div>

    <div class="event-info__block">
        <i class="fa fa-flag event-info__icon" aria-hidden="true"></i>
        <div class="event-info__h1">
            <?= $event->organization; ?>
        </div>
    </div>

</div>


<?
    function comparator($a, $b) {
        return ($b["score"] > $a["score"] ? 1 : -1);
    }
?>


<div class="section__content mt-50 mb-50 pl-20 pr-20">
    <h1 class="text-brand fs-2 mb-10">
        Результаты мероприятия
    </h1>
    <h4 class="h4 mt-10 mb-30">
        <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="link text-underline">Детальный результат</a>
    </h4>


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
                
                <h2 class="section__text section__text--center">
                    <? if ($event->results['participants']->publish == 0) : ?>
                        <br>
                        <label class="label label--danger">не опубликован</label>
                    <? endif; ?>
                </h2>

                <div class="members">

                    <?

                    $sorted_members = array();

                    foreach ($event->members["participants"] as $member) {

                        if (!empty($event->scores["participants"][$member->id]['overall']) && $event->results["participants"]->publish == TRUE) {

                            $score = $event->scores["participants"][$member->id]['overall'];
                            $score = is_int($score) ? $score : number_format($score, 1);

                        } else {

                            $score = 0;

                        }


                        $data = array(
                            'member'          => $member,
                            'mode'            => "participants",
                            'score'           => $score,
                            'member_position' => 0,
                            'maxScore'       => $event->results["participants"]->maxScore
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

            </div>

        <? endif; ?>


        <? if (!empty($event->members["teams"])): ?>

            <div id="teamsResults" class="<?= empty($event->members["participants"]) ? '' : 'hide'; ?>">

                <h2 class="section__text section__text--center">
                    <? if ($event->results['teams']->publish == 0) : ?>
                        <br>
                        <label class="label label--danger">не опубликован</label>
                    <? endif; ?>
                </h2>

                <div class="members">

                    <?

                    $sorted_members = array();

                    foreach ($event->members["teams"] as $member) {

                        if (!empty($event->scores["teams"][$member->id]['overall']) && $event->results["teams"]->publish == TRUE) {

                            $score = $event->scores["teams"][$member->id]['overall'];
                            $score = is_int($score) ? $score : number_format($score, 1);

                        } else {

                            $score = 0;

                        }


                        $data = array(
                            'member'          => $member,
                            'mode'            => "teams",
                            'score'           => $score,
                            'member_position' => 0,
                            'maxScore'       => $event->results["teams"]->maxScore
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

            </div>

        <? endif; ?>

    </div>


    <div class="width-full text-center">

        <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="ui-btn ui-btn--1 ui-btn--45px">Детальный результат</a>

    </div>

</div>
