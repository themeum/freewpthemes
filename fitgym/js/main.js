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
*  -------------------------------------- 
*  -------------------------------------- */

jQuery(document).ready(function($){'use strict';


    /* --------------------------------------
    *       2. Sticky Nav
    *  -------------------------------------- */
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 50 ) {
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

    $('.themeum-pagination').find('.prev').parent('li').addClass('prev-arrow');
    $('.themeum-pagination').find('.next').parent('li').addClass('next-arrow');

});
