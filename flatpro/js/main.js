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
            jQuery('#masthead').addClass('sticky');
        } else {
            jQuery('#masthead').removeClass('sticky');
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
    *       8. Testimonial & Slider
    *  -------------------------------------- */
    var dir = $("html").attr("dir");
    var rtl = false;
    if( dir == 'rtl' ){
        rtl = true;
    }

    // Testimonial Code
    if( $('.testimonial_content_wrapper').length > 0 ){
        var auto    = $('.testimonial_content_wrapper').data('autoplay'),
            dot     = $('.testimonial_content_wrapper').data('showdots'),
            navi    = $('.testimonial_content_wrapper').data('showarrow');
        var argument = {
                        rtl: rtl,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    };
        if( auto == 'yes' ){ argument.autoplay = true ; }else{ argument.autoplay = false; }
        if( dot == 'yes' ){ argument.dots = true; }else{ argument.dots = false; }
        if( navi == 'yes' ){
            argument.nextArrow = '<span class="slick-next"><i class="fa fa-arrow-right"></i></span>'; 
            argument.prevArrow = '<span class="slick-prev"><i class="fa fa-arrow-left"></i></span>'; 
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
                            
        $('.testimonial_content_wrapper').slick( argument );
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
    // Slider Video & Image Popup
    $('.popup-youtube, .popup-vimeo, .portfolio-layout2').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false,
          delegate: 'a', 
          type: 'image'
    });

    /* --------------------------------------
    *       9. Portfolio Items Filter
    *  -------------------------------------- */
    $(window).load(function(){
        var $container = $('.portfolioContainer');
        $container.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
    
        $('.portfolioFilter a').click(function(){
            $('.portfolioFilter .current').removeClass('current');
            $(this).addClass('current');
     
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
             });
             return false;
        }); 
    });

    //Jquery Smoth Scroll
    // Select all links with hashes
    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
          && 
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });


});
