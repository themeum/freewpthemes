/*global $:false
  _____ _
 |_   _| |__   ___ _ __ ___   ___ _   _ _ __ ___
   | | | '_ \ / _ \ '_ ` _ \ / _ \ | | | '_ ` _ \
   | | | | | |  __/ | | | | |  __/ |_| | | | | | |
   |_| |_| |_|\___|_| |_| |_|\___|\__,_|_| |_| |_|

*  --------------------------------------
*         Table of Content
*  --------------------------------------
*  1. Perform AJAX Login
*  2. Register New User
*  3. Elimentor Editor Menu Hide
*  4. Sticky Nav
*  5. Social Share
*  6. Coming Soon Page
*  7. Search Toggle
*  --------------------------------------
*  -------------------------------------- */

jQuery(document).ready(function($){'use strict';

    /* --------------------------------------
    *       1. Perform AJAX Login
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
    *       2. Register New User
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


    /* --------------------------------------
    *       3. Elimentor Editor Menu Hide
    *  -------------------------------------- */
    $(".elementor-editor-active .header").on('mouseover', function(){
        $(".header").hide();
    });
    $(".elementor-inner").on('mouseout', function(){
        $(".header").show();
    });


    /* --------------------------------------
    *       4. Sticky Nav
    *  -------------------------------------- */
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 66 ) {
            jQuery('#masthead.enable-sticky').addClass('sticky');
        } else {
            jQuery('#masthead.enable-sticky').removeClass('sticky');
        }
    });

    /* --------------------------------------
    *       5. Social Share
    *  -------------------------------------- */
    $('.prettySocial').prettySocial();

    /* --------------------------------------
    *       6. Coming Soon Page
    *  -------------------------------------- */
    if (typeof loopcounter !== 'undefined') {
        loopcounter('counter-class');
    }
    /* --------------------------------------
    *       7. Search Toggle
    *  -------------------------------------- */

    $('.thm-search-icon').click(function(){
        $('.header-search-wrap').fadeToggle();
        $(this).toggleClass('active');
    });

   
});
