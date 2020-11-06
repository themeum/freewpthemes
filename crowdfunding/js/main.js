/*global $:false */

jQuery(document).ready(function($){'use strict';



	var data = { action: 'is_user_logged_in' };
	jQuery.post(paymentAjax.ajaxurl, data, function(response) {
	    if(response == 'yes') {
	    	var logout_url = $('#logout-url').text();
	        $('#navigation ul li.myaccount').append('<ul role="menu" class="sub-menu"><li class="logout-button"><a href="#">Logout</a></li></ul>');
	        $('#navigation ul li.logout-button a').attr("href", logout_url );
	    } else {
	    	$('#navigation ul li.myaccount a').attr("href", "#myaccount").attr("data-toggle", "modal").attr("data-target", "#myaccount");
	    }
	});


	// Home page Slider Code
	$('#products-slider').owlCarousel({
		loop:true,
		navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		items:1,
		autoHeight:true
	});

	//Home page count down
	$('.count-down').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
		if (visible) {
			$(this).find('.counter').each(function () {
				var $this = $(this);
				$({ Counter: 0 }).animate({ Counter: $this.text() }, {
					duration: 3000,
					easing: 'swing',
					step: function () {
						$this.text(Math.ceil(this.Counter));
					}
				});
			});
			$(this).unbind('inview');
		}
	});

	/* --------------------------------------
	*		Google Map Code
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
			var zoom = 9;
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
	      		content: contentString
	      	});
	      	infowindow.open(map, marker);
	      	marker.addListener('click', function() {
	      		infowindow.open(map, marker);
	      	});


			map.setMapTypeId(google.maps.MapTypeId['ROADMAP']);

			//Get colors
			var fill_color                   = wpmap_color;

			if(fill_color != '') {
				var styles = [
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
					{
						"color": fill_color
					}
					]
				}
			]; // END gmap styles
			}

			// Set styles to map
			map.setOptions({styles: styles});
		});
		});
	}



	/* ************************************* */
	/* ***********	Sticky Nav ************* */
	/* ************************************* */
	$(window).on('scroll', function(){'use strict';
		if ( $(window).scrollTop() > 130 ) {
			$('#masthead').addClass('sticky');
		} else {
			$('#masthead').removeClass('sticky');
		}
	});
	// scroll animation initialize
	new WOW().init();


	


	// Jquery AJAX Search
    $('.moview-search-input').on('blur change paste keyup ', function (e) {
        var $that = $(this);
        var raw_data = $that.val(), // item container
            category = $("#searchtype").val();
        $.ajax({
            url: wpcf_ajax_object.ajax_url,
            type: 'POST',
            data: {action:'wpneo_search',raw_data: raw_data,category:category},
            beforeSend: function(){
                if ( !$('#moview-search .search-icon .moview-search-icons .fa-spinner').length ){
                    $('#moview-search .search-icon .moview-search-icons').addClass('spinner');
                    $('<i class="fa fa-spinner fa-spin"></i>').appendTo( "#moview-search .search-icon .moview-search-icons" ).fadeIn(100);
                }
            },
            complete:function(){
                $('#moview-search .search-icon .moview-search-icons .fa-spinner ').remove();    
                $('#moview-search .search-icon .moview-search-icons').removeClass('spinner');
            }
        })
        .done(function(data) {
            if(e.type == 'blur') {
               $( ".moview-search-results" ).html('');
            }else{
                $( ".moview-search-results" ).html( data );
            }
        })
        .fail(function() {
            console.log("fail");
        });
    });




});
