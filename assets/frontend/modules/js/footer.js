module.exports = (function (footer) {

    var footerWrapper = null,
        wrapper       = null,
        section       = null;

    function prepare_() {

        footerWrapper = document.getElementsByClassName('footer');
        wrapper       = document.getElementsByClassName('wrapper');
        section       = document.getElementsByClassName('section');

        footerWrapper = footerWrapper.length > 0 ? footerWrapper[0] : null;
        wrapper       = wrapper.length > 0 ? wrapper[0] : null;
        section       = section.length > 0 ? section[0] : null;

        if (footerWrapper === null || wrapper === null || section === null) return;

        checkAndMakeFixed_();
        window.onresize = function () {

            checkAndMakeFixed_();

        };

    }

    function checkAndMakeFixed_() {

        if (wrapper.offsetHeight > section.offsetHeight + 70 + footerWrapper.offsetHeight) {

            footerWrapper.classList.add('footer--fixed');

        } else {

            footerWrapper.classList.remove('footer--fixed');

        }

    }

    footer.init = function () {

        prepare_();

    };

    return footer;


})({});
