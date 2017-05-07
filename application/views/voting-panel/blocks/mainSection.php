<div class="container">

    <div class="contest">

        <? if ($event->openedContest == null ) : ?>

            <h3 class="text-center m-t-50">
                На данный момент, все конкурсы не доступны.
                <br><br>
                Дождитесь начала конкурса и <a class="underlinehover text-brand tex" onclick="window.location.reload()">обновите страницу</a>.
            </h3>

        <? else: ?>

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