jQuery(function($){

	//initlize onepagenav
	
	$('#menu-onepage-menu').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 300,
        scrollOffset: 400,
        scrollThreshold: 0.5,
        filter: ':not(.no-scroll)'

    });

    $('.common-menu-wrap .nav>li:first-child').addClass('current');
	
});