<?php 

//WPPB Hook
add_filter( 'wppb_available_addons', 'prefix_custom_addon_include' );
if ( ! function_exists('prefix_custom_addon_include')){
    function prefix_custom_addon_include($addons){
        $addons[] = 'Flatpro_Portfolio';
        return $addons;
    }
}
//Addon List Item
require 'thm-portfolio.php';