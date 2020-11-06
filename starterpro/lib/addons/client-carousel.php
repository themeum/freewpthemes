<?php
add_action('init', 'themeum_clinet_carousel_addons', 99);

function themeum_clinet_carousel_addons(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

                'thm_client_carousel'    => array(
                    'name'          => esc_html__( 'Client Carousel', 'starterpro' ),
                    'icon'          => 'fa-sliders',
                    'category'      => 'Starter',
                    'nested'        => true,
                    'accept_child'  => 'kc_single_image',
                    'params' => array(
                        array(
                            'name'    => 'clientcolumn',
                            'label'   => esc_html__('Show Column', 'starterpro'),
                            'type'    => 'select',
                            'admin_label' => true,
                            'options' => array(
                                '2'  => esc_html__('Column 2', 'starterpro'), 
                                '3'  => esc_html__('Column 3', 'starterpro'),
                                '4'  => esc_html__('Column 4', 'starterpro'),
                                '5'  => esc_html__('Column 5', 'starterpro'),
                                '6'  => esc_html__('Column 6', 'starterpro'),
                            ),
                            'value'         => '5',
                        ), 
                        array(
                            'name'    => 'clientpagination',
                            'label'   => esc_html__('Show Pagination', 'starterpro'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'starterpro'),  
                                'false'  => esc_html__('No', 'starterpro'),

                            ),
                            'value'         => 'true',
                        ),                         
                        array(
                            'name'    => 'clientautoplay',
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

function themeum_clients_carousel_register( $atts, $content = null ){
    $output = $extra_class  = $clientcolumn = $clientpagination = $clientautoplay = '';
    extract( shortcode_atts( array(
        'clientcolumn'          => '3',
        'clientpagination'        => 'true',
        'clientautoplay'          => 'true',
        'extra_class'           => '',
    ), $atts ));


    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-client-carousel';
    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    } 

    $output = '<div data-number="'.esc_attr($clientcolumn).'" data-pagi="'.esc_attr($clientpagination).'" data-aplay="'.esc_attr($clientautoplay).'" class="client-carousel owl-carousel owl-theme '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= do_shortcode( str_replace('thm_client_carousel#', 'thm_client_carousel', $content ) );
    $output .= '</div>';

    return $output;

}
add_shortcode('thm_client_carousel', 'themeum_clients_carousel_register');



