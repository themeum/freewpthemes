<?php
add_action('init', 'crowdfunding_form_data', 99);
function crowdfunding_form_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
                  'kings_crowdfunding_form' => array(
                      'name'        => 'CF Form',
                      'description' => 'Crowdfunding Form of the theme.',
                      'icon'        => 'kc-icon-pricing',
                      'category'    => 'Crowdfunding',
                      'css_box'     => true,
                      'params'      => array()
                    )
        ));
    }
}

// Register Hover Shortcode
function crowdfunding_form_data_shortcodes($atts, $content = null){
    $output = '';
    $output = do_shortcode( '[wpcf_form]' );
    return $output;
}
add_shortcode('kings_crowdfunding_form', 'crowdfunding_form_data_shortcodes');