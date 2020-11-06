/*global $:false
  _____ _
 |_   _| |__   ___ _ __ ___   ___ _   _ _ __ ___
   | | | '_ \ / _ \ '_ ` _ \ / _ \ | | | '_ ` _ \
   | | | | | |  __/ | | | | |  __/ |_| | | | | | |
   |_| |_| |_|\___|_| |_| |_|\___|\__,_|_| |_| |_|

*  --------------------------------------
*         Table of Content
*  --------------------------------------
*    1. Calendar Next Month
*    2. Calendar Prev Month
*    3. Preloader
*    4. Schedule Tab   
*    5. Magnific Popup Shop   
*    6. Social Share.
*    7. Sticky Nav
*    8. Coming Soon Page
*    9. Event Countdown
*    10. Perform AJAX Login
*    11. Register New User
*  --------------------------------------
*  -------------------------------------- */




jQuery(document).ready(function($){'use strict';


    /* -------------------------------------  
    3. Preloader
    ---------------------------------------- */

    $(window).on('load', function() {
        $('#preloader').delay(1000).fadeOut('slow', function() { $(this).remove(); });
    });

    /* --------------------------------------
    2. gallery Masonary
    *  -------------------------------------- */
    $(window).on( "load", function() {
        $(".items-masonary").masonry({
            itemSelector: '.masonary-item',
        });
    });


    const woo_tab = $('.woocommerce-tabs .nav-tabs li a');
    if (woo_tab.length){
        var selector    = $('.woocommerce-tabs .nav-tabs>li');
        selector.on( 'click', function () {
            selector.removeClass('active');
        });  
    }
    
    /* --------------------------------------
    5. Magnific Popup Shop
    *  -------------------------------------- */
     $('.cloud-zoom').magnificPopup({
        type: 'image',
        mainClass: 'product-img-zoomin',
        gallery: { enabled: true },
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it
            duration: 400, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    //  Map Popup
    $('.open-popup-link').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
    });

    /* --------------------------------------
    6. Social Share.
    *  -------------------------------------- */
    $('.prettySocial').prettySocial();


    /* --------------------------------------
    7. Sticky Nav
    *  -------------------------------------- */
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 66 ) {
            jQuery('#masthead').addClass('sticky');
        } else {
            jQuery('#masthead').removeClass('sticky');
        }
    });
    /* --------------------------------------
    8. Coming Soon Page
    *  -------------------------------------- */
    if (typeof loopCounterTwo !== 'undefined') {
        loopCounterTwo('.counter-class');
    }

    /* --------------------------------------
    9. Event Countdown
    *  -------------------------------------- */
    if (typeof loopCounterTwo !== 'undefined') {
        loopCounterTwo('.thm_countdown');
    }


    /* --------------------------------------
    5. BrideGroom Event carousel
    *  -------------------------------------- */
    $(document).on('rendered_addon', function(e, addon){
        if (typeof addon.type !== 'undefined' && ( addon.type === 'addon' || addon.type === 'inner_addon' ) && ( addon.name === 'bridegroom_event_slider' )){     
            let Container = '';
            let iframe = window.frames['wppb-builder-view'].window.document;
            if( addon.name == 'bridegroom_event_slider' ){ Container = $( iframe ).find('.bridegroom-post-slider'); }
            if( Container.length > 0 ){
                slickSliderCallback(Container, 'backend' );
            }
        }
    });
    
    /* Guten Post Slider */ 
    let post_slider = $('.bridegroom-post-slider');
    if( post_slider.length > 0 ){
        slickSliderCallback( post_slider, 'frontend' );
    }
    function slickSliderCallback( Container, type ){
        let argument = {
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: true,
            prevArrow: false,
            nextArrow: false,
            responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
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


    // # Masonry
    $(window).on( "load", function() {
        var grid = document.querySelector('.grid');
        if (grid) {
            var msnry = new Masonry( grid, {
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });

            imagesLoaded( grid ).on( 'progress', function() {
                msnry.layout();
            });
        }
    });









});
