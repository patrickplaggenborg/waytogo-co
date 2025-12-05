(function ($) {
	'use strict';

	var portfolio = {};
	edgtf.modules.portfolio = portfolio;

	portfolio.edgtfOnWindowLoad = edgtfOnWindowLoad;

	$(window).on('load', edgtfOnWindowLoad);

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfPortfolioSingleFollow().init();
		edgtfPortfolioAdvancedScrollLink();
		edgtfPortfolioAdvancedFX();
		edgtfAdvancedPortfolioLoadingImage();
	}

	function edgtfPortfolioAdvancedFX() {
		var advancedLayout = $('.edgtf-ps-advanced-layout');

		var animateContent = function () {
			var info = $('.edgtf-ps-single-additional-info-section');

			info.appear(function () {
				info.addClass('edgtf-uncover')
			},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
		}

		advancedLayout.length &&
			!Modernizr.touch &&
			animateContent();
	}

	function edgtfPortfolioAdvancedScrollLink() {
		var advancedSingles = $('.edgtf-ps-advanced-layout');

		if (advancedSingles.length) {
			advancedSingles.each(function () {
				var advancedSingle = $(this),
					scrollLinkTrigger = advancedSingle.find('.edgtf-ps-intro-scroll-link-trigger'),
					sectionToScroll = advancedSingle.find('.edgtf-ps-single-additional-info'),
					sectionToScrollTopOffset = sectionToScroll.offset().top;

				scrollLinkTrigger.on('click', function () {
					$('html, body').animate({
						scrollTop: sectionToScrollTopOffset
					}, 1000);
				});
			})
		}
	}

	var edgtfPortfolioSingleFollow = function () {
		var info = $('.edgtf-follow-portfolio-info .edgtf-portfolio-single-holder .edgtf-ps-info-sticky-holder');

		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.edgtf-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .edgtf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				constant = 30; //30 to prevent mispositioned
		}

		var infoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				if (edgtf.scroll >= infoHolderOffset - headerHeight - edgtfGlobalVars.vars.edgtfAddForAdminBar - constant) {
					var marginTop = edgtf.scroll - infoHolderOffset + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight + constant;
					// if scroll is initially positioned below mediaHolderHeight
					if (marginTop + infoHolderHeight > mediaHolderHeight) {
						marginTop = mediaHolderHeight - infoHolderHeight + constant;
					}
					info.stop().animate({
						marginTop: marginTop
					});
				}
			}
		};

		var recalculateInfoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				//Calculate header height if header appears
				if (edgtf.scroll > 0 && header.length) {
					headerHeight = header.height();
				}

				var headerMixin = headerHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar + constant;
				if (edgtf.scroll >= infoHolderOffset - headerMixin) {
					if (edgtf.scroll + infoHolderHeight + headerMixin + 2 * constant < infoHolderOffset + mediaHolderHeight) {
						info.stop().animate({
							marginTop: (edgtf.scroll - infoHolderOffset + headerMixin + 2 * constant)
						});
						//Reset header height
						headerHeight = 0;
					} else {
						info.stop().animate({
							marginTop: mediaHolderHeight - infoHolderHeight
						});
					}
				} else {
					info.stop().animate({
						marginTop: 0
					});
				}
			}
		};

		return {
			init: function () {
				infoHolderPosition();
				$(window).scroll(function () {
					recalculateInfoHolderPosition();
				});
			}
		};
	};

	function edgtfAdvancedPortfolioLoadingImage(){
		var introSection = $('.edgtf-portfolio-single-holder.edgtf-ps-advanced-layout .edgtf-ps-single-intro-section'),
			introTitle = $('.edgtf-ps-single-intro-title-holder');

		if(introSection.length){
			introSection.each(function(){
				var thisSection = $(this);

				thisSection.waitForImages(function(){
					thisSection.addClass('edgtf-loaded');
                    introTitle.addClass('edgtf-loaded-title');
				});
			})
		}
	}

})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	edgtf.modules.accordions = accordions;
	
	accordions.edgtfInitAccordions = edgtfInitAccordions;
	
	
	accordions.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function edgtfInitAccordions(){
		var accordion = $('.edgtf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('edgtf-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edgtf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.edgtf-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);

						thisTitle.on('mouseenter mouseleave', function () {
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	edgtf.modules.animationHolder = animationHolder;
	
	animationHolder.edgtfInitAnimationHolder = edgtfInitAnimationHolder;
	
	
	animationHolder.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgtfInitAnimationHolder(){
		var elements = $('.edgtf-grow-in, .edgtf-fade-in-down, .edgtf-element-from-fade, .edgtf-element-from-left, .edgtf-element-from-right, .edgtf-element-from-top, .edgtf-element-from-bottom, .edgtf-flip-in, .edgtf-x-rotate, .edgtf-z-rotate, .edgtf-y-translate, .edgtf-fade-in, .edgtf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	edgtf.modules.button = button;
	
	button.edgtfButton = edgtfButton;
	
	
	button.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var edgtfButton = function() {
		//all buttons on the page
		var buttons = $('.edgtf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function ($) {
	'use strict';
	
	var cardsGallery = {};
	edgtf.modules.cardsGallery = cardsGallery;
	
	
	cardsGallery.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(window).on('load', edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfInitCardsGallery();
	}
	
	/*
	 **	Init cards gallery shortcode
	 */
	function edgtfInitCardsGallery() {
		var holder = $('.edgtf-cards-gallery');
		
		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					cards = thisHolder.find('.edgtf-cg-card');
				
				cards.each(function () {
					var card = $(this);
					
					card.on('click', function () {
						if (!cards.last().is(card)) {
							card.addClass('edgtf-out edgtf-animating').siblings().addClass('edgtf-animating-siblings');
							card.detach();
							card.insertAfter(cards.last());
							
							setTimeout(function () {
								card.removeClass('edgtf-out');
							}, 200);
							
							setTimeout(function () {
								card.removeClass('edgtf-animating').siblings().removeClass('edgtf-animating-siblings');
							}, 1200);
							
							cards = thisHolder.find('.edgtf-cg-card');
							
							return false;
						}
					});
				});
				
				if (thisHolder.hasClass('edgtf-bundle-animation') && !edgtf.htmlEl.hasClass('touch')) {
					thisHolder.appear(function () {
						thisHolder.addClass('edgtf-appeared');
						thisHolder.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
							$(this).addClass('edgtf-animation-done');
						});
					}, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	edgtf.modules.countdown = countdown;
	
	countdown.edgtfInitCountdown = edgtfInitCountdown;
	
	
	countdown.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function edgtfInitCountdown() {
		var countdowns = $('.edgtf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	edgtf.modules.counter = counter;
	
	counter.edgtfInitCounter = edgtfInitCounter;
	
	
	counter.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function edgtfInitCounter() {
		var counterHolder = $('.edgtf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edgtf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edgtf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	edgtf.modules.customFont = customFont;
	
	customFont.edgtfCustomFontResize = edgtfCustomFontResize;
	customFont.edgtfCustomFontTypeOut = edgtfCustomFontTypeOut;
	
	
	customFont.edgtfOnDocumentReady = edgtfOnDocumentReady;
	customFont.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(document).ready(edgtfOnDocumentReady);
	$(window).on('load', edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function edgtfCustomFontResize() {
		var holder = $('.edgtf-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.edgtf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.edgtf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.edgtf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function edgtfCustomFontTypeOut() {
		var edgtfTyped = $('.edgtf-cf-typed');
		
		if (edgtfTyped.length) {
			edgtfTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.edgtf-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.edgtf-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.edgtf-cf-typed-1').text(),
					string_2 = thisTyped.find('.edgtf-cf-typed-2').text(),
					string_3 = thisTyped.find('.edgtf-cf-typed-3').text(),
					string_4 = thisTyped.find('.edgtf-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var elementsHolder = {};
	edgtf.modules.elementsHolder = elementsHolder;

	elementsHolder.edgtfInitElementsHolderResponsiveStyle = edgtfInitElementsHolderResponsiveStyle;


	elementsHolder.edgtfOnDocumentReady = edgtfOnDocumentReady;

	$(document).ready(edgtfOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitElementsHolderResponsiveStyle();
	}

	/*
	 **	Elements Holder responsive style
	 */
	function edgtfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.edgtf-elements-holder');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.edgtf-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1367-1600') !== 'undefined' && thisItem.data('1367-1600') !== false) {
						largeLaptop = thisItem.data('1367-1600');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}

					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.edgtf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.edgtf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.edgtf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.edgtf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}

                    if (typeof edgtf.modules.common.edgtfOwlSlider === "function") { // if owl function exist
                        var owl = thisItem.find('.edgtf-owl-slider');
                        if (owl.length) { // if owl is in elements holder
                            setTimeout(function () {
                                owl.trigger('refresh.owl.carousel'); // reinit owl
                            }, 100);
                        }
                    }

				});

				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}

			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var expandedGallery = {};
	edgtf.modules.expandedGallery = expandedGallery;

	expandedGallery.edgtfInitExpandedGallery = edgtfInitExpandedGallery;


	expandedGallery.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitExpandedGallery();
	}

	/*
	 **	Init Expanded Gallery shortcode
	 */
	function edgtfInitExpandedGallery(){
		var holder = $('.edgtf-expanded-gallery');

		if(holder.length){
			holder.each(function() {
				var thisHolder = $(this),
					thisHolderImages = thisHolder.find('.edgtf-eg-image');

				thisHolder.find('.edgtf-eg-image:nth-child('+Math.ceil(thisHolderImages.length / 2)+')').addClass('edgtf-eg-middle-item');

				thisHolder.appear(function() {
					thisHolder.find('.edgtf-eg-middle-item').addClass('edgtf-eg-show');

					setTimeout(function(){
						thisHolder.find('.edgtf-eg-middle-item').prev().addClass('edgtf-eg-show');
						thisHolder.find('.edgtf-eg-middle-item').next().addClass('edgtf-eg-show');
					},250);

					if (thisHolder.hasClass('edgtf-eg-five')) {
						setTimeout(function(){
							thisHolder.find('.edgtf-eg-middle-item').prev().prev().addClass('edgtf-eg-show');
							thisHolder.find('.edgtf-eg-middle-item').next().next().addClass('edgtf-eg-show');
						},500);
					}
				}, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var fullScreenImageSlider = {};
	edgtf.modules.fullScreenImageSlider = fullScreenImageSlider;
	
	
	fullScreenImageSlider.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(window).on('load', edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfInitFullScreenImageSlider();
	}
	
	/**
	 * Init Full Screen Image Slider Shortcode
	 */
	function edgtfInitFullScreenImageSlider() {
		var holder = $('.edgtf-fsis-slider');
		
		if (holder.length) {
			holder.each(function () {
				var sliderHolder = $(this),
					mainHolder = sliderHolder.parent(),
					prevThumbNav = mainHolder.children('.edgtf-fsis-prev-nav'),
					nextThumbNav = mainHolder.children('.edgtf-fsis-next-nav'),
					maskHolder = mainHolder.children('.edgtf-fsis-slider-mask');
				
				mainHolder.addClass('edgtf-fsis-is-init');
				
				edgtfImageBehavior(sliderHolder);
				edgtfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, -1); // -1 is arbitrary value because 0 can be index of item
				
				sliderHolder.on('drag.owl.carousel', function () {
					setTimeout(function () {
						if (!maskHolder.hasClass('edgtf-drag') && !mainHolder.hasClass('edgtf-fsis-active')) {
							maskHolder.addClass('edgtf-drag');
						}
					}, 200);
				});
				
				sliderHolder.on('dragged.owl.carousel', function () {
					setTimeout(function () {
						if (maskHolder.hasClass('edgtf-drag')) {
							maskHolder.removeClass('edgtf-drag');
						}
					}, 300);
				});
				
				sliderHolder.on('translate.owl.carousel', function (e) {
					edgtfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, e.item.index);
				});
				
				sliderHolder.on('translated.owl.carousel', function () {
					edgtfImageBehavior(sliderHolder);
					
					setTimeout(function () {
						maskHolder.removeClass('edgtf-drag');
					}, 300);
				});
			});
		}
	}
	
	function edgtfImageBehavior(sliderHolder) {
		var activeItem = sliderHolder.find('.owl-item.active'),
			imageHolder = sliderHolder.find('.edgtf-fsis-item');
		
		imageHolder.removeClass('edgtf-fsis-content-image-init');
		
		edgtfResetImageBehavior(sliderHolder);
		
		if (activeItem.length) {
			var activeImageHolder = activeItem.find('.edgtf-fsis-item'),
				activeItemImage = activeImageHolder.children('.edgtf-fsis-image');
			
			setTimeout(function () {
				activeImageHolder.addClass('edgtf-fsis-content-image-init');
			}, 100);
			
			activeItemImage.off().on('mouseenter', function () {
				activeImageHolder.addClass('edgtf-fsis-image-hover');
			}).on('mouseleave', function () {
				activeImageHolder.removeClass('edgtf-fsis-image-hover');
			}).on('click', function () {
				if (activeImageHolder.hasClass('edgtf-fsis-active-image')) {
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('edgtf-fsis-active');
					activeImageHolder.removeClass('edgtf-fsis-active-image');
				} else {
					sliderHolder.trigger('stop.owl.autoplay');
					sliderHolder.parent().addClass('edgtf-fsis-active');
					activeImageHolder.addClass('edgtf-fsis-active-image');
				}
			});
			
			//Close on escape
			$(document).keyup(function (e) {
				if (e.keyCode === 27) { //KeyCode for ESC button is 27
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('edgtf-fsis-active');
					activeImageHolder.removeClass('edgtf-fsis-active-image');
				}
			});
		}
	}
	
	function edgtfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, itemIndex) {
		var activeItem = itemIndex === -1 ? sliderHolder.find('.owl-item.active') : $(sliderHolder.find('.owl-item')[itemIndex]),
			prevItemImage = activeItem.prev().find('.edgtf-fsis-image').css('background-image'),
			nextItemImage = activeItem.next().find('.edgtf-fsis-image').css('background-image');
		
		if (prevItemImage.length) {
			prevThumbNav.css({'background-image': prevItemImage});
		}
		
		if (nextItemImage.length) {
			nextThumbNav.css({'background-image': nextItemImage});
		}
	}
	
	function edgtfResetImageBehavior(sliderHolder) {
		var imageHolder = sliderHolder.find('.edgtf-fsis-item');
		
		if (imageHolder.length) {
			imageHolder.removeClass('edgtf-fsis-active-image');
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	edgtf.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.edgtfInitFullScreenSections = edgtfInitFullScreenSections;
	
	
	fullScreenSections.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function edgtfInitFullScreenSections(){
		var fullScreenSections = $('.edgtf-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this);

				if( (thisFullScreenSections.hasClass('edgtf-fss-disabled-for-mobile') && edgtf.windowWidth > 768 ) || ! thisFullScreenSections.hasClass('edgtf-fss-disabled-for-mobile') ) {
                    var fullScreenSectionsWrapper = thisFullScreenSections.children('.edgtf-fss-wrapper'),
                        fullScreenSectionsItems = fullScreenSectionsWrapper.children('.edgtf-fss-item'),
                        fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
                        fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('edgtf-fss-item-has-style'),
                        enableContinuousVertical = false,
                        enableNavigationData = '',
                        enablePaginationData = '';

                    var defaultHeaderStyle = '';
                    if (edgtf.body.hasClass('edgtf-light-header')) {
                        defaultHeaderStyle = 'light';
                    } else if (edgtf.body.hasClass('edgtf-dark-header')) {
                        defaultHeaderStyle = 'dark';
                    }

                    if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
                        enableContinuousVertical = true;
                    }
                    if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
                        enableNavigationData = thisFullScreenSections.data('enable-navigation');
                    }
                    if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
                        enablePaginationData = thisFullScreenSections.data('enable-pagination');
                    }

                    var enableNavigation = enableNavigationData !== 'no',
                        enablePagination = enablePaginationData !== 'no';


                    fullScreenSectionsWrapper.fullpage({
                        sectionSelector: '.edgtf-fss-item',
                        scrollingSpeed: 1200,
                        verticalCentered: false,
                        continuousVertical: enableContinuousVertical,
                        navigation: enablePagination,
                        anchors: ['firstPage', 'secondPage', 'thirdPage', 'fourthPage', 'lastPage'],
                        loopTop: true,
                        loopBottom: true,
                        onLeave: function (index, nextIndex, direction) {

                            var imageHolder = fullScreenSectionsItems.find('.edgtf-fsss-image-holder'),
                                contentHolder = fullScreenSectionsItems.find('.edgtf-fsss-content-holder');

                            if (imageHolder.length) {
                                imageHolder.each(function () {
                                    $(this).removeClass('edgtf-show');
                                })
                            }

                            if (contentHolder.length) {
                                contentHolder.each(function () {
                                    $(this).removeClass('edgtf-show');
                                })
                            }

                            if (fullScreenSectionsItemsHasHeaderStyle) {
                                checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
                            }

                            if (enableNavigation) {
                                checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
                            }
                        },
                        afterRender: function () {
                            var imageHolder = fullScreenSectionsItems.first().find('.edgtf-fsss-image-holder'),
                                contentHolder = fullScreenSectionsItems.first().find('.edgtf-fsss-content-holder');

                            if (fullScreenSectionsItemsHasHeaderStyle) {
                                checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
                            }

                            if (enableNavigation) {
                                checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
                                thisFullScreenSections.children('.edgtf-fss-nav-holder').css('visibility', 'visible');
                            }

                            fullScreenSectionsWrapper.css('visibility', 'visible');

                            if (imageHolder.length) {
                                imageHolder.addClass('edgtf-show');
                            }

                            if (contentHolder.length) {
                                contentHolder.addClass('edgtf-show');
                            }

                        },
                        afterLoad: function (section, origin, destination, direction) {

                            var imageHolder = fullScreenSectionsItems.eq(origin - 1).find('.edgtf-fsss-image-holder'),
                                contentHolder = fullScreenSectionsItems.eq(origin - 1).find('.edgtf-fsss-content-holder'),
								bgPlaceholers = fullScreenSectionsWrapper.find('.edgtf-fsss-item-bg-placeholder'),
                                activeBgPlaceholder = fullScreenSectionsItems.eq(origin - 1).find('.edgtf-fsss-item-bg-placeholder');

                            if (imageHolder.length) {
                                imageHolder.addClass('edgtf-show');
                            }

                            if (contentHolder.length) {
                                contentHolder.addClass('edgtf-show');
                            }

                            if (bgPlaceholers.length) {
                                bgPlaceholers.each(function(){
                                	$(this).removeClass('edgtf-show');
								});
                            }

                            if (activeBgPlaceholder.length) {
                                activeBgPlaceholder.addClass('edgtf-show');
                            }

                        }
                    });

                    setResposniveData(thisFullScreenSections);

                    if (enableNavigation) {
                        thisFullScreenSections.find('#edgtf-fss-nav-up').on('click', function () {
                            $.fn.fullpage.moveSectionUp();
                            return false;
                        });

                        thisFullScreenSections.find('#edgtf-fss-nav-down').on('click', function () {
                            $.fn.fullpage.moveSectionDown();
                            return false;
                        });
                    }
                }

			});

		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + default_header_style + '-header');
		} else {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#edgtf-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#edgtf-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.edgtf-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1366px) {.edgtf-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.edgtf-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.edgtf-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	edgtf.modules.googleMap = googleMap;
	
	googleMap.edgtfShowGoogleMap = edgtfShowGoogleMap;
	
	
	googleMap.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function edgtfShowGoogleMap(){
		var googleMap = $('.edgtf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.edgtf-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "edgtf-map-"+ uniqueId;
				
				edgtfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function edgtfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'edgtf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgtf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('edgtf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			edgtfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function edgtfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var timeline = {};
	edgtf.modules.timeline = timeline;
	
	timeline.edgtfInitHorizontalTimeline = edgtfInitHorizontalTimeline;
	
	
	timeline.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitHorizontalTimeline().init();
	}
	
	function edgtfInitHorizontalTimeline() {
		var timelines = $('.edgtf-horizontal-timeline'),
			eventsMinDistance;
		
		function initTimeline(timelines) {
			timelines.each(function () {
				var timeline = $(this),
					timelineComponents = {};
				
				eventsMinDistance = timeline.data('distance');
				
				//cache timeline components
				timelineComponents['timelineNavWrapper'] = timeline.find('.edgtf-ht-nav-wrapper');
				timelineComponents['timelineNavWrapperWidth'] = timelineComponents['timelineNavWrapper'].width();
				timelineComponents['timelineNavInner'] = timelineComponents['timelineNavWrapper'].find('.edgtf-ht-nav-inner');
				timelineComponents['fillingLine'] = timelineComponents['timelineNavInner'].find('.edgtf-ht-nav-filling-line');
				timelineComponents['timelineEvents'] = timelineComponents['timelineNavInner'].find('a');
				timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
				timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
				timelineComponents['timelineNavigation'] = timeline.find('.edgtf-ht-nav-navigation');
				timelineComponents['timelineEventContent'] = timeline.find('.edgtf-ht-content');
				
				//select initial event
				timelineComponents['timelineEvents'].first().addClass('edgtf-selected');
				timelineComponents['timelineEventContent'].find('li').first().addClass('edgtf-selected');
				
				//assign a left postion to the single events along the timeline
				setDatePosition(timelineComponents, eventsMinDistance);
				
				//assign a width to the timeline
				var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
				
				//the timeline has been initialize - show it
				timeline.addClass('edgtf-loaded');
				
				//detect click on the next arrow
				timelineComponents['timelineNavigation'].on('click', '.edgtf-next', function (e) {
					e.preventDefault();
					updateSlide(timelineComponents, timelineTotWidth, 'next');
				});
				
				//detect click on the prev arrow
				timelineComponents['timelineNavigation'].on('click', '.edgtf-prev', function (e) {
					e.preventDefault();
					updateSlide(timelineComponents, timelineTotWidth, 'prev');
				});
				
				//detect click on the a single event - show new event content
				timelineComponents['timelineNavInner'].on('click', 'a', function (e) {
					e.preventDefault();
					
					var thisItem = $(this);
					
					timelineComponents['timelineEvents'].removeClass('edgtf-selected');
					thisItem.addClass('edgtf-selected');
					
					updateOlderEvents(thisItem);
					updateFilling(thisItem, timelineComponents['fillingLine'], timelineTotWidth);
					updateVisibleContent(thisItem, timelineComponents['timelineEventContent']);
				});
				
				var mq = checkMQ();
				
				//on swipe, show next/prev event content
				timelineComponents['timelineEventContent'].on('swipeleft', function(){
					( mq === 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
				});
				timelineComponents['timelineEventContent'].on('swiperight', function(){
					( mq === 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
				});
				
				//keyboard navigation
				$(document).keyup(function (event) {
					if (event.which === '37' && elementInViewport(timeline.get(0))) {
						showNewContent(timelineComponents, timelineTotWidth, 'prev');
					} else if (event.which === '39' && elementInViewport(timeline.get(0))) {
						showNewContent(timelineComponents, timelineTotWidth, 'next');
					}
				});
			});
		}
		
		function updateSlide(timelineComponents, timelineTotWidth, string) {
			//retrieve translateX value of timelineComponents['timelineNavInner']
			var translateValue = getTranslateValue(timelineComponents['timelineNavInner']),
				wrapperWidth = Number(timelineComponents['timelineNavWrapper'].css('width').replace('px', ''));
			//translate the timeline to the left('next')/right('prev')
			if(string === 'next') {
				translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth);
			} else {
				translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
			}
		}
		
		function showNewContent(timelineComponents, timelineTotWidth, string) {
			//go from one event to the next/previous one
			var visibleContent = timelineComponents['timelineEventContent'].find('.edgtf-selected'),
				newContent = (string === 'next') ? visibleContent.next() : visibleContent.prev();
			
			if (newContent.length > 0) { //if there's a next/prev event - show it
				var selectedDate = timelineComponents['timelineNavInner'].find('.edgtf-selected'),
					newEvent = (string === 'next') ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
				
				updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
				updateVisibleContent(newEvent, timelineComponents['timelineEventContent']);
				
				newEvent.addClass('edgtf-selected');
				selectedDate.removeClass('edgtf-selected');
				
				updateOlderEvents(newEvent);
				updateTimelinePosition(string, newEvent, timelineComponents);
			}
		}
		
		function updateTimelinePosition(string, event, timelineComponents) {
			//translate timeline to the left/right according to the position of the edgtf-selected event
			var eventStyle = window.getComputedStyle(event.get(0), null),
				eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
				timelineWidth = Number(timelineComponents['timelineNavWrapper'].css('width').replace('px', '')),
				timelineTotWidth = Number(timelineComponents['timelineNavInner'].css('width').replace('px', '')),
				timelineTranslate = getTranslateValue(timelineComponents['timelineNavInner']);
			
			if ((string === 'next' && eventLeft > timelineWidth - timelineTranslate) || (string === 'prev' && eventLeft < -timelineTranslate)) {
				translateTimeline(timelineComponents, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
			}
		}
		
		function translateTimeline(timelineComponents, value, totWidth) {
			var timelineNavInner = timelineComponents['timelineNavInner'].get(0);
			
			value = (value > 0) ? 0 : value; //only negative translate value
			value = (!(typeof totWidth === 'undefined') && value < totWidth) ? totWidth : value; //do not translate more than timeline width
			
			setTransformValue(timelineNavInner, 'translateX', value + 'px');
			
			//update navigation arrows visibility
			(value === 0) ? timelineComponents['timelineNavigation'].find('.edgtf-prev').addClass('edgtf-inactive') : timelineComponents['timelineNavigation'].find('.edgtf-prev').removeClass('edgtf-inactive');
			(value === totWidth) ? timelineComponents['timelineNavigation'].find('.edgtf-next').addClass('edgtf-inactive') : timelineComponents['timelineNavigation'].find('.edgtf-next').removeClass('edgtf-inactive');
		}
		
		function updateFilling(selectedEvent, filling, totWidth) {
			//change .edgtf-ht-nav-filling-line length according to the edgtf-selected event
			var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
				eventLeft = eventStyle.getPropertyValue("left"),
				eventWidth = eventStyle.getPropertyValue("width");
			
			eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;
			
			var scaleValue = eventLeft / totWidth;
			
			setTransformValue(filling.get(0), 'scaleX', scaleValue);
		}
		
		function setDatePosition(timelineComponents, min) {
			for (var i = 0; i < timelineComponents['timelineDates'].length; i++) {
				var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
					distanceNorm = Math.round(distance / timelineComponents['eventsMinLapse']) + 2;
				
				timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm * min + 'px');
			}
		}
		
		function setTimelineWidth(timelineComponents, width) {
			var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length - 1]),
				timeSpanNorm = timeSpan / timelineComponents['eventsMinLapse'],
				timeSpanNorm = Math.round(timeSpanNorm) + 4,
				totalWidth = timeSpanNorm * width;
			
			if (totalWidth < timelineComponents['timelineNavWrapperWidth']) {
				totalWidth = timelineComponents['timelineNavWrapperWidth'];
			}
			
			timelineComponents['timelineNavInner'].css('width', totalWidth + 'px');
			
			updateFilling(timelineComponents['timelineNavInner'].find('a.edgtf-selected'), timelineComponents['fillingLine'], totalWidth);
			updateTimelinePosition('next', timelineComponents['timelineNavInner'].find('a.edgtf-selected'), timelineComponents);
			
			return totalWidth;
		}
		
		function updateVisibleContent(event, timelineEventContent) {
			var eventDate = event.data('date'),
				visibleContent = timelineEventContent.find('.edgtf-selected'),
				selectedContent = timelineEventContent.find('[data-date="' + eventDate + '"]'),
				selectedContentHeight = selectedContent.height(),
				classEnetering = 'edgtf-selected edgtf-enter-left',
				classLeaving = 'edgtf-leave-right';
		
			if (selectedContent.index() > visibleContent.index()) {
				classEnetering = 'edgtf-selected edgtf-enter-right';
				classLeaving = 'edgtf-leave-left';
			}
			
			selectedContent.attr('class', classEnetering);
			
			visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
				visibleContent.removeClass('edgtf-leave-right edgtf-leave-left');
				selectedContent.removeClass('edgtf-enter-left edgtf-enter-right');
			});
			
			timelineEventContent.css('height', selectedContentHeight + 'px');
		}
		
		function updateOlderEvents(event) {
			event.parent('li').prevAll('li').children('a').addClass('edgtf-older-event').end().end().nextAll('li').children('a').removeClass('edgtf-older-event');
		}
		
		function getTranslateValue(timeline) {
			var timelineStyle = window.getComputedStyle(timeline.get(0), null),
				timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") || timelineStyle.getPropertyValue("-moz-transform") || timelineStyle.getPropertyValue("-ms-transform") || timelineStyle.getPropertyValue("-o-transform") || timelineStyle.getPropertyValue("transform"),
				translateValue = 0;
			
			if (timelineTranslate.indexOf('(') >= 0) {
				var timelineTranslate = timelineTranslate.split('(')[1];
				
				timelineTranslate = timelineTranslate.split(')')[0];
				timelineTranslate = timelineTranslate.split(',');
				
				translateValue = timelineTranslate[4];
			}
			
			return Number(translateValue);
		}
		
		function setTransformValue(element, property, value) {
			element.style["-webkit-transform"] = property + "(" + value + ")";
			element.style["-moz-transform"] = property + "(" + value + ")";
			element.style["-ms-transform"] = property + "(" + value + ")";
			element.style["-o-transform"] = property + "(" + value + ")";
			element.style["transform"] = property + "(" + value + ")";
		}
		
		//based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
		function parseDate(events) {
			var dateArrays = [];
			
			events.each(function () {
				var singleDate = $(this),
					dateCompStr = new String(singleDate.data('date')),
					dayComp = ['2000', '0', '0'],
					timeComp = ['0', '0'];
				
				if ( dateCompStr.length === 4 ) { //only year
					dayComp = [dateCompStr, '0', '0'];
				} else {
					var dateComp = dateCompStr.split('T');
					
					dayComp = dateComp[0].split('/'); //only DD/MM/YEAR
					
					if (dateComp.length > 1) { //both DD/MM/YEAR and time are provided
						dayComp = dateComp[0].split('/');
						timeComp = dateComp[1].split(':');
					} else if (dateComp[0].indexOf(':') >= 0) { //only time is provide
						timeComp = dateComp[0].split(':');
					}
				}
				
				var newDate = new Date(dayComp[2], dayComp[1] - 1, dayComp[0], timeComp[0], timeComp[1]);
				
				dateArrays.push(newDate);
			});
			
			return dateArrays;
		}
		
		function daydiff(first, second) {
			return Math.round((second - first));
		}
		
		function minLapse(dates) {
			//determine the minimum distance among events
			var dateDistances = [];
			
			for (var i = 1; i < dates.length; i++) {
				var distance = daydiff(dates[i - 1], dates[i]);
				dateDistances.push(distance);
			}
			
			return Math.min.apply(null, dateDistances);
		}
		
		/*
		 How to tell if a DOM element is visible in the current viewport?
		 http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
		 */
		function elementInViewport(el) {
			var top = el.offsetTop;
			var left = el.offsetLeft;
			var width = el.offsetWidth;
			var height = el.offsetHeight;
			
			while (el.offsetParent) {
				el = el.offsetParent;
				top += el.offsetTop;
				left += el.offsetLeft;
			}
			
			return (
				top < (window.pageYOffset + window.innerHeight) &&
				left < (window.pageXOffset + window.innerWidth) &&
				(top + height) > window.pageYOffset &&
				(left + width) > window.pageXOffset
			);
		}
		
		function checkMQ() {
			//check if mobile or desktop device
			return window.getComputedStyle(document.querySelector('.edgtf-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
		}
		
		return {
			init: function () {
				(timelines.length > 0) && initTimeline(timelines);
			}
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	edgtf.modules.icon = icon;
	
	icon.edgtfIcon = edgtfIcon;
	
	
	icon.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgtfIcon = function() {
		var icons = $('.edgtf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('edgtf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.edgtf-icon-animation-holder').addClass('edgtf-icon-animation-show');
				}, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.edgtf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	edgtf.modules.iconListItem = iconListItem;
	
	iconListItem.edgtfInitIconList = edgtfInitIconList;
	
	
	iconListItem.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var edgtfInitIconList = function() {
		var iconList = $('.edgtf-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('edgtf-appeared');
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';

    var interactiveLinkShowcase = {};
    edgtf.modules.interactiveLinkShowcase = interactiveLinkShowcase;

    interactiveLinkShowcase.edgtfInitInteractiveLinkShowcase = edgtfInitInteractiveLinkShowcase;
    interactiveLinkShowcase.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitInteractiveLinkShowcase();
    }

    /**
     * Init item showcase shortcode
     */
    function edgtfInitInteractiveLinkShowcase() {
        var interactiveLinkShowcase = $('.edgtf-ils-holder');
	
	    if (interactiveLinkShowcase.length) {
		    interactiveLinkShowcase.each(function(){
			    var thisInteractiveLinkShowcase = $(this),
				    singleImage = thisInteractiveLinkShowcase.find('.edgtf-ils-item-image'),
				    singleLink  = thisInteractiveLinkShowcase.find('.edgtf-ils-item-link');
			    
			    singleImage.eq(0).addClass('edgtf-active');
			    thisInteractiveLinkShowcase.find('.edgtf-ils-item-link[data-index="0"]').addClass('edgtf-active');
			
			    singleLink.children().on('touchstart mouseenter', function() {
				    var thisLink = $(this).parent(),
					    index = parseInt( thisLink.data('index'), 10 );
				
				    singleImage.removeClass('edgtf-active').eq(index).addClass('edgtf-active');
				    singleLink.removeClass('edgtf-active');
				    thisInteractiveLinkShowcase.find('.edgtf-ils-item-link[data-index="'+index+'"]').addClass('edgtf-active');
			    });
		    });
	    }
    }

})(jQuery);
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
(function($) {
	'use strict';
	
	var itemShowcase = {};
	edgtf.modules.itemShowcase = itemShowcase;
	
	itemShowcase.edgtfInitItemShowcase = edgtfInitItemShowcase;
	
	
	itemShowcase.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitItemShowcase();
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function edgtfInitItemShowcase() {
		var itemShowcase = $('.edgtf-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.edgtf-is-left'),
					rightItems = thisItemShowcase.find('.edgtf-is-right'),
					itemImage = thisItemShowcase.find('.edgtf-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='edgtf-is-item-holder edgtf-is-left-holder' />");
				rightItems.wrapAll( "<div class='edgtf-is-item-holder edgtf-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('edgtf-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(edgtf.windowWidth > 1200) {
									itemAppear('.edgtf-is-left-holder .edgtf-is-item');
									itemAppear('.edgtf-is-right-holder .edgtf-is-item');
								} else {
									itemAppear('.edgtf-is-item');
								}
							});
					},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('edgtf-appeared');
						}, i*150);
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	edgtf.modules.pieChart = pieChart;
	
	pieChart.edgtfInitPieChart = edgtfInitPieChart;
	
	
	pieChart.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function edgtfInitPieChart() {
		var pieChartHolder = $('.edgtf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.edgtf-pc-percentage'),
					barColor = '#e65625',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.edgtf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var process = {};
	edgtf.modules.process = process;
	
	process.edgtfInitProcess = edgtfInitProcess;
	
	
	process.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function edgtfInitProcess() {
		var holder = $('.edgtf-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('edgtf-process-appeared');
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	edgtf.modules.progressBar = progressBar;
	
	progressBar.edgtfInitProgressBars = edgtfInitProgressBars;
	
	
	progressBar.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function edgtfInitProgressBars() {
		var progressBar = $('.edgtf-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.edgtf-pb-content'),
					progressBar = thisBar.find('.edgtf-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					edgtfInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('edgtf-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function edgtfInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var roadmap = {};
    edgtf.modules.roadmap = roadmap;

    roadmap.edgtfInitRoadmap = edgtfInitRoadmap;

    roadmap.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitRoadmap();
    }

    function edgtfInitRoadmap() {
        var roadmap = $('.edgtf-roadmap');

        if (roadmap.length) {
            roadmap.each(function () {
                var thisRoadmap = $(this),
                    roadMapHolder = thisRoadmap.find('.edgtf-roadmap-holder'),
                    roadmapItemsHolder = thisRoadmap.find('.edgtf-roadmap-inner-holder'),
                    roadmapItems = thisRoadmap.find('.edgtf-roadmap-item'),
                    visibleItems = 5,
                    roadmapInitalWidth = thisRoadmap.width(),
                    roadmapHolderWidth = 0,
                    itemsWidth,
                    itemsHeight = 0,
                    itemReached = roadmapItems.filter('.edgtf-roadmap-reached-item').last(),
                    prevArrow = thisRoadmap.find('.edgtf-rl-arrow-left'),
                    nextArrow = thisRoadmap.find('.edgtf-rl-arrow-right'),
                    firstActive,
                    lastActive,
                    translateCurrent = 0,
                    moving = false;

                itemReached.siblings().remove('edgtf-roadmap-reached-item');
                itemReached.prevAll().addClass('edgtf-roadmap-passed-item');

                //set width for items and holder, also set classes and first and last active items
                var setWidths = function () {
                    roadmapInitalWidth = thisRoadmap.width();

                    if (edgtf.windowWidth > 1024) {
                        visibleItems = 5;
                    } else if (edgtf.windowWidth > 680) {
                        visibleItems = 3;
                    } else {
                        visibleItems = 1;
                    }

                    itemsWidth = roadmapInitalWidth / visibleItems;

                    roadmapItems.each(function () {
                        var thisItem = $(this),
                            thisItemHeight;

                        thisItem.width(itemsWidth);
                        roadmapHolderWidth += itemsWidth;

                        //needs to be here in order to calculate height right because of the width
                        thisItemHeight = thisItem.find('.edgtf-roadmap-item-content-holder').outerHeight();

                        if (itemsHeight < thisItemHeight) {
                            itemsHeight = thisItemHeight;
                        }
                    });

                    roadmapItemsHolder.width(roadmapHolderWidth);
                    thisRoadmap.css({'paddingTop': itemsHeight + 70, 'paddingBottom': itemsHeight + 70});

                    //if firstactive set change them accordingly
                    if (typeof firstActive !== 'undefined') {
                        roadmapItems.removeClass('edgtf-roadmap-active-item');
                        firstActive.addClass('edgtf-roadmap-active-item');
                        for (var i = 0; i < visibleItems - 1; i++) {
                            firstActive.nextAll().eq(i).addClass('edgtf-roadmap-active-item');
                        }
                        lastActive = roadmapItems.filter('.edgtf-roadmap-active-item').last();
                    } else {
                        roadmapItems.eq(visibleItems).prevAll().addClass('edgtf-roadmap-active-item');
                        firstActive = roadmapItems.filter('.edgtf-roadmap-active-item').first();
                        lastActive = roadmapItems.filter('.edgtf-roadmap-active-item').last();
                    }
                };

                //movement for provided step (> 0 to the right, < 0 to the left)
                var moveRoadmap = function (step, timeout) {
                    var nextItem;
                    //prevent multiple clicks while animating with moving  var
                    if (!moving) {
                        //grab item to be moved to
                        if (step >= 1) {
                            nextItem = lastActive.nextAll().eq(step - 1);
                        } else {
                            nextItem = firstActive.prevAll().eq(Math.abs(step) - 1);
                        }
                        if (nextItem.length) {
                            moving = true;

                            //adjust classes according to currently moved to item
                            roadmapItems.removeClass('edgtf-roadmap-active-item');
                            nextItem.addClass('edgtf-roadmap-active-item');
                            if (step >= 1) {
                                for (var i = 0; i < visibleItems - 1; i++) {
                                    nextItem.prevAll().eq(i).addClass('edgtf-roadmap-active-item');
                                }
                            } else {
                                for (var i = 0; i < visibleItems - 1; i++) {
                                    nextItem.nextAll().eq(i).addClass('edgtf-roadmap-active-item');
                                }
                            }

                            //set new first and last active items
                            firstActive = roadmapItems.filter('.edgtf-roadmap-active-item').first();
                            lastActive = roadmapItems.filter('.edgtf-roadmap-active-item').last();

                            //move holder and set var moving to false
                            translateCurrent -= step * itemsWidth;
                            roadmapItemsHolder.css({'transform': 'translateX(' + translateCurrent + 'px)'});
                            setTimeout(function () {
                                moving = false;
                            }, timeout);
                        }
                    }
                };

                //move holder to provided item
                var moveTo = function (item) {
                    var firstActiveIndex = firstActive.index(),
                        lastActiveIndex = lastActive.index(),
                        goToIndex = item.index(),
                        moveStep = 0,
                        middle;

                    middle = (firstActiveIndex + lastActiveIndex) / 2;

                    //if first or second item, go to third item
                    //else if last or one before, go to third form the back
                    //else go to the desired
                    if (goToIndex < Math.floor(visibleItems / 2)) {
                        moveStep = firstActiveIndex - 2;
                    } else if (goToIndex > roadmapItems.length - 1 - Math.floor(visibleItems / 2)) {
                        moveStep = roadmapItems.length - 1 - lastActiveIndex;
                    } else {
                        moveStep = goToIndex - middle;
                    }
                    moveRoadmap(moveStep, 0);
                }

                //adjust translate so it wouldn't be stopped in the middle of items
                var resizeTranslateAdj = function () {
                    var adjustment = firstActive.index() * itemsWidth;

                    translateCurrent = -adjustment;
                    roadmapItemsHolder.css({'transform': 'translateX(' + translateCurrent + 'px)'});
                }

                //inital set of widths and items
                setWidths();

                //move to reached item
                moveTo(itemReached);

                //bind movement for prev and next arrow
                nextArrow.on("click", function () {
                    moveRoadmap(1, 200); //init movement to to right
                });
                prevArrow.on("click", function () {
                    moveRoadmap(-1, 200); //init movement to to right
                });

                //adjustments on resize
                $(window).resize(function () {
                    setWidths();
                    resizeTranslateAdj();
                });

                $('.edgtf-roadmap-item-content-holder').css('opacity', 0);
                $('.edgtf-roadmap-item-above .edgtf-roadmap-item-content-holder').css('transform', 'translateY(20px)');
                $('.edgtf-roadmap-item-below .edgtf-roadmap-item-content-holder').css('transform', 'translateY(-20px)');
            });


            roadmap.appear(function () {
                $('.edgtf-roadmap-item-content-holder').each(function (i) {
                    var fadeInTime = .2 + i / 5;

                    $(this).css({
                        'opacity': 1,
                        'transform': 'translateY(0)',
                        'transition': 'transform .25s ease-in-out ' + fadeInTime + 's, opacity .25s ease-in-out ' + fadeInTime + 's '
                    })
                })
            })

        }


    }

})(jQuery);
(function($) {
	'use strict';
	
	var stackedImages = {};
	edgtf.modules.stackedImages = stackedImages;

	stackedImages.edgtfInitItemShowcase = edgtfInitStackedImages;


	stackedImages.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitStackedImages();
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function edgtfInitStackedImages() {
		var stackedImages = $('.edgtf-stacked-images-holder');

		if (stackedImages.length) {
			stackedImages.each(function(){
				var thisStackedImages = $(this),
					itemImage = thisStackedImages.find('.edgtf-si-images');

				//logic
				thisStackedImages.animate({opacity:1},200);

				setTimeout(function(){
					thisStackedImages.appear(function(){
						itemImage.addClass('edgtf-appeared');
					},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
				},100);
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var tabs = {};
    edgtf.modules.tabs = tabs;

    tabs.edgtfInitTabs = edgtfInitTabs;


    tabs.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitTabs();
    }

    /*
     **	Init tabs shortcode
     */
    function edgtfInitTabs() {
        var tabs = $('.edgtf-tabs');

        if (tabs.length) {
            tabs.each(function () {
                var thisTabs = $(this);

                thisTabs.children('.edgtf-tab-container').each(function (index) {
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.edgtf-tabs-nav li:nth-child(' + index + ') a'),
                        navLink = navItem.attr('href');

                    link = '#' + link;

                    if (link.indexOf(navLink) > -1) {
                        navItem.attr('href', link);
                    }
                });

                thisTabs.tabs();

                $('.edgtf-tabs a.edgtf-external-link').off('click');
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';
    
    var textMarquee = {};
    edgtf.modules.textMarquee = textMarquee;
    
    textMarquee.edgtfInitTextMarquee = edgtfInitTextMarquee;
	textMarquee.edgtfTextMarqueeResize = edgtfTextMarqueeResize;
    
    textMarquee.edgtfOnDocumentReady = edgtfOnDocumentReady;
    
    $(document).ready(edgtfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfTextMarqueeResize();
        edgtfInitTextMarquee();
    }
    
    /**
     * Init Text Marquee effect
     */
    function edgtfInitTextMarquee() {
        var textMarqueeShortcodes = $('.edgtf-text-marquee');

        if (textMarqueeShortcodes.length) {
            textMarqueeShortcodes.each(function(){
                var textMarqueeShortcode = $(this),
                    marqueeElements = textMarqueeShortcode.find('.edgtf-marquee-element'),
                    originalText = marqueeElements.filter('.edgtf-original-text'),
                    auxText = marqueeElements.filter('.edgtf-aux-text');

                var calcWidth = function(element) {
                    var width;

                    if (textMarqueeShortcode.outerWidth() > element.outerWidth()) {
                        width = textMarqueeShortcode.outerWidth();
                    } else {
                        width = element.outerWidth();
                    }

                    return width;
                };

                var marqueeEffect = function () {
	                edgtfRequestAnimationFrame();
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = calcWidth(originalText);
                    marqueeElements.css({'width':marqueeWidth}); // set the same width to both elements
                    auxText.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
                            currentPos = 0;

                        var edgtfInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        requestNextAnimationFrame(edgtfInfiniteScrollEffect);

                            $(window).resize(function(){
                                marqueeWidth = calcWidth(originalText);
                                currentPos = 0;
                                originalText.css('left',0);
                                auxText.css('left', marqueeWidth); //set to the right of the inital marquee element
                            });
                        }; 
                            
                        edgtfInfiniteScrollEffect();
                    });
                };

                marqueeEffect();
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function edgtfRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') !== -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

	/*
	 **	Text Marquee resizing style
	 */
	function edgtfTextMarqueeResize() {
		var holder = $('.edgtf-text-marquee');

		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';

				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}

				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}

				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}

				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.edgtf-text-marquee." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.edgtf-text-marquee." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.edgtf-text-marquee." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-text-marquee." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}

				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}

				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var uncoveringSections = {};
    edgtf.modules.uncoveringSections = uncoveringSections;

    uncoveringSections.edgtfInitUncoveringSections = edgtfInitUncoveringSections;


    uncoveringSections.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitUncoveringSections();
    }

    /*
     **	Init full screen sections shortcode
     */
    function edgtfInitUncoveringSections(){
        var uncoveringSections = $('.edgtf-uncovering-sections');

        if(uncoveringSections.length){
            uncoveringSections.each(function() {
                var thisUS = $(this),
                    thisCurtain = uncoveringSections.find('.curtains'),
                    curtainItems = thisCurtain.find('.edgtf-uss-item'),
                    curtainShadow = uncoveringSections.find('.edgtf-fss-shadow');
                var body = edgtf.body;
                var defaultHeaderStyle = '';
                if (body.hasClass('edgtf-light-header')) {
                    defaultHeaderStyle = 'light';
                } else if (body.hasClass('edgtf-dark-header')) {
                    defaultHeaderStyle = 'dark';
                }

                body.addClass('edgtf-uncovering-section-on-page');
                if(edgtfPerPageVars.vars.edgtfHeaderVerticalWidth > 0 && edgtf.windowWidth > 1024) {
                    curtainItems.css({
                        left : edgtfPerPageVars.vars.edgtfHeaderVerticalWidth,
                        width: 'calc(100% - ' + edgtfPerPageVars.vars.edgtfHeaderVerticalWidth + 'px)'
                    });

                    curtainShadow.css({
                        left : edgtfPerPageVars.vars.edgtfHeaderVerticalWidth,
                        width: 'calc(100% - ' + edgtfPerPageVars.vars.edgtfHeaderVerticalWidth + 'px)'
                    });
                }

                thisCurtain.curtain({
                    scrollSpeed: 400,
                    nextSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle); },
                    prevSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);}
                });

                checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                setResposniveData(thisCurtain);

                thisUS.addClass('edgtf-loaded');
            });
        }
    }

    function checkFullScreenSectionsItemForHeaderStyle(thisUncoveringSections, default_header_style) {
        var section_header_style = thisUncoveringSections.find('.current').data('header-style');
        if (section_header_style !== undefined && section_header_style !== '') {
            edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + default_header_style + '-header');
        } else {
            edgtf.body.removeClass('edgtf-light-header edgtf-dark-header');
        }
    }

    function setResposniveData(thisUncoveringSections) {
        var uncoveringSections = thisUncoveringSections.find('.edgtf-uss-item'),
            responsiveStyle = '',
            style = '';

        uncoveringSections.each(function(){
            var thisSection = $(this),
                thisSectionImage = thisSection.find('.edgtf-uss-image-holder'),
                itemClass = '',
                imageLaptop = '',
                imageTablet = '',
                imagePortraitTablet = '',
                imageMobile = '';

            if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
                itemClass = thisSection.data('item-class');
            }

            if (typeof thisSectionImage.data('laptop-image') !== 'undefined' && thisSectionImage.data('laptop-image') !== false) {
                imageLaptop = thisSectionImage.data('laptop-image');
            }
            if (typeof thisSectionImage.data('tablet-image') !== 'undefined' && thisSectionImage.data('tablet-image') !== false) {
                imageTablet = thisSectionImage.data('tablet-image');
            }
            if (typeof thisSectionImage.data('tablet-portrait-image') !== 'undefined' && thisSectionImage.data('tablet-portrait-image') !== false) {
                imagePortraitTablet = thisSectionImage.data('tablet-portrait-image');
            }
            if (typeof thisSectionImage.data('mobile-image') !== 'undefined' && thisSectionImage.data('mobile-image') !== false) {
                imageMobile = thisSectionImage.data('mobile-image');
            }


            if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {

                if (imageLaptop.length) {
                    responsiveStyle += "@media only screen and (max-width: 1366px) {.edgtf-uss-item." + itemClass + " .edgtf-uss-image-holder { background-image: url(" + imageLaptop + ") !important; } }";
                }
                if (imageTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 1024px) {.edgtf-uss-item." + itemClass + " .edgtf-uss-image-holder { background-image: url( " + imageTablet + ") !important; } }";
                }
                if (imagePortraitTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 800px) {.edgtf-uss-item." + itemClass + " .edgtf-uss-image-holder { background-image: url( " + imagePortraitTablet + ") !important; } }";
                }
                if (imageMobile.length) {
                    responsiveStyle += "@media only screen and (max-width: 680px) {.edgtf-uss-item." + itemClass + " .edgtf-uss-image-holder { background-image: url( " + imageMobile + ") !important; } }";
                }
            }
        });

        if (responsiveStyle.length) {
            style = '<style type="text/css">' + responsiveStyle + '</style>';
        }

        if (style.length) {
            $('head').append(style);
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	edgtf.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.edgtfInitVerticalSplitSlider = edgtfInitVerticalSplitSlider;
	
	
	verticalSplitSlider.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function edgtfInitVerticalSplitSlider() {
		var slider = $('.edgtf-vertical-split-slider'),
			progressBarFlag = true;
		
		if (slider.length) {
			if (edgtf.body.hasClass('edgtf-vss-initialized')) {
				edgtf.body.removeClass('edgtf-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(edgtf.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (edgtf.body.hasClass('edgtf-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (edgtf.body.hasClass('edgtf-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.edgtf-vss-ms-section',
				leftSelector: '.edgtf-vss-ms-left',
				rightSelector: '.edgtf-vss-ms-right',
				afterRender: function () {
					edgtfCheckVerticalSplitSectionsForHeaderStyle($('.edgtf-vss-ms-left .edgtf-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
					edgtf.body.addClass('edgtf-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="edgtf-vss-responsive"></div>'),
						leftSide = slider.find('.edgtf-vss-ms-left > div'),
						rightSide = slider.find('.edgtf-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.edgtf-vss-responsive .edgtf-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'edgtf-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof edgtf.modules.animationHolder.edgtfInitAnimationHolder === "function") {
						edgtf.modules.animationHolder.edgtfInitAnimationHolder();
					}
					
					if (typeof edgtf.modules.button.edgtfButton === "function") {
						edgtf.modules.button.edgtfButton().init();
					}
					
					if (typeof edgtf.modules.elementsHolder.edgtfInitElementsHolderResponsiveStyle === "function") {
						edgtf.modules.elementsHolder.edgtfInitElementsHolderResponsiveStyle();
					}
					
					if (typeof edgtf.modules.googleMap.edgtfShowGoogleMap === "function") {
						edgtf.modules.googleMap.edgtfShowGoogleMap();
					}
					
					if (typeof edgtf.modules.icon.edgtfIcon === "function") {
						edgtf.modules.icon.edgtfIcon().init();
					}
					
					if (progressBarFlag && typeof edgtf.modules.progressBar.edgtfInitProgressBars === "function" && ($('.edgtf-vss-ms-left .edgtf-vss-ms-section.active').find('.edgtf-progress-bar').length || $('.edgtf-vss-ms-right .edgtf-vss-ms-section.active').find('.edgtf-progress-bar').length)){
						edgtf.modules.progressBar.edgtfInitProgressBars();
						progressBarFlag = false;
					}
				},
				onLeave: function (index, nextIndex) {
					if (progressBarFlag && typeof edgtf.modules.progressBar.edgtfInitProgressBars === "function" && ($('.edgtf-vss-ms-left .edgtf-vss-ms-section.active').find('.edgtf-progress-bar').length || $('.edgtf-vss-ms-right .edgtf-vss-ms-section.active').find('.edgtf-progress-bar').length)){
						setTimeout(function(){
							edgtf.modules.progressBar.edgtfInitProgressBars();
						},700); // scrolling speed is 700

						progressBarFlag = false;
					}

					edgtfIntiScrollAnimation(slider, nextIndex);
					edgtfCheckVerticalSplitSectionsForHeaderStyle($($('.edgtf-vss-ms-left .edgtf-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (edgtf.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (edgtf.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	function edgtfIntiScrollAnimation(slider, nextIndex) {
		
		if (slider.hasClass('edgtf-vss-scrolling-animation')) {
			
			if (nextIndex > 1 && !slider.hasClass('edgtf-vss-scrolled')) {
				slider.addClass('edgtf-vss-scrolled');
			} else if (nextIndex === 1 && slider.hasClass('edgtf-vss-scrolled')) {
				slider.removeClass('edgtf-vss-scrolled');
			}
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function edgtfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header').addClass('edgtf-' + default_header_style + '-header');
		} else {
			edgtf.body.removeClass('edgtf-light-header edgtf-dark-header');
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var workflow = {};
	edgtf.modules.workflow = workflow;

    workflow.edgtfWorkflow = edgtfWorkflow;


    workflow.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
        edgtfWorkflow();
	}

    function edgtfWorkflow() {
        var workflowShortcodes = $('.edgtf-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('edgtf-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.edgtf-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('edgtf-appeared');
                        setTimeout(function () {
                            workflowItems.each(function (i) {
                                var workflowItem = $(this);
                                setTimeout(function () {
                                    workflowItem.addClass('edgtf-appeared');
                                }, 350 * i);
                            });
                        }, 350);
                    }, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

                }
            });
        }
    }
	
})(jQuery);
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
(function ($) {
    'use strict';

    var testimonialsCarousel = {};
    edgtf.modules.testimonialsCarousel = testimonialsCarousel;

    testimonialsCarousel.edgtfInitTestimonials = edgtfInitTestimonialsCarousel;


    testimonialsCarousel.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).on('load', edgtfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitTestimonialsCarousel();
    }

    /**
     * Init testimonials shortcode elegant type
     */
    function edgtfInitTestimonialsCarousel(){
        var testimonial = $('.edgtf-testimonials-holder.edgtf-testimonials-carousel');

        if(testimonial.length){
            testimonial.each(function(){
                var thisTestimonials = $(this),
                    mainTestimonialsSlider = thisTestimonials.find('.edgtf-testimonials-main'),
                    imagePagSlider = thisTestimonials.children('.edgtf-testimonial-image-nav'),
                    loop = true,
                    autoplay = true,
                    sliderSpeed = 5000,
                    sliderSpeedAnimation = 600,
                    mouseDrag = false;

                if (mainTestimonialsSlider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (mainTestimonialsSlider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (typeof mainTestimonialsSlider.data('slider-speed') !== 'undefined' && mainTestimonialsSlider.data('slider-speed') !== false) {
                    sliderSpeed = mainTestimonialsSlider.data('slider-speed');
                }
                if (typeof mainTestimonialsSlider.data('slider-speed-animation') !== 'undefined' && mainTestimonialsSlider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = mainTestimonialsSlider.data('slider-speed-animation');
                }
                if(edgtf.windowWidth < 680){
                    mouseDrag = true;
                }

                if (mainTestimonialsSlider.length && imagePagSlider.length) {
                    var text = mainTestimonialsSlider.owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: mouseDrag,
                        onInitialize: function () {
                            mainTestimonialsSlider.css('visibility', 'visible');
                        }
                    });

                    var image = imagePagSlider.owlCarousel({
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        center: true,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: false,
                        responsive: {
                            1025: {
                                items: 5
                            },
                            0: {
                                items: 3
                            }
                        },
                        onInitialize: function () {
                            imagePagSlider.css('visibility', 'visible');
                            thisTestimonials.css('opacity', '1');
                        }
                    });

                    imagePagSlider.find('.owl-item').on('click touchpress', function (e) {
                        e.preventDefault();

                        var thisItem = $(this),
                            itemIndex = thisItem.index(),
                            numberOfClones = imagePagSlider.find('.owl-item.cloned').length,
                            modifiedItems = itemIndex - numberOfClones / 2 >= 0 ? itemIndex - numberOfClones / 2 : itemIndex;

                        image.trigger('to.owl.carousel', modifiedItems);
                        text.trigger('to.owl.carousel', modifiedItems);
                    });

                }
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var testimonialsImagePagination = {};
    edgtf.modules.testimonialsImagePagination = testimonialsImagePagination;

    testimonialsImagePagination.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfTestimonialsImagePagination();
    }

    /**
     * Init Owl Carousel
     */
    function edgtfTestimonialsImagePagination() {
        var sliders = $('.edgtf-testimonials-image-pagination-inner');

        if (sliders.length) {
            sliders.each(function() {
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = false,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 500,
                    margin = 0,
                    stagePadding = 0,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOutClass = false, // keyframe css animation
                    navigation = false,
                    pagination = false,
                    drag = true,
                    sliderDataHolder = slider;

                if (sliderDataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
                    sliderSpeed = sliderDataHolder.data('slider-speed');
                }
                if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
                }
                if (sliderDataHolder.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
                }
                if (sliderDataHolder.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (sliderDataHolder.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if (navigation && pagination) {
                    slider.addClass('edgtf-slider-has-both-nav');
                }

                if (pagination) {
                    var dotsContainer = '#edgtf-testimonial-pagination';
                    $('.edgtf-tsp-item').on('click', function () {
                        slider.trigger('to.owl.carousel', [$(this).index(), 300]);
                    });
                }

                if (slideItemsNumber <= 1) {
                    loop = false;
                    autoplay = false;
                    navigation = false;
                    pagination = false;
                }

                slider.waitForImages(function () {
                    $(this).owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        margin: margin,
                        stagePadding: stagePadding,
                        center: center,
                        autoWidth: autoWidth,
                        animateIn: animateInClass,
                        animateOut: animateOutClass,
                        dots: pagination,
                        dotsContainer: dotsContainer,
                        nav: navigation,
                        drag: drag,
                        callbacks: true,
                        navText: [
                            '<span class="edgtf-prev-icon ion-chevron-left"></span>',
                            '<span class="edgtf-next-icon ion-chevron-right"></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        },
                        onDrag: function (e) {
                            if (edgtf.body.hasClass('edgtf-smooth-page-transitions-fadeout')) {
                                var sliderIsMoving = e.isTrigger > 0;

                                if (sliderIsMoving) {
                                    slider.addClass('edgtf-slider-is-moving');
                                }
                            }
                        },
                        onDragged: function () {
                            if (edgtf.body.hasClass('edgtf-smooth-page-transitions-fadeout') && slider.hasClass('edgtf-slider-is-moving')) {

                                setTimeout(function () {
                                    slider.removeClass('edgtf-slider-is-moving');
                                }, 500);
                            }
                        }
                    });

                });
            });
        }
    }
    
})(jQuery);