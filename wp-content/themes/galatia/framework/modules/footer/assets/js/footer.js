(function ($) {
    "use strict";

    var footer = {};
    edgtf.modules.footer = footer;

    footer.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).on('load', edgtfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */

    function edgtfOnWindowLoad() {
        edgtfUncoveringFooter();
    }

    function edgtfUncoveringFooter() {
        var uncoverFooter = $('body:not(.error404) .edgtf-footer-uncover');

        if (uncoverFooter.length && !edgtf.htmlEl.hasClass('touch')) {
            var footer = $('footer'),
                footerHeight = footer.find('.edgtf-footer-inner').outerHeight(),
                content = $('.edgtf-content');

            var uncoveringCalcs = function () {
                content.css('margin-bottom', footerHeight);
                footer.css('height', footerHeight);
            };

            //set
            uncoveringCalcs();
            footer.css('visibility', 'visible');

            $(window).resize(function () {
                //recalc
                footerHeight = footer.find('.edgtf-footer-inner').outerHeight();
                uncoveringCalcs();
            });

            //content appear fx
            var footerContentAppearFx = function () {
                var footerTop = footer.find('.edgtf-footer-top-holder'),
                    footerBottom = footer.find('.edgtf-footer-bottom-holder'),
                    footerColumns = footer.find('.edgtf-column-content'),
                    correctiveFactor,
                    marginOffset = parseInt(content.css('margin-top')),
                    opacityReset = false,
                    endOfPage = false;

                if (footerBottom.length) {
                    correctiveFactor = parseInt(footerBottom.css('padding-bottom'));
                } else {
                    correctiveFactor = parseInt(footerTop.css('padding-bottom'));
                }

                var animateFooterContent = function () {
                    if (edgtf.scroll + edgtf.windowHeight + marginOffset >= content.offset().top + content.height() + correctiveFactor) {
                        var start = content.offset().top + content.height() + correctiveFactor,
                            end = start + footerHeight - correctiveFactor,
                            scroll = edgtf.scroll + edgtf.windowHeight,
                            delta = (scroll - start) / (end - start);

                        opacityReset = false;

                        if (!endOfPage) {
                            footerColumns.addClass('edgtf-showing');
                            footerColumns.css({
                                'opacity': delta
                            });
                        } else {
                            footerColumns.css({
                                'opacity': 1
                            });
                        }

                    } else {
                        if (!opacityReset) {
                            opacityReset = true;
                            footerColumns.removeClass('edgtf-showing');
                            footerColumns.css({
                                'opacity': 0
                            });
                        }
                    }

                    if (edgtf.scroll + edgtf.windowHeight === $(document).height()) {
                        endOfPage = true;
                    } else {
                        endOfPage = false;
                    }
                }

                $(window).scroll(function () {
                    animateFooterContent();
                });
            };

            footerContentAppearFx();
        }
    }

})(jQuery);