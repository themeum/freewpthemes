<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';


	$link_color = esc_attr($themeum_options['link-color']);
	if(isset($link_color)){
		$output .= '#main-menu .sub-menu li.active, #main-menu .nav>li>ul li:hover,#main-menu .nav>li.nav-myacount a,
		.wpcf7-form-control.wpcf7-submit,#comments .form-submit #submit,#navigation .navbar-header .navbar-toggle,
		
		.themeum-pagination  .pagination>.active>a, .themeum-pagination  .pagination>.active>a:focus, 
		.themeum-pagination .pagination>.active>a:hover, .themeum-pagination  .pagination>.active>span, 
		.themeum-pagination  .pagination>.active>span:focus, .themeum-pagination  .pagination>.active>span:hover,
		.themeum-pagination .pagination>li>a:focus, .themeum-pagination .pagination>li>a:hover, .themeum-pagination .pagination>li>span:focus, 
		.themeum-pagination .pagination>li>span:hover,.project-category-list ul li:hover{ background-color: '. esc_attr($link_color) .'; }';
		
		$output .= 'a,a:focus, sup.featured-post,.widget ul li a:hover, #footer .widget a:hover,.themeum-person .social-icon a:hover, #mobile-menu ul li:hover > a,
		#featured-ideas a:hover,#popular-ideas .details h4 a:hover,#popular-ideas .details .entry-meta a:hover,
		#mobile-menu ul li:hover > a, #mobile-menu ul li.active > a,#featured-ideas .navigation li.active a{ color: '. esc_attr($link_color) .'; }';
		$output .= '.form-control:focus{ border-color: '. esc_attr($link_color) .'; }';
	}
	
	if(isset($themeum_options['hover-color'])){
		$output .= 'a:hover, .widget.widget_rss ul li a{ color: '.esc_attr($themeum_options['hover-color']) .'; }';
		$output .= '.wpcf7-form-control.wpcf7-submit:hover,#main-menu .nav>li.nav-myacount a:hover,.wpb_tour_next_prev_nav a:hover,
		#navigation .navbar-header .navbar-toggle:hover, #navigation .navbar-header .navbar-toggle:focus{ background: '.esc_attr($themeum_options['hover-color']) .'; }';
		$output .= '.project-category-list ul li:hover{ border-color: '. esc_attr($themeum_options['hover-color']) .'; }';
	}


echo $output;