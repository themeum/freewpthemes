<?php
add_action('init', 'themeum_image_hover_function', 99);

function themeum_image_hover_function(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_image_hover' => array(
                'name'        => 'Image Hover Effect',
                'description' => esc_html__('Add Image Hover Effect', 'aresmurphy'),
                'icon'        => 'sl-camera',
                'category'    => 'Ares Murphy',
                'params'        => array(
                'general'   => array(     
                    array(
                        'type'          => 'text',
                        'name'          => 'title',
                        'label'         => esc_html__( 'Title', 'aresmurphy' ),
                        'description'   => esc_html__( 'Add Title', 'aresmurphy' ),
                        'admin_label'   => true,
                    ),             
                    array(
                        'name'  => 'hover_image',
                        'label' => esc_html__( 'Person Image', 'aresmurphy' ),
                        'type'  => 'attach_image'
                    ),                                                                            
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'aresmurphy' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'aresmurphy' ),
                    )
                ),

                )//params
            ),//themeum_image_hover

            )//array
        ); // End add map

    } // End if
}

// Register Hover Shortcode
function themeum_shortcode_image_hover_function($atts, $content = null){
    $output = $hover_image = $image_style = $title = $align = '';
    extract( shortcode_atts( array(
        'hover_image'           => '',
        'image_sign'            => '',
        'title'                 => '',
        'extra_class'           => ''
    ), $atts ));

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-image-hover-effect';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

    if ( $hover_image > 0 ) {
        $img_link = wp_get_attachment_image_src( $hover_image, 'full' );
        $img_link = $img_link[0];
        $image_style = 'style = "background: url('.esc_url($img_link).') no-repeat;background-size:cover;"';
    }

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="single-image-wrap">';
            $output .= '<div class="single-image-container">';
                $output .= '<div class="hover-image-overlay"></div>';
                $output .= '<h3 class="hover-image-title">'.wp_kses_post($title).'</h3>';
                $output .= '<a class="plus-icon" href="'.esc_url($img_link).'">+</a>';
                $output .= '<img class="img-responsive" src="'.esc_url($img_link).'" alt="gallery">';
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('themeum_image_hover', 'themeum_shortcode_image_hover_function');

