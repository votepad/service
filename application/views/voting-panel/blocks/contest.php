
<?  $contest = $event->contests[$event->cur_contest['index']]; ?>

<?  foreach ($contest->stages as $stageKey => $stage): ?>

    <div id="<?= 'contest_' . $contest->id . '_' . $stage->hash; ?>" class="stage hide">

        <div class="block t-lh-50px pl-md-25 hidden-xs hidden-sm text-bold">
            <?= $stage->name; ?>
        </div>

        <? foreach($stage->members as $memberKey => $member) : ?>

            <div class="block member">

                    <div role="button" class="block__heading valign p-20" data-toggle="collapse" data-area="member_<?= $stageKey . '_' . $memberKey;?>" data-opened="false">
                    <img class="thumb100 image--circle mr-20" src="<?= URL::site('uploads/' . ($stage->mode == "1" ? 'participants' : 'teams') . '/m_'. $member->logo); ?>" alt="Member Logo">
                    <div class="width-full">
                        <h3 class="h3 mt-0"><?=$member->name?></h3>
                        <?
                            $totalMaxScore = 0;
                            foreach($stage->criterions as $criterion):
                                $totalMaxScore += $criterion->maxScore;
                            endforeach;
                        ?>
                        <h4 class="h4">
                            Итоговый балл: <span class="text-brand member__total-score">0</span> из <?= $totalMaxScore; ?>
                            <i class="fa fa-chevron-down fl_r" aria-hidden="true"></i>
                        </h4>
                    </div>
                </div>

                <div id="member_<?= $stageKey . '_' . $memberKey; ?>" class="collapse">

                    <div class="block__wrapper pb-0">

                        <? foreach ($stage->criterions as $criterionKey => $criterion) : ?>

                            <div class="criterion">

                                <p class="criterion__name">
                                    <span><?=$criterion->name; ?></span>
                                    <? if ($criterion->description != "") : ?>
                                        <a class="criterion__description" role="button" data-text='<?=$criterion->description; ?>'>
                                            <i class="fa fa-question-circle" aria-hidden="true" ></i>
                                        </a>
                                    <? endif; ?>
                                </p>

                                <div class="criterion__scores">

                                    <? $uniqid = 'score-' . $contest->id . '-' . $stage->id . '-' . $criterion->id . '-' . $member->id ?>

                                    <? for ($i = $criterion->minScore; $i <= $criterion->maxScore; $i++): ?>

                                        <?
                                        $data = json_encode(array(
                                            'mode'      => ($contest->mode == 1 ? 'participants' : 'teams'),
                                            'event'     => $event->id,
                                            'contest'   => $contest->id,
                                            'stage'     => $stage->id,
                                            'criterion' => $criterion->id,
                                            'judge'     => $judge->id,
                                            'member'    => $member->id,
                                            'score'     => array(
                                                'criterion' => $i,
                                                'stage' => json_decode($stage->formula, true)[$criterion->id],
                                                'contest' => json_decode($contest->formula, true)[$stage->id] * json_decode($stage->formula, true)[$criterion->id],
                                                'result' => json_decode($contest->formula, true)[$stage->id] * json_decode($stage->formula, true)[$criterion->id]
                                            )

                                        ));

                                        if (!empty($event->scores[$member->id]['judges'][$judge->id][$contest->id][$stage->id][$criterion->id])) {
                                            $crScore = $event->scores[$member->id]['judges'][$judge->id][$contest->id][$stage->id][$criterion->id];
                                        } else {
                                            $crScore = 0;
                                        }

                                        ?>

                                        <input id="<?= $uniqid . '-' . $i; ?>"
                                               type="radio"
                                               class="criterion__score-input js-scores"
                                               name="<?= $uniqid ?>"
                                               value="<?= $i ?>"
                                               data-value='<?= $data ?>'
                                               <?= $i == $crScore ? 'checked="true"': ''; ?>>

                                        <label role="button" for="<?= $uniqid . '-' . $i; ?>" class="criterion__score <?= $i == $crScore ? 'criterion__score--active': ''; ?>">
                                            <span class="criterion__score-value">
                                                <?= $i; ?>
                                            </span>
                                        </label>


                                    <? endfor; ?>

                                </div>

                            </div>

                        <? endforeach; ?>

                    </div>

                    <div class="block__footer p-20">

                        <a role="button" class="ui ui-btn--1 ui-btn--35px fl_r" onclick="voting.validate(this, 'member')">
                            Поставить баллы
                        </a>

                    </div>
                </div>

            </div>

        <? endforeach; ?>

        <? if (count($contest->stages) > 1 && count($contest->stages) != $stageKey + 1) : ?>

            <a role="button" class="ui-btn ui-btn--1 ui-btn--45px fl_r mt-20" onclick="voting.validate(this, 'stage')" data-href="<?= URL::site('/voting?contest=' . $contest->id . '#' . Methods_Methods::getUriByTitle($contest->stages[$stageKey +1 ]->name)); ?>">
                Следующий этап
            </a>

        <? elseif (count($event->contests) > $event->cur_contest['index'] + 1 ) :?>

            <a role="button" class="ui-btn ui-btn--1 ui-btn--45px fl_r mt-20" onclick="voting.validate(this, 'stage')" data-href="<?=URL::site('voting/?contest=' . $event->contests[$event->cur_contest['index'] + 1]->id . '#' . Methods_Methods::getUriByTitle($event->contests[$event->cur_contest['index'] + 1]->stages[0]->name)); ?>">
                Следующий конкурс
            </a>

        <? else: ?>

            <a role="button" class="ui-btn ui-btn--1 ui-btn--45px fl_r mt-20" onclick="voting.validate(this, 'stage')" data-href="<?=URL::site('event/' . $event->id);?>">
                Посмотреть результаты
            </a>

        <? endif; ?>

    </div>

<? endforeach; ?>