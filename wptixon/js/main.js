/*global $:false */
jQuery(document).ready(function($){'use strict';

// WooCommerce Carousel
$(".carousel-woocommerce .products").owlCarousel({
    autoPlay: 1000, //Set AutoPlay to 3 seconds
    items : $('.carousel-woocommerce').data('post-number'),
    loop : true,
    nav: true,
    navText: [
        '<i class="sl-arrow-left"></i>',
        '<i class="sl-arrow-right"></i>'
      ],
});

// -------------------- Masonry JS ---------------------
$(window).load(function(){'use strict';

var $portfolio = $('.portfolio-items');
var $portfolio_selectors = $('.portfolio-filter >li>a');
  if( $('.element-masonry').length > 0 ){


      $('.portfolio-items').isotope({
          itemSelector: '.element-masonry',
          //percentPosition: true,
          masonry: {
              columnWidth: '.element-masonry',
          }
        });

   }else{
     $portfolio.isotope({
         itemSelector : '.portfolio-item',
         resizable: true,
         layoutMode : 'fitRows'
     });
   }

   $portfolio_selectors.on('click', function(){
       $portfolio_selectors.removeClass('active');
       $(this).addClass('active');
       var selector = $(this).attr('data-filter');
       $portfolio.isotope({ filter: selector });
       return false;
   });

 });
// -----------------------------------------------------


    // Sticky Nav
    jQuery(window).on('scroll', function(){'use strict';
        if ( jQuery(window).scrollTop() > 66 ) {
            jQuery('#masthead').addClass('sticky');
        } else {
            jQuery('#masthead').removeClass('sticky');
        }
    });
    $('.prettySocial').prettySocial();





    //classic slider
    var delay = 1;
    setTimeout(function() {
        var $slidercarousel = $(".classic-slider");
        var $slidepagination  = $slidercarousel.data('pagi');
        var $sliderpaginav  = $slidercarousel.data('nav');
        var $slideautoplay  = $slidercarousel.data('aplay');
        $slidercarousel.owlCarousel({
            loop:true,
            nav:$sliderpaginav,
            margin:0,
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
                    nav:$sliderpaginav,
                }
            }
        });
    }, delay);


    //portfolio slider
    var delay = 1;
    setTimeout(function() {
        var $portfoliocarousel = $(".portfolio-slider");
        var $portfoliopagination  = $portfoliocarousel.data('pagi');
        var $portfoliopaginav  = $portfoliocarousel.data('nav');
        var $portfolioautoplay  = $portfoliocarousel.data('aplay');
        $portfoliocarousel.owlCarousel({
            loop:true,
            nav:$portfoliopaginav,
            margin:0,
            smartSpeed:800,
            dots:$portfoliopagination,
            autoplay:$portfolioautoplay,
            items:1,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:1,
                },
                1000:{
                    items:2,
                    nav:$portfoliopaginav,
                }
            }
        });
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
            rtl:false,
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






});
