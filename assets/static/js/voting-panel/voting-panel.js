$(document).ready(function () {

    let headerMenuBtn = document.getElementById('openMobileMenu'),
        headerBrand   = document.getElementsByClassName('header__brand')[0],
        asideMenu     = document.getElementsByClassName('mobile-aside')[0],
        backdrop      = document.createElement('div');

    backdrop.className = "modal-backdrop in";

    let toggleMobile = function() {
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

    headerMenuBtn.addEventListener('click', toggleMobile, false);
    backdrop.addEventListener('click', toggleMobile, false);





    /**
     * Update Total Score for Member
     */
    let updateTotalScore = function (el, operand, score) {
        switch (operand) {
            case "+":
                el.html(parseInt(el.html()) + parseInt(score));
                break;
            case "-":
                el.html(parseInt(el.html()) - parseInt(score));
                break;
        }
    };


    /**
     * Prepare Member
     */
    $('.member').each(function () {
        let curScore = $('.member__total-score', this);
        $('.score__input[checked]', this).each(function () {
            updateTotalScore(curScore, "+" , $(this).val());
        });
    });


    /**
     * Set Score on Click
     */
    $('.score').click(function(){
        let totalScore = $(this).closest('.member').find('.member__total-score');

        if ( ! $(this).hasClass('score--active') ) {
            let tmpScore = $(this).parent().children('.score--active').children('.score__input');
            tmpScore = tmpScore.val() ? tmpScore.val() : 0;
            
            updateTotalScore(totalScore, "-" , tmpScore);
            $(this).parent().children('.score--active').removeClass('score--active');

            updateTotalScore(totalScore, "+" , $('.score__input', this).val());
            $(this).addClass('score--active');
        }

    });


    /**
     * Update Criterions Block Height on window resize
     */
    let criterionsBlock = document.getElementsByClassName('member__criterions--collapse');
    let updateCriterionsBlockHeight = function () {

        for (let i = 0; i < criterionsBlock.length; i++) {


            if ( criterionsBlock[i].dataset.height !== undefined) {
                if ( criterionsBlock[i].style.height === "0px" ) {
                    criterionsBlock[i].removeAttribute('data-height');
                } else {
                    criterionsBlock[i].dataset.height = criterionsBlock[i].children[0].clientHeight;
                    criterionsBlock[i].style.height = criterionsBlock[i].children[0].clientHeight + "px";
                    console.log();
                }
            }
        }

    };

    window.addEventListener('resize', updateCriterionsBlockHeight);


    /**
     * Working with modal
     * - show full description of contest || stage || criterion
     */
    let modalInfoHeading = $('#modalInfoHeading'),
        modalInfoContent = $('#modalInfoContent');

    $('.openModalInfo').click(function() {
        let type    = $(this).data('type'),
            text    = $(this).html(),
            heading = null,
            content = null;

        switch(type) {
            case "contest" :
                heading = "Описание конкурса: " + $(this).parent().children('.content__header').html().toLowerCase();
                content = text;
                break;
            case "stage" :
                heading = "Описание этапа: " + $(this).parent().children('.stage__header').html().toLowerCase();
                content = text;
                break;
            case "criterion":
                heading = "Описание критерия";
                content = text;
                break;
        }

        modalInfoHeading.html(heading);
        modalInfoContent.html(content);

        $("#modalInfoBlock").modal();

    });


    /**
     * Checking Criterions By member
     * @param member
     */
    let isCriterionsValid = function (member, mod) {
        let status = true,
            name   = member.find('.member__name');

        member.find('.criterion__scores').each(function () {

            if ( $('.score__input:checked', this).val() === undefined ) {
                status = false;
                (mod !== "init") ? $(this).addClass('criterion__scores--invalid') : '';
            } else {
                $(this).removeClass('criterion__scores--invalid');
            }

        });

        (mod !== "init") ? status ? name.removeClass('member__name--invalid') : name.addClass('member__name--invalid') : '';

        return status;

    };



    /**
     * Submit Member Criterions On Click
     * - checking Validation
     * - close collapse
     */
    $('.criterion__submit-btn').click(function () {
        let member = $(this).closest('.member');

        if ( isCriterionsValid(member) ) {
            member.children('.member__header').click();
        }

    });


    /**
     * Checking if Next stage is allowed
     * TODO checking next stage by ID from `stageOriginId[curStageNum+1]`
     */
    let isStageAllowed = function (num) {
        if (num == 2)
            return false;

        return true;
    };


    /**
     * Checking if Next stage is DONE
     */
    let isStageDone = function (num, mod) {
        let status = true;

        $('[data-stagenumber="' + num + '"]').find('.member').each(function () {

            status ? status = isCriterionsValid($(this), mod) : isCriterionsValid($(this), mod);

        });

        return status;
    };



    /**
     * Prepare Stages
     * - get origin stage ID
     */
    let stageOriginId = [],
        curStage = null;

    if (vp.cookies.get('cur_stage')) {
        curStage = vp.cookies.get('cur_stage');
        if ( isStageAllowed(curStage + 1) && isStageDone(curStage, "init") ) {
            curStage = 0;
        }
    } else {
        curStage = 1;
        vp.cookies.set({
            name: 'cur_stage',
            value: 'current-stage~' + curStage ,
            path: '/',
            expires: 21600,
        })
    }

    $('.stage').each(function () {
        stageOriginId.push($(this).data('stageid'));

        if ( parseInt($(this).data('stagenumber')) === parseInt(curStage)) {
            $(this).addClass('fadeInRight');
        } else {
            $(this).addClass('fadeOutLeft hide');
        }
    });




    /**
     * Next Stage
     */
    let stageWaitingBlock = $('[data-stagenumber="0"]'),
        contestWaitingBlock = $('[data-contestnumber="0"]');


    $('.stage__submit-btn').click(function () {
        let curStageEl       = $(this).closest('.stage'),
            curStageNum      = parseInt(curStageEl.data('stagenumber')) === 0 ? parseInt(vp.cookies.get('cur_stage')) : parseInt(curStageEl.data('stagenumber')),
            nextStageAllowed = isStageAllowed(curStageNum + 1),
            stageValid       = isStageDone(curStageNum);

        if (!stageValid) {
            return;
        }

        if ( curStageEl.data('stagenumber') !== 0 ) {
            curStageEl.toggleClass('fadeInRight fadeOutLeft');
            addWithTimer(curStageEl, 'hide', 400);
        }

        if ( nextStageAllowed ) {
            $('[data-stagenumber="' + curStageNum + 1 + '"]').toggleClass('fadeInRight fadeOutLeft hide');
            vp.cookies.set({
                name: 'cur_stage',
                value: 'current-stage~' + parseInt(curStageNum + 1),
                path: '/',
                expires: 21600,
            });
            stageWaitingBlock.removeClass('fadeInRight');
            addWithTimer(stageWaitingBlock, 'fadeOutLeft hide', 400);
        } else {
            stageWaitingBlock.removeClass('fadeOutLeft hide');
            stageWaitingBlock.addClass('fadeInRight');
        }
        //$('body').animate({ scrollTop: 0 }, 600);
    });


    let addWithTimer = function (el, classnames, time) {
        setTimeout(function () {
            el.addClass(classnames);
        }, time);
    };



    setTimeout(function () {
        $('.loader').remove();
    },1000)


});