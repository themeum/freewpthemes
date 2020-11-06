/*global $:false
  _____ _
 |_   _| |__   ___ _ __ ___   ___ _   _ _ __ ___
   | | | '_ \ / _ \ '_ ` _ \ / _ \ | | | '_ ` _ \
   | | | | | |  __/ | | | | |  __/ |_| | | | | | |
   |_| |_| |_|\___|_| |_| |_|\___|\__,_|_| |_| |_|

*  --------------------------------------
*         Table of Content
*  --------------------------------------
*    1. Preloader
*    2. Blog Masonary
*    3. Social Share
*    4. Search
*    5. Post Slider 
*    6. Sticky Nav
*    7. ScrollUp
*  --------------------------------------
*  -------------------------------------- */


jQuery(document).ready(function($){'use strict';


    /* -------------------------------------  
    *  1. Preloader
    ---------------------------------------- */
    $(window).on('load', function() {
        $('#preloader').delay(1000).fadeOut('slow', function() { $(this).remove(); });
    });


    /* --------------------------------------
    2. Blog Masonary: Homepage Lifestyle
    *  -------------------------------------- */
    $(window).on( "load", function() {
        $(".items-masonary").masonry({
            itemSelector: '.masonary-item',
        });
    });

    /* --------------------------------------
    3. Social Share.
    *  -------------------------------------- */
    $('.prettySocial').prettySocial();


    /* --------------------------------------
    4. Search.
    *  -------------------------------------- */
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


    /* --------------------------------------
    5. Gutenwp Post Slider 
    *  -------------------------------------- */
    $(document).on('rendered_addon', function(e, addon){
        if (typeof addon.type !== 'undefined' && ( addon.type === 'addon' || addon.type === 'inner_addon' ) && ( addon.name === 'themeum_post_slider' )){     
            let Container = '';
            let iframe = window.frames['wppb-builder-view'].window.document;
            if( addon.name == 'themeum_post_slider' ){ Container = $( iframe ).find('.gutenwp-post-slider'); }
            if( Container.length > 0 ){
                slickSliderCallback(Container, 'backend' );
            }
        }
    });
    /* Guten Post Slider */ 
    let post_slider = $('.gutenwp-post-slider');
    if( post_slider.length > 0 ){
        slickSliderCallback( post_slider, 'frontend' );
    }
    function slickSliderCallback( Container, type ){
        let argument = {
            dots: false,
            infinite: true,
            slidesToShow: 1,
            speed: 900,
            fade: true,
            adaptiveHeight: true,
            nextArrow: '.next_caro',
            prevArrow: '.previous_caro'
        };
        if( type == 'backend' ){
            Container.not('.slick-initialized').slick(argument);
            Container.each(function(){
                if (!$(this).hasClass('slick-initialized')){
                    $(this).slick();
                }
            });
        }
        if( type == 'frontend' ){
            Container.slick(argument);
        }
    }

    /* --------------------------------------
    6. Sticky Nav
    *  -------------------------------------- */
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 66 ) {
            jQuery('#masthead').addClass('sticky');
        } else {
            jQuery('#masthead').removeClass('sticky');
        }
    });


    /* --------------------------------------
    7. ScrollUp
    *  -------------------------------------- */
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp',     // Element ID
            scrollDistance: 300,        // Distance from top/bottom before showing element (px)
            scrollFrom: 'top',          // 'top' or 'bottom'
            scrollSpeed: 300,           // Speed back to top (ms)
            easingType: 'linear',       // Scroll to top easing (see http://easings.net/)
            animation: 'fade',          // Fade, slide, none
            animationSpeed: 200,        // Animation in speed (ms)
            scrollTrigger: false,       // Set a custom triggering element. Can be an HTML string or jQuery object
            scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-arrow-up"></i>', // Text for element, can contain HTML
            scrollTitle: false,         // Set a custom <a> title if required.
            scrollImg: false,           // Set true to use image
            activeOverlay: false,       // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647          // Z-Index for the overlay
        });
    });
     /* --------------------------------------
    *           End ScrollUp
    *  -------------------------------------- */


    /* --------------------------------------
    *       1. Gallery Slider
    *  -------------------------------------- */
    $(document).on('rendered_addon', function(e, addon){
        if (typeof addon.type !== 'undefined' && ( addon.type === 'addon' || addon.type === 'inner_addon' ) && ( addon.name === 'themeum_post_slider2' )){     
            let Container = '';
            let iframe = window.frames['wppb-builder-view'].window.document;
            if( addon.name == 'themeum_post_slider2' ){ Container = $( iframe ).find('.themeum-post-slider2'); }
            if( Container.length > 0 ){
                slickGallerySliderCallback(Container, 'backend' );
            }
        }
    });

    let gallery_slider = $('.themeum-post-slider2');
    if( gallery_slider.length > 0 ){
        slickGallerySliderCallback( gallery_slider, 'frontend' );
    }
    function slickGallerySliderCallback( Container, type ){
        var dir = $("html").attr("dir");
        var rtl = false;
        if( dir == 'rtl' ){
            rtl = true;
        }
        let argument = {
            rtl: rtl,
            arrows:false,
            slidesToShow: 3,
            slidesToScroll: 1,
            vertical: true,
            speed: 600,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                     breakpoint: 992,
                     settings: {
                        slidesToShow: 3,
                        speed: 900,
                     }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        speed: 900,
                    }
                },
            ]
        };
        if( type == 'backend' ){
            Container.not('.slick-initialized').slick(argument);
            Container.each(function(){
                if (!$(this).hasClass('slick-initialized')){
                    $(this).slick();
                }
            });
        }
        if( type == 'frontend' ){
            Container.slick(argument);
        }
    }

    

    // On Before Slide Change.
    $('.themeum-post-slider2').on('beforeChange', function(event, slick, image, imageSource){
        var bg = $('.themeum-post-slider2').find('.img-responsive.slider-bg').eq(imageSource).attr('src');
        $('.home-lifestyle').css('background', 'url(' + bg + ')');
    });

    // Onload Image Source.
    var bg = $('.themeum-post-slider2').find('.img-responsive.slider-bg').attr('src');
    $('.home-lifestyle').css('background', 'url(' + bg + ')');

});













