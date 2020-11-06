jQuery(document).ready(function($){ 'use strict';
	/* Select Post Format */ 
	$(document).on('change', 'select[id*="post-format"]', function(){ 
		for (var i =0; i < $( '.editor-post-format select option').length; i++) {
			var formate = $( '.editor-post-format select option:eq('+i+')' ).attr('value');	
			$('div[id^=post-meta-'+formate+']').hide();
		}
		var formate = $( '.editor-post-format select' ).attr('value');
		$('div[id^=post-meta-'+formate+']').show();
	});
	/* End. */ 

	$(window).load(function(){
		for (var i =0; i < $( '.editor-post-format select option').length; i++ ) {
			var formate = $( '.editor-post-format select option:eq('+i+')' ).attr('value');	
			$('div[id^=post-meta-'+formate+']').hide();
		}
		var formate = $( '.editor-post-format select' ).attr('value');
		$('div[id^=post-meta-'+formate+']').show();
	});
	/* End on load. */ 
	
});