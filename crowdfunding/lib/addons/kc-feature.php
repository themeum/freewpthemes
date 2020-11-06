<?php
add_action('init', 'king_feature_data', 99);

function king_feature_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
            'kings_feature' => array(
                'name'        => 'Feature',
                'description' => 'Feature shortcode of the theme.',
                'icon'        => 'kc-icon-feature-box',
                'category'    => 'Crowdfunding',
                'css_box'     => true,
                'params'      => array(
                                'Icon' => array(
                                        array(
                                            'name'          => 'text_align',
                                            'type'          => 'dropdown',
                                            'label'         => 'Text Align',
                                            'description'   => 'Select the Text Align',
                                            'options'       => array(
                                                                'left'      => 'Left',
                                                                'center'    => 'Center',
                                                                'right'     => 'Right',
                                                            ),
                                            'value'         => 'Left',
                                            'admin_label'   => true,
                                            ),
                                        array(
                                            'name'          => 'total_padding',
                                            'type'          => 'text',
                                            'label'         => 'Sub Title Padding',
                                            'description'   => 'Total Padding of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'icon_class',
                                            'type'          => 'icon_picker',
                                            'label'         => 'Select Icon',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'icon_size',
                                            'type'          => 'number_slider',
                                            'label'         => 'Icon Size',
                                            'options'       => array(
                                                                'min'           => 0,
                                                                'max'           => 200,
                                                                'unit'          => 'px',
                                                                'show_input'    => true
                                                              ) ,
                                            'value'         => '20px',
                                            'description'   => 'Chose Title Icon Size here, Default is 20px'
                                        ),
                                        array(
                                            'name'          => 'icon_color',
                                            'type'          => 'color_picker',
                                            'label'         => 'Icon Color',
                                            'value'         => '#444',
                                            'admin_label'   => true,
                                        ),
                                    ),
                                'Title' => array(
                                        array(
                                            'name'          => 'title',
                                            'type'          => 'text',
                                            'label'         => 'Title Text',
                                            'description'   => 'Title of the heading.',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'title_color',
                                            'type'          => 'color_picker',
                                            'label'         => 'Title Color',
                                            'value'         => '#444',
                                            'admin_label'   => true,
                                            
                                        ),
                                        array(
                                            'name'          => 'title_fontsize',
                                            'type'          => 'number_slider',
                                            'label'         => 'Title Font Size',
                                            'options'       => array(
                                                                'min'       => 0,
                                                                'max'       => 40,
                                                                'unit'      => 'px',
                                                                'show_input'=> true
                                                              ),
                                            'value'         => '20px',
                                            'description'   => 'Chose Title Font Size here, Default is 20px'
                                        ),
                                        array(
                                            'name'          => 'title_padding',
                                            'type'          => 'text',
                                            'label'         => 'Padding',
                                            'description'   => 'Padding of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'title_margin',
                                            'type'          => 'text',
                                            'label'         => 'Margin',
                                            'description'   => 'Margin of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),
                                    ) ,
                                'Sub Title' => array(
                                        array(
                                            'name'          => 'sub_title',
                                            'type'          => 'textarea',
                                            'label'         => 'Sub Title Text',
                                            'description'   => 'Title of the heading.',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'sub_title_color',
                                            'type'          => 'color_picker',
                                            'label'         => 'Sub Title Color',
                                            'admin_label'   => true,
                                            'value'         => '#444',
                                        ),
                                        array(
                                            'name'          => 'sub_title_fontsize',
                                            'type'          => 'number_slider',
                                            'label'         => 'Sub Title Font Size',
                                            'options'       => array(
                                                                'min'           => 0,
                                                                'max'           => 100,
                                                                'unit'          => 'px',
                                                                'show_input'    => true
                                                            ),
                                            'value'         => '20px',
                                            'description'   => 'Chose Title Font Size here, Default is 20px'
                                        ),
                                        array(
                                            'name'          => 'sub_title_padding',
                                            'type'          => 'text',
                                            'label'         => 'Sub Title Padding',
                                            'description'   => 'Padding of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'sub_title_margin',
                                            'type'          => 'text',
                                            'label'         => 'Sub Title Margin',
                                            'description'   => 'Margin of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),
                                    ) ,
                            )
                )
        ));
    }
}

// Register Hover Shortcode
function king_feature_data_shortcodes($atts, $content = null){

  extract( shortcode_atts( array(
        'text_align'            => 'center',
        'total_padding'         => '',

        'icon_class'            => 'fa-university',
        'icon_size'             => '40px',
        'icon_color'            => '#4f585f',

        'title'                 => '',
        'title_color'           => '#000',
        'title_fontsize'        => '16px',
        'title_padding'         => '',
        'title_margin'          => '',
        
        'sub_title'             => '',
        'sub_title_color'       => '#4f585f',
        'sub_title_fontsize'    => '16px',
        'sub_title_padding'     => '',
        'sub_title_margin'      => '',
    ), $atts ));
    $output = $align = $title_style = $sub_title_style = $total = $icon_style = '';

    if( $text_align ){ 
        if( $text_align == 'left' ){ $align = 'text-left'; }
        if( $text_align == 'right' ){ $align = 'text-right'; }
        if( $text_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-center';
    }

    if( $total_padding ){ $total = 'style="padding:'.$total_padding.';"'; }

    if( $icon_size ){ $icon_style .= 'font-size:'.$icon_size.';'; }
    if( $icon_color ){ $icon_style .= 'color:'.$icon_color.';'; }


    if( $title_color ){ $title_style .= 'color:'.$title_color.';'; }
    if( $title_fontsize ){ $title_style .= 'font-size:'.$title_fontsize.';'; }
    if( $title_padding ){ $title_style .= 'padding:'.$title_padding.';'; }
    if( $title_margin ){ $title_style .= 'margin:'.$title_margin.';'; }

    if( $sub_title_color ){ $sub_title_style .= 'color:'.$sub_title_color.';'; }
    if( $sub_title_fontsize ){ $sub_title_style .= 'font-size:'.$sub_title_fontsize.';'; }
    if( $sub_title_padding ){ $sub_title_style .= 'padding:'.$sub_title_padding.';'; }
    if( $sub_title_margin ){ $sub_title_style .= 'margin:'.$sub_title_margin.';'; }

    $output .= '<div class="box-feature-content '.$align.'" '.$total.'>';
        $output .= '<i style="'.$icon_style.'" class="fa '.$icon_class.'"></i>';
        if( $title ){ $output .= '<h4 style="'.$title_style.'">'.$title.'</h4>'; }
        if( $sub_title ){ $output .= '<p style="'.$sub_title_style.'">'.$sub_title.'</p>'; }
    $output .= '</div>';

    return $output;
  }

add_shortcode('kings_feature', 'king_feature_data_shortcodes');

