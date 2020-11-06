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
*  5. Header Search Toggle
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
        if ( jQuery(window).scrollTop() > 50 ) {
            jQuery('#masthead.enable-sticky').addClass('sticky');
            jQuery('.site-header').slideDown();
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

    $('.rhino-pagination').find('.prev').parent('li').addClass('prev-arrow');
    $('.rhino-pagination').find('.next').parent('li').addClass('next-arrow');


    /* --------------------------------------
    *       5. Header Search Toggle
    *  -------------------------------------- */
    var searchClc = $('.thm-search-icon, .thm-fullscreen-search .search-overlay i, #main-menu .wp-megamenu-wrap .wpmm-nav-wrap > ul > li.wpmm-social-link-search a'),
        searchForm = $('.thm-fullscreen-search'),
        searchIcon = $('.thm-search-icon i');
        
        searchClc.on('click', function(){
        searchForm.toggleClass('active');
    });

    //-------------------------------------
    //On Load Animation
    //-------------------------------------
    $('html').mousemove(function(e){
        var wx = $(window).width();
        var wy = $(window).height();
        
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        
        var newx = x - wx/2;
        var newy = y - wy/2;
        
        $('#sub-head-parallax div, .rhino-carousel div').each(function(){
            var speed = $(this).attr('data-speed');
            if($(this).attr('data-revert')) speed *= -1;
            TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
            
        });
        
    });

});
