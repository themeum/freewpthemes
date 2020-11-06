(function($) {  "use strict"; 

	/* --------------------------------------
	*	Sticky Header Add
	*  -------------------------------------- */
	var sticky_holder = jQuery('<div class="sticky-holder"></div>'),
		masthead = jQuery('#masthead');
		
	jQuery(window).on('scroll', function(){'use strict';
		if ( jQuery(window).scrollTop() > 45 ) {
			if (!masthead.hasClass('sticky') && masthead.hasClass('sticky-enabled')) {
				masthead.addClass('sticky');
				sticky_holder.css({'height': masthead.outerHeight()});
				sticky_holder.insertAfter('#masthead');
			}
		} else {
			masthead.removeClass('sticky');

			sticky_holder.remove();
		}
	});
	
	
	/* --------------------------------------
	*	SOcial Share ADD
	*  -------------------------------------- */
	$('.prettySocial').prettySocial();

	
	/* --------------------------------------
	*	Counter
	*  -------------------------------------- */
	if (typeof loopcounter !== 'undefined') { 
		loopcounter('match-counter-class'); 
	}
	if (typeof loopcounter !== 'undefined') { 
		loopcounter('home-countdown-timer');
	}
	if (typeof loopcounter !== 'undefined') { 
		loopcounter('counter-class');
	}


	/* -------------------------------------- */
	// 		Product Image Popup
	/* -------------------------------------- */
	$('.cloud-zoom').magnificPopup({
		type: 'image',
		mainClass: 'product-img-zoomin',
		gallery: { enabled: true },
		zoom: {
			enabled: true, 
			duration: 400, 
			easing: 'ease-in-out', 
			opener: function(openerElement) {
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	});


	/* -------------------------------------- */
	/* 		Club Gallery image PopUp
	/* -------------------------------------- */
	$('.club-gallery').magnificPopup({
		type: 'image',
		mainClass: 'product-img-zoomin',
		gallery: { enabled: true },
		zoom: {
			enabled: true,
			duration: 400, 
			easing: 'ease-in-out', 
			opener: function(openerElement) {
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	});


	/* -------------------------------------- */
	// 		Search Open
	/* -------------------------------------- */
    $(".search-open-icon").on('click',function(e){
    	e.preventDefault();
    	$(".top-search-input-wrap, .top-search-overlay").fadeIn(200);
    	$(this).hide();
    	$('.search-close-icon').show().css('display','inline-block');
    });
    $(".search-close-icon, .top-search-overlay").on('click',function(e){
    	e.preventDefault();
    	$(".top-search-input-wrap, .top-search-overlay").fadeOut(200);
    	$('.search-close-icon').hide();
    	$('.search-open-icon').show();
    });


	/* -------------------------------------- */
	// 		Load More Pagination
	/* -------------------------------------- */
	$('.post-loadmore').on('click',function(event){
		event.preventDefault();
		var $that = $(this);
		if($that.hasClass('disable')){
			return false;
		}
		var container 		= $that.closest('.themeum-area'),
			perpage 		= $that.data('per_page'), 		
			show_author 	= $that.data('show_author'), 
			show_date 		= $that.data('show_date'), 	
			show_category 	= $that.data('show_category'), 
			order 			= $that.data('order'), 		
			category 		= $that.data('category'), 	
			total_posts 	= $that.data('total_posts'), 	
			layout 			= $that.data('layout');
		var items = container.find('.themeum-latest-item'),
			itemNumbers = items.length,
			paged = ( itemNumbers / perpage ) + 1; 	

		$.ajax({
			url: thm_calcio.ajax_url,
			type: 'POST',
			data: {
				action: 'thmloadmore', perpage: perpage,layout: layout,paged:paged,show_author:show_author,show_date:show_date,show_category:show_category,order:order,category:category},
			beforeSend: function(){
				$that.addClass('disable');
				$('<i class="fa fa-spinner fa-spin" style="margin-left:10px"></i>').appendTo( $that ).fadeIn(100);
			},
			complete:function(){
				$that.find('.fa-spinner ').remove();
			}
		})
		.done(function(data) {
			var newLenght  = container.find('.themeum-latest-item').length;
			if(total_posts <= newLenght){
				$('.load-wrap').fadeOut(400,function(){
					$('.load-wrap').remove();
				});
			}
			$that.removeClass('disable');
			container.find('.themeum-container').append( data );
		})
	});


	/* -------------------------------------- */
	// 		RTL Support Visual Composer
	/* -------------------------------------- */	
	var delay = 100;
	function themeum_rtl() {
		if( jQuery("html").attr("dir") == 'rtl' ){
			var count = jQuery( ".entry-content > div.vc_row-fluid" ).length;
			if( count==1 ){
				if ( jQuery( ".entry-content > div.vc_row-fluid" ).attr( "data-vc-full-width" ) ) {
				    if( jQuery( ".entry-content > div.vc_row-fluid" ).data( "vc-full-width" ) === true ){
						jQuery( '.entry-content > div.vc_row-fluid' ).css({'left':'auto','right':jQuery('.entry-content > div.vc_row-fluid').css('left')});
					}
				}
			}else{
				for (var i = 0; i < count; ++i) {
					if ( jQuery( ".entry-content > div.vc_row-fluid" ).eq(i).attr( "data-vc-full-width" ) ) {
					    if( jQuery( ".entry-content > div.vc_row-fluid" ).eq(i).data( "vc-full-width" ) === true ){
							jQuery( '.entry-content > div.vc_row-fluid' ).eq(i).css({'left':'auto','right':jQuery('.entry-content > div.vc_row-fluid').eq(i).css('left')});	
						}
					}
				}
			}
		}
	}
	setTimeout( themeum_rtl , delay);
	jQuery( window ).resize(function() {
		setTimeout( themeum_rtl , 1);
	});
})(jQuery);
