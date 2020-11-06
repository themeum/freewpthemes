<?php

add_action('init', 'king_person_data', 99);

function king_person_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
            'kings_person'    => array(
                'name'        => 'Person',
                'description' => 'Title shortcode of the theme.',
                'icon'        => 'kc-icon-team',
                'category'    => 'Crowdfunding',
                'css_box'     => true,
                'params'      => array(
                                        array(
                                            'name'          => 'images',
                                            'label'         => 'Upload Image',
                                            'type'          => 'attach_image',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'name',
                                            'type'          => 'text',
                                            'label'         => 'Name',
                                            'description'   => 'Put here name',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'designation',
                                            'type'          => 'text',
                                            'label'         => 'Designation',
                                            'description'   => 'Put here designation',
                                            'admin_label'   => true,
                                        ),
                                ),
                )
        ));
    }
}

// Register Hover Shortcode
function king_person_shortcodes($atts, $content = null){
    extract( shortcode_atts( array(
        'images'        => '',
        'name'          => '',
        'designation'   => '',
    ), $atts ));
    $output = $attribute = '';

    if( $images ){ $attribute .= ' images="'.$images.'"'; }
    if( $name ){ $attribute .= ' name="'.$name.'"'; }
    if( $designation ){ $attribute .= ' designation="'.$designation.'"'; }

    $output .= do_shortcode( '[wpneo_person '.$attribute.'][/wpneo_person]' );

    return $output;
  }
add_shortcode('kings_person', 'king_person_shortcodes');