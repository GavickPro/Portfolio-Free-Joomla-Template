/**
 * @package     Joomla.Site
 * @subpackage  Templates.gk_portfolio
 *
 * @copyright   Copyright (C) 2015 GavickPro. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

function portfolio_is_touch_device() {
	return (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
}

(function($) {
	$(document).ready(function() {
		// set the information about touch screen
		$(document.body).addClass(portfolio_is_touch_device() ? 'touch-screen' : 'no-touch-screen');

		// get the post images
		var blocks = [];

		jQuery('.item--notloaded').each(function(i, block) {
			blocks.push(block);
		});

		var add_class = function(block, class_name, delay) {
			setTimeout(function() {
				jQuery(block).addClass(class_name);
			}, delay);
		};

		for(var i = 0; i < blocks.length; i++) {
			add_class($(blocks[i]).find('.item__helper'), 'item__helper--animated', i * 200);
		}

		// Fix :hover portfolio effect on the touch screens
		jQuery('.item').each(function(i, block) {
			block = jQuery(block);

			if(block.find('.item__preview').length) {
				var preview = block.find('.item__preview');

				block.bind('touchstart', function() {
					block.attr('data-touch-time', new Date());
				});

				block.bind('touchend', function(e) {				
					if(block.attr('data-touch-time') - new Date() < 500) {
						if(block.hasClass('item--hover')) {
							block.removeClass('item--hover');
						} else {
							block.addClass('item--hover');
						}
					}
				});

				if(preview.attr('data-url')) {
					preview.click(function() {
						window.location.href = preview.attr('data-url');
					});
				}
			} else {
				var preview = block.find('.item__title');

				if(preview.attr('data-url')) {
					block.click(function() {
						window.location.href = preview.attr('data-url');
					});
				}
			}
		});

		jQuery('.item--notloaded').each(function(i, wrapper) {
			wrapper = jQuery(wrapper);
			var img = wrapper.find('img')[0];
			var interval = 500;

			if(wrapper.hasClass('item--slow-animation')) {
				interval = 750;
			}

			if(wrapper.hasClass('item--fast-animation')) {
				interval = 250;
			}

			if(img) {
				// wait for the images
				var timer = setInterval(function() {
					// when the image is laoded
					if(img.complete) {
						// stop periodical calls
						clearInterval(timer);
						// generate the image wrapper
						var src = jQuery(img).attr('src');
						var url = jQuery(img).parent().attr('data-url');
						jQuery(img).remove();
						var img_container = jQuery('<div class="item__image item--transition-long" data-url="'+url+'" style="background-image: url(\''+src+'\')"></div>');
						img_container.appendTo(wrapper.find('.item__helper'));
						
						if(url) {
							img_container.css('cursor', 'pointer');
							
							img_container.bind('touchend', function(e) {
								img_container.attr('data-touched', 'true');

								setTimeout(function() {
									img_container.attr('data-touched', 'false');
								}, 250);
							});

							img_container.click(function() {
								if(!img_container.attr('data-touched') || img_container.attr('data-touched') === 'false') {
									window.location = img_container.attr('data-url');
								}
							});
						}
						
						wrapper.removeClass('item--notloaded');
						// add class with delay
						setTimeout(function() {
							img_container.addClass('item--loaded');
						}, interval);
					}          
				}, 500);
				// add necessary mouse events
				wrapper.mouseenter(function() {
					if(!wrapper.hasClass('item--no-anim')) {
						wrapper.addClass('item--hover');
						wrapper.find('.item__preview').addClass('item__preview--show');
					}
				});

				wrapper.mouseleave(function() {
					if(!wrapper.hasClass('item--no-anim')) {
						wrapper.removeClass('item--hover');
						wrapper.find('.item__preview').removeClass('item__preview--show');
					}
				});
			} else {
				// where there is no image - display the text directly
				wrapper.find('.item__preview').addClass('item__preview--show');
			}
		});

		// Gallery popups
		var photos = jQuery('.gk-photo');
		
		if(photos.length > 0) {
			// photos collection
			var collection = [];
			// create overlay elements
			var overlay = jQuery('<div>', { class: 'gk-photo-overlay' });
			var overlay_prev = jQuery('<a>', { class: 'gk-photo-overlay-prev' });
			var overlay_next = jQuery('<a>', { class: 'gk-photo-overlay-next' });
			// put the element
			overlay.appendTo(jQuery('body'));
			// add events
			overlay.click(function() {
				var img = overlay.find('img');
				if(img) { img.remove(); }
				overlay.removeClass('active');
				overlay_prev.removeClass('active');
				overlay_next.removeClass('active');
				setTimeout(function() {
					overlay.css('display', 'none');
				}, 300);
			});
			// prepare links
			photos.each(function(j, photo) {
				photo = jQuery(photo);
				var link = photo.find('a');
				collection.push(link.attr('href'));
				link.click(function(e) {
					e.preventDefault();
					e.stopPropagation();
					overlay.css('display', 'block');
					
					setTimeout(function() {
						overlay.addClass('active');
						
						setTimeout(function() {
							overlay_prev.addClass('active');
							overlay_next.addClass('active');
						}, 300);
						
						var img = jQuery('<img>', { class: 'loading' });
						img.load(function() {
							img.removeClass('loading');
						});
						img.attr('src', link.attr('href'));
						img.prependTo(overlay);
					}, 50);
				});
			});
			// if collection is bigger than one photo
			if(collection.length > 1) {
				overlay_prev.appendTo(overlay);
				overlay_next.appendTo(overlay);
				
				overlay_prev.click(function(e) {
					e.preventDefault();
					e.stopPropagation();
					
					var img = overlay.find('img');
					if(!img.hasClass('loading')) {
						img.addClass('loading');
					}
					setTimeout(function() {
						var current_img = img.attr('src');
						var id = collection.indexOf(current_img);
						var new_img = collection[(id > 0) ? id - 1 : collection.length - 1];
						img.attr('src', new_img);
					}, 300);
				});
				
				overlay_next.click(function(e) {
					e.preventDefault();
					e.stopPropagation();
					
					var img = overlay.find('img');
					if(!img.hasClass('loading')) {
						img.addClass('loading');
					}
					setTimeout(function() {
						var current_img = img.attr('src');
						var id = collection.indexOf(current_img);
						var new_img = collection[(id < collection.length - 1) ? id + 1 : 0];
						img.attr('src', new_img);
					}, 300);
				});
			}
		}	

		// Main menu scripts	    
		var main_menu = jQuery(".navigation");
		var main_menu_container = main_menu.find('.nav').first();
		var submenuHeight = main_menu_container.outerHeight();
		
		main_menu.click(function() {
			if(jQuery(window).outerWidth() <= 720) {
				if(main_menu.hasClass("opened")) {
					main_menu_container.animate({
						'height': 0
					}, 500, function() {
						main_menu.removeClass("opened");
					});
				} else {
					main_menu.addClass("opened");
					var h = submenuHeight;
					main_menu_container.css('height', '0');
					main_menu_container.animate({
						'height': h + "px"
					}, 500);
				}
			}
		});	
		
		// Fix for the mobile devices
		if($(document.body).hasClass('touch-screen')) {
			$('.nav .parent').children('a').each(function(i, link) {
				$(link).click(function(e) {
					e.preventDefault();
				});
			});
		}
		
		$('.nav .parent').children('a, span').on('touchend', function(e) {
			e.stopPropagation();
			e.preventDefault();
			
			if(!$(this).attr('data-time') || (parseInt($(this).attr('data-time'), 10) + 500.0) < new Date().getTime()) {
				$(this).parent().addClass('opened');
				var other = $(this).parent().parent().find('li');
				
				for(var i = 0; i < other.length; i++) {
					var other_class = $(other[i]).attr('class').split(' ')[0];
					var current_parent_class = $(this).parent().attr('class').split(' ')[0];
					
					if(other_class !== current_parent_class && !$(other[i]).parent('.' + current_parent_class).length) {
						$(other[i]).removeClass('opened');
					}
				}
				
				$(this).attr('data-time', new Date().getTime());
				return true;
			}
			
			if($(this).attr('data-time') && (parseInt($(this).attr('data-time'), 10) + 500.0) > new Date().getTime()) {
				if($(this).attr('href')) {
					window.location.href = $(this).attr('href');
				}
				
				return true;
			}
			
			if($(this).attr('data-time') && (parseInt($(this).attr('data-time'), 10) + 500.0) < new Date().getTime()) {
				$(this).parent().removeClass('opened');
				$(this).removeAttr('data-time');
				return true;
			}
		});

		// fit videos
		jQuery(".video-wrapper").fitVids();
	});
})(jQuery);
