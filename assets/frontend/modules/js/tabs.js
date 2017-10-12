/**
 * Tabs Module - Usage
 *
 * On Tab button add
 * - `data-toggle="tabs"`
 * - `data-area="tabs-block-id"` - ID of tabs block
 */


module.exports = (function (tabs) {

    var tabsArray   = null,
        corePrefix  = 'VP: tabs module',
        nodes       = [];

    var prepare_ = function (options) {

        tabsArray = document.querySelectorAll('[data-toggle="tabs"]');

        if (tabsArray !== null) {

            for (var i = 0; i < tabsArray.length; i++) {

                var area = document.getElementById(tabsArray[i].dataset.area);

                if (!area) {

                    vp.core.log('Could not catch element by `data-area` attribute');

                } else {

                    tabsArray[i].addEventListener('click', changeTab, false);

                }

            }

        }


    };

    var changeTab = function () {

        var curTab    = this,
            tabsBlock = curTab.closest('.ui-tabs'),
            oldTab    = tabsBlock.getElementsByClassName('ui-tabs__tab--active')[0];

        if (oldTab) {

            oldTab.classList.remove('ui-tabs__tab--active');
            document.getElementById(oldTab.dataset.area).classList.add('hide');

        }

        curTab.classList.add('ui-tabs__tab--active');
        document.getElementById(curTab.dataset.area).classList.remove('hide');

    };

    tabs.init = function (options) {

        prepare_(options);

    };

    return tabs;

})({});