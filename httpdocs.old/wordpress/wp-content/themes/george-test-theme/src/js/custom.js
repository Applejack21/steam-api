jQuery(document).on('ready', function() {
	stickyHeader();
	// scrollLink();
	// iframeWrapper();
	relExternal();
	lazyImages();
});

jQuery(window).on('resize', function() {
	
});

jQuery(window).on('scroll', function() {
	stickyHeader();
});

jQuery(window).on('orientationchange', function() {
	stickyHeader();
});

jQuery(window).on('load resize orientationchange', function() {

});

/* ================================================ */

function isMobile() {
	var isMobile = false;

	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
		return true;
	} else {
		return false;
	}
}


function stickyHeader() {
	var body = jQuery('body');
	var header = jQuery('.site-header');
	var browser_top = jQuery(window).scrollTop();
	var header_bottom = header.offset().top + header.outerHeight();

	if ( browser_top > 25 ) {
		header.addClass('with-bg');
	} else {
		header.removeClass('with-bg');
	}
}


function testimonialSlider() {
	var target = jQuery('.section-testimonials .quotes');

	if (!target.children().length) {
		return false;
	}

	jQuery(target).on('init', function(event, slick, currentSlide){
		jQuery(target).css('visibility', 'visible');
	});

	jQuery(target).slick({
		fade: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3600,
		draggable: false,
		focusOnSelect: false,
		pauseOnFocus: false,
		pauseOnHover: true,
		dotsClass: 'slick-dots',
		prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
		responsive: [
			{
				breakpoint: 992,
				settings: {
					draggable: true
				}
			},
			{
				breakpoint: 768,
				settings: {
					draggable: true,
					arrows: false
				}
			}
		]
	});
}


function scrollLink() {
	var hash_links = jQuery('.page-sections').find('a[href^="#"]');

	hash_links.each(function() {
		jQuery(this).on('click', function(e) {
			e.preventDefault();
			var target = jQuery(this).attr('href');
			var offset = jQuery('.site-header').outerHeight();

			if ( jQuery('body').hasClass('logged-in') ) {
				offset = jQuery('.site-header').outerHeight() + jQuery('#wpadminbar').outerHeight();
			}

			jQuery('html, body').animate({ scrollTop: jQuery( target ).offset().top - (offset + 50) }, 300);
		})
	})
}


function iframeWrapper() {
	var iframes = jQuery('.site-wrapper').find('iframe[src*="youtube"], iframe[src*="youtu.be"], iframe[src*="vimeo"]');

	iframes.each(function() {
		jQuery(this).wrap('<div class="embed-responsive embed-responsive-16by9"></div>')
	});
}


function mobileSlider( element, slides_show, slides_scroll, rows, dots_class ) {
	jQuery( element ).each(function(){
		var carousel = jQuery(this);

		if ( !dots_class ) {
			dots_class = 'slick-dots';
		}

		/* Initializes a slick carousel only on mobile screens */
		// slick on mobile
		if ( jQuery(window).width() >= 768 ) {
			if ( carousel.hasClass('slick-initialized') ) {
				carousel.slick('unslick');
			}
		} else {
			if ( !carousel.hasClass('slick-initialized') ) {
				carousel.css('visibility', 'visible');

				if ( rows > 1 ) {
					carousel.slick({
						slidesPerRow: slides_show,
						rows: rows,
						mobileFirst: true,
						dots: true,
						dotsClass: dots_class,
						arrows: false,
						autoplay: false,
						autoplaySpeed: 4000,
					});
				} else {
					carousel.slick({
						slidesToShow: slides_show,
						slidesToScroll: slides_scroll,
						mobileFirst: true,
						dots: true,
						dotsClass: dots_class,
						arrows: false,
						autoplay: false,
						autoplaySpeed: 4000,
						centerMode: true
					});
				}
			}
		}
	});
}


function relExternal() {
	jQuery('a[rel="external"]').on('click', function() {
		window.open(this.href);
		return false;
	});
}


function lazyImages() {
	jQuery('.lazy-img').Lazy({
		effect: "fadeIn",
		effectTime: 300,
		threshold: 0,
		// delay: 300000,
		afterLoad: function(element) {
			element.removeClass('lazy-img');
			element.addClass('lazy-img-loaded');
		},
	});

	jQuery('.lazy-bg').Lazy({
		effect: "fadeIn",
		effectTime: 150,
		// threshold: 0,
		// delay: 300000,
		afterLoad: function(element) {
			element.removeClass('lazy-bg');
			element.addClass('lazy-bg-loaded');
		},
	});
}