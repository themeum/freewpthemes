/*global $:false
  _____ _                                         
 |_   _| |__   ___ _ __ ___   ___ _   _ _ __ ___  
   | | | '_ \ / _ \ '_ ` _ \ / _ \ | | | '_ ` _ \ 
   | | | | | |  __/ | | | | |  __/ |_| | | | | | |
   |_| |_| |_|\___|_| |_| |_|\___|\__,_|_| |_| |_|

*  --------------------------------------
*         Table of Content
*  --------------------------------------
*  1. FAQ onScroll Animation
*  2. Sticky Nav
*  3. Social Share
*  4. Coming Soon Page
*  5. Blog Tab Move Class -remove
*  6. Pagination JS
*  7. Shop Single Image Popup
*  8. Woocommerce Tab
*  9. Product Color Variation
*  10. Woocart in topbar Menu
*  -------------------------------------- 
*  -------------------------------------- */

jQuery(document).ready(function($){'use strict';

    /* --------------------------------------
    *       1. FAQ onScroll Animation
    *  -------------------------------------- */
    var offset = 100;
    $('.faq-index a').on('click', function(event) {
        if (typeof $( '#'+$(this).attr('href').slice(1) ).offset().top !== 'undefined') {
            event.preventDefault();
            $('html, body').animate({scrollTop: $( '#'+$(this).attr('href').slice(1) ).offset().top - offset }, 'slow');
        }
    });
 
    /* --------------------------------------
    *       2. Sticky Nav
    *  -------------------------------------- */
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 0 ) {
            jQuery('#masthead.enable-sticky').addClass('sticky');
        } else {
            jQuery('#masthead.enable-sticky').removeClass('sticky');
        }
    });


    /* --------------------------------------
    *       3. Social Share
    *  -------------------------------------- */
    $('.prettySocial').prettySocial();


    /* --------------------------------------
    *       4. Coming Soon Page
    *  -------------------------------------- */
    if (typeof loopcounter !== 'undefined') {
        loopcounter('counter-class');
    }

    /*----------------------------------
    *      5. Blog Tab Move Class           
    ------------------------------------ */ 
    // $(".category-navigation li a").click(function(){
    //     $(".category-navigation li").removeClass("active");
    // });

    /*----------------------------------
    *        6. Pagination JS           
    ------------------------------------ */
    if( $('.themeum-pagination').length > 0 ){
        if( !$(".themeum-pagination ul li:first-child a").hasClass('prev') ){ 
            $(".themeum-pagination ul").prepend('<li class="p-2 first"><span>'+$(".themeum-pagination").data("preview")+'</span></li>');
        }
        if( !$(".themeum-pagination ul li:last-child a").hasClass('next') ){ 
            $(".themeum-pagination ul").append('<li class="p-2 first"><span>'+$(".themeum-pagination").data("nextview")+'</span></li>');
        }
        $(".themeum-pagination ul li:last-child").addClass("ml-auto");
        $(".themeum-pagination ul").addClass("justify-content-start").find('li').addClass('p-2').eq(1).addClass('ml-auto');
    }


    /*----------------------------------
    *    7. Shop Single Image Popup           
    ------------------------------------ */
    $('.cloud-zoom').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function (openerElement) {
                return openerElement.next('img') ? openerElement : openerElement.find('img');
            }
        },
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        }

    });


    /*----------------------------------
    *    8. Woocommerce Tab           
    ------------------------------------ */
    var wooTabNav = $('.woocommerce-tabs .nav-tabs > li');
    wooTabNav.on('click', function () {
        wooTabNav.removeClass('active');
        $(this).addClass('active');
    });

    $('.themeum-pagination li a').each(function(){
        if($(this).hasClass('prev')){
            $(this).closest('li').addClass('act-left');
        }
        if($(this).hasClass('next')){
            $(this).closest('li').addClass('act-right');
        }
    });


    /*------------------------------------------
    *      9. Product Color Variation         
    -------------------------------------------- */ 
    if(jQuery('.variations_form').length) { 
        makealloptions(); // Call back function.
    }

    // Color Reset.
    jQuery(document).on('click','.reset_variations',function(){
        jQuery('.selected').each(function(){
            jQuery(this).removeClass('unselected');  
        });
    });

    // On Click with select color.
    jQuery(document).on('click','.variation_button',function(){
        // console.log(jQuery(this));
        if( jQuery('#'+jQuery(this).attr('rel')).val() == jQuery(this).attr('id') ){
            jQuery('#'+jQuery(this).attr('rel')).val('');
            jQuery(this).removeClass('selected').addClass('unselected');
        }else{
            jQuery('#'+jQuery(this).attr('rel')).val(jQuery(this).attr('id'));
            jQuery('#'+jQuery(this).attr('rel')+'_buttons .variation_button').removeClass('selected').addClass('unselected');
            jQuery(this).removeClass('unselected').addClass('selected');
            //if(jQuery(this).attr('rel')!='pa_frame'){
                jQuery('#variation_'+jQuery(this).attr('rel')+' .var-notice').stop(true,true).hide();
                var notTarget = jQuery(this).attr('rel')+'_'+jQuery(this).attr('id')+'_description';
                jQuery('#'+jQuery(this).attr('rel')+'_descriptions .variation_description').each(function(){
                    if(jQuery(this).attr('id')!=notTarget){
                        jQuery(this).hide();
                    }
                }); 
            //} 
        }
        jQuery('#'+jQuery(this).attr('rel')).change();
    });
        
    jQuery('.variation_descriptions_wrapper:first-child').append('');
    jQuery(document).on('change','.variations_form select',function(){  
        makealloptions(); // Call back function.
    });
    
    function makealloptions(){ 
        jQuery('.variations_form select').each(function(index, element) {
            var curr_select = jQuery(this).attr('id');
            if(jQuery('#'+curr_select+'_buttons').length){
                if(!jQuery('#'+curr_select+'_buttons').find('.selected').length){
                    jQuery('#'+curr_select+'_buttons').html('');
                    jQuery('#'+curr_select+'_descriptions .variation_description').stop(true,true).slideUp("fast");
                }else{
                    jQuery('#'+curr_select+'_buttons .unselected').hide();
                }
            }else{
                jQuery( '<div class="variation_buttons_wrapper"><div id="'+curr_select+'_buttons" class="variation_buttons"></div></div><div class="variation_descriptions_wrapper"><div id="'+curr_select+'_descriptions" class="variation_descriptions"></div></div>' ).insertBefore( jQuery(this) );
            }

            // Get Colors 
            jQuery('#'+jQuery(this).attr('id')+' option').each(function(index, element) {
                if(jQuery(this).val()!=''){
                    // Get Image
                    var image = jQuery('#'+curr_select+'_'+jQuery(this).val()+'_description .image img');
                    if(jQuery('#'+jQuery(this).val()).length){
                        jQuery('#'+jQuery(this).val()).show();
                    }else{
                        jQuery( "#"+curr_select+'_buttons' ).append( '<a href="javascript:void(0);" class="variation_button'+((jQuery('#'+curr_select).val()==jQuery(this).val())?' selected':' unselected')+'" id="'+jQuery(this).val()+'" title="'+jQuery(this).text()+'" rel="'+curr_select+'">'+jQuery('.'+jQuery(this).val()+'_image').html()+'</a>' );
                        if(jQuery('#'+curr_select).val()==jQuery(this).val()){
                            jQuery('#'+curr_select+'_'+jQuery(this).val()+'_description .var-notice').stop(true,true).hide();
                            jQuery('#'+curr_select+'_'+jQuery(this).val()+'_description').stop(true,true).slideDown("fast")
                        }
                    }
                }else{
                    if(  jQuery('#'+curr_select+' option').length == 1 && jQuery('#'+curr_select+' option[value=""]').length){
                         jQuery( "#"+curr_select+'_buttons' ).append( 'Combination Not Avalable <a href="javascript:void(0);" class="variation_reset">Reset</a>' );
                    }
                }
            });
        });
        if(jQuery('.single_variation .price .amount').is(':visible') || jQuery('.single_add_to_cart_button').is(':visible')){
            jQuery('p.lead-time').show();
            jQuery('p.price-prompt').hide();
            if(jQuery('.single_variation .price .amount').is(':visible')){
                // jQuery('div [itemprop="offers"] .price').hide();
            }else{
                jQuery('div [itemprop="offers"] .price').clone().appendTo( jQuery( ".single_variation" ) );
            }
        }
        
        jQuery('form.variations_form').fadeIn();
        jQuery('.product_meta').fadeIn();       
    }

    // Woocart hover
    jQuery( ".woocart" ).hover(function() {
        jQuery(this).find('.widget_shopping_cart').stop( true, true ).fadeIn();
    }, function() {
        jQuery(this).find('.widget_shopping_cart').stop( true, true ).fadeOut();
    }); 

    // End Product Color Variation      


    /*------------------------------------------
    *      10. Woocart in topbar Menu         
    -------------------------------------------- */
    jQuery('.woocart a').html( jQuery('.woo-cart').html() );
    jQuery('.add_to_cart_button').on('click',function(){'use strict';
        jQuery('.woocart a').html( jQuery('.woo-cart').html() );            
        var total = 0;
        if( jQuery('.woo-cart-items span.cart-has-products').html() != 0 ){
            if( jQuery('#navigation ul.cart_list').length  > 0 ){
                for ( var i = 1; i <= jQuery('#navigation ul.cart_list').length; i++ ) {
                    var total_string = jQuery('#navigation ul.cart_list li:nth-child('+i+') .quantity').text();
                    total_string = total_string.substring(-3, total_string.length);
                    total_string = total_string.replace('×', '');
                    total_string = parseInt( total_string.trim() );
                    if( !isNaN(total_string) ){ total = total_string + total; }
                }
            }
        }
        jQuery('.woo-cart-items span.cart-has-products').html( total+1 );
    }); 
    // End woocart.
});


// Callback Function for product color variation.
function goToFrames(){
    jQuery('<div class="current_selection_prompt">Current selection</div>').insertBefore('.entry-summary h1');
    jQuery('.variations .variation').each(function(index, element) {
        jQuery(this).stop(true,true).slideUp( "fast");
    });
    var current_selections;
    jQuery('#current_selections').html();
    
    jQuery('.variation_button.selected').each(function(){   
        jQuery('#current_selections').html(jQuery('#current_selections').html()+'<span>'+jQuery('#variation_'+jQuery(this).attr('rel')+' .variation_name_value').html()+':</span> '+jQuery(this).attr('title')+'  &nbsp; ');
    });
    jQuery('.variation_descriptions_wrapper img').attr('data-parent','.variation_descriptions_wrapper');
}


