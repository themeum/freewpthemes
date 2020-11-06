<?php 

//WPPB Hook
add_filter( 'wppb_available_addons', 'prefix_custom_addon_include' );
if ( ! function_exists('prefix_custom_addon_include')){
    function prefix_custom_addon_include($addons){
        $addons[] = 'Winkel_Action';
        $addons[] = 'Winkel_Title';
        $addons[] = 'Winkel_Woo_Featured';
        $addons[] = 'Winkel_Woo_Popular';
        $addons[] = 'Winkel_Woo_Latest';
        $addons[] = 'Winkel_Latest_News';
        return $addons;
    }
}
//Addon List Item
require 'thm-action.php';
require 'thm-title.php';
require 'thm-woo-featured.php';
require 'thm-woo-popular.php';
require 'thm-woo-latest.php';
require 'thm-latest-news.php';