<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';

$headerbg = $themeum_options['header-bg'];
if(isset($headerbg)){
	$output .= '.header{ background: '.esc_attr($themeum_options['header-bg']) .'; }';
}


if ($themeum_options['header-fixed']){

	if(isset($headerbg)){
		$output .= '#masthead.sticky{ background-color: rgba('.themeum_hex2rgb($headerbg).',.95); }';
	}
	$output .= '#masthead.sticky{ position:fixed; z-index:99999;margin:0 auto 30px; width:100%;box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.22);}';
	$output .= '#masthead.sticky #header-container{ padding:0;transition: padding 200ms linear; -webkit-transition:padding 200ms linear;}';
	$output .= '#masthead.sticky .navbar.navbar-default{ background: rgba(255,255,255,.95); border-bottom:1px solid #f5f5f5}';
}



if(isset($themeum_options['header-padding-top'])){
	$output .= '#header-container{ padding-top: '. (int) esc_attr($themeum_options['header-padding-top']) .'px; }';
}

if(isset($themeum_options['header-padding-bottom'])){
	$output .= '.site-header{ padding-bottom: '. (int) esc_attr($themeum_options['header-padding-bottom']) .'px; }';
}

if(isset($themeum_options['footer-bg'])){
	$output .= '#footer{ background: '.esc_attr($themeum_options['footer-bg']) .'; }';
}

if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
	$output .= "body.page-template-coming-soon-php{
		background: #fff;
		display: table;
		width: 100%;
		height: 100%;
		min-height: 100%;
	}";
}


if(isset($themeum_options['css_editor'])){
   $output .= $themeum_options['css_editor'];
}


echo $output;