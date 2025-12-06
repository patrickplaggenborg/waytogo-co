(function ($) {
    'use strict';

    var portfolioList = {};
    edgtf.modules.portfolioList = portfolioList;

    portfolioList.edgtfOnWindowLoad = edgtfOnWindowLoad;
    portfolioList.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(window).on('load', edgtfOnWindowLoad);
    $(window).scroll(edgtfOnWindowScroll);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitPortfolioFilter();
        edgtfInitPortfolioListAnimation();
        edgtfInitPortfolioPagination().init();
        edgtfInitAdvancedPortfolioListHover();
        edgtfInitPortfolioJustifiedGallery();
        edgtfParallaxElements();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtfOnWindowScroll() {
        edgtfInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgtfInitPortfolioListAnimation() {
        var portList = $('.edgtf-portfolio-list-holder.edgtf-pl-has-animation');

        if (portList.length) {
            portList.each(function () {
                var thisPortList = $(this).children('.edgtf-pl-inner');

                thisPortList.children('article').each(function (l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function () {
                        thisArticle.addClass('edgtf-item-show');

                        setTimeout(function () {
                            thisArticle.addClass('edgtf-item-shown');
                        }, 1000);
                    }, {accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function edgtfInitPortfolioFilter() {
        var filterHolder = $('.edgtf-portfolio-list-holder .edgtf-pl-filter-holder');

        if (filterHolder.length) {
            filterHolder.each(function () {
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.edgtf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.edgtf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('edgtf-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.edgtf-pl-filter:first').addClass('edgtf-pl-current');

                if (thisPortListHolder.hasClass('edgtf-pl-gallery')) {
                    thisPortListInner.isotope();
                }

                thisFilterHolder.find('.edgtf-pl-filter').on('click', function () {
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.edgtf-pl-filter').removeClass('edgtf-pl-current');
                    thisFilter.addClass('edgtf-pl-current');

                    if (portListHasLoadMore && !portListHasArticles && filterValue.length) {
                        edgtfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        filterValue = filterValue.length === 0 ? '*' : filterValue;

                        thisFilterHolder.parent().children('.edgtf-pl-inner').isotope({filter: filterValue});
                        edgtf.modules.common.edgtfInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function edgtfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.edgtf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
            ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'galatia_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.edgtf-pl-loading');

        if (nextPage <= maxNumPages) {
            loadingItem.addClass('edgtf-showing edgtf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if (portListHasArticles) {
                            setTimeout(function () {
                                edgtf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.edgtf-masonry-grid-sizer').width(), true);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('edgtf-showing edgtf-filter-trigger');

                                setTimeout(function () {
                                    thisPortListInner.css('opacity', '1');
                                    edgtfInitPortfolioListAnimation();
                                    edgtf.modules.common.edgtfInitParallax();
                                    edgtfInitAdvancedPortfolioListHover();
                                    edgtfParallaxElements();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('edgtf-showing edgtf-filter-trigger');
                            edgtfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }

    /**
     * Initializes portfolio pagination functions
     */
    function edgtfInitPortfolioPagination() {
        var portList = $('.edgtf-portfolio-list-holder');

        var initStandardPagination = function (thisPortList) {
            var standardLink = thisPortList.find('.edgtf-pl-standard-pagination li');

            if (standardLink.length) {
                standardLink.each(function () {
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisPortList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function (thisPortList) {
            var loadMoreButton = thisPortList.find('.edgtf-pl-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisPortList);
            });
        };

        var initInifiteScrollPagination = function (thisPortList) {
            var portListHeight = thisPortList.outerHeight(),
                portListTopOffest = thisPortList.offset().top,
                portListPosition = portListHeight + portListTopOffest - edgtfGlobalVars.vars.edgtfAddForAdminBar;

            if (!thisPortList.hasClass('edgtf-pl-infinite-scroll-started') && edgtf.scroll + edgtf.windowHeight > portListPosition) {
                initMainPagFunctionality(thisPortList);
            }
        };

        var initMainPagFunctionality = function (thisPortList, pagedLink) {
            var thisPortListInner = thisPortList.find('.edgtf-pl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
                maxNumPages = thisPortList.data('max-num-pages');
            }

            if (thisPortList.hasClass('edgtf-pl-pag-standard')) {
                thisPortList.data('next-page', pagedLink);
            }

            if (thisPortList.hasClass('edgtf-pl-pag-infinite-scroll')) {
                thisPortList.addClass('edgtf-pl-infinite-scroll-started');
            }

            var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisPortList),
                loadingItem = thisPortList.find('.edgtf-pl-loading'),
                loadMore = thisPortList.find('.edgtf-pl-load-more-holder');

            nextPage = loadMoreDatta.nextPage;

            if (nextPage <= maxNumPages || maxNumPages === 0) {
                if (thisPortList.hasClass('edgtf-pl-pag-standard')) {
                    loadingItem.addClass('edgtf-showing edgtf-standard-pag-trigger');
                    thisPortList.addClass('edgtf-pl-pag-standard-animate');
                } else {
                    loadingItem.addClass('edgtf-showing');
                }
                if (loadMore.length) {
                    loadMore.addClass('edgtf-hidden');
                }

                var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'galatia_core_portfolio_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                    success: function (data) {
                        if (!thisPortList.hasClass('edgtf-pl-pag-standard')) {
                            nextPage++;
                        }

                        thisPortList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        if (thisPortList.hasClass('edgtf-pl-pag-standard')) {
                            edgtfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);

                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('edgtf-pl-masonry')) {
                                    edgtfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                } else if (thisPortList.hasClass('edgtf-pl-gallery') && thisPortList.hasClass('edgtf-pl-has-filter')) {
                                    edgtfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                } else {
                                    edgtfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                }
                            });
                        } else {
                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('edgtf-pl-masonry')) {
                                    if (pagedLink === 1) {
                                        edgtfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                    } else {
                                        edgtfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                    }
                                } else if (thisPortList.hasClass('edgtf-pl-gallery') && thisPortList.hasClass('edgtf-pl-has-filter') && pagedLink !== 1) {
                                    edgtfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                } else {
                                    if (pagedLink === 1) {
                                        edgtfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore);
                                    } else {
                                        edgtfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml, loadMore);
                                    }
                                }
                            });
                        }

                        if (thisPortList.hasClass('edgtf-pl-infinite-scroll-started')) {
                            thisPortList.removeClass('edgtf-pl-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisPortList.find('.edgtf-pl-load-more-holder').hide();
            }
        };

        var edgtfInitStandardPaginationLinkChanges = function (thisPortList, maxNumPages, nextPage) {
            var standardPagHolder = thisPortList.find('.edgtf-pl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.edgtf-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.edgtf-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.edgtf-pag-next a');

            standardPagNumericItem.removeClass('edgtf-pag-active');
            standardPagNumericItem.eq(nextPage - 1).addClass('edgtf-pag-active');

            standardPagPrevItem.data('paged', nextPage - 1);
            standardPagNextItem.data('paged', nextPage + 1);

            if (nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if (nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var edgtfInitHtmlIsotopeNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            edgtf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.edgtf-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
            thisPortList.removeClass('edgtf-pl-pag-standard-animate');
            if (loadMore.length) {
                loadMore.removeClass('edgtf-hidden');
            }

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                edgtfInitPortfolioListAnimation();
                edgtf.modules.common.edgtfInitParallax();
                edgtf.modules.common.edgtfPrettyPhoto();
                edgtfInitAdvancedPortfolioListHover();
                edgtfParallaxElements();
            }, 1500);
        };

        var edgtfInitHtmlGalleryNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore) {
            loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
            thisPortList.removeClass('edgtf-pl-pag-standard-animate');
            thisPortListInner.html(responseHtml);
            edgtfInitPortfolioListAnimation();
            edgtf.modules.common.edgtfInitParallax();
            edgtf.modules.common.edgtfPrettyPhoto();
            edgtfInitAdvancedPortfolioListHover();
            edgtfParallaxElements();
            if (loadMore.length) {
                loadMore.removeClass('edgtf-hidden');
            }
        };

        var edgtfInitAppendIsotopeNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml, loadMore) {
            thisPortListInner.append(responseHtml);
            edgtf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.edgtf-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('edgtf-showing');
            if (loadMore.length) {
                loadMore.removeClass('edgtf-hidden')
            }

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                edgtfInitPortfolioListAnimation();
                edgtf.modules.common.edgtfInitParallax();
                edgtf.modules.common.edgtfPrettyPhoto();
                edgtfInitAdvancedPortfolioListHover();
                edgtfParallaxElements();
            }, 1500);
        };

        var edgtfInitAppendGalleryNewContent = function (thisPortListInner, loadingItem, responseHtml, loadMore) {
            loadingItem.removeClass('edgtf-showing');
            thisPortListInner.append(responseHtml);
            edgtfInitPortfolioListAnimation();
            edgtf.modules.common.edgtfInitParallax();
            edgtf.modules.common.edgtfPrettyPhoto();
            edgtfInitAdvancedPortfolioListHover();
            edgtfParallaxElements();
            if (loadMore.length) {
                loadMore.removeClass('edgtf-hidden')
            }
        };

        return {
            init: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('edgtf-pl-pag-standard')) {
                            initStandardPagination(thisPortList);
                        }

                        if (thisPortList.hasClass('edgtf-pl-pag-load-more')) {
                            initLoadMorePagination(thisPortList);
                        }

                        if (thisPortList.hasClass('edgtf-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            scroll: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('edgtf-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            getMainPagFunction: function (thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
        };
    }

    function edgtfInitAdvancedPortfolioListHover() {
        var portfolioLists = $('.edgtf-portfolio-list-holder');

        portfolioLists.each(function () {
            portfolioList = $(this);

            if (portfolioList.hasClass('edgtf-pl-with-advanced-hover')) {
                var canvasImgHolder = portfolioList.find('.edgtf-pli-image');

                if (canvasImgHolder.length) {
                    canvasImgHolder.each(function () {
                        var thisCanvasImgHolder = $(this),
                            canvas = thisCanvasImgHolder.find('canvas'), //check if canvas is already initialized so we can skip already initialized articles due to load more duplicate
                            alreadyHasCanvas = canvas.length ? true : false;

                        if( ! alreadyHasCanvas ){
                            edgtfGenerateCanvasOutput(thisCanvasImgHolder, thisCanvasImgHolder);
                        }
                    });
                }
            }
        });
    }

    function edgtfGenerateCanvasOutput(canvas, canvasHolder) {

        var displacementSprite, displacementFilter, repaint;

        var image_src = canvas.data('src');
        var canvas_width = canvas.data('width');
        var canvas_height = canvas.data('height');

        var app_img = new PIXI.Application(canvas_width, canvas_height, {transparent: true});
        canvas.append(app_img.view);

        app_img.stage.interactive = true;

        var stage = new PIXI.Container();
        var loader = new PIXI.loaders.Loader();
        loader.reset();

        app_img.stage.addChild(stage);

        var canvas_img = new PIXI.Sprite(
            PIXI.Texture.fromImage(image_src)
        );

        canvas_img.alpha = 1;
        loader.add(image_src);
        var img = new Image();
        img.src = image_src;

        img.onload = function () {
            canvas_img.width = canvas_width + 10;
            canvas_img.height = canvas_height;
            canvas_img.x = -5;
            canvasHolder.addClass('edgtf-initialized');
        };

        function animate_img() {
            displacementSprite.rotation += 0.001;
            repaint = requestAnimationFrame(animate_img);
        }

        app_img.view.addEventListener('mouseover', function () {
            displacementSprite = PIXI.Sprite.fromImage(edgtfGlobalVars.vars.templateUrl + '/assets/img/portfolio-hover-pattern.jpg');
            displacementSprite.texture.baseTexture.wrapMode = PIXI.WRAP_MODES.REPEAT;
            displacementFilter = new PIXI.filters.DisplacementFilter(displacementSprite);
            stage.addChild(displacementSprite);
            stage.filters = [displacementFilter];
            displacementFilter.scale.x = 0;
            displacementFilter.scale.y = 0;
            TweenLite.to(displacementFilter.scale, 2, {x: 50});
            animate_img();
        });

        app_img.view.addEventListener('mouseleave', function () {
            TweenLite.to(displacementFilter.scale, 1, {x: 0});
            cancelAnimationFrame(repaint);
        });

        stage.addChild(canvas_img);

    }

    /**
     * Initializes portfolio list justified gallery
     */
    function edgtfInitPortfolioJustifiedGallery() {
        var portLists = $('.edgtf-portfolio-list-holder.edgtf-pl-justified-gallery');

        if (portLists.length) {
            portLists.each(function () {
                var portList = $(this),
                    spacing = typeof portList.data('space-value') !== 'undefined' ? portList.data('space-value') : 0,
                    rowHeight = typeof portList.data('row-height') !== 'undefined' ? portList.data('row-height') : 200,
                    lastRow = typeof portList.data('last-row') !== 'undefined' ? portList.data('last-row') : 'nojustify',
                    justifyThreshold = typeof portList.data('justify-threshold') !== 'undefined' ? portList.data('justify-threshold') : 0.1;
                var thisPortList = portList.children('.edgtf-pl-inner');

                thisPortList.waitForImages(function () {
                    thisPortList.justifiedGallery({
                        captions: false,
                        rowHeight: rowHeight,
                        margins: spacing,
                        border: 0,
                        lastRow: lastRow,
                        justifyThreshold: justifyThreshold,
                        selector: '> article'
                    }).on('jg.complete jg.rowflush', function () {
                        var deducted = false;
                        thisPortList.find('article').addClass('show').each(function () {
                            $(this).height(Math.round($(this).height()));
                            if (!deducted && $(this).width() === 0) {
                                thisPortList.height(thisPortList.height() - $(this).height() - spacing);
                                deducted = true;
                            }
                        });
                    });
                    /*initPLJustifiedGalleryFilter(portList, thisPortList, false);*/
                    portList.css('opacity', '1');
                });
            });
        }
    }

    /**
     * Parallax Elements Instances
     */
    function edgtfParallaxElements() {
        var parallaxElements = $('.edgtf-pl-has-parallax .edgtf-pl-item-inner');

        if (parallaxElements.length && !edgtf.htmlEl.hasClass('touch')) {
            parallaxElements.each(function () {
                var parallaxElement = $(this),
                    randCoeff = (Math.floor(Math.random() * 2) + 1) * 0.1,
                    delta = -Math.round(parallaxElement.height() * randCoeff),
                    dataParallax = '{"y":' + delta + ', "smoothness":20}';

                parallaxElement.attr('data-parallax', dataParallax);
            });

            setTimeout(function () {
                ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
            }, 100); //wait for calcs
        }
    }

})(jQuery);