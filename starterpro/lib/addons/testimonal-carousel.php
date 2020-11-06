<?php
add_action('init', 'themeum_testimonial_carousel_addons', 99);

function themeum_testimonial_carousel_addons(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

                'thm_testimonial_carousel'    => array(
                    'name'          => esc_html__( 'Testimonial Carousel', 'starterpro' ),
                    'icon'          => 'fa-sliders',
                    'category'      => 'Starter',
                    'nested'        => true,
                    'accept_child'  => 'themeum_testimonial',
                    'params' => array(
                        array(
                            'name'    => 'testicolumn',
                            'label'   => esc_html__('Show Column', 'starterpro'),
                            'type'    => 'select',
                            'options' => array(
                                '1'  => esc_html__('Column 1', 'starterpro'),
                                '2'  => esc_html__('Column 2', 'starterpro'), 
                                '3'  => esc_html__('Column 3', 'starterpro'),
                                '4'  => esc_html__('Column 4', 'starterpro'),
                                '5'  => esc_html__('Column 5', 'starterpro'),
                            ),
                            'value'         => '1',
                        ), 
                        array(
                            'name'    => 'testipagination',
                            'label'   => esc_html__('Show Pagination', 'starterpro'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'starterpro'),  
                                'false'  => esc_html__('No', 'starterpro'),

                            ),
                            'value'         => 'false',
                        ),                         
                        array(
                            'name'    => 'testinav',
                            'label'   => esc_html__('Show Navigation', 'starterpro'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'starterpro'),  
                                'false'  => esc_html__('No', 'starterpro'),
                            ),
                            'value'         => 'true',
                        ),                         
                        array(
                            'name'    => 'testiautoplay',
                            'label'   => esc_html__('Auto play', 'starterpro'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'starterpro'),  
                                'false'  => esc_html__('No', 'starterpro'),
                            ),
                            'value'         => 'true',
                        ), 
                        array(
                            'type'          => 'text',
                            'label'         => esc_html__( 'Custom class', 'starterpro' ),
                            'name'          => 'extra_class',
                            'description'   => esc_html__( 'Enter extra custom class', 'starterpro' )
                        ),



                    )                    
                )

            )
        ); // End add map

    } // End if
}

function themeum_testimonial_carousel_register( $atts, $content = null ){
    $output = $extra_class  = $testicolumn = $testipagination = $testiautoplay = $testinav = '';
    extract( shortcode_atts( array(
        'testicolumn'            => '1',
        'testipagination'        => 'true',
        'testiautoplay'          => 'true',
        'testinav'               => 'true',
        'extra_class'            => '',
    ), $atts ));

    

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'thm_testimonial_carousel';
    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

    $output = '<div data-number="'.esc_attr($testicolumn).'" data-pagi="'.esc_attr($testipagination).'" data-aplay="'.esc_attr($testiautoplay).'" data-testnav="'.esc_attr($testinav).'" class="themeum-testimonial-carousel owl-carousel owl-theme testimonial-carousel '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= do_shortcode( str_replace('thm_testimonial_carousel#', 'thm_testimonial_carousel', $content ) );
    $output .= '</div>';

    return $output;

}
add_shortcode('thm_testimonial_carousel', 'themeum_testimonial_carousel_register');