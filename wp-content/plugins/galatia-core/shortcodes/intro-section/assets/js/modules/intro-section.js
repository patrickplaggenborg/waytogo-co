(function ($) {
    'use strict';

    var introSection = {};

    edgtf.modules.introSection = introSection;
    introSection.edgtfIntroSection = edgtfIntroSection;
    introSection.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfIntroSection().init();
    }

    /**
     * Intro Section object that initializes intro section animations
     * @type {Function}
     */
    var edgtfIntroSection = function () {
        var introSection = $('#edgtf-intro-section'),
            params = {
                start: 1.3,
                end: 1.5
            };

        var zIndexes = function () {
            introSection
                .closest('.vc_row')
                .siblings().length
            &&
            introSection
                .closest('.vc_row')
                .siblings()
                .css({
                    'position': 'relative',
                    'z-index': 10
                });
        }

        var updateParams = function () {
            params.y = introSection.offset().top;
            params.h = introSection.outerHeight();
        }

        var setSizes = function () {
            var bgHolder = $('.edgtf-is-bg-wrapper');

            bgHolder.css({
                'top': params.y + 'px',
                'height': params.h + 'px'
            });
        }

        var scrollAnimation = function () {
            var buffer = 0,
                contentW = $('.edgtf-is-content-wrapper'),
                content = $('.edgtf-is-content');

            var scrollDirection = function () {
                params.downwards = edgtf.scroll >= buffer ? true : false;
                buffer = edgtf.scroll;
            }

            var fadeBg = function () {
                if(edgtf.body.hasClass('page-template-coming-soon-page')) {
                    if (params.downwards && edgtf.scroll + edgtf.windowHeight / 3 >=
                        params.y + params.h * params.start && !introSection.hasClass('edgtf-fade-bg')) {
                        introSection.addClass('edgtf-fade-bg');
                    } else if (!params.downwards && edgtf.scroll + edgtf.windowHeight / 3 <=
                        params.y + params.h * params.start && introSection.hasClass('edgtf-fade-bg')) {
                        introSection.removeClass('edgtf-fade-bg');
                    }
                } else{
                    if (params.downwards && edgtf.scroll + 1.2 * edgtf.windowHeight >=
                        params.y + params.h * params.start && !introSection.hasClass('edgtf-fade-bg')) {
                        introSection.addClass('edgtf-fade-bg');
                    } else if (!params.downwards && edgtf.scroll + 1.2 * edgtf.windowHeight <=
                        params.y + params.h * params.start && introSection.hasClass('edgtf-fade-bg')) {
                        introSection.removeClass('edgtf-fade-bg');
                    }
                }
            }

            var fadeContent = function () {
                var cW = {
                    y: contentW.offset().top,
                    h: contentW.height()
                }

                var c = cW.y <= params.y + params.h / 2 ? (cW.y - params.y) / 2 : params.y + params.h / 2;

                if (edgtf.scroll >= c &&
                    edgtf.scroll < cW.y + cW.h) {
                    var coeff = (edgtf.scroll - c) / (cW.y + cW.h - c);

                    coeff = Math.min(coeff, 1);
                    coeff = Math.max(coeff, 0);

                    var opacityVal = 1 - coeff.toFixed(2),
                        yVal = !Modernizr.touch ? coeff * 50 : 0;

                    content.css({
                        'opacity': opacityVal,
                        'transform': 'translate3d(0px, ' + yVal + '%, 0px)'
                    });
                }

                edgtf.scroll === 0 && content.css({'opacity': 1, 'transform': 'translate3d(0px, 0%, 0px)'});
            }

            $(window).on('scroll', function () {
                scrollDirection();
                fadeBg();
                fadeContent();
            });
        }

        return {
            init: function () {
                if (introSection.length) {
                    zIndexes();
                    scrollAnimation();
                    introSection.waitForImages(function () {
                        updateParams();
                        setSizes();
                    });
                    $(window).on('resize', function () {
                        updateParams();
                        setSizes();
                    });
                }
            }
        }
    };
})(jQuery);