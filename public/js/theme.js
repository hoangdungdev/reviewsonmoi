(function($){
"use strict"; // Start of use strict
//Fix Detail Info
function detail_fixed(){
	if($(window).width()>767){
		if($('.detail-fixed-info').length>0){
			var ot = $('.detail-fixed-info').offset().top;
			var sh = $('.detail-fixed-info').height();
			var height = $('.detail-info').map(function (){
				return $(this).height();
			}).get();
			var dh = Math.max.apply(null, height);
			var st = $(window).scrollTop();
			var top = $(window).scrollTop() - ot;
			if(st>ot&&st<ot+sh-dh){
				$('.detail-fixed-info').addClass('onscroll');
				$('.detail-fixed-info.onscroll .detail-info').css('top',top+'px');
			}else if(st<ot){
				$('.detail-info').css('top',0);
			}else{
				$('.detail-fixed-info').removeClass('onscroll');
			}
		}
	}else{
		$('.detail-info').css('top',0);
	}
}
//Tag Toggle
function toggle_tab(){
	if($('.toggle-tab').length>0){
		$('.toggle-tab').each(function(){
			$(this).find('.item-toggle-tab.active .toggle-tab-content').show();
			$(this).find('.toggle-tab-title').on('click',function(event){
				if($(this).next().length>0){
					event.preventDefault();
					$(this).parent().siblings().removeClass('active');
					$(this).parent().addClass('active');
					$(this).parents('.toggle-tab').find('.toggle-tab-content').slideUp();
					$(this).next().stop(true,false).slideDown();
				}
				
			});
		});
	}
}	
//Popup Wishlist
function popup_wishlist(){
	$('.wishlist-link').on('click',function(event){
		event.preventDefault();
		$('.wishlist-mask').fadeIn();
		var counter = 5;
		var popup;
		popup = setInterval(function() {
			counter--;
			if(counter < 0) {
				clearInterval(popup);
				$('.wishlist-mask').hide();
			} else {
				$(".wishlist-countdown").text(counter.toString());
			}
		}, 1000);
	});
}
//Menu Responsive
function rep_menu(){
	if($(window).width()<768){
		if($('.btn-toggle-mobile-menu').length>0){
			return false;
		}else{
			$('.main-nav li.menu-item-has-children,.main-nav li.has-mega-menu').append('<span class="btn-toggle-mobile-menu"></span>');
			$('.main-nav .btn-toggle-mobile-menu').on('click',function(event){
				$(this).toggleClass('active');
				$(this).prev().stop(true,false).slideToggle();
			});
		}
	}else{
		$('.btn-toggle-mobile-menu').remove();
		$('.main-nav .sub-menu,.main-nav .mega-menu').slideDown();
	}
}
//Custom ScrollBar
function custom_scroll(){
	if($('.custom-scroll').length>0){
		$('.custom-scroll').each(function(){
			$(this).mCustomScrollbar({
				scrollButtons:{
					enable:true
				}
			});
		});
	}
}
//Offset Menu
function offset_menu(){
	if($(window).width()>767){
		$('.main-nav .sub-menu').each(function(){
			var wdm = $(window).width();
			var wde = $(this).width();
			var offset = $(this).offset().left;
			var tw = offset+wde;
			if(tw>wdm){
				$(this).addClass('offset-right');
			}
		});
	}else{
		return false;
	}
}
//Fixed Header
function fixed_header(){
	if($('.header-ontop').length>0){
		if($(window).width()>1023){
			var ht = $('#header').height();
			var st = $(window).scrollTop();
			if(st>ht){
				$('.header-ontop').addClass('fixed-ontop');
			}else{
				$('.header-ontop').removeClass('fixed-ontop');
			}
		}else{
			$('.header-ontop').removeClass('fixed-ontop');
		}
	}
} 
//Slider Background
function background(){
	$('.bg-slider .item-slider').each(function(){
		var src=$(this).find('.banner-thumb a img').attr('src');
		$(this).css('background-image','url("'+src+'")');
	});	
}
function animated(){
	$('.banner-slider .owl-item').each(function(){
		var check = $(this).hasClass('active');
		if(check==true){
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).addClass(anime);
			});
		}else{
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).removeClass(anime);
			});
		}
	});
	var owl = this;
	var visible = this.owl.visibleItems;
	var first_item = visible[0];
	var last_item = visible[visible.length-1];
	this.$elem.find('.owl-item').removeClass('first-item');
	this.$elem.find('.owl-item').removeClass('last-item');
	this.$elem.find('.owl-item').eq(first_item).addClass('first-item');
	this.$elem.find('.owl-item').eq(last_item).addClass('last-item');
}
function slick_animated(){
	$('.banner-slider .item-slider').each(function(){
		var check = $(this).hasClass('slick-active');
		if(check==true){
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).addClass(anime);
			});
		}else{
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).removeClass(anime);
			});
		}
	});
}
function slick_control(){
	$('.slick-slider').each(function(){
		$(this).find('.slick-prev').html($('.slick-active').prev().find('.client-thumb a').html());
		$(this).find('.slick-next').html($('.slick-active').next().find('.client-thumb a').html());
	});
}
//Detail Gallery
function detail_gallery(){
	if($('.detail-gallery').length>0){
		$('.detail-gallery').each(function(){
			$(this).find(".carousel").jCarouselLite({
				btnNext: $(this).find(".gallery-control .next"),
				btnPrev: $(this).find(".gallery-control .prev"),
				speed: 800,
				visible:4
			});
			//Elevate Zoom
			$('.detail-gallery').find('.mid img').elevateZoom({
				zoomType: "inner",
				cursor: "crosshair",
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 750
			});
			$(this).find(".carousel a").on('click',function(event) {
				event.preventDefault();
				$(this).parents('.detail-gallery').find(".carousel a").removeClass('active');
				$(this).addClass('active');
				var z_url =  $(this).find('img').attr("src");
				$(this).parents('.detail-gallery').find(".mid img").attr("src", z_url);
				$('.zoomWindow').css('background-image','url("'+z_url+'")');
			});
		});
	}
}
//Background Image
function background_image(){
	if($('.banner-background').length>0){
		$('.banner-background').each(function(){
			var i_url = $(this).find('.image-background').attr("src");
			$(this).css('background-image','url("'+i_url+'")');	
		});
	}
}

//Document Ready
jQuery(document).ready(function(){
	//Fixed Detail
	detail_fixed();
	//Box Parallax	
	if($('.parallax').length>0){
		$('.parallax').each(function(){
			var p_url = $(this).attr("data-image");
			$(this).css('background-image','url("'+p_url+'")');	
		});
	}
	//Full Mega Menu
	if($('.main-nav').length>0){
		$('.main-nav').each(function(){
			var nav_os = $(this).offset().left;
			var par_os = $(this).parents('.container,.container-fluid').offset().left;
			var nav_left = nav_os - par_os - 15;
			$(this).find('.has-mega-menu > .sub-menu').css('margin-left','-'+nav_left+'px');
		});
	}
	//Vegetable Hover
	if($('.fruit-list-cat').length>0){
		$('.fruit-list-cat').each(function(){
			$(this).find('.item-fruit-cat1').on('mouseover',function(){
				$(this).parents('.fruit-list-cat').find('.item-fruit-cat1').removeClass('item-center');
				$(this).addClass('item-center');
			});
			$(this).on('mouseout',function(){
				$(this).find('.item-fruit-cat1').removeClass('item-center');
				$(this).find('.item-active').addClass('item-center');
			});
		});
	}
	//Filter Price
	if($('.range-filter').length>0){
		$('.range-filter').each(function(){
			$(this).find( ".slider-range" ).slider({
				range: true,
				min: 0,
				max: 800,
				values: [ 50, 545 ],
				slide: function( event, ui ) {
					$(this).parents('.range-filter').find( ".amount" ).html( '<span>' + 'Price: $' +ui.values[ 0 ]+'</span>' + '<span>' + ' - $' + ui.values[ 1 ]+'</span>');
				}
			});
			$(this).find( ".amount" ).html('<span>' + 'Price: $' +$(this).find( ".slider-range" ).slider( "values", 0 )+'</span>' + '<span>'+ ' - $' +$(this).find( ".slider-range" ).slider( "values", 1 )+'</span>');
		});
	}
	//Qty Up-Down
	$('.detail-qty').each(function(){
		var qtyval = parseInt($(this).find('.qty-val').text(),10);
		$(this).find('.qty-up').on('click',function(event){
			event.preventDefault();
			qtyval=qtyval+1;
			$('.qty-val').text(qtyval);
		});
		$(this).find('.qty-down').on('click',function(event){
			event.preventDefault();
			qtyval=qtyval-1;
			if(qtyval>1){
				$('.qty-val').text(qtyval);
			}else{
				qtyval=1;
				$('.qty-val').text(qtyval);
			}
		});
	});
	//Menu Responsive
	$('.toggle-mobile-menu').on('click',function(event){
		event.preventDefault();
		$(this).parents('.main-nav').toggleClass('active');
	});
	//Detail Gallery
	detail_gallery();
	//Wishlist Popup
	popup_wishlist();
	//Menu Responsive 
	rep_menu();
	//Offset Menu
	offset_menu();
	//Toggle Tab
	toggle_tab();
	//Background Image
	background_image();
	//Animate
	if($('.wow').length>0){
		new WOW().init();
	}
	//Video Light Box
	if($('.btn-video').length>0){
		$('.btn-video').fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',

			arrows : false,
			helpers : {
				media : {},
				buttons : {}
			}
		});	
	}
	//Light Box
	if($('.fancybox').length>0){
		$('.fancybox').fancybox();	
	}
	if($('.fancybox-media').length>0){
		$('.fancybox-media').attr('rel', 'media-gallery').fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',
			arrows : false,
			helpers : {
				media : {},
				buttons : {}
			}
		});
	}
	if($('.fancybox-buttons').length>0){
		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',

			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,

			helpers : {
				title : {
					type : 'inside'
				},
				buttons	: {}
			},

			afterLoad : function() {
				this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});
	}
	//Back To Top
	$('.scroll-top').on('click',function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow');
	});
	//Shop The Look
	$('.box-hover-dir').each( function() {
		$(this).hoverdir(); 
	});
});
//Window Load
jQuery(window).on('load',function(){ 
	//Video Parallax
	if($('.block-video-parallax').length > 0){
		if($(window).width()>1024){
			$(window).on('scroll',function() {
				var ot = $('.block-video-parallax').offset().top;
				var sh = $('.block-video-parallax').height();
				var st = $(window).scrollTop();
				var top = (($(window).scrollTop() - ot) * 0.5) + 'px';
				if(st>ot&&st<ot+sh){
					$('.block-video-parallax .video-parallax').css({
						'margin-top': top
					});
				}else{
					$('.block-video-parallax .video-parallax').css({
						'margin-top': 0
					});
				}
			});
		}
	}
	//Custom Scroll
	custom_scroll();
	//Pre Load
	$('body').removeClass('preload'); 
	//Owl Carousel
	if($('.wrap-item').length>0){
		$('.wrap-item').each(function(){
			var data = $(this).data();
			$(this).owlCarousel({
				addClassActive:true,
				stopOnHover:true,
				lazyLoad:true,
				itemsCustom:data.itemscustom,
				autoPlay:data.autoplay,
				transitionStyle:data.transition, 
				paginationNumbers:data.paginumber,
				beforeInit:background,
				afterAction:animated,
				navigationText:['<i class="icon ion-ios-arrow-thin-left"></i>','<i class="icon ion-ios-arrow-thin-right"></i>'],
			});
		});
	}
	//Parallax Slider
	if($('.parallax-slider').length>0){
		$(window).scroll(function() {
			var ot = $('.parallax-slider').offset().top;
			var sh = $('.parallax-slider').height();
			var st = $(window).scrollTop();
			var top = (($(window).scrollTop() - ot) * 0.5) + 'px';
			if(st>ot&&st<ot+sh){
				$('.parallax-slider .item-slider').css({
					'background-position': 'center ' + top
				});
			}else{
				$('.parallax-slider .item-slider').css({
					'background-position': 'center 0'
				});
			}
		});
	}
	//Slick Slider
	if($('.client-slider .slick').length>0){
		$('.client-slider .slick').each(function(){
			$(this).slick({
				fade: true,
				infinite: true,
				initialSlide:1,
				slidesToShow: 1,
				prevArrow:'<div class="slick-prev slick-nav"></div>',
				nextArrow:'<div class="slick-next slick-nav"></div>',
			});
			slick_control();
			$('.slick').on('afterChange', function(event){
				slick_control();
			});
		});
	}	
	//Popular Category Slider
	if($('.popcat-slider16 .slick').length>0){
		$('.popcat-slider16 .slick').each(function(){
			$(this).slick({
				infinite: true,
				slidesToShow: 4,
				initialSlide:2,
				centerMode: true,
				centerPadding: '320px',
				prevArrow:'<span class="prev"><i class="icon ion-ios-arrow-thin-left"></i></span>',
				nextArrow:'<span class="next"><i class="icon ion-ios-arrow-thin-right"></i></span>',
				responsive: [
					{
					  breakpoint: 1500,
					  settings: {
						centerMode: true,
						centerPadding: '250px',
						slidesToShow: 3
					  }
					},
					{
					  breakpoint: 1170,
					  settings: {
						centerMode: true,
						centerPadding: '150px',
						slidesToShow: 3
					  }
					},
					{
					  breakpoint: 768,
					  settings: {
						centerMode: true,
						centerPadding: '0px',
						slidesToShow: 3
					  }
					},
					{
					  breakpoint: 560,
					  settings: {
						centerMode: true,
						centerPadding: '0px',
						slidesToShow: 2
					  }
					},
					{
					  breakpoint: 375,
					  settings: {
						centerMode: true,
						centerPadding: '0px',
						slidesToShow: 1
					  }
					}
				  ]
			});
		});
	}	
	//Day Countdown
	if($('.days-countdown').length>0){
		$(".days-countdown").TimeCircles({
			fg_width: 0.05,
			bg_width: 0,
			text_size: 0,
			circle_bg_color: "transparent",
			time: {
				Days: {
					show: true,
					text: "Days",
					color: "#fff"
				},
				Hours: {
					show: true,
					text: "Hours",
					color: "#fff"
				},
				Minutes: {
					show: true,
					text: "Mins",
					color: "#fff"
				},
				Seconds: {
					show: true,
					text: "Secs",
					color: "#fff"
				}
			}
		}); 
	}
	//Day Countdown
	if($('.deal-timer').length>0){
		$(".deal-timer").TimeCircles({
			fg_width: 0.05,
			bg_width: 0,
			text_size: 0,
			circle_bg_color: "transparent",
			time: {
				Days: {
					show: true,
					text: "",
					color: "#fff"
				},
				Hours: {
					show: true,
					text: "",
					color: "#fff"
				},
				Minutes: {
					show: true,
					text: "",
					color: "#fff"
				},
				Seconds: {
					show: true,
					text: "",
					color: "#fff"
				}
			}
		}); 
	}
	//Time Countdown
	if($('.time-countdown').length>0){
		$(".time-countdown").each(function(){
			var data = $(this).data(); 
			$(this).TimeCircles({
				fg_width: data.width,
				bg_width: 0,
				text_size: 0,
				circle_bg_color: data.bg,
				time: {
					Days: {
						show: data.day,
						text: data.text[0],
						color: data.color,
					},
					Hours: {
						show: data.hou,
						text: data.text[1],
						color: data.color,
					},
					Minutes: {
						show: data.min,
						text: data.text[2],
						color: data.color,
					},
					Seconds: {
						show: data.sec,
						text: data.text[3],
						color: data.color,
					}
				}
			}); 
		});
	}
	//Count Down Master
	if($('.countdown-master').length>0){
		$('.countdown-master').each(function(){
			$(this).FlipClock(65100,{
		        clockFace: 'HourlyCounter',
		        countdown: true,
		        autoStart: true,
		    });
		});
	}
	//Blog Masonry 
	if($('.masonry-list-post').length>0){
		$('.masonry-list-post').masonry({
			// options
			itemSelector: '.item-post-masonry',
		});
	}
});
//Window Resize
jQuery(window).on('resize',function(){
	offset_menu();
	fixed_header();
	detail_gallery();
	rep_menu();
	detail_fixed();
});
//Window Scroll
jQuery(window).on('scroll',function(){
	//Fixed Detail
	detail_fixed();
	//Scroll Top
	if($(this).scrollTop()>$(this).height()){
		$('.scroll-top').addClass('active');
	}else{
		$('.scroll-top').removeClass('active');
	}
	//Fixed Header
	fixed_header();
	//Rotate Number
	if($('.list-statistic').length>0){
		var hT = $('.list-statistic').offset().top;
		var	hH = $('.list-statistic').outerHeight();
		var	wH = $(window).height();
		var	wS = $(this).scrollTop();
		if (wS > (hT + hH - wH)) {
			$('.numscroller').each(function() {
				$(this).prop('Counter', 0).animate({
					Counter: $(this).text()
				}, {
					duration: 1000,
					easing: 'swing',
					step: function() {
						$(this).text(Math.ceil(this.Counter));
					}
				});
			}); {
				$('.rotate-number').removeClass('numscroller');
			};
		}
	}
});
})(jQuery); // End of use strict