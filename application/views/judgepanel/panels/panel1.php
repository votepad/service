
<?=View::factory('judgepanel/blocks/jumbotron_wrapper', array('event' => $event))?>


<section class="section__content">

    <? //foreach($event->contests as $contest): ?>
    <? $contest = $event->contests[0] ?>

        <div id="stages-nav"></div>

        <? $stages = array() ?>
        <div class="stages">
            <? foreach ($contest->stages as $st => $stage): ?>
                <? $stages[] = $stage->name ?>
                <div class="stage-block tabs__block <?= $st == 0 ? 'tabs__block--active' : '' ?>" id="stage<?= $st ?>">

                    <!-- Member -->
                    <? foreach($stage->members as $member): ?>
                        <div class="stage-block__member">

                            <!-- Criterions for stage -->
                            <div class="criterions">

                                <!--Default slide with Member info -->
                                <div class="criterion-block">
                                    <div class="criterion-block__image-wrapper">
                                        <img class="criterion-block__image" src="/uploads/participants/<?= $member->photo ?>">
                                    </div>

                                    <div class="criterion-block__content criterion-block__content--small">
                                        <p class="member-name"><?= $member->name ?></p>
                                        <p class="member-text">Итоговый балл: <span class="member-text--brand">0</span> из 15</p>
                                        <p class="member-text--small">
                                            <i class="inlineblock">Для оценивания <br>смахните вправо</i>
                                            <i class="inlineblock fa fa-hand-o-right" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </div>

                                <!-- Criterions -->
                                <? foreach($stage->criterions as $key => $criterion): ?>
                                    <div class="criterion-block">

                                        <div class="criterion-block__content">
                                            <p class="member-name"><?= $member->name ?>
                                                <small class="criterion-counter"><span class="member-text--brand"><?= $key+1 ?></span>/<?= count($stage->criterions) ?></small>
                                            </p>
                                            <p class="member-text">
                                                <?= $criterion->name ?>
                                                <i class="member-icon fa fa-question-circle" aria-hidden="true"></i>
                                            </p>
                                            <div class="scores-area">

                                                <? for ($i = $criterion->min_score; $i <= $criterion->max_score; $i++): ?>
                                                    <span name="vp-custom-radiobox" data-name="vp-radiobox-<?= $criterion->id ?>" data-value="<?= $i ?>"><?= $i ?></span>
                                                <? endfor; ?>

                                             </div>
                                        </div>

                                    </div>
                                <? endforeach; ?>

                            </div>
                        </div>
                    <? endforeach; ?>

                </div>
            <? endforeach; ?>

        </div>
        <script>
            stagena.init(<?= json_encode($stages) ?>);
        </script>

    <?// endforeach; ?>

</section>

<script type="text/javascript">
    radioElem.init();
    new stages_holder();
    new slider(['A', 'B']);
    vp.tabs.init();
</script>