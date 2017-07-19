<?
function comparator($a, $b) {
    return ($b["score"] - $a["score"]);
}
?>

<div class="section__wrapper">

    <div class="event-info clear-fix">
        <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">

            <i class="fa fa-clock-o event-info__icon text-brand" aria-hidden="true"></i>
            <span id="eventStartTime" data-value="<?=$event->dt_start; ?>"></span>
            <span id="eventEndTime" data-value="<?=$event->dt_end; ?>"></span>
            <span id="eventTimeCounter" class="event-info__h1"></span>
            <span id="eventTime" class="event-info__h2"></span>
        </div>
        <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">
            <i class="fa fa-map-marker event-info__icon text-brand" aria-hidden="true"></i>
            <span class="event-info__h1"><?=$event->address; ?></span>
        </div>
        <div class="col-xs-12 col-md-4 event-info__block">
            <i class="fa fa-flag event-info__icon text-brand" aria-hidden="true"></i>
            <a href="<?=URL::site('organization/' . $organization->id); ?>" class="event-info__h1"><?=$organization->name; ?></a>
            <span class="event-info__h2"></span>
        </div>
    </div>



<!--    <section id="eventDescription" class="container"></section>-->


        <section id="eventResult" class="container">
            <h1 class="text-brand m-t-50 m-b-50">
                Результаты мероприятия
                <br>
                <small><a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="underlinehover">Подробный рейтинг</a></small>
            </h1>

            <? if($event->contestsCount == 0) : ?>

                <h2 class="text-brand m-t-50 text-center text--default">
                    На данный момент актуальные результаты отсутствуют.
                </h2>

            <? else: ?>
                <? if (count($event->members["participants"]) > 0 && $event->result_max_score["participants"] > 0) : ?>

                    <? if (count($event->members["teams"]) > 0 && $event->result_max_score["teams"] > 0) : ?>

                        <h2 class="text-center m-b-30">Результаты участников</h2>

                    <? endif;?>

                    <ul class="members">


                        <?
                        // TODO убрать говнокод
                        $is_publish = true;
                        foreach ($event->contests as $contest) {
                            foreach ($contest->stages as $stage) {

                                if ($is_publish)
                                    $is_publish = $stage->is_publish;

                            }
                        }

                        $sorted_members = array();

                        foreach ($event->members["participants"] as $member) {

                            if (!empty($event->scores[$member->id]['overall']['total']) && $is_publish) {
                                $score = floatval($event->scores[$member->id]['overall']['total']);
                            } else {
                                $score = 0;
                            }


                            $data = array(
                                'member'          => $member,
                                'mode'            => "participants",
                                'score'           => $score,
                                'member_position' => 0,
                                'max_score'       => $event->result_max_score["participants"]
                            );

                            array_push($sorted_members, $data);

                        }

                        usort($sorted_members, "comparator");

                        foreach ($sorted_members as $member_position => $member) {

                            $member["member_position"] = $member_position;
                            echo View::factory('events/landing/blocks/member', $member);

                        }

                        ?>

                    </ul>

                <? endif;?>


                <? if (count($event->members["teams"]) > 0 && $event->result_max_score["teams"] > 0) : ?>

                    <? if (count($event->members["participants"]) > 0 && $event->result_max_score["participants"] > 0) : ?>

                        <h2 class="text-center m-b-30">Результаты команд</h2>

                    <? endif;?>

                    <ul class="members">

                        <? foreach ($event->members["teams"] as $memberKey => $member):

                            $data = array(
                                'member'    => $member,
                                'memberKey' => $memberKey,
                                'mode'      => "teams",
                                'max_score' => $event->result_max_score["teams"]
                            );

                            echo View::factory('events/landing/blocks/member', $data);

                        endforeach; ?>

                    </ul>

                <? endif;?>

                <div class="col-xs-12 text-center">

                    <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="btn btn_primary btn-result">Подробный рейтинг</a>

                </div>

            <? endif; ?>

        </section>



</div>