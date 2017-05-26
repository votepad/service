let voting = function (voting) {

    let headerMenuBtn       = null,
        headerBrand         = null,
        asideMenu           = null,
        stages              = null,
        curHash             = null,
        members             = null,
        membersCriterions   = null,
        collapseMemberBtn   = null,
        scores              = null,
        modalInfoHeading    = null,
        modalInfoContent    = null,
        modalOpenBtn        = null;


    let backdrop      = document.createElement('div');
        backdrop.className = "modal-backdrop in";



    /**
     * Prepare Header And Mobile Menu
     * @private
     */
    let prepareHeader_ = function() {
        headerMenuBtn = document.getElementById('openMobileMenu');
        headerBrand   = document.getElementsByClassName('header__brand')[0];
        asideMenu     = document.getElementsByClassName('mobile-aside')[0];

        headerMenuBtn.addEventListener('click', toggleMobileMenu_, false);
        backdrop.addEventListener('click', toggleMobileMenu_, false);
    };


    /**
     * Prepare Members Block
     * - count Total Score
     * @private
     */
    let prepareMembers_ = function () {

        members = document.getElementsByClassName('member');
        
        membersCriterions = document.getElementsByClassName('member__criterions--collapse');

        collapseMemberBtn = document.getElementsByClassName('criterion__submit');
        
        window.addEventListener('resize', updateCriterionsBlockHeight_);

        let curScore      = null,
            curInputScore = null;

        for (let i = 0; i < members.length; i++) {
            let curScore      = members[i].getElementsByClassName('member__total-score')[0],
                curInputScore = members[i].getElementsByClassName('score__input');

            collapseMemberBtn[i].addEventListener('click', closeMemberCollapse_);

            for (let j = 0; j < curInputScore.length; j++) {
                if ( curInputScore[j].hasAttribute('checked') ) {
                    updateTotalScore_(curScore, "+" , curInputScore[j].value);
                }

            }

        }

    };

    /**
     * Prepare Scores Buttons
     * @private
     */
    let prepareScores_ = function() {
        scores = document.getElementsByClassName('score');

        for (let i = 0; i < scores.length; i++) {
            scores[i].addEventListener('click', setScore_)
        }
    };


    /**
     * Prepare Modal
     * - working with jQuery
     * @private
     */
    let prepareModal_ = function () {
        modalInfoHeading = document.getElementById('modalInfoHeading');
        modalInfoContent = document.getElementById('modalInfoContent');
        modalOpenBtn     = document.getElementsByClassName('openModalInfo');

        for (let i = 0; i < modalOpenBtn.length; i++) {
            modalOpenBtn[i].addEventListener('click', openModal_)
        }

    };


    /**
     * Prepare Stages
     * @private
     */

    let prepareStages_ = function () {

        stages = document.getElementsByClassName('stage');
        curHash = window.location.hash;

        let isOpened = false;

        for (let i = 0; i < stages.length; i++) {
            if (stages[i].dataset.hash === curHash) {
                isOpened = true;
                stages[i].classList.add('fadeInRight');
            } else {
                stages[i].classList.add('fadeOutLeft','hide');
            }
        }

        if (!isOpened) {
            stages[0].classList.remove('fadeOutLeft','hide');
            stages[0].classList.add('fadeInRight');
        }

        let nextContestLinkBtn = document.getElementsByClassName('nextContestLinkBtn');
        for(let i = 0; i < nextContestLinkBtn.length; i++) {
            nextContestLinkBtn[i].addEventListener('click', nextLinkOnClick_);
        }

        window.addEventListener('hashchange', toggleStage_);

    };



    /**
     * Toggle Mobile Menu - open / close on click
     * @private
     */
    let toggleMobileMenu_ = function() {
        if ( ! headerMenuBtn.parentNode.classList.contains('header__menu-icon--open')) {
            document.body.appendChild(backdrop);
        } else {
            document.body.classList.remove('modal-open');
            document.getElementsByClassName('modal-backdrop')[0].remove()
        }

        headerMenuBtn.parentNode.classList.toggle('header__menu-icon--open');
        headerBrand.classList.toggle('header__brand--active');
        asideMenu.classList.toggle('mobile-aside--open');
    };


    /**
     * Update Total Score for Member
     * @param el - html Element
     * @param operand - "+" / "-" 
     * @param score
     * @private
     */
    let updateTotalScore_ = function (el, operand, score) {
        switch (operand) {
            case "+":
                el.innerHTML = parseInt(el.innerHTML) + parseInt(score);
                break;
            case "-":
                el.innerHTML = parseInt(el.innerHTML) - parseInt(score);
                break;
        }
    };


    /**
     * Set Score On Click
     * @private
     */
    let setScore_ = function () {
        let totalScore = this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('member__total-score')[0],
            tmpScoreEl = null,
            tmpScore   = null;

        if ( ! this.classList.contains('score--active') ) {

            tmpScoreEl = this.parentNode.getElementsByClassName('score--active')[0];
            tmpScore = tmpScoreEl ? tmpScoreEl.children[1].value : 0;

            updateTotalScore_(totalScore, "-" , tmpScore);
            tmpScoreEl ? tmpScoreEl.classList.remove('score--active') : '';

            updateTotalScore_(totalScore, "+" , $('.score__input', this).val());
            this.classList.add('score--active');
        }

    };


    /**
     * Update Criterions Block Height on window resize
     * @private
     */
    let updateCriterionsBlockHeight_ = function () {

        for (let i = 0; i < membersCriterions.length; i++) {

            if ( membersCriterions[i].dataset.height !== undefined) {
                if ( membersCriterions[i].style.height === "0px" ) {
                    membersCriterions[i].removeAttribute('data-height');
                } else {
                    membersCriterions[i].dataset.height = membersCriterions[i].children[0].clientHeight;
                    membersCriterions[i].style.height = membersCriterions[i].children[0].clientHeight + "px";
                }
            }
        }

    };



    /**
     * Next Stage
     * - checking validation of Active Stage
     * @private
     */
    let nextLinkOnClick_ = function (e) {

        members = this.parentNode.getElementsByClassName('member');

        let isStageValid = true;

        for (let i = 0; i < members.length; i++) {
            isStageValid ? isStageValid = isCriterionsValid_(members[i]) : isCriterionsValid_(members[i]);
        }

        if (!isStageValid) {
            e.preventDefault();
            vp.notification.notify({
                'type': 'danger',
                'message': 'Пожалуйста, проставьте баллы всем участникам'
            });
        }


    };

    let toggleStage_ = function (event) {

        let oldHash      = event.oldURL.split('#')[1],
            newHash      = event.newURL.split('#')[1],
            oldHashInd   = null,
            newHashInd   = null,
            members      = null,
            isStageValid = true;

        for (let i = 0; i < stages.length; i++) {

            if (stages[i].dataset.hash === "#" + oldHash)
                oldHashInd = i;

            if (stages[i].dataset.hash === "#" + newHash)
                newHashInd = i;

        }

        if (oldHash === undefined || oldHash === '') {
            oldHashInd = 0;
            oldHash = '';
        }
        if (newHash === undefined || newHash === '') {
            newHashInd = 0;
            newHash = '';
        }

        if (curHash === oldHash || curHash === "#"+oldHash) {

            members = stages[oldHashInd].getElementsByClassName('member');

            for (let i = 0; i < members.length; i++) {
                isStageValid ? isStageValid = isCriterionsValid_(members[i]) : isCriterionsValid_(members[i]);
            }

            if (!isStageValid) {
                event.preventDefault();
                window.location.hash = oldHash === undefined ? '' : "#" + oldHash;
                vp.notification.notify({
                    'type': 'danger',
                    'message': 'Пожалуйста, проставьте баллы всем участникам'
                });
            } else {
                curHash = newHash;

                stages[oldHashInd].classList.remove('fadeInLeft', 'fadeInRight');
                stages[newHashInd].classList.remove('fadeOutLeft', 'fadeOutRight', 'hide');
                setTimeout(function () {
                    stages[oldHashInd].classList.add('hide');
                }, 400);

                if (oldHashInd < newHashInd) {
                    // move right
                    stages[oldHashInd].classList.add('fadeOutLeft');
                    stages[newHashInd].classList.add('fadeInRight');
                } else {
                    // move left
                    stages[oldHashInd].classList.add('fadeOutRight');
                    stages[newHashInd].classList.add('fadeInLeft');
                }
            }
        }
    };


    /**
     * Close Member Collapse
     * @private
     */
    let closeMemberCollapse_ = function () {
        let member = this.parentNode.parentNode.parentNode.parentNode;

        if ( isCriterionsValid_(member) )
            member.getElementsByClassName('member__header')[0].click();
        else
            vp.notification.notify({
                'type': 'danger',
                'message': 'Пожалуйста, проставьте баллы участнику'
            });
    };


    /**
     * Checking Criterions By Member
     * @param member - html Element
     * @returns {boolean}
     * @private
     */
    let isCriterionsValid_ = function (member) {
        let isMemberValid = true,
            memberName    = member.getElementsByClassName('member__name')[0],
            memberScores  = member.getElementsByClassName('criterion__scores');


        for (let i = 0; i < memberScores.length; i++) {

            if ( memberScores[i].querySelector('.score__input:checked') === null ) {
                isMemberValid = false;
                memberScores[i].classList.add('criterion__scores--invalid');
            } else {
                memberScores[i].classList.remove('criterion__scores--invalid');
            }

        }

        isMemberValid ? memberName.classList.remove('member__name--invalid') : memberName.classList.add('member__name--invalid');

        return isMemberValid;

    };


    /**
     * Working with modal
     * - show full description of contest || stage || criterion
     * @private
     */
    let openModal_ = function () {
        let type    = this.dataset.type,
            text    = this.innerHTML,
            heading = null,
            content = null;

        switch(type) {
            case "contest" :
                heading = "Описание конкурса: " + this.parentNode.getElementsByClassName('content__header')[0].innerHTML.toLowerCase();
                content = text;
                break;
            case "stage" :
                heading = "Описание этапа: " + this.parentNode.getElementsByClassName('stage__header')[0].innerHTML.toLowerCase();
                content = text;
                break;
            case "criterion":
                heading = "Описание критерия";
                content = text;
                break;
        }

        modalInfoHeading.innerHTML = heading;
        modalInfoContent.innerHTML = content;

        $("#modalInfoBlock").modal();

    };


    
    voting.init = function () {
        prepareHeader_();
        prepareMembers_();
        prepareScores_();
        prepareModal_();
        prepareStages_();

        // remove Loader
        //setTimeout(function () {
            document.getElementsByClassName('loader')[0].remove();
        //}, 1000)
    };
    
    return voting;
    
}({});
