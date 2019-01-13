(function (win, $) {

    'use strict';

    /**
     * init()
     */
    var init = function () {
        $('.js-btn-action, .js-btn-remove').each(function () {
            var $this = $(this),
                url = $this.data('url'),
                refresh = $this.data('refresh'),
                question = $this.data('question');

            $this.click(function (ev) {
                ev.preventDefault();
                if (win.confirm(question)) {
                    $.post(url)
                        .done(function () {
                            if (typeof refresh === 'undefined') {
                                win.location.reload(true);
                            } else {
                                win.location.assign(refresh);
                            }
                        });
                }
            });
        });

        $('.js-nav-tab-default').each(function () {
            var $this = $(this);
            $this.click(function (ev) {
                ev.preventDefault();
                $(this).tab('show');
            });
        });
    };

    /**
     * Main process
     */
    init();

    return {
        init: init
    };

}(window, jQuery));
