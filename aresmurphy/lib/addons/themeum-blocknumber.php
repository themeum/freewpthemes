<?php
add_action('init', 'themeum_blocknumber_data', 99);
function themeum_blocknumber_data(){
    global $kc;
    if (function_exists('kc_add_map')) 
    {
    kc_add_map(
        array(
            'themeum_blocknumber' => array(
                'name'        => 'Themeum Block Number',
                'description' => esc_html__('Block Number shortcode', 'aresmurphy'),
                'icon'        => 'fa-header',
                'category'    => 'Ares Murphy',
                'params'      => array(

                    'General' => array(
                            array(
                                'name'          => 'number',
                                'type'          => 'text',
                                'label'         => esc_html__('Number text', 'aresmurphy'),
                                'description'   => esc_html__('Number of the heading.', 'aresmurphy'),
                                'admin_label'   => true,
                            ),   
                            array(
                                'name'          => 'title',
                                'type'          => 'textarea',
                                'label'         => esc_html__('Title text', 'aresmurphy'),
                                'description'   => esc_html__('Title of the heading.', 'aresmurphy'),
                                'admin_label'   => true,
                            ),
                                                       
                            array(
                                'name'  => 'extra_class',
                                'label' => esc_html__('Extra class', 'aresmurphy'),
                                'description'   => esc_html__('Custom class for wrapper of the shortcode', 'aresmurphy'),
                                'type'  => 'text'
                            ),
                        ),//general

                        'styling' => array(
                            array(
                                'name'    => 'css_custom',
                                'type'    => 'css',
                                'options'       => array(
                                    array(
                                        "screens" => "any,1024,999,767,479",
                                        'Title Style' => array(
                                            array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.blocknumber-title'),                                            
                                            array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.blocknumber-title'),
                                            array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.blocknumber-title'),
                                            array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'aresmurphy'), 'selector' => '.blocknumber-title'),
                                            array('property' => 'line-height', 'label' => esc_html__('Line height', 'aresmurphy'), 'selector' => '.blocknumber-title'),
                                            array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.blocknumber-title'),
                                            array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.blocknumber-title'),
                                            array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.blocknumber-title')
                                        ),                                       
                                        'Number'  => array(
                                            array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'background-color', 'label' => esc_html__('Background Color', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'aresmurphy'), 'selector' => '.blocknumber-digit:hover'),
                                            array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'line-height', 'label' => esc_html__('Line height', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'width', 'label' => esc_html__('Width', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'height', 'label' => esc_html__('Height', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'border-radius', 'label' => esc_html__('Border radius', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                            array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.blocknumber-digit'),
                                        ),                                
                                        'Box' => array(
                                            array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.blocknumber-wrap'),
                                            array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.blocknumber-wrap'),
                                        ),
                                    )
                                )
                            )
                        ),//styling
                    ) //params
                )//themeum_blocknumber
        ));
    }
  }

// Register Hover Shortcode
function themeum_blocknumber_shortcodes($atts, $content = null){
    $output = $number = $title = $numstyle =  '';
    extract( shortcode_atts( array(
        'number'                => '',
        'title'                 => '',
        'extra_class'           => ''
    ), $atts ));
    

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-blocknumber-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    } 

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="blocknumber-wrap">';
            $output .= '<div class="blocknumber-content">';
                $output .= '<div class="media">';
                    if ( !empty($number) ) {
                        $output .= '<div class="pull-left"><span class="blocknumber-digit">'.esc_attr($number).'</span></div>';
                    }
                    if ( !empty($title) ) {
                        $output .= '<div class="media-body text-left blocknumber-title">'.esc_attr($title).'</div>';
                    }
                $output .= '</div>';//media
            $output .= '</div>';//blocknumber-content
        $output .= '</div>';//blocknumber-wrap
    $output .= '</div>';

    return $output;
  }
add_shortcode('themeum_blocknumber', 'themeum_blocknumber_shortcodes');