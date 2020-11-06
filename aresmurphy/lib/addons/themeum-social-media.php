<?php
add_action('init', 'themeum_social_media', 99);

function themeum_social_media(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_social' => array(
                'name'        => 'Themeum Social Button',
                'description' => esc_html__('Add Social Button', 'aresmurphy'),
                'icon'        => 'sl-share',
                'category'    => 'Ares Murphy',
                'params'        => array(

                'socials'   => array(
                    array(
                        'name'          => 'text_align',
                        'type'          => 'dropdown',
                        'label'         => esc_html__( 'Text Align', 'aresmurphy' ),
                        'description'   => esc_html__( 'Select the Text Align', 'aresmurphy' ),
                        'options'       => array(
                            'left'      => 'Left',
                            'center'    => 'Center',
                            'right'     => 'Right',
                        ),
                        'value'         => 'left',
                    ),                      
                    array(
                        'name'          => 'facebook',
                        'label'         => esc_html__( 'Facebook Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link facebook. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'twitter',
                        'label'         => esc_html__( 'Twitter Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link twitter. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'google_plus',
                        'label'         => esc_html__( 'Google Plus Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link google plus. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'linkedin',
                        'label'         => esc_html__( 'Linkedin Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link linkedin. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'youtube',
                        'label'         => esc_html__( 'Youtube Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link Youtube. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),                    
                    array(
                        'name'          => 'pinterest',
                        'label'         => esc_html__( 'Pinterest Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link pinterest. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'flickr',
                        'label'         => esc_html__( 'Flickr Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link flickr. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'instagram',
                        'label'         => esc_html__( 'Instagram Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link instagram. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'dribbble',
                        'label'         => esc_html__( 'Dribbble Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link dribbble. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'reddit',
                        'label'         => esc_html__( 'Reddit Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link reddit. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'email',
                        'label'         => esc_html__( 'Email Link', 'aresmurphy' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link email. It hidden when field blank.', 'aresmurphy' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                ),
                'styling'   => array(
                    array(
                        'name'      => 'css_custom',
                        'type'      => 'css',
                        'options'   => array(
                            array(
                                "screens" => "any,1024,999,767,479",
                                'Social'    => array(
                                    array('property' => 'color', 'label' => esc_html__('Icon Color', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'color', 'label' => esc_html__('Icon Hover Color', 'aresmurphy'), 'selector' => '.themeum-content-socials a:hover'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'aresmurphy'), 'selector' => '.themeum-content-socials a:hover'),
                                    array('property' => 'border-radius', 'label' => 'Border Radius', 'selector' => '.themeum-content-socials a'),   
                                    array('property' => 'width', 'label' => esc_html__('Width', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),  
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),                                  
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'aresmurphy'), 'selector' => '.themeum-content-socials a'),
                                    array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'aresmurphy'), 'selector' => '.themeum-content-socials a:hover'),
                                ),
                            )
                        )
                    )
                ),
                )//params
            ),//themeum_social

            )//array
        ); // End add map

    } // End if
}

// Register Hover Shortcode
function themeum_social_data_shortcodes($atts, $content = null){
    $output = $extra_class = $data_socials = $text_align = $align = '';
    extract( shortcode_atts( array(
        'text_align'            => 'center',
        'facebook'              => '',
        'twitter'               => '',
        'google_plus'           => '',
        'linkedin'              => '',
        'youtube'               => '',
        'pinterest'             => '',
        'flickr'                => '',
        'instagram'             => '',
        'dribbble'              => '',
        'reddit'                => '',
        'email'                 => '',
        'extra_class'           => ''
    ), $atts ));


    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    $class_title = array( 'themeum_social' );
    $wrap_class[] = 'themeum-social-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

    if( $text_align ){ 
        if( $text_align == 'left' ){ $align = 'text-left'; }
        if( $text_align == 'right' ){ $align = 'text-right'; }
        if( $text_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-left';
    }

    //social share
    $social_list = array(
        'facebook',
        'twitter',
        'google_plus',
        'linkedin',
        'pinterest',
        'youtube',
        'flickr',
        'instagram',
        'dribbble',
        'reddit',
        'email',
    );

    foreach( $social_list as $acc ){
        if( !empty( $atts[$acc]) && $atts[$acc] != '__empty__' ){
            $icon = str_replace( array('_', 'email') , array( '-', 'envelope-o') , $acc);
            $data_socials .= '<a href="' . $atts[$acc] . '" target="_blank"><i class="fa-' . $icon . '"></i></a>';
        }
    }
    if( !empty( $data_socials) ){
        $data_socials = '<div class="themeum-content-socials">' . $data_socials . '</div>';
    }
    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="'.$align.' '.esc_attr( implode( ' ', $class_title ) ).'">';
            $output .= $data_socials;
        $output .= '</div>';
    $output .= '</div>';
    return $output;
}
add_shortcode('themeum_social', 'themeum_social_data_shortcodes');



