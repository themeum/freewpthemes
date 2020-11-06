<?php
add_action('init', 'king_google_map', 99);
function king_google_map(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
            'kc_google_map' => array(
                'name'          => 'Google Map',
                'description'   => 'Google Map Shortcode',
                'icon'          => 'kc-icon-map',
                'category'      => 'Crowdfunding',
                'css_box'       => true,
                'params'        => array(
                                      array(
                                            'name'        => 'latitude',
                                            'type'        => 'text',
                                            'label'       => 'Latitude',
                                            'description' => 'Total Padding of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label' => true,
                                        ),
                                      array(
                                            'name'        => 'longitude',
                                            'type'        => 'text',
                                            'label'       => 'Longitude',
                                            'description' => 'Total Padding of the heading eg( 0px 0px 0px 0px )',
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
                                            'value'       => '400px',
                                            'description' => 'Choose the height of the google Map.'
                                        ),
                                      array(
                                            'name'        => 'map_color',
                                            'type'        => 'color_picker',
                                            'label'       => 'Map Color',
                                            'value'       => '#4bb463',
                                            'admin_label' => true,
                                        ),
                                      array(
                                            'name'        => 'address',
                                            'type'        => 'textarea',
                                            'label'       => 'Address' ,
                                            'description' => 'Address Line of Google Map.',
                                            'admin_label' => true,
                                        ),
                )
            )
        ));
    }
}


// Google Map Shortcode
function king_google_map_shortcodes($atts, $content = null){
    extract( shortcode_atts( array(
        'latitude'         => '',
        'longitude'        => '',
        'height'           => '400px',
        'map_color'        => '',
        'address'          => '',
    ), $atts ));
    $output = $attribute = '';

    if( $latitude ){ $attribute .= ' latitude="'.$latitude.'"'; }
    if( $longitude ){ $attribute .= ' longitude="'.$longitude.'"'; }
    if( $height ){ $attribute .= ' minimum_height="'.$height.'"'; }
    if( $map_color ){ $attribute .= ' map_color="'.$map_color.'"'; }
    if( $address ){ $attribute .= ' address="'.$address.'"'; }

    $output = do_shortcode( '[google_map '.$attribute.']' );

    return $output;
}
add_shortcode('kc_google_map', 'king_google_map_shortcodes');

