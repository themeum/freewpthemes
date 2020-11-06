<?php
add_action('init', 'crowdfunding_registration_data', 99);
function crowdfunding_registration_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
              'kings_crowdfunding_registration' => array(
                  'name'        => 'CF Registration',
                  'description' => 'Crowdfunding Registration Form of the plugins.',
                  'icon'        => 'kc-icon-divider',
                  'category'    => 'Crowdfunding',
                  'css_box'     => true,
                  'params'      => array()
                )
        ));
    }
}

// Register Hover Shortcode
function crowdfunding_registration_data_shortcodes($atts, $content = null){
    $output = '';
    $output = do_shortcode( '[wpcf_registration]' );
    return $output;
}
add_shortcode('kings_crowdfunding_registration', 'crowdfunding_registration_data_shortcodes');