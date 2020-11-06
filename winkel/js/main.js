/*global $:false
  _____ _                                         
 |_   _| |__   ___ _ __ ___   ___ _   _ _ __ ___  
   | | | '_ \ / _ \ '_ ` _ \ / _ \ | | | '_ ` _ \ 
   | | | | | |  __/ | | | | |  __/ |_| | | | | | |
   |_| |_| |_|\___|_| |_| |_|\___|\__,_|_| |_| |_|

*  --------------------------------------
*         Table of Content
*  --------------------------------------
*  01. Single Page Sticky
*  02. Coming Soon Same Height
*  03. Newsletter
*  04. Search Button
*  05. Product Quantity Change
*  06. Product Single Page Image Popup
*  07. Elimentor Editor Menu Hide
*  08. Sticky Nav
*  09. Social Share
*  10. Coming Soon Page Countdown
*  11. Perform AJAX Login
*  12. Register New User
*  13. Google Map
*  14. Testimonial & Slider
*  15. Product Accordion
*  16. Shop Page Category Change
*  17. Remove Cart Items
*  -------------------------------------- 
*  -------------------------------------- */

jQuery(document).ready(function($){'use strict';

    /* --------------------------------------
    *       01. Single Page Sticky
    *  -------------------------------------- */
    var window_width = $(window).width();              
    if(window_width > 767) {
        $('.thm-single-desc').stick_in_parent({
            offset_top: 200
        });
    }

    
    $('.widget_layered_nav select').addClass('chosen-select');
    $(".chosen-select").chosen();
    

    /* --------------------------------------
    *       02. Coming Soon Same Height
    *  -------------------------------------- */
    var minHeight = '';
    if(window_width > 767){
        var equal_height_1 = -1,
            eq_height_class = $('.equal-height-1');
        eq_height_class.each(function() {
            if($(this).height() >  minHeight){
                equal_height_1 = $(this).height();
            }
        });
        eq_height_class.height(equal_height_1);
    }

    
    /* --------------------------------------
    *       03. Newsletter
    *  -------------------------------------- */
    function popupClose (mainSelector, parentSelector, openSelector, closeSelector) {
        var accountPopup = $(mainSelector);
        accountPopup.each(function() {
            var accOpen = $(openSelector),
                accClose = $(closeSelector),
                accPopup= $(this).closest(parentSelector);
            if(accClose.length){
                accClose.on('click', function(e) {
                    e.preventDefault();
                    accPopup.removeClass('active');
                });
            }
            if(accOpen.length){
                accOpen.on('click', function(e) {
                    e.preventDefault();
                    accPopup.addClass('active');
                });
            }
        });
    }
    popupClose('.thm-mailchimp-popup > div', '.thm-mailchimp-popup', '.mc-open', '.mc-close');
    

    /* --------------------------------------
    *       04. Search Button
    *  -------------------------------------- */
    $(".search-open-icon").on('click',function(e){
        $(".top-search-input-wrap, .top-search-overlay").fadeIn(200);
        $(".search-btn").focus();
        $(this).hide();
        $('.search-close-icon').show().css('display','inline-block');
        e.preventDefault();
    });
    $(".search-close-icon, .top-search-overlay").on('click',function(e){
        $(".top-search-input-wrap, .top-search-overlay").fadeOut(200);
        $('.search-close-icon').hide();
        $('.search-open-icon').show();
        e.preventDefault();
    });
    $(document).keydown(function(e){
        var code = e.keyCode || e.which;
        if( code == 27 ){
            $(".top-search-input-wrap, .top-search-overlay").fadeOut(200);
            $('.search-close-icon').hide();
            $('.search-open-icon').show();
        }
    });
   
    
    /* --------------------------------------
    *       05. Product Quantity Change
    *  -------------------------------------- */
    $('.product-quantity .plus,.product-quantity .minus').live('click',function(e){
        var count = 0;
        var selector = $(this).parent().find( '.qty' );
        if( $(this).hasClass('plus') ){
            count = parseInt( selector.val() ) + 1;
        }else{ 
            if( selector.val() != 0 ){ count = parseInt( selector.val() ) - 1; }
        }
        selector.val( count );
        $(".woocommerce .cart input.button").prop('disabled', false);
        e.preventDefault();
    });


    /* --------------------------------------
    *       06. Product Single Page Image Popup
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
    *       07. Elimentor Editor Menu Hide
    *  -------------------------------------- */
    $(".elementor-editor-active .header").on('mouseover', function(){
        $(".header").hide();
    });
    $(".elementor-inner").on('mouseout', function(){
        $(".header").show();
    });


    /* --------------------------------------
    *       08. Sticky Nav
    *  -------------------------------------- */
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 66 ) {
            jQuery('#masthead').addClass('sticky');
        } else {
            jQuery('#masthead').removeClass('sticky');
        }
    });


    /* --------------------------------------
    *       09. Social Share
    *  -------------------------------------- */
    $('.prettySocial').prettySocial();


    /* --------------------------------------
    *       10. Coming Soon Page Countdown
    *  -------------------------------------- */
    if (typeof loopcounter !== 'undefined') {
        loopcounter('counter-class');
    }



    /* --------------------------------------
    *       11. Perform AJAX Login
    *  -------------------------------------- */
    $('form#login').on('submit', function(e){ 'use strict';
        $('form#login p.status').show().text(ajax_objects.loadingmessage);
        var checked = false;
        if( $('form#login #remember').is(':checked') ){ checked = true; }
            //console.log( 'working!!!2'+ajax_objects.ajaxurl );
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_objects.ajaxurl,
                data: { 
                    'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': $('form#login #username').val(), 
                    'password': $('form#login #password').val(), 
                    'remember': checked, 
                    'security': $('form#login #security').val() },
                success: function(data){
                    //console.log( 'working!!!' );
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
    *       12. Register New User
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
    *       13. Google Map
    *  -------------------------------------- */
    var map;
    function initMap() {
        var wpaddress       = $('#map').data( 'address' );
        var wplatitude      = $('#map').data( 'latitude' );
        var wplongitude     = $('#map').data( 'longitude' );
        var wpheight        = $('#map').data( 'height' );
        var wptype          = $('#map').data( 'type' );
        var wpzoom          = $('#map').data( 'zoom' );
        var flugurl         = $('#map').data( 'flugurl' );
        var wpstyles        = $('#map').data( 'styles' );
        var controls        = $('#map').data( 'controls' );
        var zoomcontrol     = $('#map').data( 'zoomcontrol' );
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
        $("#map").height( wpheight );
        var latlng = new google.maps.LatLng(wplatitude, wplongitude);
        var map = new google.maps.Map(document.getElementById('map'), {
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
    if( $('#map').length > 0 ){
        initMap();    
    }



    /* --------------------------------------
    *       14. Testimonial & Slider
    *  -------------------------------------- */
    var dir = $("html").attr("dir");
    var rtl = false;
    if( dir == 'rtl' ){
        rtl = true;
    }

    if( $('.gallery').find('br').remove() ){
        $('.gallery').slick({
            nextArrow: '<i class="fa fa-arrow-right"></i>',
            prevArrow: '<i class="fa fa-arrow-left"></i>',
        });
    }

    // Slider Code
    if( $('.slider_content_wrapper').length > 0 ){
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
                    $(this).find('.slider-discount').addClass( $(this).find('.slider-discount').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-discount').data( 'speed' ) );
                    
					$(this).find('.slider-button-1').addClass( $(this).find('.slider-button-1').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-1').data( 'speed' ) );
					$(this).find('.slider-button-2').addClass( $(this).find('.slider-button-2').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-2').data( 'speed' ) );
				} else {
					$(this).find('.slider-media').removeClass( $(this).find('.slider-media').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-media').data( 'speed' ) );
					$(this).find('.slider-subtitle').removeClass( $(this).find('.slider-subtitle').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-subtitle').data( 'speed' ) );
					$(this).find('.slider-title').removeClass( $(this).find('.slider-title').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-title').data( 'speed' ) );
					$(this).find('.slider-content').removeClass( $(this).find('.slider-content').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-content').data( 'speed' ) );
                    $(this).find('.slider-discount').removeClass( $(this).find('.slider-discount').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-discount').data( 'speed' ) );
					$(this).find('.slider-button-1').removeClass( $(this).find('.slider-button-1').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-1').data( 'speed' ) );
					$(this).find('.slider-button-2').removeClass( $(this).find('.slider-button-2').data( 'animation' ) ).css( $speed_ , $(this).find('.slider-button-2').data( 'speed' ) );
				}
		 	});
		}, 1 );
    }
    // Slider Video & Image Popup
    $('.popup-youtube, .popup-vimeo').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
    });


    /* --------------------------------------
    *      15. Product Accordion
    *  -------------------------------------- */
    var thmProductAccordion = $('.thm-product-accordion');
    thmProductAccordion.each(function() {
        var thmProAccSingle = $(this).find('.single-item'),
            thmProAccTitle = $(this).find('.accordion-title'),
            thmProAccContent = $(this).find('.accordion-content'),
            thmProAccIcon = $(this).find('.accordion-icon'),
            thmNextCollapse = $(this).find('.collapse-next'),
            thmPrevCollapse = $(this).find('.collapse-prev');
            thmProAccSingle.each(function() {
                if($(this).hasClass('active')){
                    $(this).children('.accordion-content').slideDown();
                }
            });
        thmProAccTitle.add(thmProAccIcon).on('click', function(e) {
            e.preventDefault();
            if($(this).closest('.single-item').hasClass('active')){
                thmProAccSingle.removeClass('active').find('.accordion-icon').text('+');
                thmProAccContent.slideUp();
                return;
            }
            thmProAccSingle.removeClass('active').find('.accordion-icon').text('+');
            $(this).closest('.single-item').addClass('active').find('.accordion-icon').text('-');
            thmProAccContent.slideUp();
            $(this).siblings('.accordion-content').slideToggle();
        });
        
        thmNextCollapse.on('click', function(e) {
            e.preventDefault();
            var parentItem = $(this).parents('.single-item'),
                currentContent = parentItem.find('.accordion-content'),
                nextContent = parentItem.next('.single-item').find('.accordion-content');
            if(nextContent.length){
                parentItem.removeClass('active').find('.accordion-icon').text('+');
                parentItem.next('.single-item').addClass('active').find('.accordion-icon').text('-');
                currentContent.slideUp();
                nextContent.slideDown();
            }
        });
        
        thmPrevCollapse.on('click', function(e) {
            e.preventDefault();
            var parentItem = $(this).parents('.single-item'),
                currentContent = parentItem.find('.accordion-content'),
                prevContent = parentItem.prev('.single-item').find('.accordion-content');
            if(prevContent.length){
                parentItem.removeClass('active').find('.accordion-icon').text('+');
                parentItem.prev('.single-item').addClass('active').find('.accordion-icon').text('-');
                currentContent.slideUp();
                prevContent.slideDown();
            }
        });
    });


    /* --------------------------------------
    *      16. Shop Page Category Change
    *  -------------------------------------- */
    $( ".wooc-cats-list" ).change(function() {
        window.location.href = $(this).val();
    });




    /* --------------------------------------
    *      17. Remove Cart Items
    *  -------------------------------------- */
    $(".product-remove a").on('click',function(e){
        e.preventDefault();
        var that = $(this);
        var selector = $('.confirm-message');
        swal({
            title: selector.data('title'),
            text: selector.data('desc'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: selector.data('btntext'),
            closeOnConfirm: false
        },
        function(){
            swal( selector.data('successtitle') , selector.data('successdesc')  , 'success');
            that.closest('div.product-list').slideUp().remove();
            $.get(  that.attr('href'), function(data, status){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: ajax_objects.ajaxurl,
                    data: { 'action': 'totalprice' },
                    success: function(data){
                        $('.winkel-total-cart').html( data.message );
                    }
                });
            });

            

        });
    });

    
    


    $('.winkel-minus-cart,.winkel-plus-cart').on('click',function(e){
        var count = 0;
        var that = $(this);
        var selector = $(this).parent().find( '.qty' );
        if( $(this).hasClass('plus') ){
            count = parseInt( selector.val() ) + 1;
        }else{ 
            if( selector.val() != 0 ){ count = parseInt( selector.val() ) - 1; }
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_objects.ajaxurl,
            data: { 
                'cartid'    : $(this).data( 'cartid' ),
                'quantity'  : count,
                'action'    : 'cartupdate' 
            },
            success: function(data){
                $('.winkel-total-cart').html( data.total );
                that.closest('ul').find('.product-subtotal span').html( data.single );
            }
        });
        e.preventDefault();
    });



    $('.winkel-fill-checkout').on('click',function(e){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_objects.ajaxurl,
            data: { 'action'    : 'checkoutdata' },
            success: function(data){
                $('.checkout-shortcode').html( data.message );
                if( $('.confirm-message').length > 0 ){
                    $('form.woocommerce-checkout').attr( 'action', $('.confirm-message').data('currenturl') );
                }
            }
        });
        e.preventDefault();
    });



    
    $('#place_order').on('click',function(e){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_objects.ajaxurl,
            data: { 'action'    : 'checkoutdata' },
            success: function(data){
                $('.checkout-shortcode').html( data.message );
            }
        });
        e.preventDefault();
    });
    
    
    // Hideshow Login
    $('.showlogin').live('click',function(e){
        $('.woocommerce-form-login').slideToggle();
        e.preventDefault();
    });
    $('.showcoupon').live('click',function(e){
        $('.checkout_coupon').slideToggle();
        e.preventDefault();
    });



    //Pagination JS
    if( $('.themeum-pagination').length > 0 ){
        if( !$(".themeum-pagination ul li:first-child a").hasClass('prev') ){ 
            $(".themeum-pagination ul").prepend('<li class="p-2 first"><span>'+$(".themeum-pagination").data("preview")+'</span></li>');
        }
        if( !$(".themeum-pagination ul li:last-child a").hasClass('next') ){ 
            $(".themeum-pagination ul").append('<li class="p-2 first"><span>'+$(".themeum-pagination").data("nextview")+'</span></li>');
        }
        $(".themeum-pagination ul li:last-child").addClass("ml-auto");
        $(".themeum-pagination ul").addClass("d-flex justify-content-start").find('li').addClass('p-2').eq(1).addClass('ml-auto');
    }

    
    // Checkout Hover ViewCart
    if( $('.widget_shopping_cart_content').length > 0 ){
        setInterval(function(){
            $( '.widget_shopping_cart_content .show-cart-btn' ).html( $( '.widget_shopping_cart_content .show-cart-btn' ).data('viewcart') );
        },1);
    }

});
