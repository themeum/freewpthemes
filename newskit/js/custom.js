(function ($) {

    var dir = $("html").attr("dir");
    var rtl = false;
    if( dir == 'rtl' ){
        rtl = true;
    }


	// Slider Code
    var WidgetLAEPostCarouselHandler = function ($scope, $) {
        var carousel_elem = $scope.find('.themeum-post-slider').eq(0);
        if( carousel_elem.length > 0 ){
            var control = false;
            if(  $('.themeum-post-slider').data('control') == 'yes' ){ control = true; }
            var autoplay = false;
            if(  $('.themeum-post-slider').data('autoplay') == 'yes' ){ autoplay = true; }

            $('.themeum-post-slider').slick({
                dots: true,
                rtl: rtl,
		        infinite: true,
		        speed: 300,
		        slidesToShow: 1,
		        slidesToScroll: 1,
            });
        }
    };
    //# Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/newskit-post-slider.default', WidgetLAEPostCarouselHandler);
    });


    //Top Headline
    var WidgetLAEHeadlineCarouselHandler = function ($scope, $) {
        var carousel_elem = $scope.find('.themeum-top-headlines').eq(0);
        if( carousel_elem.length > 0 ){
            var control = false;
            if(  $('.themeum-top-headlines').data('control') == 'yes' ){ control = true; }
            var autoplay = false;
            if(  $('.themeum-top-headlines').data('autoplay') == 'yes' ){ autoplay = true; }

            $('.themeum-top-headlines').slick({
                dots: false,
                infinite: true,
                speed: 300,
                rtl: rtl,
                slidesToShow: 5,
                slidesToScroll: 5,
                nextArrow: '',
                prevArrow: '',
                responsive: [
                 {
                     breakpoint: 1024,
                     settings: {
                         slidesToShow: 5,
                         slidesToScroll: 5,
                         infinite: true,
                         dots: true
                     }
                 },
                 {
                     breakpoint: 992,
                     settings: {
                         slidesToShow: 3,
                         slidesToScroll: 5,
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
            });
        }
    };

    //Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/newskit-headlines.default', WidgetLAEHeadlineCarouselHandler);
    });


})(jQuery);