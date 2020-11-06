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

    // comming soon
    if (typeof loopcounter !== 'undefined') {
        loopcounter('counter-class');
    }


    // Scroll Top 
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp',     // Element ID
            scrollDistance: 300,        // Distance from top/bottom before showing element (px)
            scrollFrom: 'top',          // 'top' or 'bottom'
            scrollSpeed: 300,           // Speed back to top (ms)
            easingType: 'linear',       // Scroll to top easing (see http://easings.net/)
            animation: 'fade',          // Fade, slide, none
            animationSpeed: 200,        // Animation in speed (ms)
            scrollTrigger: false,       // Set a custom triggering element. Can be an HTML string or jQuery object
            scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false,         // Set a custom <a> title if required.
            scrollImg: false,           // Set true to use image
            activeOverlay: false,       // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647          // Z-Index for the overlay
        });
    });
    // Scroll top end

    // Load More Pagination
    $.fn.isOnScreen = function(){
        var bounds = this.offset();
        var win = $(window);
        var viewport = {
            top : $(window).scrollTop(),
            left : $(window).scrollLeft()
        };
        viewport.right = viewport.left + $(window).width();
        viewport.bottom = viewport.top + $(window).height();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();
        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom)); 
    };
    $(window).scroll(function(){
        
        if($("#post-loadmore").length > 0) {
            if ($('#post-loadmore').isOnScreen()) {
                
                var win = $(window);
                $('#post-loadmore').show();

                var $that = $("#post-loadmore");
                if($that.hasClass('disable')){
                    return false;
                }

                var container = $('#content'), // item container
                    perpage = $that.data('per_page'), // post per page number
                    total_posts = $that.data('total_posts');

                var items = container.find('.blog-list'),
                    itemNumbers = items.length,
                    paged = Math.ceil(( itemNumbers / perpage ) + 1); // paged number

                $.ajax({
                    url: theme_personalblog.ajax_url,
                    type: 'POST',
                    data: {action: 'personalblog_load_more_posts',perpage: perpage,paged:paged},
                    beforeSend: function(){
                        $that.addClass('disable');
                        $('<i class="fa fa-spinner fa-spin" style="margin-left:10px"></i>').appendTo( "#post-loadmore" ).fadeIn(100);
                    },
                    complete:function(){
                        $('#post-loadmore .fa-spinner ').remove();
                       
                    }
                })

                .done(function(data) {
                    var newLenght  = container.find('.blog-list').length;
                    if(total_posts <= newLenght){
                        $('.load-wrap').fadeOut(100,function(){
                            $('.load-wrap').remove();
                            $('#post-loadmore').remove();  
                        });
                    }
                    $that.removeClass('disable');
                    var $newItems = $(data);
                    $('#content').append( $newItems );
                    $('.blog-list').addClass('fullwidth'); 
  
                })
                .fail(function() {
                    alert('failed');
                    console.log("error");
                });
            }
        }
    });

    

});


