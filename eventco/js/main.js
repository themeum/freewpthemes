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

    /* -------------------------------------  
    1. Calendar Next Month
    ---------------------------------------- */
    function getNextMonth(){
        $(".upcoming-events").addClass("loading-calendar");
        $('.calendar').addClass('spinner');
        var nextmonth = $("#nextmonth").attr("month");  
        var nextyear  = $("#nextmonth").attr("year");
        $.ajax({
            type: 'POST',
            url: ajax_objects.ajaxurl,
            data: { "action": "eventco_displaynextmonth", "nextmonth":nextmonth, "nextyear":nextyear, _nonce : ajax_objects.ajax_nonce},
            success: function(data){
               $(".upcoming-events").removeClass("loading-calendar");
               $('.calendar').removeClass('spinner');
               $("#calendar_area").html(data);
            }
        }); 
    }

    /* -------------------------------------  
    2. Calendar Prev Month
    ---------------------------------------- */
    function getPrevMonth(){
        $(".upcoming-events").addClass("loading-calendar");
        $('.calendar').addClass('spinner');
        var prevmonth = $("#premonth").attr("month");  
        var prevyear  = $("#premonth").attr("year"); 
        $.ajax({
            type: 'POST',
            url: ajax_objects.ajaxurl,
            data: { "action": "eventco_displaynextmonth","nextmonth":prevmonth,"nextyear":prevyear, _nonce : ajax_objects.ajax_nonce},
            success: function(data){
                $(".upcoming-events").removeClass("loading-calendar");
                $('.calendar').removeClass('spinner');
                $("#calendar_area").html(data);
            }
        }); 
    }


jQuery(document).ready(function($){'use strict';


    /* -------------------------------------  
    3. Preloader
    ---------------------------------------- */

    $(window).on('load', function() {
        $('#preloader').delay(1000).fadeOut('slow', function() { $(this).remove(); });
    });

    /* -------------------------------------  
    4. Schedule Tab
    ---------------------------------------- */
    const event_tab = $('.event-schedule-tab-view');
    if (event_tab.length){
        var selector    = $('.event-schedule-tab-view ul li');
        selector.on( 'click', function () {
            selector.removeClass('active');
        });
        event_tab.fadeIn();
    }

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
    10. Perform AJAX Login
    *  -------------------------------------- */
    $('form#login').on('submit', function(e){ 'use strict';
        $('form#login p.status').show().text(ajax_objects.loadingmessage);
        var checked = false;
        if( $('form#login #rememberlogin').is(':checked') ){ checked = true; }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_objects.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #usernamelogin').val(),
                'password': $('form#login #passwordlogin').val(),
                'remember': checked,
                'security': $('form#login #securitylogin').val() },
            success: function(data){
                console.log( 'working!!!' );
                if (data.loggedin == true){
                    $('form#login div.login-error').removeClass('alert-danger').addClass('alert-success');
                    $('form#login div.login-error').text(data.message);
                    document.location.href = ajax_objects.redirecturl;
                }else{
                    $('form#login div.login-error').removeClass('alert-success').addClass('alert-danger');
                    $('form#login div.login-error').text(data.message);
                }
                if($('form#login .login-error').text() == ''){
                    $('form#login div.login-error').hide();
                }else{
                    $('form#login div.login-error').show();
                }
            }
        });
        e.preventDefault();
    });
    if($('form#login .login-error').text() == ''){
        $('form#login div.login-error').hide();
    }else{
        $('form#login div.login-error').show();
    }



    /* --------------------------------------
    11. Register New User
    *  -------------------------------------- */
    $('form#register').on('submit', function(e){ 'use strict';
        $('form#register p.status').show().text(ajax_objects.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_objects.ajaxurl,
            data: {
                'action':   'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#register #username').val(),
                'email':    $('form#register #email').val(),
                'password': $('form#register #password').val(),
                'security': $('form#register #security').val() },
            success: function(data){

                if (data.loggedin == true){
                    $('form#register div.login-error').removeClass('alert-danger').addClass('alert-success');
                    $('form#register div.login-error').text(data.message);
                    $('form#register')[0].reset();
                }else{
                    $('form#register div.login-error').removeClass('alert-success').addClass('alert-danger');
                    $('form#register div.login-error').text(data.message);
                }
                if($('form#register .login-error').text() == ''){
                    $('form#register div.login-error').hide();
                }else{
                    $('form#register div.login-error').show();
                }
            }
        });
        e.preventDefault();
    });

    if($('form#register .login-error').text() == ''){
        $('form#register div.login-error').hide();
    }else{
        $('form#register div.login-error').show();
    }




});
