<?php
add_action('init', 'themeum_testimonial_carousel', 99);

function themeum_testimonial_carousel(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_testimonial' => array(
                'name'        => 'Testimonial',
                'description' => esc_html__('Add themeum testimonial', 'aresmurphy'),
                'icon'        => 'fa-quote-left',
                'category'    => 'Ares Murphy',
                'params'        => array(

                'general'   => array(
                    array(
                        'type'          => 'radio_image',
                        'label'         => __( 'Select layout', 'aresmurphy' ),
                        'name'          => 'layout',
                        'admin_label'   => true,
                        'options'       => array(
                            '1' => get_template_directory_uri()  . '/lib/addons/image/testimonial/1.png',
                            '2' => get_template_directory_uri()  . '/lib/addons/image/testimonial/3.png',
                            '3' => get_template_directory_uri()  . '/lib/addons/image/testimonial/2.png',
                            '4' => get_template_directory_uri()  . '/lib/addons/image/testimonial/4.png',
                        ),
                        'value'         => '1'
                    ),                    
                    array(
                        'name'  => 'image',
                        'label' => esc_html__( 'Person Image', 'aresmurphy' ),
                        'type'  => 'attach_image'
                    ),
                    array(
                        'name'  => 'image_sign',
                        'label' => esc_html__( 'Person Signature', 'aresmurphy' ),
                        'type'  => 'attach_image',
                        'relation'    => array(
                            'parent'    => 'layout',
                            'show_when' => '2',
                        ),
                    ),
                    array(
                        'type'          => 'text',
                        'name'          => 'title',
                        'label'         => esc_html__( 'Name', 'aresmurphy' ),
                        'value'         => 'Your Name',
                        'admin_label'   => true
                    ),
                    array(
                        'name'    => 'headline',
                        'label'   => esc_html__('Type', 'aresmurphy'),
                        'type'    => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'h1'  => 'H1',
                            'h2'  => 'H2',
                            'h3'  => 'H3',
                            'h4'  => 'H4',
                            'h5'  => 'H5',
                            'h6'  => 'H6',
                            'div'  => 'div',
                            'span'  => 'Span',
                            'p'     => 'P'
                        ),
                        'value'         => 'h3',
                    ),                     
                    array(
                        'name'      => 'subtitle',
                        'label'     => esc_html__( 'Subtitle', 'aresmurphy' ),
                        'type'      => 'text',
                        'value'     => 'Manager'
                    ),
                    array(
                        'type'  => 'textarea',
                        'name'  => 'desc',
                        'label' => esc_html__( 'Description', 'aresmurphy' ),
                        'value' => '',
                    ),                    
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'aresmurphy' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'aresmurphy' )
                    )
                ),
                'styling'   => array(
                    array(
                        'name'      => 'css_custom',
                        'type'      => 'css',
                        'options'   => array(
                            array(
                                "screens" => "any,1024,999,767,479",
                                'Title' => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.testimonial-content-title'),
                                ),
                                'Subtitle'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.testimonial-content-subtitle'),
                                ),
                                'Image' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                    array('property' => 'width', 'label' => esc_html__('Width', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border radius', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.testimonial-content-image img'),
                                ),
                                'Desc'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.testimonial-content-desc'),
                                ),  
                                'Box' => array(
                                    array('property' => 'background', 'label' => esc_html__('Background Color', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                    array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in:hover'),
                                    array('property' => 'width', 'label' => esc_html__('Width', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border radius', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.themeum-testimonial-wrap-in'),
                                ),                              
                            )
                        )
                    )
                ),
                'animate' => array(
                    array(
                        'name'    => 'animate',
                        'type'    => 'animate'
                    )
                ),

                )//params
            ),//themeum_testimonial

            )//array
        ); // End add map

    } // End if
}

// Register Hover Shortcode
function themeum_testimonial_data_shortcodes($atts, $content = null){
    $output = $image_sign = $sign_img = $image = $data_img = $headline = $extra_class = $align = $title_style = $style = $subtitle = $data_title = $data_subtitle = $desc =$data_desc = '';$layout = 1;
    extract( shortcode_atts( array(
        'layout'                => '1',
        'image'                 => '',
        'image_sign'            => '',
        'title'                 => '',
        'subtitle'              => '',
        'headline'              => 'h3',
        'desc'                  => '',
        'extra_class'           => ''
    ), $atts ));

    if( empty( $headline ) ) {
        $headline = 'h3';
    }

    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    $class_title = array( 'themeum_testimonial' );
    $wrap_class[] = 'themeum-testimonial-wrap-' . esc_attr($layout);

    $wrap_class[] = 'themeum-testimonial-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }


    // testimonial image
    if ( $image > 0 ) {
        $img_link = wp_get_attachment_image_src( $image, 'full' );
        $img_link = $img_link[0];

        $data_img .= '<div class="testimonial-content-image">';
            $data_img .= '<img src="'. esc_url($img_link) .'" alt="">';
        $data_img .= '</div>';
    }

    if ( $image_sign > 0 ) {
        $sign_image = wp_get_attachment_image_src( $image_sign, 'full' );
        $sign_image = $sign_image[0];
        $sign_img .= '<div class="testimonial-sign-image">';
        $sign_img .= '<img src="'. esc_url($sign_image) .'" alt="">';
        $sign_img .= '</div>';
    }

    //title
    if ( !empty( $title ) ) {
        $data_title .= '<'.esc_attr($headline).' class="testimonial-content-title">';
            $data_title .= wp_kses_post($title);
        $data_title .= '</'.esc_attr($headline).'>';
    }   

    //subtitle  
    if ( !empty( $subtitle ) ) {
        $data_subtitle .= '<div class="testimonial-content-subtitle">';
            $data_subtitle .= wp_kses_post($subtitle);
        $data_subtitle .= '</div>';
    }

    //Description
    if ( !empty( $desc ) ) {
        $data_desc .= '<div class="testimonial-content-desc">';
            $data_desc .= wp_kses_post($desc);
        $data_desc .= '</div>';
    }

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="item '.esc_attr( implode( ' ', $class_title ) ).'">';
            switch ( $layout ) {
                case '2':
                    $output .= '<div class="themeum-testimonial-wrap-in">';
                        $output .= '<div class="media">';
                            $output .= '<div class="testi-img pull-left">';
                                $output .= $data_img;
                            $output .= '</div>';//pull-left
                            $output .= '<div class="media-body">';
                                $output .= $data_title;
                                $output .= $data_subtitle;
                                $output .= $data_desc;
                                $output .= $sign_img;
                            $output .= '</div>';//media-body
                        $output .= '</div>';//media
                    $output .= '</div>';//themeum-testimonial-wrap-in
                break;
                case '3':
                    $output .= '<div class="themeum-testimonial-wrap-in">';
                        $output .= $data_img;
                        $output .= $data_desc;
                        $output .= $data_title;
                        $output .= $data_subtitle;
                    $output .= '</div>';//themeum-testimonial-wrap-in
                break;
                case '4':
                        $output .= '<div class="themeum-testimonial-wrap-in">';
                            $output .= '<div class="testi4-content-wrap">';
                                $output .= $data_desc;
                                $output .= '<div class="testi4-content clearfix">';
                                    $output .= $data_img;
                                    $output .= '<div class="testi4-content-title">';
                                        $output .= $data_title;
                                        $output .= $data_subtitle;
                                    $output .= '</div>';//media
                                $output .= '</div>';//media
                            $output .= '</div>';//media
                        $output .= '</div>';//themeum-testimonial-wrap-in
                break;                
                default:
                    $output .= '<div class="themeum-testimonial-wrap-in">';
                        $output .= $data_img;
                        $output .= $data_desc;
                        $output .= $data_title;
                        $output .= $data_subtitle;
                        $output .= '<i class="fa fa-quote-right"></i>';
                    $output .= '</div>';//themeum-testimonial-wrap-in
                break;            
            }
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('themeum_testimonial', 'themeum_testimonial_data_shortcodes');



