/*global $:false */
jQuery(document).ready(function($){'use strict';

    // Sticky Nav
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 0 ) {
            jQuery('#masthead').addClass('sticky');
        } else {
            jQuery('#masthead').removeClass('sticky');
        }
    });

    $('.prettySocial').prettySocial();

    /*==========  isotope  ==========*/
    $(window).load(function(){'use strict';
        var $portfolio_selectors = $('.portfolio-filter >li>a');
        var $portfolio = $('.portfolio-items');
        $portfolio.isotope({
            itemSelector : '.portfolio-item',
            resizable: true,
            layoutMode : 'fitRows'
        });
        
        $portfolio_selectors.on('click', function(){
            $portfolio_selectors.removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $portfolio.isotope({ filter: selector });
            return false;
        });
    });
    //  end...


    //classic slider
    var delay = 1;
    setTimeout(function() {
        var $slidercarousel = $(".classic-slider");
        var $slidepagination  = $slidercarousel.data('pagi');
        var $slideautoplay  = $slidercarousel.data('aplay');
        $slidercarousel.owlCarousel({
            loop:true,
            nav:false,
            margin:0,
            rtl:true,
            smartSpeed:800,
            dots:$slidepagination,
            autoplay:$slideautoplay,
            items:1,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:1,
                },
                1000:{
                    items:1,
                    nav:false,
                }
            }
        });
        // $(".owl-item.active .classic-slider-title").addClass('animated slideInLeft');
        //$slidercarousel.css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 300);

    }, delay);  

    //team slider
    var delay = 1;
    setTimeout(function() {
        var $teamcarousel = $(".team-carousel");
        var $count  = $teamcarousel.data('number');
        var $pagination  = $teamcarousel.data('pagi');
        var $autoplay  = $teamcarousel.data('aplay');
        $teamcarousel.owlCarousel({
            loop:true,
            nav:false,
            margin:30,
            rtl:true,
            smartSpeed:400,
            dots:$pagination,
            autoplay:$autoplay,
            responsiveClass:true,
            items:$count,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:$count,
                }
            }
        });
        // $teamcarousel.css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 300);
    }, delay);     

    //client slider
    var delay = 1;
    setTimeout(function() {
        var $clientcarousel = $(".client-carousel");
        var $clientcount  = $clientcarousel.data('number');
        var $clientpagination  = $clientcarousel.data('pagi');
        var $clientautoplay  = $clientcarousel.data('aplay');        
        $clientcarousel.owlCarousel({
            loop:true,
            nav:false,
            margin:30,
            rtl:true,
            smartSpeed:400,
            dots:$clientpagination,
            autoplay:$clientautoplay,
            responsiveClass:true,
            items:$clientcount,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:$clientcount,
                }
            }
        });
        // $clientcarousel.css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 300);
    }, delay);    

    //testimonial slider
    var delay = 1;
    setTimeout(function() {
            var $testicarousel = $(".themeum-testimonial-carousel");
            var $testicount  = $testicarousel.data('number');
            var $testipagination  = $testicarousel.data('pagi');
            var $testiautoplay  = $testicarousel.data('aplay');
            var $testnav  = $testicarousel.data('testnav');
        $testicarousel.owlCarousel({
            loop:true,
            margin:30,
            rtl:true,
            dots:$testipagination,
            autoplay:$testiautoplay,
            smartSpeed:400,
            nav:$testnav,
            navText: ['<i class="fa fa-long-arrow-left">','<i class="fa fa-long-arrow-right">'],
            responsiveClass:true,
            items:$testicount,
            responsive:{
                0:{
                    items:1,
                    nav:false,
                },
                600:{
                    items:1,
                },
                1000:{
                    items:$testicount,
                }
            }
        });
        // $testicarousel.css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 300);
    }, delay);  
  

    //comming soon
    if (typeof loopcounter !== 'undefined') {
        loopcounter('counter-class');
    }

    /* --------------------------------------
    *       video popup
    *  -------------------------------------- */
    if ($(".video-popup-middle-in a").length > 0) {
        $(".video-popup-middle-in a").magnificPopup({
            type: 'iframe',
            rtl:true,
            mainClass: 'mfp-fade',
            removalDelay: 300,
            preloader: false,
            fixedContentPos: false
        });
    }

    /* --------------------------------------
    *       Project image popup
    *  -------------------------------------- */

    $('.plus-icon').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        rtl:true,
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
    *       Google Map Code
    *  -------------------------------------- */
    var wplatitude = document.getElementById('wplatitude');
    if (wplatitude != null){

        jQuery(function($){
            google.maps.event.addDomListener(window, 'load', function(){

            var wplatitude = document.getElementById('wplatitude').innerHTML;
            var wplongitude = document.getElementById('wplongitude').innerHTML;
            var wpmap_color = document.getElementById('wpmap_color').innerHTML;
            var wpaddress = document.getElementById('wpaddress').innerHTML;
            

                
            var mapId = 'gmap';

              // Get data
              var zoom = 16;
              var mousescroll = false;

              var latlng = new google.maps.LatLng( wplatitude, wplongitude);
              var mapOptions = {
                zoom: zoom,
                center: latlng,
                disableDefaultUI: true,
                scrollwheel: mousescroll
              };

              var map = new google.maps.Map(document.getElementById(mapId), mapOptions);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });


                var contentString = '<div id="map-info-content">'+wpaddress+'</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    pixelOffset: new google.maps.Size(0, 0),                
                });

                //infowindow.open(map, marker);

                marker.addListener('click', function() {
                    //infowindow.open(map, marker);
                });


                map.setMapTypeId(google.maps.MapTypeId['ROADMAP']);

              //Get colors
              var fill_color  = wpmap_color;

              if(fill_color != '') {
                var styles = [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": fill_color // #d9d9d9
                        },{
                            "lightness": 17
                        }
                    ]
                },{
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e9e9e9"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },{
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },{
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#bfbfbf"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#bfbfbf"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#bdbdbd"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#bfbfbf"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#c5c5c5"
                        },
                        {
                            "lightness": 10
                        }
                    ]
                },

                ]; // END gmap styles
            }

            // Set styles to map
           map.setOptions({styles: styles});


        });
        });

    }

    //For sticky Header
    jQuery(window).on('scroll', function(e) {

        if (jQuery(this).scrollTop() > 400) {
            jQuery('#back-top').fadeIn();
        } else {
            jQuery('#back-top').fadeOut();
        }
    });

    //Smoth Scroll
    jQuery(function() {
        jQuery('a[href*="#"]:not([href="#"])').on('click', function(e) {
            var headheight = jQuery("header").height();
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = jQuery(this.hash);
                target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    jQuery('html, body').animate({
                        scrollTop: target.offset().top - 65
                    }, 1000);
                    return false;
                }
            }
        });
    });

});
