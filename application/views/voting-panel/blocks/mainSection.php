<div class="container">

    <ul class="contests">

        <li class="contest animated fadeInDown">

            <h3 class="content__header">contest name</h3>

            <a class="contest__description openModalInfo" data-type="contest">content description </a>

            <ul class="content__stages">

                <li class="stage animated" data-stagenumber="0" data-stageid="0">

                    <div>
                        Waiting Next Stage
                    </div>

                    <div class="stage__submit">
                        <button role="button" class="stage__submit-btn">
                            Открыть этап
                        </button>
                    </div>

                </li>

                <li class="stage animated" data-stagenumber="1" data-stageid="1">

                    <h4 class="stage__header">stage name</h4>

                    <a class="stage__description openModalInfo" data-type="stage">stage description</a>

                    <ul class="stage__members">

                        <li class="member">
                            <div role="button" class="member__header clear_fix" data-toggle="collapse" data-area="member1" data-opened="false">
                                <img class="member__image" src="http://votepad/uploads/participants/no-participant.png" alt="Member Image">
                                <div class="member__content">
                                    <h4 class="member__name">Name5Name5Name5Name5Name5Name5Name5Name5Name5Name5</h4>
                                    <p class="member__addition">Итоговый балл: <span class="text-brand member__total-score">0</span> из 15</p>
                                </div>
                            </div>
                            <div id="member1" class="collapse member__criterions--collapse">
                                <div class="member__criterions clear_fix">
                                    <ul class="criterions">

                                        <li class="criterion">

                                            <p class="criterion__name">
                                                Criterion Name
                                                <i class="fa fa-question-circle openModalInfo criterion__description" aria-hidden="true" data-type="criterion">
                                                    <span class="criterion__description-text">Long description about criterion</span>
                                                </i>
                                            </p>


                                            <div class="criterion__scores">
                                                <label for="1" class="score">
                                                    <span class="score__text">1</span>
                                                    <input id="1" name="1" type="radio" class="score__input" value="1">
                                                </label>
                                                <label for="2" class="score">
                                                    <span class="score__text">2</span>
                                                    <input id="2" name="1" type="radio" class="score__input" value="2">
                                                </label>
                                                <label for="3" class="score">
                                                    <span class="score__text">3</span>
                                                    <input id="3" name="1" type="radio" class="score__input" value="3">
                                                </label>
                                                <label for="4" class="score">
                                                    <span class="score__text">4</span>
                                                    <input id="4" name="1" type="radio" class="score__input" value="4">
                                                </label>
                                                <label for="5" class="score">
                                                    <span class="score__text">5</span>
                                                    <input id="5" name="1" type="radio" class="score__input" value="5">
                                                </label>
                                            </div>

                                        </li>

                                        <li class="criterion">

                                            <p class="criterion__name">
                                                Criterion Name
                                                <i class="fa fa-question-circle openModalInfo criterion__description" aria-hidden="true" data-type="criterion">
                                                    <span class="criterion__description-text">Long description about criterion</span>
                                                </i>
                                            </p>


                                            <div class="criterion__scores">
                                                <label for="11" class="score">
                                                    <span class="score__text">1</span>
                                                    <input id="11" name="2" type="radio" class="score__input" value="1">
                                                </label>
                                                <label for="21" class="score">
                                                    <span class="score__text">2</span>
                                                    <input id="21" name="2" type="radio" class="score__input" value="2">
                                                </label>
                                                <label for="31" class="score score--active">
                                                    <span class="score__text">3</span>
                                                    <input id="31" name="2" type="radio" class="score__input" value="3" checked>
                                                </label>
                                                <label for="41" class="score">
                                                    <span class="score__text">4</span>
                                                    <input id="41" name="2" type="radio" class="score__input" value="4">
                                                </label>
                                                <label for="51" class="score">
                                                    <span class="score__text">5</span>
                                                    <input id="51" name="2" type="radio" class="score__input" value="5">
                                                </label>
                                            </div>

                                        </li>

                                    </ul>

                                    <div class="criterion__submit">
                                        <button role="button" class="criterion__submit-btn" data-collapseBtn="collapseBtn1" data-collapseArea="collapseBtn1">
                                            Подтвердить баллы
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <div class="stage__submit">
                        <button role="button" class="stage__submit-btn">
                            Следующий этап
                        </button>
                    </div>

                </li>

            </ul>

        </li>

    </ul>

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










<!--<section class="section__content">-->
<!---->
<!--    --><?// //foreach($event->contests as $contest): ?>
<!--    --><?// $contest = $event->contests[0] ?>
<!---->
<!--        <div id="stages-nav"></div>-->
<!---->
<!--        --><?// $stages = array() ?>
<!--        <div class="stages">-->
<!--            --><?// foreach ($contest->stages as $key => $stage): ?>
<!--                --><?// $stages[] = $stage->name ?>
<!--                <div class="stage-block tabs__block --><?//= !$key ? 'tabs__block--active' : '' ?><!--" id="stage--><?//= $key ?><!--">-->
<!---->

<!--                    --><?// foreach($stage->members as $member): ?>
<!--                        <div class="stage-block__member">-->
<!---->

<!--                            <div class="criterions">-->
<!---->

<!--                                <div class="criterion-block">-->
<!--                                    <div class="criterion-block__image-wrapper">-->
<!--                                        <img class="criterion-block__image" src="/uploads/participants/--><?//= $member->photo ?><!--">-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="criterion-block__content criterion-block__content--small">-->
<!--                                        <p class="member-name">--><?//= $member->name ?><!--</p>-->
<!--                                        <p class="member-text">Итоговый балл: <span class="member-text--brand">0</span> из 15</p>-->
<!--                                        <p class="member-text--small">-->
<!--                                            <i class="inlineblock">Для оценивания <br>смахните вправо</i>-->
<!--                                            <i class="inlineblock fa fa-hand-o-right" aria-hidden="true"></i>-->
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->

<!--                                --><?// foreach($stage->criterions as $key => $criterion): ?>
<!--                                    <div class="criterion-block">-->
<!---->
<!--                                        <div class="criterion-block__content">-->
<!--                                            <p class="member-name">--><?//= $member->name ?>
<!--                                                <small class="criterion-counter"><span class="member-text--brand">--><?//= $key+1 ?><!--</span>/--><?//= count($stage->criterions) ?><!--</small>-->
<!--                                            </p>-->
<!--                                            <p class="member-text">-->
<!--                                                --><?//= $criterion->name ?>
<!--                                                <i class="member-icon fa fa-question-circle" aria-hidden="true"></i>-->
<!--                                            </p>-->
<!--                                            <div class="scores-area">-->
<!---->
<!--                                                --><?// $uniqid = $contest->id . '-' . $stage->id . '-' . $criterion->id . '-' . $member->id ?>
<!---->
<!--                                                --><?// for ($i = $criterion->min_score; $i <= $criterion->max_score; $i++): ?>
<!--                                                    --><?// $data = json_encode(array(
//                                                        'event' => $event->id,
//                                                        'data'  => array(
//                                                            'contest'   => $contest->id,
//                                                            'stage'     => $stage->id,
//                                                            'criterion' => $criterion->id,
//                                                            'judge'     => $judge->id,
//                                                            'member'    => $member->id,
//                                                            'score'     => $i
//                                                        )
//                                                    ))?>
<!--                                                    <span name="vp-custom-radiobox-<//?= $uniqid ?>" class="js-scores" data-name="vp-radiobox---><?////= $uniqid ?><!--" data-value='--><?////= $data ?><!--'>--><?//=1// $i ?><!--</span>-->
<!--                                                --><?// endfor; ?>
<!---->
<!--                                             </div>-->
<!--                                        </div>-->
<!---->
<!--                                    </div>-->
                                        <script>
//                                            radioboxes('vp-custom-radiobox<?////= $uniqid ?>////');
                                        </script>
                                <?// endforeach; ?>
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    --><?// endforeach; ?>
<!---->
<!--                </div>-->
<!--            --><?// endforeach; ?>
<!---->
<!--        </div>-->
            <script>
//                stagenav.init(<?//= json_encode($stages) ?>//);
            </script>

    <?// endforeach; ?>
<!---->
<!--</section>-->
<!---->
<script type="text/javascript">
//    new stages_holder();
//    //new slider(['A', 'B']);
//    scores.init(<?////= $judge->id ?>////);
//    vp.tabs.init({
//        search: false,
//        counter: false
//    });
</script>