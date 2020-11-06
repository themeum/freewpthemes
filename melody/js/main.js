/*global $:false
  _____ _
 |_   _| |__   ___ _ __ ___   ___ _   _ _ __ ___
   | | | '_ \ / _ \ '_ ` _ \ / _ \ | | | '_ ` _ \
   | | | | | |  __/ | | | | |  __/ |_| | | | | | |
   |_| |_| |_|\___|_| |_| |_|\___|\__,_|_| |_| |_|

*  --------------------------------------
*         Table of Content
*  --------------------------------------
*  1. Sticky Nav
*  2. Social Share
*  3. Coming Soon Page
*  4. Countdown
*  --------------------------------------
*  -------------------------------------- */
jQuery(document).ready(function($){'use strict';
    
    // 1. Sticky Nav
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 66 ) {
            jQuery('#masthead.enable-sticky').addClass('sticky');
        } else {
            jQuery('#masthead.enable-sticky').removeClass('sticky');
        }
    });
    
    // 2. Social Share
    $('.prettySocial').prettySocial();

    // 3. Coming Soon Page
    if (typeof loopcounter !== 'undefined') {
        loopcounter('counter-class');
    }

    
    // 4. Countdown
    if (typeof loopcounter !== 'undefined') {
        loopcounter('thm_countdown');
    }

    
});
