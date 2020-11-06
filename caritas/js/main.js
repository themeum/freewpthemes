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

jQuery(document).ready(function($){
    'use strict';


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



    var donation_input = $('.caritas-addon-donation .donation-ammount-wrap > input');
    donation_input.on('click', function(){
        // remove previous active class and add class
        donation_input.removeClass('active');
        $(this).addClass('active');

        var currency = $(".caritas-addon-donation .donation-ammount-wrap").data('currency'),
            crncy_code = currency.split(':'),
            pid = $(".caritas-addon-donation .donation-ammount-wrap").data('pid'),
            this_val = $(this).val(),
            amt = this_val.split('$');

        if (amt[1]) {
            var amt = amt[1];
        } else{
            var amt = this_val;
        };

        if (amt != '' && amt > 0) {
            $(".caritas-addon-donation .donation-button .donation-button-link").attr("href", "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business="+pid+"&item_name=donation&amount="+amt+"&currency_code="+crncy_code[0]+"");
        };

    });


    //donation custom onkeyup change value
    $('.caritas-addon-donation .donation-ammount-wrap > input.input-text').on('keyup', function(event) {
        var this_val = $(this).val(),
            pid = $(".caritas-addon-donation .donation-ammount-wrap").data('pid'),
            currency = $(".caritas-addon-donation .donation-ammount-wrap").data('currency'),
            crncy_code = currency.split(':');

        if (this_val != '' && this_val > 0) {
            $(".caritas-addon-donation .donation-button .donation-button-link").attr("href", "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business="+pid+"&item_name=donation&amount="+this_val+"&currency_code="+crncy_code[0]+"");
        };
    });



});
