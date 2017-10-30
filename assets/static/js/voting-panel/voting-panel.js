var voting = function (voting) {

    var navigation      = null,
        contest         = contest,
        corePrefix      = "VP: voting panel",
        stages              = null,
        members             = null,
        membersCriterions   = null,
        collapseMemberBtn   = null,
        scores              = null,
        modalInfoHeading    = null,
        modalInfoContent    = null,
        modalOpenBtn        = null;


    var backdrop      = document.createElement('div');
        backdrop.className = "modal-backdrop in";






    /**
     * Prepare Navigation Between Contest Stage
     * @private
     */
    var prepareNavigation_ = function() {
        var nav  = document.getElementById('navStagesHashes'),
            cont = document.getElementById('curContest');

        if (nav && cont) {
            contest = cont.value;
            navigation = JSON.parse(nav.value);
            window.addEventListener('hashchange', changeSectionOnHashChange_);
            changeSectionOnHashChange_();
            nav.remove();
            cont.remove();
        }
    };


    /**
     * Get Stage on Hash Change
     * @private
     */
    var changeSectionOnHashChange_ = function () {
        var hash    = window.location.hash.split('#'),
            stage   = null;

        switch (hash.length) {
            case 2:
                changeSection_(hash[1]);
                break;
            default:
                vp.core.log('Incorrect hash of the page', 'error', corePrefix)
        }
    };


    /**
     * Select Section By Stage
     * @param stage - stage HASH
     * @private
     */
    var changeSection_ = function (stage) {

        if (navigation.indexOf(stage) === -1) {
            vp.core.log('Stage does not on the page', 'error', corePrefix);
            return;
        }

        var oldNavSmallStage = document.querySelector('.js-nav-small-stage.ui-tabs__tab--active'),
            curNavSmallStage = document.querySelector('.js-nav-small-stage[data-area="contest_' + contest + '_' + stage + '"]'),
            oldNavLargeStage = document.querySelector('.js-nav-large-stage.nav__item--active'),
            curNavLargeStage = document.querySelector('.js-nav-large-stage[data-area="contest_' + contest + '_' + stage + '"]');

        if (oldNavSmallStage && curNavSmallStage && oldNavLargeStage && curNavLargeStage) {

            var oldStage = document.getElementById(oldNavSmallStage.dataset.area),
                curStage = document.getElementById(curNavSmallStage.dataset.area);

            if (oldStage && curStage) {
                oldNavSmallStage.classList.remove('ui-tabs__tab--active');
                curNavSmallStage.classList.add('ui-tabs__tab--active');
                oldNavLargeStage.classList.remove('nav__item--active');
                curNavLargeStage.classList.add('nav__item--active');

                oldStage.classList.add('hide');
                curStage.classList.remove('hide');
            }

        }

    };






    /**
     * Validate Member
     * @param area  - HTML element `.member`
     * @returns {boolean}
     * @private
     */
    var validateMember_ = function (area) {
        var heading    =  area.querySelector('.block__heading'),
            criterions = area.querySelectorAll('.criterion__scores'),
            valid      = true;

        for (var i = 0; i < criterions.length; i++) {
            var score = criterions[i].querySelector('input[type="radio"]:checked');
            if (score === null) {
                valid = false;
                criterions[i].classList.add('criterion__scores--invalid')
            } else {
                criterions[i].classList.remove('criterion__scores--invalid')
            }
        }

        if (!valid) {
            heading.classList.add('text-danger');
        } else {
            heading.classList.remove('text-danger');
            if (heading.dataset.opened === "true") {
                heading.click();
            }
        }

        return valid;
    };


    /**
     * Validate Stage
     * @param area -    HTML element `.stage`
     * @returns {boolean}
     * @private
     */
    var validateStage_ = function (area) {
        var blocks = area.querySelectorAll('.member'),
            valid  = true;

        for(var i = 0; i < blocks.length; i++) {
            if (!validateMember_(blocks[i])) {
                valid = false;
            }
        }
        return valid;
    };

    /**
     * Validate Function `onclick`
     * @param element - clicked button
     * @param mode - 'member||stage'
     */
    voting.validate = function(element, mode) {
        var message = "",
            valid   = true;

        switch (mode) {
            case 'member':
                valid = validateMember_(element.closest('.member'));
                message = "Поставьте баллы участнику";
                break;
            case 'stage':
                valid = validateStage_(element.closest('.stage'));
                message = "Поставьте баллы всем участникам";
                if (valid) {
                    window.location.assign(element.dataset.href)
                }
                break
        }

        if (!valid) {
            vp.notification.notify({
                type: 'error',
                message: message
            })
        }
    };






    /**
     * Update Score On Click
     * @private
     */
    var updateScore_ = function () {
        this.click();
        var member     = this.closest('.member'),
            inputs     = member.querySelectorAll('input:checked'),
            totalScore = member.querySelector('.member__total-score'),
            score      = 0;

        if (inputs.length && member && totalScore) {

            for (var i = 0; i < inputs.length; i++) {
                score += parseInt(inputs[i].value);
            }

            totalScore.textContent = score;

        }

    };


    /**
     * Prepare Scores Buttons
     * @private
     */
    var prepareScores_ = function() {
        scores = document.getElementsByClassName('criterion__score');

        for (var i = 0; i < scores.length; i++) {
            scores[i].addEventListener('click', updateScore_)
        }
    };


    /**
     * Notify Criterion Description
     * @private
     */
    var notifyDescription_  = function() {
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h2 class="h2 mt-10">Описание критерия</h2>' +
                '<p class="m-0">' + this.dataset.text + '</p>',
            showCancelButton: false,
            confirmText: 'Закрыть'
        })
    };


    var prepareCriterionDescription_ = function () {
        var descriptions = document.getElementsByClassName('criterion__description');

        for (var i = 0; i < descriptions.length; i++) {
            descriptions[i].addEventListener('click', notifyDescription_)
        }

    };

    
    voting.init = function () {
        prepareNavigation_();
        prepareCriterionDescription_();
        prepareScores_();
    };
    
    return voting;
    
}({});
