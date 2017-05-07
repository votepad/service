<div class="container">

    <div class="contest">

        <? if ($event->openedContest == null ) : ?>

            <h3 class="text-center m-t-50">
                На данный момент, все конкурсы не доступны.
                <br><br>
                Дождитесь начала конкурса и <a class="underlinehover text-brand tex" onclick="window.location.reload()">обновите страницу</a>.
            </h3>

        <? else: ?>

            <? $contest = $event->openedContest; ?>

            <h3 class="content__header"><?= $contest->name; ?></h3>

            <a class="contest__description openModalInfo" data-type="contest"><?= $contest->description; ?></a>

            <ul class="content__stages">

                <? foreach ($contest->stages as $stageKey => $stage) : ?>

                    <li class="stage animated" data-hash="#<?= Methods_Methods::getUriByTitle($stage->name);?>">

                        <h4 class="stage__header"><?=$stage->name; ?></h4>

                        <a class="stage__description openModalInfo" data-type="stage"><?=$stage->description; ?></a>

                        <ul class="stage__members">

                            <? foreach($stage->members as $memberKey => $member) : ?>

                                <li class="member">

                                    <div role="button" class="member__header clear_fix" data-toggle="collapse" data-area="member_<?= $stageKey . '_' . $memberKey;?>" data-opened="false">
                                        <img class="member__image" src="<?= URL::site($stage->mode == "1" ? '/uploads/participants/' . $member->photo : '/uploads/teams/' . $member->logo ); ?>" alt="Member Image">
                                        <div class="member__content">
                                            <h4 class="member__name"><?=$member->name?></h4>
                                            <?
                                                $totalMaxScore = 0;
                                                foreach($stage->criterions as $criterion):
                                                    $totalMaxScore += $criterion->max_score;
                                                endforeach;
                                            ?>
                                            <p class="member__addition">Итоговый балл: <span class="text-brand member__total-score">0</span> из <?=$totalMaxScore; ?>
                                                <i class="fa fa-angle-double-down member__addition-collapse-icon" aria-hidden="true"></i>
                                            </p>
                                        </div>
                                    </div>

                                    <div id="member_<?= $stageKey . '_' . $memberKey; ?>" class="collapse member__criterions--collapse">

                                        <div class="member__criterions clear_fix">

                                            <ul class="criterions">

                                                <? foreach ($stage->criterions as $criterionKey => $criterion) : ?>

                                                    <li class="criterion">

                                                        <p class="criterion__name">
                                                            <?=$criterion->name; ?>
                                                            <? if ($criterion->description != "") : ?>
                                                                <i class="fa fa-question-circle openModalInfo criterion__description" aria-hidden="true" data-type="criterion">
                                                                    <span class="criterion__description-text"><?=$criterion->description; ?></span>
                                                                </i>
                                                            <? endif; ?>
                                                        </p>


                                                        <div class="criterion__scores">

                                                            <? $uniqid = $contest->id . '-' . $stage->id . '-' . $criterion->id . '-' . $member->id ?>

                                                                <? for ($i = $criterion->min_score; $i <= $criterion->max_score; $i++): ?>

                                                                    <? $data = json_encode(array(
                                                                        'event' => $event->id,
                                                                        'data'  => array(
                                                                            'contest'   => $contest->id,
                                                                            'stage'     => $stage->id,
                                                                            'criterion' => $criterion->id,
                                                                            'judge'     => $judge->id,
                                                                            'member'    => $member->id,
                                                                            'score'     => $i
                                                                        )
                                                                    ))?>

                                                                <label for="<?= $uniqid . '-' . $i; ?>" class="score">
                                                                    <span class="score__text"><?= $i; ?></span>
                                                                    <input id="<?= $uniqid . '-' . $i; ?>" type="radio" class="score__input" name="<?= $uniqid ?>" value="<?= $i ?>" data-name="vp-radiobox-<?= $uniqid ?>" data-value="<?= $data ?>">
                                                                </label>

                                                            <? endfor; ?>

                                                        </div>

                                                    </li>

                                                <? endforeach; ?>

                                            </ul>

                                            <div class="criterion__submit">
                                                <button role="button" class="criterion__hide-btn">
                                                    Свернуть
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </li>

                            <? endforeach; ?>

                        </ul>

                        <div class="stage__submit">

                            <? if ($contest->id == $event->contestsIds[count($event->contestsIds) - 1]) : ?>

                                <a href="<?=URL::site('event/' . $event->id);?>" class="stage__submit-btn" disabled>
                                    Посмотреть результаты
                                </a>

                            <? elseif (count($contest->stages) == $stageKey + 1) :?>

                                <?
                                    $ind = 0;

                                    foreach ($event->contestsIds as $key => $contestId) :
                                        if ($contestId == $contest->id) :
                                            $ind = $key;
                                        endif;
                                    endforeach;

                                ?>

                                <a href="<?=URL::site('voting/?contest=' . $event->contestsIds[$ind + 1]); ?>" class="stage__submit-btn">
                                    Следующий конкурс
                                </a>

                            <? else: ?>

                                <a href="#<?=Methods_Methods::getUriByTitle($contest->stages[$stageKey +1 ]->name);?>" class="stage__submit-btn">
                                    Следующий этап
                                </a>

                            <? endif; ?>

                        </div>

                    </li>

                <? endforeach; ?>

            </ul>

        <? endif; ?>

    </div>

</div>


<div class="modal fade" id="modalInfoBlock" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 id="modalInfoHeading" class="modal-title"></h4>
            </div>
            <div id="modalInfoContent" class="modal-body"></div>
        </div>
    </div>
</div>