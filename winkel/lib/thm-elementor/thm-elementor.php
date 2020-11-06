<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function eae_elementor_init(){
    Elementor\Plugin::instance()->elements_manager->add_category(
        'themeum-elementor',
        [
            'title'  => 'Winkel Elements',
            'icon' => 'apps'
        ],
        0
    );
}
add_action('elementor/init','eae_elementor_init');


function winkel_all_category_list( $cat ){
    $data = array();
    $data['allpost'] = 'All Category';
    $query1 = get_terms( $cat );
    if( $query1 ){
        foreach ( $query1 as $post ) {
          $data[ $post->slug ] = $post->name; 
        }
    }
    return $data;
}

function add_new_elements(){
    require_once plugin_dir_path( __FILE__ ).'thm-title.php';
    require_once plugin_dir_path( __FILE__ ).'thm-action.php';
    require_once plugin_dir_path( __FILE__ ).'thm-button.php';
    require_once plugin_dir_path( __FILE__ ).'thm-counter.php';
    require_once plugin_dir_path( __FILE__ ).'thm-testimonial.php';
    require_once plugin_dir_path( __FILE__ ).'thm-gmap.php';
    require_once plugin_dir_path( __FILE__ ).'thm-post-grid.php';
    require_once plugin_dir_path( __FILE__ ).'thm-post-grid-2.php';
    require_once plugin_dir_path( __FILE__ ).'thm-team.php';
    require_once plugin_dir_path( __FILE__ ).'thm-hire-button.php';
    require_once plugin_dir_path( __FILE__ ).'thm-slider-2.php';
    require_once plugin_dir_path( __FILE__ ).'thm-feature-box.php';
    require_once plugin_dir_path( __FILE__ ).'thm-pricing.php';
    require_once plugin_dir_path( __FILE__ ).'thm-tabs.php';
    require_once plugin_dir_path( __FILE__ ).'thm-latest-news.php';

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        require_once plugin_dir_path( __FILE__ ).'thm-woo-featured.php';
        require_once plugin_dir_path( __FILE__ ).'thm-woo-popular.php';
        require_once plugin_dir_path( __FILE__ ).'thm-woo-latest.php';
    }

}
add_action('elementor/widgets/widgets_registered','add_new_elements');