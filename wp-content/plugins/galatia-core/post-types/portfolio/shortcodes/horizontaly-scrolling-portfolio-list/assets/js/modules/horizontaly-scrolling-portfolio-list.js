(function ($) {
    'use strict';

    var horizontalyScrollingPortfolioList = {};
    edgtf.modules.horizontalyScrollingPortfolioList = horizontalyScrollingPortfolioList;

    horizontalyScrollingPortfolioList.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitHorizontalyScrollingPortfolioList();
    }

    function edgtfInitHorizontalyScrollingPortfolioList() {
        var list = $('.edgtf-horizontaly-scrolling-portfolio-holder');

        if (list.length && edgtf.windowWidth >= 768) {
            var listInner = list.find('.edgtf-hspl-inner'),
                items = list.find('.edgtf-hspl-item'),
                marginHolder = list.find('.edgtf-hspl-margin-holder'),
                customItem = list.find('.edgtf-hspl-custom'),
                listWidth = 0,
                widthVal = 412,
                customItemWidth = 0,
                decreaseHeightHeader = list.data('header-decrease'),
                decreaseHeightContentBottom = list.data('content-bottom-decrease');

            var widthCalcs = function () {
                //custom sizing
                if (edgtf.windowWidth <= 1440 && edgtf.windowWidth > 1280) {
                    if (edgtf.windowHeight <= 645) {
                        widthVal = 412;
                    } else {
                        widthVal = 412;
                    }
                } else if (edgtf.windowWidth <= 1280 && edgtf.windowWidth > 1024) {
                    widthVal = 412;
                } else if (edgtf.windowWidth <= 1024 && edgtf.windowWidth > 768) {
                    widthVal = 412;
                } else if (edgtf.windowWidth === 768) {
                    widthVal = 390;
                } else {
                    widthVal = 412;
                }

                listWidth = 0;
                if (customItem.length) {
                    if (edgtf.windowWidth > 1444) {
                        customItemWidth = parseInt(2.1 * widthVal);
                    } else if (edgtf.windowWidth > 1024) {
                        customItemWidth = parseInt(1.53 * widthVal);
                    } else {
                        customItemWidth = widthVal;
                    }
                    customItem.width(customItemWidth);
                    listInner.css('marginLeft', customItemWidth + 'px'); //set slider left margin only if there is custom element which is static
                    listInner.css('paddingRight', customItemWidth + 'px'); //set slider left margin only if there is custom element which is static
                }
                items.each(function () {
                    var item = $(this),
                        itemWidth = widthVal;

                    listWidth += itemWidth;
                    item.width(itemWidth);
                });
                if (edgtf.htmlEl.hasClass('touch')) {
                    listWidth += customItemWidth;
                }
                listInner.width(listWidth);
            }

            var heightCalcs = function () {
                var height = edgtf.windowHeight;
            }

            heightCalcs();
            widthCalcs();

            if (edgtf.body.hasClass('edgtf-smooth-page-transitions-preloader')) {
                $(document).on('edgtfLoaderRemoved', function () {
                    listInner.addClass('edgtf-ready');
                });
            } else {
                listInner.addClass('edgtf-ready');
            }

            $(window).resize(function () {
                heightCalcs();
                widthCalcs();
            });

            console.log(edgtf.htmlEl.hasClass('touch'));
            console.log(edgtf.windowWidth);

            if (edgtf.htmlEl.hasClass('touch')) {
                if( edgtf.windowWidth >= 768 ) {
                    //custom horizontal touch nav using hammer
                    var section = document.querySelector('.edgtf-hspl-inner'),
                        $section = $('.edgtf-hspl-inner'),
                        sectionH = new Hammer(section),
                        transformVal = 0;

                    var moveContent = function (delta) {
                        $section.css('transform', 'translate3d(' + delta + 'px, 0, 0)')
                    }

                    sectionH.on("swipe", function (ev) {
                        if (ev.deltaX > 0) {
                            transformVal += ev.distance;
                            transformVal = Math.min(0, transformVal);
                        } else {
                            transformVal -= ev.distance;
                            transformVal = -Math.min(listWidth - $section.parent().width() - parseInt($section.find('article:last-child').css('margin-right')), Math.abs(transformVal));
                        }

                        moveContent(transformVal);
                    });

                    $(window).on('resize', function () {
                        //prevent overscroll
                        if (Math.abs(transformVal) >= listWidth - $section.parent().width() - parseInt($section.find('article:last-child').css('margin-right'))) {
                            moveContent(-listWidth + $section.parent().width() + parseInt($section.find('article:last-child').css('margin-right')));
                        }
                    });
                } else{
                    console.log('here');
                }
            } else {
                //custom smooth horizontal scroll using virtual scroll
                var section = document.querySelector('.edgtf-hspl-inner'),
                    sectionWidth = section.getBoundingClientRect().width,
                    targetX = 0,
                    currentX = 0,
                    ease = 0.08,
                    coeff = parseInt(list.parent().css('paddingLeft')) * 2
                        - parseInt(window.getComputedStyle(section.querySelector('article:last-child')).marginRight); //adj.

                edgtf.htmlEl
                    .add(edgtf.body)
                    .addClass('edgtf-overflow-hidden');

                edgtf.modules.common.edgtfDisableScroll();

                window.addEventListener('resize', function () {
                    coeff = parseInt(list.parent().css('paddingLeft')) * 2
                        - parseInt(window.getComputedStyle(section.querySelector('article:last-child')).marginRight);
                    sectionWidth = section.getBoundingClientRect().width;
                })

                VirtualScroll.on(function (e) {
                    targetX += e.deltaY;
                    targetX = Math.max((sectionWidth - window.innerWidth + coeff) * -1, targetX);
                    targetX = Math.min(0, targetX);
                });

                var changeFixedLogoOnMouseMove = function () {
                    if (edgtf.body.hasClass('edgtf-fixed-only-logo') && edgtf.body.hasClass('edgtf-with-uploaded-fixed-logo')) {

                        var x1 = 0,
                            y1 = 0,
                            x2,
                            y2,
                            counter = 0;

                        $(document).on('mousemove', function (e) {
                            x2 = e.clientX;
                            y2 = e.clientY;
                        });

                        setInterval(function () {
                            counter++;
                            var mouseMoved = (x1 !== x2 && y1 !== y2); //check if mouse has changed position

                            if (counter > 1 && mouseMoved) { //counter is there to prevent changing logo in first iteration since coordinates will always be different
                                edgtf.body.addClass('edgtf-mouse-is-moving');
                                edgtf.body.removeClass('edgtf-mouse-is-idle');
                            } else {
                                edgtf.body.addClass('edgtf-mouse-is-idle');
                                edgtf.body.removeClass('edgtf-mouse-is-moving');
                            }
                            x1 = x2;
                            y1 = y2;
                        }, 200);
                    }
                }

                var changeFixedLogoOnScroll = function (targetX, currentX) {
                    var scrollOffset = Math.abs(targetX - currentX);

                    if (scrollOffset < 5) {
                        edgtf.body.addClass('edgtf-slider-is-idle');
                        edgtf.body.removeClass('edgtf-slider-is-moving');
                    } else {
                        edgtf.body.addClass('edgtf-slider-is-moving');
                        edgtf.body.removeClass('edgtf-slider-is-idle');
                    }
                }

                var customContentFadeout = function (currentX) {
                    if (customItem.length) {
                        var customItemContent = customItem.find('.edgtf-hspl-custom-content'),
                            delta = Math.abs(currentX),
                            customItemWidth = customItem.outerWidth(),
                            indent = 2 * customItemWidth / 3;

                        if (delta <= indent) {
                            var offset = 1 - delta / indent;
                            customItemContent.css('opacity', offset);
                        } else {
                            customItemContent.css('opacity', 0);
                        }

                    }
                }

                var performScroll = function () {
                    requestAnimationFrame(performScroll);
                    //changeFixedLogoOnMouseMove();
                    changeFixedLogoOnScroll(targetX, currentX);
                    customContentFadeout(currentX);
                    currentX += (targetX - currentX) * ease;
                    var t = 'translate3d(' + currentX + 'px, 0px, 0px)';
                    var s = section.style;
                    s["transform"] = t;
                    s["webkitTransform"] = t;
                    s["mozTransform"] = t;
                    s["msTransform"] = t;
                }

                performScroll();
            }
        }
    }
})(jQuery);