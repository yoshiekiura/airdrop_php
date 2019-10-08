$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top-$('nav').height()
    }, 500);
});

//Carousel Time Line
	var $timeline_carousel = $('.timeline-carousel');
	if ($timeline_carousel.length > 0 ) {
		var c_rtl = ($body_m.hasClass('is-rtl')) ? true : false;
		$timeline_carousel.addClass('owl-carousel').owlCarousel({
			navText: ["<i class='ti ti-angle-left'></i>","<i class='ti ti-angle-right'></i>"],
			items:6,
			nav:true,
			margin:30,
			rtl: c_rtl,
			responsive:{
				0 : {
					items:1,
				},
				400 : {
					items:2,
					center:false,
				},
				599 : {
					items:3,
				},
				1024 : {
					items:5,
				},
				1170 : {
					items:6,
				}
			}
		});
	}
	
	//Carousel Roadmap
	var $roadmap_carousel = $('.roadmap-carousel');
	if ($roadmap_carousel.length > 0 ) {
		var c_rtl_r = ($body_m.hasClass('is-rtl')) ? true : false;
		$roadmap_carousel.addClass('owl-carousel').owlCarousel({
			items:6,
			nav:false,
			dost:true,
			margin:30,
			rtl: c_rtl_r,
			responsive:{
				0 : {
					items:1,
				},
				400 : {
					items:2,
					center:false,
				},
				599 : {
					items:3,
				},
				1024 : {
					items:4,
				},
				1170 : {
					items:5,
				}
			}
		});
	}	
	
	//Carousel Roadmap
	var $roadmap_carousel_withnav = $('.roadmap-carousel-withnav');
	if ($roadmap_carousel_withnav.length > 0 ) {
		var c_rtl_rn = ($body_m.hasClass('is-rtl')) ? true : false;
		$roadmap_carousel_withnav.addClass('owl-carousel').owlCarousel({
			navText: ["<i class='ti ti-angle-left'></i>","<i class='ti ti-angle-right'></i>"],
			items:5,
			nav:true,
			dost:false,
			margin:30,
			rtl: c_rtl_rn,
			responsive:{
				0 : {
					items:1,
				},
				400 : {
					items:2,
					center:false,
				},
				599 : {
					items:3,
				},
				1024 : {
					items:4,
				},
				1170 : {
					items:5,
				}
			}
		});
	}	

	//Carousel
	var $has_carousel = $('.has-carousel');
	if ($has_carousel.length > 0 ) {
		var c_rtl_c = ($body_m.hasClass('is-rtl')) ? true : false;
		$has_carousel.each(function(){
			var $self = $(this);
			var c_item = ($self.data('items')) ? $self.data('items') : 4;
			var c_item_t = (c_item >= 3) ? 2 : c_item;
			var c_item_m = (c_item_t >= 2) ? 1 : c_item_t;
			var c_delay =($self.data('delay')) ? $self.data('delay') : 6000;
			var c_auto =($self.data('auto')) ? true : false;
			var c_loop =($self.data('loop')) ? true : false;
			var c_dots = ($self.data('dots')) ? true : false;
			var c_navs = ($self.data('navs')) ? true : false;
			var c_ctr = ($self.data('center')) ? true : false;
			var c_mgn = ($self.data('margin')) ? $self.data('margin') : 30;
			$self.addClass('owl-carousel').owlCarousel({
				navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
				items: c_item, loop: c_loop, nav: c_navs, dots: c_dots, margin: c_mgn, center: c_ctr,
				autoplay: c_auto, autoplayTimeout: c_delay, autoplaySpeed: 300, rtl: c_rtl_c,
				responsive:{ 0:{ items:1 }, 480:{ items: c_item_m }, 768:{ items: c_item_t }, 1170:{ items: c_item } }
			});
		});
	}