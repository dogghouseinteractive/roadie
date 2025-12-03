jQuery(document).ready(function() {
	//Handle the Hamburger open/close logic
	jQuery('#hamburger').on('click', function() {
		if(jQuery(this).hasClass('clicked')) {
			jQuery(this).removeClass('clicked');
			jQuery(this).css('top', '50%');
			jQuery('body').removeClass('nav-is-open');
		} else {
			jQuery(this).addClass('clicked');
			jQuery('body').addClass('nav-is-open');
		}
		if(jQuery('.top-bun, .patty, .bottom-bun').hasClass('animated')) {
			jQuery('.top-bun, .patty, .bottom-bun').removeClass('animated').css('opacity', '1.0');
		}
		jQuery('#hamburger-toggle-menu').toggleClass('clicked');
	});
	
	//Prevent parent menu item from triggering navigation on click when sub nav exists
	jQuery('#toggle-nav li.menu-item-has-children').on('click', function() {
		jQuery(this).toggleClass('clicked');
	});
	jQuery('#toggle-nav li.menu-item-has-children .sub-menu li a').on('click', function(e) {
		e.stopPropagation();
	});
	jQuery('#toggle-nav li.menu-item-has-children > a').on('click', function(e) {
		e.preventDefault();
	});

	function masonry() {
		jQuery('.masonry').imagesLoaded(function() {
			jQuery('.masonry').masonry({
				itemSelector: 'a'
			});
		});
	}
	setTimeout(masonry, 300);
	
	if(jQuery(window).width() > 767) {
		jQuery('.lazy').each(function() {
			var scroll = jQuery(window).scrollTop();
			if(scroll >= jQuery(this).offset().top - Math.floor(jQuery(window).height()) ) {
				jQuery(this).attr('loaded', 'true');
				jQuery(this).addClass('loaded');
			}
		});
	}
	
	/* For Accordions with Images, prevent closing of all accordions, but open a closed one on click, while closing any open ones */
	
	jQuery(document).on('click', '.accordions-block.content-above .accordions .accordion .accordion-heading', function() {
		if(jQuery(this).closest('.accordion').hasClass('active')) {
			// Do nothing 
		} else if(jQuery('.accordion').hasClass('active')) {
			jQuery('.accordion').removeClass('active');
			jQuery(this).closest('.accordion').addClass('active');
		} else {
			jQuery(this).closest('.accordion').addClass('active');
		} 
	});
	
	/* For Accordions without Images, make them open and close like regular accordions */
	jQuery(document).on('click', '.accordions-block.content-beside .accordions .accordion .accordion-heading', function() {
		if(jQuery(this).closest('.accordion').hasClass('active')) {
			jQuery(this).closest('.accordion').removeClass('active');
		} else if(jQuery('.accordion').hasClass('active')) {
			jQuery('.accordion').removeClass('active');
			jQuery(this).closest('.accordion').addClass('active');
		} else {
			jQuery(this).closest('.accordion').addClass('active');
		}
	});
	
	/* Accordion the Categories menu on the blog page(s) */
	jQuery('aside#secondary #block-5').on('click', function() {
		jQuery(this).toggleClass('clicked');
		jQuery('aside#secondary #block-4').toggleClass('clicked');
	});
	
});

jQuery('#logo').imagesLoaded(function() {
	if(jQuery('#hamburger').hasClass('clicked')) {
		jQuery('body').addClass('nav-is-open');
		jQuery('header #hamburger-toggle-menu').addClass('clicked');
	}
	if(jQuery('#wpadminbar').length > 0) {
		var adminBarHeight = jQuery('#wpadminbar').height();
	} else {
		var adminBarHeight = 0;
	}
	var headerHeight = jQuery('header.site-header').outerHeight();
	jQuery('header.site-header').css('top', adminBarHeight);
	jQuery('main').css('padding-top', headerHeight);
	jQuery('.top-bun, .patty, .bottom-bun, #logo').addClass('animated');
});

jQuery(window).on('resize', function() {
	
});

if(jQuery(window).width() > 767) {
	jQuery(window).on('scroll', function() {
		var scroll = jQuery(window).scrollTop();
		jQuery('.lazy').each(function() {
			if(!jQuery(this).hasClass('loaded')) { 
				if(scroll >= jQuery(this).offset().top - Math.floor(jQuery(window).height()) ) {
					jQuery(this).attr('loaded', 'true');
					jQuery(this).addClass('animated');
					if(jQuery(this).hasClass('fade-in-up')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-down')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-left')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-right')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-up')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-down')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-left')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in-right')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('fade-in')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('slide-in-right')) {
						jQuery(this).addClass('fadeIn');
						jQuery(this).css('opacity', '1.0');
					}
					if(jQuery(this).hasClass('slide-in-left')) {
						jQuery(this).addClass('fadeIn');
						jQuery(this).css('opacity', '1.0');
					}
					if(jQuery(this).hasClass('slide-in-right')) {
						jQuery(this).addClass('fadeIn');
						jQuery(this).css('opacity', '1.0');
					}
					if(jQuery(this).hasClass('slide-in-left')) {
						jQuery(this).addClass('fadeIn');
						jQuery(this).css('opacity', '1.0');
					}
					if(jQuery(this).hasClass('zoom-in')) {
						jQuery(this).addClass('fadeIn');
						jQuery(this).css('opacity', '1.0');
					}
				}
			}
		});
		if(scroll >= 1) {
			jQuery('.masonry').imagesLoaded(function() {
				jQuery('.masonry').masonry({
					itemSelector: 'a'
				});
			});
		}
	});
}