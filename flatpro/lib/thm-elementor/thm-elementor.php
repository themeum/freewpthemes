<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function eae_elementor_init(){
    Elementor\Plugin::instance()->elements_manager->add_category(
        'themeum-elementor',
        [
            'title'  => 'Flat Pro Elements',
            'icon' => 'apps'
        ],
        0
    );
}
add_action('elementor/init','eae_elementor_init');

function flatpro_all_category_list( $cat ){
    $data = array();
    $data['allpost'] = 'All Category';
    $query1 = get_terms( $cat );
    if( $query1 ){
        foreach ( $query1 as $post ) {
            if( isset($data[ $post->slug ]) ){
               $data[ $post->slug ] = $post->name; 
            }
        }
    }
    return $data;
}
function add_new_elements(){
   require_once plugin_dir_path( __FILE__ ).'thm-title.php';
   require_once plugin_dir_path( __FILE__ ).'thm-button.php';
   require_once plugin_dir_path( __FILE__ ).'thm-counter.php';
   require_once plugin_dir_path( __FILE__ ).'thm-testimonial.php';
   require_once plugin_dir_path( __FILE__ ).'thm-gmap.php';
   require_once plugin_dir_path( __FILE__ ).'thm-post-grid.php';
   require_once plugin_dir_path( __FILE__ ).'thm-post-grid-2.php';
   require_once plugin_dir_path( __FILE__ ).'thm-team.php';
   require_once plugin_dir_path( __FILE__ ).'thm-portfolio.php';
   require_once plugin_dir_path( __FILE__ ).'thm-hire-button.php';
   require_once plugin_dir_path( __FILE__ ).'thm-slider-2.php';
   require_once plugin_dir_path( __FILE__ ).'thm-feature-box.php';
   require_once plugin_dir_path( __FILE__ ).'thm-pricing.php';
   require_once plugin_dir_path( __FILE__ ).'thm-tabs.php';
}
add_action('elementor/widgets/widgets_registered','add_new_elements');