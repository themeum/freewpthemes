<?php
add_action('init', 'icon_title_data', 99);

function icon_title_data(){
    global $kc;
        if( function_exists('kc_add_map') ){
            $kc->add_map(array(
                'kings_icon_title' => array(
                    'name'        => 'Icon Title',
                    'description' => 'Icon Title shortcode of the theme.',
                    'icon'        => 'kc-icon-icon',
                    'category'    => 'Crowdfunding',
                    'css_box'     => true,
                    'params'      => array(
                                      array(
                                            'name'          => 'icon_class',
                                            'type'          => 'icon_picker',
                                            'label'         => 'Select Icon',
                                            'admin_label'   => true,
                                          ),
                                      array(
                                            'name'          => 'text',
                                            'type'          => 'text',
                                            'label'         => 'Text',
                                            'description'   => 'Put here Text',
                                            'admin_label'   => true,
                                          ),
                                      array(
                                            'name'          => 'color',
                                            'type'          => 'color_picker',
                                            'label'         => 'Color',
                                            'value'         => '#444',
                                            'admin_label'   => true,
                                          ),
                                      array(
                                            'name'          => 'font_size',
                                            'type'          => 'number_slider',
                                            'label'         => 'Title Font Size',
                                            'options'       => array(
                                                                'min'       => 0,
                                                                'max'       => 100,
                                                                'unit'      => 'px',
                                                                'show_input'=> true
                                                              ),
                                            'value'         => '20px',
                                            'description'   => 'Chose Title Font Size here, Default is 20px'
                                          ),
                            )
                )
          ));
      }
  }

// Icon Data Shortcode
function icon_data_data_shortcodes($atts, $content = null){

    extract( shortcode_atts( array(
        'icon_class'     => 'fa-university',
        'text'           => '',
        'color'          => '#4f585f',
        'font_size'      => '40px',
    ), $atts ));
    $output = $attribute = '';

    if( $icon_class ){ $attribute .= ' icon_class="'.$icon_class.'"'; }
    if( $color ){ $attribute .= ' color="'.$color.'"'; }
    if( $font_size ){ $attribute .= ' font_size="'.$font_size.'"'; }

    $output .= do_shortcode( '[icontext '.$attribute.']'.$text.'[/icontext]' );

    return $output;
  }
add_shortcode('kings_icon_title', 'icon_data_data_shortcodes');