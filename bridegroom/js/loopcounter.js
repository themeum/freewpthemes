jQuery(document).ready(function($){ 'use strict';

	// CountDown
	window.loopCounterTwo = function( Selector  ) {
		if(typeof Selector != 'undefined'){

			$(Selector ).each(function(){			
				var date = $(this ).attr('data-date');
				var currentItem = $(this);

				var countDownDate = new Date(date).getTime();

				// Update the count down every 1 second
				var x = setInterval(function() {
					// Get todays date and time
					var now = new Date().getTime();

					// Find the distance between now an the count down date
					var distance = countDownDate - now;

					// Time calculations for days, hours, minutes and seconds. 
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);

					// console.log(seconds);

					if ( distance < 0 ) {
						days = hours = minutes = seconds = 0;
					}

					currentItem.find('.counter-days').html(days);
					currentItem.find('.counter-hours').html(hours);
					currentItem.find('.counter-minutes').html(minutes);
					currentItem.find('.counter-seconds').html(seconds);

				}, 1000);

			});
		}
    }

});