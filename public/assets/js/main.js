/*-----------------------------------------------------------------------------------

    Template Name :  Ntec - Saas & Software HTML5 Template 
    Author : template_mr
    Developed By :sayfurrahaman265@gmail.com
    Version : 1.0
    Created on   : 29/02/2024.

-----------------------------------------------------------------------------------*/

(function ($) {
	"use strict";

	/*------------------------------------
			Preloader
		--------------------------------------*/

	$(window).on('load', function () {
		$('#preloader').delay(350).fadeOut('slow');
		$('body').delay(350).css({ 'overflow': 'visible' });
	});


	// ---------------- Data CSS Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});


	/*------------------------------------
		Mobile Menu
	--------------------------------------*/

	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "991",
		meanExpand: '+',
		meanShowChildren: true,
		meanExpandableChildren: true,
		meanContract: "-",
		meanDisplay: "block"
	});

	$('#mobile-menu-active').metisMenu();

	$('#mobile-menu-active .has-dropdown > a').on('click', function (e) {
		e.preventDefault();
	});

	$(".hamburger-menu > a").on("click", function (e) {
		e.preventDefault();
		$(".slide-bar").toggleClass("show");
		$("body").addClass("on-side");
		$('.body-overlay').addClass('active');
		$(this).addClass('active');
	});

	$(".close-mobile-menu > a").on("click", function (e) {
		e.preventDefault();
		$(".slide-bar").removeClass("show");
		$("body").removeClass("on-side");
		$('.body-overlay').removeClass('active');
		$('.hamburger-menu > a').removeClass('active');
	});

	$('.body-overlay').on('click', function () {
		$(this).removeClass('active');
		$(".slide-bar").removeClass("show");
		$("body").removeClass("on-side");
		$('.hamburger-menu > a').removeClass('active');
	});



	//sticky-menu
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 200) {
			$(".main-header-area").removeClass("sticky-menu");
		} else {
			$(".main-header-area").addClass("sticky-menu");
		}
	});

	// Add .active class to current navigation based on URL
	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
	$(".menu-list > li  a").each(function () {
		if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
			$(this).addClass("active");
		// $(this).parent("li").addClass("active");
	})


	//shopping-cart-bar
	$(".shopping-cart").on("click", function () {
		$(".cart-menu-right").addClass('cart-info');
	});
	$(".close-icon").click(function () {
		$(".cart-menu-right").removeClass('cart-info');

	});

	//hero__slider__two
	const hero__slider__two = new Swiper('.hero__slider__two', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView:1,
		loop: true,
		speed: 1500,
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
		},
		slideToClickedSlide: true,
		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
	//hero__slider__three
	const hero__slider__three = new Swiper('.hero__slider__three', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView:1,
		loop: true,
		speed: 1500,
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
		},
		slideToClickedSlide: true,
		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		  },
	});
	//project__slider__one
	const project__slider__one = new Swiper('.project__slider__one', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 3,
		loop: true,
		speed: 1200,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		  },
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
		},
		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			780: {
				slidesPerView: 2,
			},
			1320: {
				slidesPerView: 3,
			},
		},

	});

	//project__slider__two
	const project__slider__two = new Swiper('.project__slider__two', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 4,
		loop: true,
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
		},
		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			991: {
				slidesPerView: 2,
			},
			1320: {
				slidesPerView: 3,
			},
			1770: {
				slidesPerView: 4,
			},
		},

	});
	//project__slider__three
	const project__slider__three = new Swiper('.project__slider__three', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 4,
		loop: true,
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		  },
		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			991: {
				slidesPerView: 2,
			},
			1320: {
				slidesPerView: 3,
			},
			1770: {
				slidesPerView: 4,
			},
		},

	});


	//testimonial__slider__one
	const testimonial__slider__one = new Swiper('.testimonial__slider__one', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 3,
		loop: true,
		speed: 1200,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		  },
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
		},
		slideToClickedSlide: true,
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			// when window width is >= 480px
			575: {
				slidesPerView: 1,
				spaceBetween: 30
			},
			// when window width is >= 640px
			991: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			1320: {
				slidesPerView: 3,
				spaceBetween: 30
			}
		}
	});

	//team__slider__one
	const team__slider__one = new Swiper('.team__slider__one', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 4,
		loop: true,
		autoplay: {
			delay: 1500,
		},
		slideToClickedSlide: true,
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			// when window width is >= 480px
			575: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			// when window width is >= 640px
			991: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			1320: {
				slidesPerView: 4,
				spaceBetween: 30
			}
		}
	});
	//team__slider__one
	const team__page__slider = new Swiper('.team__page__slider', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 3,
		loop: true,
		autoplay: {
			delay: 1500,
		},
		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			575: {
				slidesPerView: 1,
				spaceBetween: 30
			},
			// when window width is >= 640px
			991: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			1200: {
				slidesPerView: 3,
				spaceBetween: 30
			}
		}
	});

//partner__slider__one
	const partner__slider__one = new Swiper('.partner__slider__one', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 5,
		loop: true,
		spaceBetween:100,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},

		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			780: {
				slidesPerView: 3,
			},
			992: {
				slidesPerView: 4,
			},
			1200: {
				slidesPerView: 5,
			},
		},

	});

	//service__slider__three
		const service__slider__three = new Swiper('.service__slider__three', {
			// Optional parameters
			direction: 'horizontal',
			slidesPerView: 4,
			loop: true,
			spaceBetween:30,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
			  },
			autoplay: {
				delay: 2000,
				disableOnInteraction: false,
			},
	
			slideToClickedSlide: true,
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				780: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 3,
				},
				1320: {
					slidesPerView: 4,
				},
			},
	
		});

	//portfolio__slider__one
	const portfolio__slider__one = new Swiper('.portfolio__slider__one', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 3,
		loop: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},

		breakpoints: {
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			992: {
				slidesPerView: 2,
				spaceBetween: 55
			},
			1400: {
				slidesPerView: 3,
				spaceBetween: 55
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});


	//testimonial__thumbs__slider
	const testimonial__thumbs__slider = new Swiper('.testimonial__thumbs__slider', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView:4,
		loop: true,
		centerMode: true,
		centeredSlides: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			575: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			991: {
				slidesPerView: 4,
				spaceBetween: 30
			},
			1200: {
				slidesPerView: 5,
				spaceBetween: 30
			}
		}
	});
	//portfolio__slider__two
	const portfolio__slider__two = new Swiper('.portfolio__slider__two', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 4,
		loop: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},

		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			768: {
				slidesPerView: 2,
			},
			992: {
				slidesPerView: 3,
			},
			1200: {
				slidesPerView: 4,
			},
		},
		// If we need pagination
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},

	});


	//testimonial__slider__two
	const testimonial__slider__two = new Swiper('.testimonial__slider__two', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 2,
		loop: true,
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},

		slideToClickedSlide: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			780: {
				slidesPerView: 2,
			},
			992: {
				slidesPerView: 2,
			},
		},
		// If we need pagination
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},

	});

	//testimonial__slider__three
	const blog__slider__two = new Swiper('.blog__slider__two', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView: 4,
		loop: true,
		autoplay: {
			delay: 1500,
		},
		slideToClickedSlide: true,
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			// when window width is >= 480px
			575: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			// when window width is >= 640px
			991: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			1320: {
				slidesPerView: 4,
				spaceBetween: 30
			}
		}
	});
	//blog__gallery__slider
	const blog__gallery__slider = new Swiper('.blog__gallery__slider', {
		// Optional parameters
		direction: 'horizontal',
		slidesPerView:2,
		loop: true,
		spaceBetween: 30,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},

		slideToClickedSlide: true,

		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

	});

	//price-toggle-btn
	jQuery(function (ht_contenttoggle) {
		ht_contenttoggle(".ht-toggle-btn .ht-input").each(function () {
			var n = ht_contenttoggle(this).parents(".ht-content-toggle").find(".ht-content-toggle-back"),
				e = ht_contenttoggle(this).parents(".ht-content-toggle").find(".ht-content-toggle-front");
			this.checked ? (e.hide(), n.show()) : (n.hide(), e.show()), ht_contenttoggle(this).on("change", function () {
				this.checked ? (e.hide(), n.show()) : (n.hide(), e.show())
			})
		})
	});


	// -------------------- price btn
	$(".price-btn").click(function () {

		var lable = $(".price-btn").text().trim();

		if (lable == "Monthly") {
			$(".price-btn").text("Yearly");
			$(".yearly-price").show();
			$(".monthly-price").hide();
		}
		else {
			$(".price-btn").text("Monthly");
			$(".monthly-price").show();
			$(".yearly-price").hide();
		}

	});

	$(function () {
		$('.chart').easyPieChart({
			animate: {
				duration: 1000,
				enabled: true
			},
			scaleLength: 0,
			size: 105,
			trackColor: 'rgba(112, 112, 112, 0.1)',
			barColor: '#FF723A',
			scaleColor: 'false',
			lineWidth: 15,
			trackWidth: 15,
			lineCap: 'round',
			rotate: 0,
		});
	});


	// -------------------- Remove Placeholder When Focus Or Click
	$("input,textarea").each(function () {
		$(this).data('holder', $(this).attr('placeholder'));
		$(this).on('focusin', function () {
			$(this).attr('placeholder', '');
		});
		$(this).on('focusout', function () {
			$(this).attr('placeholder', $(this).data('holder'));
		});
	});


	/* magnificPopup video view */
	$('.popup-video').magnificPopup({
		type: 'iframe'
	});



	/* Cart Plus Minus Js */
	$(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function () {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
	});

	//jquiry-price-slider
	$(function () {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 500,
			values: [75, 300],
			slide: function (event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
			" - $" + $("#slider-range").slider("values", 1));
	});


	// scrollToTop
	$.scrollUp({
		scrollName: 'scrollUp', // Element ID
		topDistance: '300', // Distance from top before showing element (px)
		topSpeed: 500, // Speed back to top (ms)
		animation: 'fade', // Fade, slide, none
		animationInSpeed: 300, // Animation in speed (ms)
		animationOutSpeed: 300, // Animation out speed (ms)
		scrollText: '<i class="fas fa-chevron-double-up"></i>', // Text for element
		activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	});

	$('.counter').counterUp({
		delay: 10,
		time: 2000
	});

	$('select').niceSelect();
	// aos animation
	AOS.init({
		duration: 1200,
		easing: 'ease', // default easing for AOS animations
		once: true, // whether animation should happen only once - while scrolling down
		mirror: true,
	  })
	  
})(jQuery);