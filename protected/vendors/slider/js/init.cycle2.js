//*** Global vars ***
var retina = window.devicePixelRatio > 1;	//detect retina display

//*** Actions for document ready ***
jQuery(document).ready(function($) {
	//Append the InputFocus() and InputBlur() functions to any elements with the class "clearfocus"
	$(".clearfocus").focus(function() { InputFocus(this); });
	$(".clearfocus").blur(function() { InputBlur(this); });
	$(".clearfocus").each(function() { if (this.value != this.defaultValue) { $(this).addClass('filled'); } });
	$(".resetfield").each(function() { $(this).val( this.defaultValue ); });
	
    //jquery validate defaultInvalid method
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		if (element.value == element.defaultValue) {return false;}
		return true;
	}, "This field is required.");
	
	//fix short pages
	MakeElementFillVisibleSpace('#container');
	
	//responsive layout
	ResponsiveLayout();
	
	//fix hero slideshow offset
	FixSlideshowOffset();
	
	//show or hide nav initially
	if ($(window).scrollTop() == 0) {
		ShowNav(0);
	}
	
	//cycle hero
	InitSlideshow();
	
	//cycle arrow keys
	$(document).keydown(function(e){
		if ( ! $(document.activeElement).is('input, textarea, select')) {	//disable on input
			if (e.keyCode == 37) { //left arrow
			   $('.hero .rotator').cycle('prev');
			   return false;
			} else if (e.keyCode == 39) { //right arrow
			   $('.hero .rotator').cycle('next');
			   return false;
			}
		}
	});
	
	//cycle photo credit
	if ($('.hero .photo-credit').length > 0) {
		$('.hero .rotator').on( 'cycle-before', function(event, opts, outgoing, incoming, forwardFlag) {
			$('.hero .photo-credit').stop().animate({opacity: 0}, 250, function() {
				var photograph_credit = $(incoming).attr('photograph_credit');
				if (photograph_credit != '') {
					$('.hero .photo-credit').text(photograph_credit);
					$('.hero .photo-credit').stop().animate({opacity: 1}, 250);
				}
			});
		});
		var photograph_credit = $('.hero .cycle-slide-active').attr('photograph_credit');	//initial photo
		if (photograph_credit != '') {
			$('.hero .photo-credit').text(photograph_credit);
			$('.hero .photo-credit').css('opacity', 1);
		} else {
			$('.hero .photo-credit').css('opacity', 0);
		}
	}
	
	//bind window scroll events
	$(window).scroll(function() {
		ScrollHeader();
	});
	ScrollHeader();
	if ($('body.home').length > 0) {
		$(window).scroll(function() {
			ScrollHomeNav();
		});
		ScrollHomeNav();
	}
		
	//nav dropdown on rollover
	jQuery('#header').mouseenter(function() {
		ShowNav();
	});
	jQuery('#header').mouseleave(function() {
		HideNav();
	});
	
	//gallery images lightbox
	$('.gallery-images a').fancybox({
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		titlePosition: 'inside',
		overlayColor: '#302821',
		padding: 0
	});
	
	//no context menu on right click on images
	$(document).bind('contextmenu', function(e) {
		 //e.preventDefault();
	 });
	 
	 //mobile menu trigger
	 $('.menu-toggle').click(function() {
		if ($(this).is('.open')) {
			mobileMenuOff();
		} else {
			mobileMenuOn();
		}
	 });
	 
	 //mobile menu overlay click - hide
	 $('.mobile-menu-overlay').click(function() {
		mobileMenuOff();
	 });
	 
	 //home menu ajax loading
	 $('.home .nav .ajax a').click(function() {
		var slug = $(this).attr('href').replace(base_url, '');
		slug = slug.replace(/\//g, '');
		window.location.href = '#' + slug;
		$('.home .nav li.current-menu-item').removeClass('current-menu-item');
		$(this).parent().addClass('current-menu-item');	//highlight nav
		return false;
	 });
	 
	 //retina display - replace images (they should have width/height already set)
	 if (retina) {
		$('img[retina_src]').each(function() {
			var retina_src = $(this).attr('retina_src');
			$(this).attr('src', retina_src);
		});
	 }
	 
	 //remove ads that aren't shown
	 $('.ad').each(function() {
		if ($(this).children().length == 0) {
			$(this).remove();
		}
	 });
	 /*if ($('.right-col-ad').length ==0) {	//enlarge article on desktop if no right ad
		$('.article-content').addClass('no-right-ad');
	 }*/
});

//*** Handheld device orientation change ***
window.onorientationchange = function() {
	//fix short pages
	MakeElementFillVisibleSpace('#container');
	
	//responsive layout
	ResponsiveLayout();
	
	//fix hero slideshow offset
	FixSlideshowOffset();
}

//*** Actions for window load, i.e. when all assets are downloaded ***
jQuery(window).load(function() {
	//fix short pages
	MakeElementFillVisibleSpace('#container');
	
	//responsive layout
	ResponsiveLayout();
	
	//fix hero slideshow offset
	FixSlideshowOffset();
	
	//fix header position
	ScrollHeader();
	if ($('body.home').length > 0) {
		ScrollHomeNav();
	}
});

//*** Actions for window resize ***
jQuery(window).resize(function() {
	//fix short pages
	MakeElementFillVisibleSpace('#container');
	
	//responsive layout
	ResponsiveLayout();
	
	//fix hero slideshow offset
	FixSlideshowOffset();
});


//*** Custom Functions ***


//init slideshow
var swiping = 0;
function InitSlideshow() {
	$('.hero .rotator').cycle('destroy');
	$('.hero .rotator img').css('visibility', 'visible');	//fix disappearing images	
	$('.hero .rotator').cycle({
		timeout: 0,
		speed: 650,
		fx: 'carousel',
		'pause-on-hover': true,
		next: '#hero_next',
		prev: '#hero_prev',
		slides: '> a',
		'carousel-visible': 3,
		pager: '#hero_pager'
	});
	$('.hero .rotator').off( 'cycle-update-view');	//unbind link event
	$('.hero .rotator').off( 'cycle-before');	//unbind link event
	$('.hero .rotator').on( 'cycle-before', function( event, opts ) {	//remove link
		$('.hero .hero-inner-link').removeAttr('href');
	});
	$('.hero .rotator').on( 'cycle-update-view', function( event, opts ) {	//update link event
		var link = $('.hero .rotator .cycle-slide-active').attr('href');
		if (link != '' && link != undefined) {
			$('.hero .hero-inner-link').attr('href', link);
		}
	});
	$('.hero').touchwipe({
			wipeLeft: function() {
				if (swiping == 0) {
					swiping = 1;
					jQuery(".hero .rotator").cycle("next");
					setTimeout(function() { swiping=0; }, 200);	//hacky
				}
			},
			wipeRight: function() {
				if (swiping == 0) {
					swiping = 1;
					jQuery(".hero .rotator").cycle("prev");
					setTimeout(function() { swiping=0; }, 200);	//hacky
				}
			},
			preventDefaultEvents: false	//enable scrolling up/down
	});	
	FixSlideshowOffset();
}

//fix for cycle2 slider not updating pager immediately
$(document).on( 'cycle-update-view-before', function( e, opts, slideOpts ) {
    var pagers;
    if ( opts.pager ) {
        pagers = opts.API.getComponent( 'pager' );
        pagers.each(function() {
           $(this).children().removeClass( opts.pagerActiveClass )
            .eq( opts.currSlide ).addClass( opts.pagerActiveClass );
        });
    }
});

//center the slideshow
function FixSlideshowOffset() {
	if ($('.hero').length > 0) {
		image_width = $('.hero img').first().width();
		window_width = $(window).width();
		var offset = (window_width - image_width) / 2;
		if (offset < 0) { offset = 0; }
		$('.hero .rotator .cycle-carousel-wrap').css('margin-left', offset)
	}
	
	//fix overlapping hero nav and photo credit (on mobile)
	var hero_width = $('.hero .inner').width();
	var extras_width = $('#hero_pager').width() + $('.photo-credit').width() + 50;
	if (extras_width > hero_width) {
		$('.hero .inner').addClass('stacked');
	} else {
		$('.hero .inner').removeClass('stacked');
	}
}

//move the header/nav
function ScrollHeader() {
	var scrollTop = $(window).scrollTop();
	//hide/show nav
	if (scrollTop == 0) {
		$('#header').removeAttr('hiding');
		ShowNav(200);
	} else {
		if ($('#header:hover').length == 0 && ! $('#header').attr('hiding') == '1') {
			$('#header').attr('hiding', '1');
			HideNav(350);
			setTimeout(function() {
				$('#header').removeAttr('hiding');
			}, 350);
		}
	}
}
function ScrollHomeNav() {
	if ($('body.mobile').length > 0) { return false; }	//don't do anything in mobile view
	var scrollTop = jQuery(window).scrollTop();
	var header_height = $('#header').outerHeight();
	if ($('#header.smaller').length > 0) { header_height = header_height + 21; }
	
	if ($('.nav-container.lower').attr('initial_top')) {
		var nav_initial_top = $('.nav-container.lower').attr('initial_top');
	} else {
		var nav_initial_top = $('.nav-container.lower').position().top;
		$('.nav-container.lower').attr('initial_top', nav_initial_top);	//save the intial top position
	}
	
	if (scrollTop > nav_initial_top - header_height) {	//scrolling down
		if ($('.nav-container.lower .nav').length > 0) {
			$('.nav-container.lower .nav').appendTo('.nav-container.upper'); //move nav in DOM
			ShowNav(0);
			if ($('#header:hover').length == 0 && ! $('#header').attr('hiding') == '1') {
				$('#header').attr('hiding', '1');
				HideNav(350);
				setTimeout(function() {
					$('#header').removeAttr('hiding');
				}, 350);
			}
			$('.home #header .inner .arrow').hide();
			$('.nav-container.lower').css('z-index', 100);
		}
		//swap header on home
		$('.home-header *').fadeOut();
		$('.inside-header *').fadeIn();
		$('.home #header').addClass('smaller');
	} else {	//scrolling up
		if ($('.nav-container.upper .nav').length > 0) {
			$('.nav-container.upper .nav').appendTo('.nav-container.lower'); //move nav in DOM
			$('.home #header .inner .arrow').show();
			$('.nav-container.lower').css('z-index', 200);
		}
		//swap header on home
		$('.inside-header *').fadeOut();
		$('.home-header *').fadeIn();
		$('.home #header').removeClass('smaller');
	}
}

//responsive layout
function ResponsiveLayout() {
	var window_width = $(window).width();
	var switching;
	if ($('body').is('.responsive')) {	//already applied
		switching = false;
	} else {
		switching = true; //apply switching logic first time
		$('body').addClass('responsive');
	}

	if (window_width < 768) {		//mobile
		if ( ! $('body').is('.mobile')) { switching=true;	}
		$('body').removeClass('full tablet');
		$('body').addClass('mobile');
		ScrollHeader();
		if ($('body.home').length > 0) {
			ScrollHomeNav();
		}
		if (switching == true) { //changed from to full size to mobile
			if ($('body.home').length > 0) {
				$('.nav-container.lower .nav').appendTo('.nav-container.upper');	//move nav in DOM
			}
			mobileMenuOff(0);
			InitSlideshow();	//re-init slideshow
		}
		mobileMenuOff(0);
	} else if (window_width < 1200) {		//tablet
		if ( ! $('body').is('.tablet')) { switching=true;	}
		$('body').removeClass('full mobile');
		$('body').addClass('tablet');
		ScrollHeader();
		if ($('body.home').length > 0) {
			ScrollHomeNav();
		}
		if (switching == true) { //changed from mobile to full size
			$('.nav-container.upper').show();
			if ($('body.home').length > 0) {
				$('.nav-container.upper .nav').appendTo('.nav-container.lower');	//move nav in DOM
			}
			mobileMenuOff(0);
			InitSlideshow();	//re-init slideshow
		}
	} else {
		if ( ! $('body').is('.full')) { switching=true; }
		$('body').removeClass('tablet mobile');
		$('body').addClass('full');
		ScrollHeader();
		if ($('body.home').length > 0) {
			ScrollHomeNav();
		}
		if (switching == true) { //changed from mobile to full size
			$('.nav-container.upper').show();
			if ($('body.home').length > 0) {
				$('.nav-container.upper .nav').appendTo('.nav-container.lower');	//move nav in DOM
			}
			mobileMenuOff(0);
			InitSlideshow();	//re-init slideshow
		}
	}
	
	 //right column ad, article-sidebar set (single pages)
	 if ($('.article-content .entry-content').length > 0) {
		var content_top = $('.article-content .entry-content').position().top;
		$('.right-col-ad').css('top', content_top+9);
		var article_sidebar_top = $('.article-sidebar').position().top;
		$('.article-sidebar').css('margin-top', content_top-article_sidebar_top+9);
	}
	
	//stretch elements 100%
	$('.stretch').each(function() {
		$(this).css('width', 'auto').css('margin-left', 0);	//set to default width
		var offset_left = $(this).offset().left * -1;
		var new_width = window_width;
		$(this).width(new_width).css('margin-left', offset_left);
	});
}

//mobile menu show
function mobileMenuOn(speed) {
	if (speed == undefined) {speed=300;}
	$('.mobile .nav-container.upper').show();
	$('.menu-toggle').addClass('open');
	var menu_height = $('.mobile .nav').height();
	$('.mobile .nav').css('top', menu_height * -1);
	$('.mobile .nav').animate({'top': 0}, speed);
	$('.mobile .mobile-menu-overlay').stop().show().animate({'opacity': 0.8}, speed);
}

//mobile menu hide
function mobileMenuOff(speed) {
	if (speed == undefined) {speed=300;}
	$('.menu-toggle').removeClass('open');
	var menu_height = $('.mobile .nav').height();
	$('.mobile .nav').animate({'top': menu_height * -1}, speed, function() {
		$('.mobile .nav-container.upper').hide();
	});
	$('.mobile .mobile-menu-overlay').stop().show().animate({'opacity': 0}, speed, function() {
		$(this).hide();
	});
}

//show nav
function ShowNav(time) {
	if (time == undefined) { time = 200; }
	if ($('body.mobile').length > 0) { return false; }
	jQuery('#header .nav-container.upper').css('height', 40);
	jQuery('#header .nav').stop().animate({top: 0}, time);
}
//hide nav
function HideNav(time) {
	if (time == undefined) { time = 200; }
	if ($('body.mobile').length > 0) { return false; }
	if ($(window).scrollTop() == 0) { return false; }
	jQuery('#header .nav').stop().animate({top: -28}, time, function() {
		jQuery('#header .nav-container.upper').css('height', 12);
	});
}


//*** Basic Functions ***

function InputFocus(element) {
	if (element.value == element.defaultValue) {
		element.value = "";
		jQuery(element).addClass('filled');
	}
}
function InputBlur(element) {
	if (element.value == "") {
		jQuery(element).removeClass('filled');
		element.value = element.defaultValue;
	}
}

//Function to make an element, e.g. content area, fill the visible space so a footer appears at the bottom. Wrapper can be a container or body element.
function MakeElementFillVisibleSpace(element_to_adjust, wrapper_element) {
	if (wrapper_element == undefined) { wrapper_element = 'body'; }
	jQuery(element_to_adjust).height('auto');
	if ( jQuery(wrapper_element).height() < jQuery(window).height() ) {
		height_difference = jQuery(window).height() - jQuery(wrapper_element).height();
		new_height = jQuery(element_to_adjust).height() + height_difference;
		jQuery(element_to_adjust).height(new_height);
	}
}

//Make single element the same height as another single element - good for having two columns the same height
function MatchHeight(elementToAdjust, elementToCompare, adjust_offset, compare_offset) {
	if (isNaN(adjust_offset)) {
		adjust_offset=jQuery(elementToAdjust).outerHeight(true) - jQuery(elementToAdjust).height();
	};
	if (isNaN(compare_offset)) {
		compare_offset=jQuery(elementToCompare).outerHeight(true) - jQuery(elementToCompare).height();
	};
	if ( jQuery(elementToAdjust).height()+adjust_offset < jQuery(elementToCompare).height()+compare_offset ) {
		jQuery(elementToAdjust).height( jQuery(elementToCompare).height()+compare_offset-adjust_offset );	//adjust the height of the adjust element to the compare element
	}
}

//get a querystring by name
function querySt(ji) {
	hu = window.location.search.substring(1);
	gy = hu.split("&");
	for (i=0;i<gy.length;i++) {
		ft = gy[i].split("=");
		if (ft[0] == ji) {
			return ft[1];
		}
	}
}