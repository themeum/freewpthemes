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
*  2. LogOut
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

    var dir = $("html").attr("dir");
    var rtl = false;
    if (dir == 'rtl') {
        rtl = true;
    }
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


    //  Gallery Image Popup
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

/* --------------------------------------
*       7. logOut
*  -------------------------------------- */

$('.thm-logout-button').on('click', function (e) {
    e.preventDefault();
    location.href = $(this).attr('href');
});

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
    *       2. Product Single Page Popup
    *  -------------------------------------- */
    $(".image-link").magnificPopup({
        delegate: 'a',
        type: "image",
        gallery: { enabled: true },
        zoom: {
            enabled: false,
            duration: 400,
            easing: "ease-in-out",
            opener: function(openerElement) {
                return openerElement.is("img") ? openerElement : openerElement.find("img");
            }
        },
    });

    /* --------------------------------------
    *       3. Elimentor Editor Menu Hide
    *  -------------------------------------- */
    // $(".elementor-editor-active .header").on('mouseover', function(){
    //     $(".header").hide();
    // });
    // $(".elementor-inner").on('mouseout', function(){
    //     $(".header").show();
    // });


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
    *       7. Google Map
    *  -------------------------------------- */
    var map;
    function initMap() {
        var wpaddress       = $('.thm-gmap').data( 'address' );
        var wplatitude      = $('.thm-gmap').data( 'latitude' );
        var wplongitude     = $('.thm-gmap').data( 'longitude' );
        var wpheight        = $('.thm-gmap').data( 'height' );
        var wptype          = $('.thm-gmap').data( 'type' );
        var wpzoom          = $('.thm-gmap').data( 'zoom' );
        var flugurl         = $('.thm-gmap').data( 'flugurl' );
        var wpstyles        = $('.thm-gmap').data( 'styles' );
        var controls        = $('.thm-gmap').data( 'controls' );
        var zoomcontrol     = $('.thm-gmap').data( 'zoomcontrol' );

        // Style Option
        var styles = '';
        switch( wpstyles ){
            case 'style1':
                styles = [{"featureType": "road","stylers": [{"color": "#b4b4b4"}]}, {"featureType": "water","stylers": [{"color": "#d8d8d8"}]}, {"featureType": "landscape","stylers": [{"color": "#f1f1f1"}]}, {"elementType": "labels.text.fill","stylers": [{"color": "#000000"}]}, {"featureType": "poi","stylers": [{"color": "#d9d9d9"}]}, {"elementType": "labels.text","stylers": [{"saturation": 1}, {"weight": 0.1}, {"color": "#000000"}]}];
                break;
            case 'style2':
                styles = [{elementType: 'geometry', stylers: [{color: '#242f3e'}]},{elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},{elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},{featureType: 'administrative.locality',elementType: 'labels.text.fill',stylers: [{color: '#d59563'}]},{featureType: 'poi',elementType: 'labels.text.fill',stylers: [{color: '#d59563'}]},{featureType: 'poi.park',elementType: 'geometry',stylers: [{color: '#263c3f'}]},{featureType: 'poi.park',elementType: 'labels.text.fill',stylers: [{color: '#6b9a76'}]},{featureType: 'road',elementType: 'geometry',stylers: [{color: '#38414e'}]},{featureType: 'road',elementType: 'geometry.stroke',stylers: [{color: '#212a37'}]},{featureType: 'road',elementType: 'labels.text.fill',stylers: [{color: '#9ca5b3'}]},{featureType: 'road.highway',elementType: 'geometry',stylers: [{color: '#746855'}]},{featureType: 'road.highway',elementType: 'geometry.stroke',stylers: [{color: '#1f2835'}]},{featureType: 'road.highway',elementType: 'labels.text.fill',stylers: [{color: '#f3d19c'}]},{featureType: 'transit',elementType: 'geometry',stylers: [{color: '#2f3948'}]},{featureType: 'transit.station',elementType: 'labels.text.fill',stylers: [{color: '#d59563'}]},{featureType: 'water',elementType: 'geometry',stylers: [{color: '#17263c'}]},{featureType: 'water',elementType: 'labels.text.fill',stylers: [{color: '#515c6d'}]},{featureType: 'water',elementType: 'labels.text.stroke',stylers: [{color: '#17263c'}]}];
                break;
            case 'style3':
                styles = [{ "elementType": "labels", "stylers": [ { "visibility": "off" }, { "color": "#f49f53" }] },{ "featureType": "landscape", "stylers": [ { "color": "#f9ddc5" }, { "lightness": -7 }] },{ "featureType": "road", "stylers": [ { "color": "#813033" }, { "lightness": 43 }] },{ "featureType": "poi.business", "stylers": [ { "color": "#645c20" }, { "lightness": 38 }] },{ "featureType": "water", "stylers": [ { "color": "#1994bf" }, { "saturation": -69 }, { "gamma": 0.99 }, { "lightness": 43 }] },{ "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "color": "#f19f53" }, { "weight": 1.3 }, { "visibility": "on" }, { "lightness": 16 }] },{ "featureType": "poi.business" },{ "featureType": "poi.park", "stylers": [ { "color": "#645c20" }, { "lightness": 39 }] },{ "featureType": "poi.school", "stylers": [ { "color": "#a95521" }, { "lightness": 35 }] },{ "featureType": "poi.medical", "elementType": "geometry.fill", "stylers": [ { "color": "#813033" }, { "lightness": 38 }, { "visibility": "off" }] },{ "elementType": "labels" },{ "featureType": "poi.sports_complex", "stylers": [ { "color": "#9e5916" }, { "lightness": 32 }] },{ "featureType": "poi.government", "stylers": [ { "color": "#9e5916" }, { "lightness": 46 }] },{ "featureType": "transit.station", "stylers": [ { "visibility": "off" }] },{ "featureType": "transit.line", "stylers": [ { "color": "#813033" }, { "lightness": 22 }] },{ "featureType": "transit", "stylers": [ { "lightness": 38 }] },{ "featureType": "road.local", "elementType": "geometry.stroke", "stylers": [ { "color": "#f19f53" }, { "lightness": -10 }] }];
                break;
            case 'style4':
                styles = [{ "featureType": "all", "elementType": "labels.text.fill", "stylers": [ { "color": "#ffffff" } ] },{ "featureType": "all", "elementType": "labels.text.stroke", "stylers": [ { "color": "#000000" }, { "lightness": 13 } ] },{ "featureType": "administrative", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" } ] },{ "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "color": "#144b53" }, { "lightness": 14 }, { "weight": 1.4 } ] },{ "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#08304b" } ] },{ "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#0c4152" }, { "lightness": 5 } ] },{ "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" } ] },{ "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#0b434f" }, { "lightness": 25 } ] },{ "featureType": "road.arterial", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" } ] },{ "featureType": "road.arterial", "elementType": "geometry.stroke", "stylers": [ { "color": "#0b3d51" }, { "lightness": 16 } ] },{ "featureType": "road.local", "elementType": "geometry", "stylers": [ { "color": "#000000" } ] },{ "featureType": "transit", "elementType": "all", "stylers": [ { "color": "#146474" } ] },{ "featureType": "water", "elementType": "all", "stylers": [ { "color": "#021019" } ] }];
                break;
            default:
                break;
        }

        $(".thm-gmap").height( wpheight );
        var latlng = new google.maps.LatLng(wplatitude, wplongitude);
        var map = new google.maps.Map(document.getElementsByClassName('thm-gmap')[0], {
          zoom: wpzoom,
          center: latlng,
          styles: styles,
          mapTypeId: wptype,
          disableDefaultUI: controls,
          scrollwheel: zoomcontrol,
        });

        // Marker + Flug
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: flugurl
        });

        // Address
        var contentString = '<div class="map-info-content">'+wpaddress+'</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        infowindow.open(map, marker);
    }
    if( $('.thm-gmap').length > 0 ){
        initMap();
    }



    /* --------------------------------------
    *       8. Portfolio_slider
    *  -------------------------------------- */

    var portSlider = $('.thm-portfolio-slider');
    var portSliderItems = portSlider.data('slide-count');
    if (!portSliderItems){
        portSliderItems = 3
    }


    portSlider.slick({
        slidesToShow: portSliderItems,
        nav: true,
        loop: true,
        rtl: rtl,
        nextArrow: '<span class="owl-arrow owlPrev"><i class="calypso-icon calypso-arrows-2"></i></span>',
        prevArrow: '<span class="owl-arrow owlNext"><i class="calypso-icon calypso-arrows"></i></span>',
        responsive: 
        [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: portSliderItems
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            },
        ]

    });

    /* --------------------------------------
    *       8. Testimonial & Slider
    *  -------------------------------------- */


    // Testimonial Code
    if( $('.testimonial_content_wrapper').length > 0 ){
        var auto    = $('.testimonial_content_wrapper').data('autoplay'),
            dot     = $('.testimonial_content_wrapper').data('showdots'),
            navi    = $('.testimonial_content_wrapper').data('showarrow');
        var argument = {
                        rtl: rtl,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    };
        if( auto == 'yes' ){ argument.autoplay = true ; }else{ argument.autoplay = false; }
        if( dot == 'yes' ){ argument.dots = true; }else{ argument.dots = false; }
        if( navi == 'yes' ){
            argument.nextArrow = '<span class="slick-next"><i class="fa fa-angle-right"></i></span>';
            argument.prevArrow = '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>';
        } else {
            argument.nextArrow = '';
            argument.prevArrow = '';
        }
        argument.responsive =  [
            {
                breakpoint: 1024,
                settings: { slidesToShow: 2, slidesToScroll: 2, }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ];
        argument.asNavFor = '.testimonial_logo_wrapper';

        $('.testimonial_content_wrapper').slick( argument );
    }

    var xs = $('.testimonial_logo_wrapper');
    var xsDot = $('.testimonial_logo_wrapper').data('slide-count');
    var xsArg = {
        asNavFor: '.testimonial_content_wrapper',
        focusOnSelect: true,
        arrows: false,
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
          breakpoint: 600,
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

    if(xsDot){
        xsArg.slidesToShow = xsDot;
    }else{
        xsArg.slidesToShow = 4
    }
    xs.slick(xsArg);



    // Slider Video & Image Popup
    $('.popup-youtube a, .popup-vimeo a, .popup-video a').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
    });


    /* --------------------------------------
    *       10. Service Slider
    *  -------------------------------------- */
    var service_slider = $('.service_slider');
    service_slider.owlCarousel({
        items: 1,
        loop: true,
        rtl: rtl
    });

    $('.srv-left-btn').on('click', function () {
        service_slider.trigger('next.owl.carousel');
    });

    $('.srv-right-btn').on('click', function () {
        service_slider.trigger('prev.owl.carousel');
    });


    /* --------------------------------------
    *       10. Search Toggle
    *  -------------------------------------- */

    var searchClc = $('.thm-search-icon, .thm-fullscreen-search .search-overlay'),
        searchForm = $('.thm-fullscreen-search');
    searchClc.on('click', function() {
        searchForm.toggleClass('active');
    });


    // woocommerce tab

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

    // $(window).on('resize', function () {
    //     var window_width = $(window).width();
    //     if (window_width > 767) {
    //         var thm_icon_col = $('.thm-icon-col').width();
    //         $('.wp-megamenu ul.wp-megamenu').css('padding-right', thm_icon_col + 'px');
    //         var thm_logo_col = $('.thm-logo-col').width();
    //         $('.wp-megamenu .thm-cat-col').css('left', thm_logo_col + 'px');
    //     }
    // });


});
