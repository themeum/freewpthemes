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
*  2. Product Single Page Popup
*  3. Elimentor Editor Menu Hide
*  4. Sticky Nav
*  5. Social Share
*  6. Coming Soon Page
*  7. Google Map
*  8. Testimonial & Slider
*  9. Portfolio Items Filter
*  --------------------------------------
*  -------------------------------------- */

jQuery(document).ready(function($){'use strict';


/* --------------------------------------
*       00. Perform AJAX Login
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
*       7. Register New User
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
    *       1. FAQ onScroll Animation
    *  -------------------------------------- */
    var offset = 100;
    $('.faq-index a').on('click', function(event) {
        if (typeof $( '#'+$(this).attr('href').slice(1) ).offset().top !== 'undefined') {
            event.preventDefault();
            $('html, body').animate({scrollTop: $( '#'+$(this).attr('href').slice(1) ).offset().top - offset }, 'slow');
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
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
    *       10. Search Toggle
    *  -------------------------------------- */

    var searchClc = $('.thm-search-icon, .thm-fullscreen-search .search-overlay'),
        searchForm = $('.thm-fullscreen-search'),
        searchIcon = $('.thm-search-icon i');

    searchClc.on('click', function(){
        searchForm.toggleClass('active');
        searchIcon.toggleClass('floox-icon d-none');
    });

    var dir = $("html").attr("dir");
    var rtl = false;
    if( dir == 'rtl' ){
        rtl = true;
    }
    // Slider Code
    var WidgetLAECarouselHandler = function ($scope, $) {
        var carousel_elem = $scope.find('.slider_content_wrapper').eq(0);

        if( carousel_elem.length > 0 ){
            var control = false;
            if(  $('.slider_content_wrapper').data('control') == 'yes' ){ control = true; }
            var autoplay = false;
            if(  $('.slider_content_wrapper').data('autoplay') == 'yes' ){ autoplay = true; }

            $('.slider_content_wrapper').slick({
                rtl: rtl,
                autoplay: autoplay,
                dots: control,
                dotsClass: 'thm-slide-control',
                nextArrow: '',
                prevArrow: '',
                speed: 300,
                autoplaySpeed: 3000,
                adaptiveHeight: true
            });

            // Slider Animation
            setInterval(function(){
                $('.slider-single-wrapper').each(function(){

                    var $speed_ = 'animation-duration';
                    if( $(this).hasClass('slick-active') ) {
                        $(this).find('.slider-media').addClass( $(this).find('.slider-media').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-media').data( 'speed' ) );
                        $(this).find('.slider-subtitle').addClass( $(this).find('.slider-subtitle').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-subtitle').data( 'speed' ) );
                        $(this).find('.slider-title').addClass( $(this).find('.slider-title').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-title').data( 'speed' ) );
                        $(this).find('.slider-content').addClass( $(this).find('.slider-content').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-content').data( 'speed' ) );
                        $(this).find('.slider-button-1').addClass( $(this).find('.slider-button-1').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-1').data( 'speed' ) );
                        $(this).find('.slider-button-2').addClass( $(this).find('.slider-button-2').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-2').data( 'speed' ) );
                    } else {
                        $(this).find('.slider-media').removeClass( $(this).find('.slider-media').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-media').data( 'speed' ) );
                        $(this).find('.slider-subtitle').removeClass( $(this).find('.slider-subtitle').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-subtitle').data( 'speed' ) );
                        $(this).find('.slider-title').removeClass( $(this).find('.slider-title').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-title').data( 'speed' ) );
                        $(this).find('.slider-content').removeClass( $(this).find('.slider-content').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-content').data( 'speed' ) );
                        $(this).find('.slider-button-1').removeClass( $(this).find('.slider-button-1').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-1').data( 'speed' ) );
                        $(this).find('.slider-button-2').removeClass( $(this).find('.slider-button-2').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-2').data( 'speed' ) );
                    }
                });
            }, 1 );
        }
    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/thm-slider.default', WidgetLAECarouselHandler);
    });

});
