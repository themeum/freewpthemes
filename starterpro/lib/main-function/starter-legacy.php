<?php 

/*--------------------------------------------------------------
 *          Theme Shortcode
 *-------------------------------------------------------------*/

// service shortcode

add_shortcode('service','service_shortcode');

function service_shortcode($atts,$content = null)
{
    extract(shortcode_atts(array( 'icon' => '', 'title' => ''),$atts));

    $output = '';

    $output .= '<div class="service-box col-md-4 col-sm-6 col-xs-12">';
    $output .= '<div class="service-box-1 pull-left">';
    $output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
    $output .= '</div>';
    $output .= '<div class="service-box-2">';
    $output .= '<h3>'.$title.'</h3>';
    $output .= '<p>'.$content.'</p>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

// feature shortcode

add_shortcode('feature','feature_shortcode');

function feature_shortcode($atts,$content = null)
{
    extract(shortcode_atts(array( 'icon' => '', 'title' => '', 'color' => '1'),$atts));

    $output = '';
    $output .= '<div class="feature-box col-md-4 col-sm-6 col-xs-12">';
    $output .= '<div class="feature-box-1 pull-left color-'.$color.'">';
    $output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
    $output .= '</div>';
    $output .= '<div class="feature-box-2">';
    $output .= '<h3>'.$title.'</h3>';
    $output .= '<p>'.$content.'</p>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

// feature shortcode

add_shortcode('action','call_to_action_shortcode');

function call_to_action_shortcode($atts,$content = null)
{
    extract(shortcode_atts(array( 'title' => '', 'link' => '#', 'button' => 'Purchase Now'),$atts));

    $output = '';
    $output .= '<div id="call-to-action">';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="col-xs-12 col-sm-7 col-md-9">';
    $output .= '<h2>'.$content.'</h2>';
    $output .= '</div>';
    $output .= '<div class="col-xs-12 col-sm-5 col-md-3">';
    $output .= '<a class="btn btn-success btn-lg pull-right" href="'.$link.'">'.$button.'</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}


/*--------------------------------------------------------------
 * Get All Terms of Taxonomy 
 * @author : Themeum
 *-------------------------------------------------------------*/


function get_all_term_names( $post_id, $taxonomy = 'post_tag' )
{
    $terms = get_the_terms( $post_id, $taxonomy );

    $term_names = '';
    if ( $terms && ! is_wp_error( $terms ) )
    { 
        $term_name = array();

        foreach ( $terms as $term ) {
            $term_name[] = $term->name;
        }

        $term_names = join( ", ", $term_name );
    }

    return $term_names;
}


/*--------------------------------------------------------------
 *              One-Page Nav Walker
 *-------------------------------------------------------------*/

class Onepage_Walker extends Walker_Nav_menu{

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){

        global $wp_query;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join(' ', $classes);

        $class_names = ' class="'. esc_attr( $class_names ) . '"';

       
        $attributes     = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes     .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';


        if($item->object == 'page')
        {
            $post_object = get_post($item->object_id);

            $separate_page = get_post_meta($item->object_id, "thm_no_hash", true);

            $disable_item = get_post_meta($item->object_id, "thm_disable_menu", true);

            $current_page_id = get_option('page_on_front');

            if ( ( $disable_item != true ) && ( $post_object->ID != $current_page_id ) ) {

                $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

                if ( $separate_page == true )
                    $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'" class="no-scroll"' : '';
                else{
                    if (is_front_page()) 
                        $attributes .= ' href="#' . $post_object->post_name . '"'; 
                    else 
                        $attributes .= ' href="' . home_url() . '#' . $post_object->post_name . '" class="no-scroll"';
                }   

                $item_output = $args->before;
                $item_output .= '<a'. $attributes .'>';
                $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
                $item_output .= $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;

                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );                             
            }
                                     
        }
        else
        {

            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'" class="no-scroll"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}

function getContrast50($hexcolor){
    return (hexdec($hexcolor) > 0xffffff/2) ? 'light-bg':'dark-bg';
}


function update_option_settings()
{
    $updated_data = get_option('updated_data');
    $old_options = get_option( "theme_mods_starter" );

    if (!$updated_data && $old_options) {

        $url = home_url();

        $logo = (isset($old_options['logo_image']) && !empty($old_options['logo_image'])) ? str_replace('[site_url]', $url, $old_options['logo_image']) : '' ;

        if (!empty($logo)) {
            set_theme_mod( 'logo', $logo );
        }

        $body_bg = (isset($old_options['body_bg']) && !empty($old_options['body_bg'])) ? $old_options['body_bg'] : '' ;

        if (!empty($body_bg)) {
            set_theme_mod( 'body_bg_color', $body_bg );
        }

        $header_bg = (isset($old_options['header_bg']) && !empty($old_options['header_bg'])) ? $old_options['header_bg'] : '' ;

        if (!empty($header_bg)) {
            set_theme_mod( 'header_color', $header_bg );
        }

        $footer_bg = (isset($old_options['footer_bg']) && !empty($old_options['footer_bg'])) ? $old_options['footer_bg'] : '' ;

        if (!empty($footer_bg)) {
            set_theme_mod( 'footer_color', $footer_bg );
        }

        update_option( 'updated_data', true );
        
    }
}
add_action( 'after_setup_theme', 'update_option_settings' );

