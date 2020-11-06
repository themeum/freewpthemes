<?php
add_action('init', 'register_thm_google_map_data', 99);
function register_thm_google_map_data(){
    global $kc;
    if( function_exists('kc_add_map') ){

    $kc->add_map(array(
            'thm_google_map' => array(
                'name'        => 'Google Map',
                'description' => 'Google Map shortcode of the theme',
                'icon'        => 'sl-envelope-open',
                'category'    => 'Tixon',
                'css_box'     => true,
                'params'      => array(
                    'Title' => array(
                          array(
                                'name'        => 'latitude',
                                'type'        => 'text',
                                'label'       => esc_html__( 'Latitude', 'wptixon' ),
                                'admin_label' => true,
                            ),
                          array(
                                'name'        => 'longitude',
                                'type'        => 'text',
                                'label'       => 'Longitude',
                                'admin_label' => true,
                          ),
                          array(
                                'name'        => 'height',
                                'type'        => 'number_slider',
                                'label'       => 'Height',
                                'options'     => array(
                                        'min'         => 0,
                                        'max'         => 1000,
                                        'unit'        => 'px',
                                        'show_input'  => true
                                  ) ,
                                'value'       => '670px',
                                'description' => esc_html__( 'Choose the height of the google Map.', 'wptixon' ),
                            ),
                        array(
                            'name'        => 'address',
                            'type'        => 'textarea',
                            'label'       => 'Address' ,
                            'description' => esc_html__( 'Address Line of Google Map.', 'wptixon' ),
                        ),
                        ),

                        'styling'   => array(
                            array(
                                'name'      => 'css_custom',
                                'type'      => 'css',
                                'options'   => array(
                                    array(
                                        "screens" => "any,1024,999,767,479",
                                        'Popup Image'  => array(
                                            array('property' => 'background-color', 'label' => esc_html__('Background Color', 'wptixon'), 'selector' => '.map-address'),
                                            array('property' => 'color', 'label' => esc_html__('Address Label Color', 'wptixon'), 'selector' => '.map-address strong'),
                                            array('property' => 'background-color', 'label' => esc_html__('Address Label Border Color', 'wptixon'), 'selector' => '.map-address strong::after'),
                                            array('property' => 'color', 'label' => esc_html__('Address Text Color', 'wptixon'), 'selector' => '.map-address'),
                                        ),                               
                                    )
                                )
                            )
                        ),
                    )
                )
        ));
    }
  }

// Register Hover Shortcode
function add_google_map_shortcode($atts, $content = null){
    $output = $extra_class = $latitude = $longitude = $height = $map_color = $address = $address_bg_color = '';
    extract( shortcode_atts( array(
        'latitude'         => '',
        'longitude'        => '',
        'height'           => '670px',
        'map_color'        => '',
        'address'          => '',
        'extra_class'           => ''
    ), $atts ));
    

    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    $wrap_class[] = 'themeum-google-map-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = $title_wrap_class;
    }

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
		$address = preg_replace('#^<\/p>|<p>$#', '', $address);
		$output .= '<div class="hidden" id="wplatitude">'.esc_attr($latitude).'</div>
					<div class="hidden" id="wplongitude">'.esc_attr($longitude).'</div>
					<div class="map-address" id="wpaddress">'.wp_kses_post($address).'</div>
					<div class="hidden" id="wpmap_color">'.esc_attr($map_color).'</div>';

		$output .= '<div id="map">';
		    $output .= '<div id="gmap-wrap">';
		        $output .= '<div id="gmap" style="height:'.(int)esc_attr($height).'px;">'; 
		        $output .= '</div>';              
		    $output .= '</div>';
		$output .= '</div>';
    $output .= '</div>';

    return $output;
  }
add_shortcode('thm_google_map', 'add_google_map_shortcode');
