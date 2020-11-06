<?php
add_action('init', 'king_title_data', 99);
function king_title_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
    $kc->add_map(array(
            'kings_title' => array(
                'name'        => 'Title',
                'description' => 'Title shortcode of the theme.',
                'icon'        => 'kc-icon-title',
                'category'    => 'Crowdfunding',
                'css_box'     => true,
                'params'      => array(
                                'Title' => array(
                                        array(
                                            'name'          => 'text_align',
                                            'type'          => 'dropdown',
                                            'label'         => 'Text Align',
                                            'options'       => array(
                                                        'left'     => 'Left',
                                                        'center'   => 'Center',
                                                        'right'    => 'Right',
                                              ),
                                            'value'         => 'Left',
                                            'description'   => 'Select the Text Align',
                                            'admin_label'   => true,
                                        ),
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
                                                                'min' => 0,
                                                                'max' => 100,
                                                                'unit' => 'px',
                                                                'show_input' => true
                                                            ),
                                            'value'         => '20',
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
                                        array(
                                            'name'          => 'font_weight',
                                            'type'          => 'dropdown',
                                            'label'         => 'Font Weight',
                                            'options'       => array(
                                                        '100'      => '100',
                                                        '200'      => '200',
                                                        '300'      => '300',
                                                        '400'      => '400',
                                                        '500'      => '500',
                                                        '600'      => '600',
                                                        '700'      => '700',
                                                        '800'      => '800',
                                                        '900'      => '900',
                                                        'bold'     => 'bold',
                                              ),
                                            'value'         => '300',
                                            'description'   => 'Select the Text Align',
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
                                        'value'         => '#444',
                                        'admin_label'   => true,
                                    ),
                                    array(
                                        'name'          => 'sub_title_fontsize',
                                        'type'          => 'number_slider',
                                        'label'         => 'Sub Title Font Size',
                                        'options'       => array(
                                                                'min'       => 0,
                                                                'max'       => 100,
                                                                'unit'      => 'px',
                                                                'show_input'=> true
                                                            ) ,
                                        'value'         => '20',
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
                                    array(
                                        'name'          => 'sub_title_line_height',
                                        'type'          => 'number_slider',
                                        'label'         => 'Sub Title Font Size',
                                        'options'       => array(
                                                                'min'       => 0,
                                                                'max'       => 100,
                                                                'unit'      => 'px',
                                                                'show_input'=> true
                                                            ) ,
                                        'value'         => '',
                                        'description'   => 'Chose Title Font Size here, Default is 20px'
                                    ),
                                ) ,



                            )
                )
        ));
    }
  }

// Register Hover Shortcode
function king_title_data_shortcodes($atts, $content = null){

  extract( shortcode_atts( array(
        'text_align'           => 'center',

        'title'                 => '',
        'title_color'           => '#000',
        'title_fontsize'        => '16px',
        'title_padding'         => '',
        'title_margin'          => '',
        'font_weight'           => '',
        
        'sub_title'             => '',
        'sub_title_color'       => '#4f585f',
        'sub_title_fontsize'    => '16px',
        'sub_title_padding'     => '',
        'sub_title_margin'      => '',
        'sub_title_line_height' => ''
    ), $atts ));
    $output = $align = $title_style = $sub_title_style = '';

    if( $text_align ){ 
        if( $text_align == 'left' ){ $align = 'text-left'; }
        if( $text_align == 'right' ){ $align = 'text-right'; }
        if( $text_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-center';
    }

    if( $title_color ){ $title_style .= 'color:'.$title_color.';'; }
    if( $title_fontsize ){ $title_style .= 'font-size:'.$title_fontsize.';'; }
    if( $title_padding ){ $title_style .= 'padding:'.$title_padding.';'; }
    if( $title_margin ){ $title_style .= 'margin:'.$title_margin.';'; }
    if( $font_weight ){ $title_style .= 'font-weight:'.$font_weight.';'; }


    if( $sub_title_color ){ $sub_title_style .= 'color:'.$sub_title_color.';'; }
    if( $sub_title_fontsize ){ $sub_title_style .= 'font-size:'.$sub_title_fontsize.';'; }
    if( $sub_title_padding ){ $sub_title_style .= 'padding:'.$sub_title_padding.';'; }
    if( $sub_title_margin ){ $sub_title_style .= 'margin:'.$sub_title_margin.';'; }
    if( $sub_title_line_height ){ $sub_title_style .= 'line-height:'.$sub_title_line_height.';'; }


    $output .= '<div class="'.$align.'">';
        $output .= '<h2 style="'.$title_style.'">'.$title.'</h2>';
        $output .= '<p style="'.$sub_title_style.'">'.$sub_title.'</p>';
    $output .= '</div>';

    return $output;
  }
add_shortcode('kings_title', 'king_title_data_shortcodes');