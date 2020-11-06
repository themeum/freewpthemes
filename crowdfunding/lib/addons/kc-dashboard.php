<?php
add_action('init', 'crowdfunding_dashboard_data', 99);
function crowdfunding_dashboard_data(){
  global $kc;
  if( function_exists('kc_add_map') ){
      $kc->add_map(array(
                  'kings_crowdfunding_dashboard' => array(
                      'name'        => 'CF Dashboard',
                      'description' => 'Crowdfunding Registration Form of the plugins.',
                      'icon'        => 'kc-icon-dropcaps',
                      'category'    => 'Crowdfunding',
                      'css_box'     => true,
                      'params'      => array()
                    )
        ));
    }
}

// Register Hover Shortcode
function crowdfunding_dashboard_data_shortcodes($atts, $content = null){
    $output = '';
    $output = do_shortcode( '[wpcf_dashboard]' );
    return $output;
}
add_shortcode('kings_crowdfunding_dashboard', 'crowdfunding_dashboard_data_shortcodes');