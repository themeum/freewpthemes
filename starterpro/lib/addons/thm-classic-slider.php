<?php
add_action('init', 'themeum_classic_slider', 99);

function themeum_classic_slider(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

            'classic_slider' => array(
                'name'        => 'Classic Slider',
                'description' => esc_html__('Add themeum classic slider', 'starterpro'),
                'icon'        => 'kc-icon-icarousel',
                'category'    => 'Starter',
                'params'      => array(
                    
                    'general' => array(

                        array(
                            'type'          => 'group',
                            'label'         => esc_html__('Add slide', 'starterpro'),
                            'name'          => 'classic_slider_opt',
                            'description'   => esc_html__( 'Repeat this fields with each item created, Each item corresponding slide.', 'starterpro' ),
                            'options'       => array('add_text' => esc_html__('Add new slide', 'starterpro')),

                            'params' => array( 
                                array(
                                    'name'          => 'slide_align',
                                    'type'          => 'dropdown',
                                    'label'         => 'Slide align',
                                    'options'       => array(
                                        'left'     => esc_html__('Left', 'starterpro'),
                                        'center'   => esc_html__('Center', 'starterpro'),
                                        'right'    => esc_html__('Right', 'starterpro'),
                                      ),
                                    'value'         => 'left',
                                    'description'   => esc_html__('Select the slide align', 'starterpro'),

                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Title', 'starterpro' ),
                                    'name' => 'title',
                                    'description' => esc_html__( 'Enter text used as title of the slide.', 'starterpro' ),
                                    'admin_label' => true,
                                ), 
                                array(
                                    'name'    => 'title_border',
                                    'label'   => esc_html__('Show title border layout', 'starterpro'),
                                    'type'    => 'select',
                                    'admin_label' => true,
                                    'options' => array(
                                        '1'  => esc_html__('Yes', 'starterpro'),  
                                        '2'  => esc_html__('No', 'starterpro'),
                                    ),
                                    'value'         => '1',
                                ),                                
                                array(
                                    'name'          => 'border_width',
                                    'type'          => 'number_slider',
                                    'label'         => esc_html__('Border width', 'starterpro'),
                                    'options'       => array(
                                        'min'           => 0,
                                        'max'           => 200,
                                        'unit'          => 'px',
                                        'show_input'    => true
                                    ),
                                    'value'         => '',
                                    'description'   => esc_html__('Choose border width for bottom of the title ', 'starterpro'),
                                    'relation'    => array(
                                        'parent'    => 'title_border',
                                        'show_when' => '1',
                                    ),
                                ),
                                array(
                                    'name'          => 'border_height',
                                    'type'          => 'number_slider',
                                    'label'         => esc_html__('Border height', 'starterpro'),
                                    'options'       => array(
                                        'min'           => 0,
                                        'max'           => 10,
                                        'unit'          => 'px',
                                        'show_input'    => true
                                    ),
                                    'value'         => '',
                                    'description'   => esc_html__('Choose border height for bottom of the title ', 'starterpro'),
                                    'relation'    => array(
                                        'parent'    => 'title_border',
                                        'show_when' => '1',
                                    ),
                                ),  
                                array(
                                    'name'    => 'border_position',
                                    'label'   => esc_html__('Title Type', 'starterpro'),
                                    'type'    => 'select',
                                    'admin_label' => true,
                                    'options' => array(
                                        'top'  => 'Top',
                                        'bottom'  => 'Bottom',
                                    ),
                                    'value'         => 'bottom',
                                    'relation'    => array(
                                        'parent'    => 'title_layout',
                                        'show_when' => 'default',
                                    ),
                                ),                                                
                                array(
                                    'name'          => 'border_bg',
                                    'type'          => 'color_picker',
                                    'label'         => esc_html__( 'Border Background', 'starterpro' ),
                                    'value'         => '',
                                    'relation'      => array(
                                        'parent'    => 'title_border',
                                        'show_when' => '1',
                                    ),
                                ),                                 
                                array(
                                    'name'    => 'headline',
                                    'label'   => esc_html__('Title headline', 'starterpro'),
                                    'type'    => 'select',
                                    'admin_label' => true,
                                    'options' => array(
                                        'h1'  => 'H1',
                                        'h2'  => 'H2',
                                        'h3'  => 'H3',
                                        'h4'  => 'H4',
                                        'h5'  => 'H5',
                                        'h6'  => 'H6',
                                        'div'  => 'div',
                                        'span'  => 'Span',
                                        'p'  => 'P'
                                    ),
                                    'value'         => 'h2',
                                ),                                                                                              
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Sub Title', 'starterpro' ),
                                    'name' => 'subtitle',
                                    'description' => esc_html__( 'Enter text used as sub title of the slide.', 'starterpro' ),
                                    'admin_label' => false,
                                ),  
                                array(
                                    'name'    => 'subheadline',
                                    'label'   => esc_html__('Sub title headline', 'starterpro'),
                                    'type'    => 'select',
                                    'admin_label' => true,
                                    'options' => array(
                                        'h1'  => 'H1',
                                        'h2'  => 'H2',
                                        'h3'  => 'H3',
                                        'h4'  => 'H4',
                                        'h5'  => 'H5',
                                        'h6'  => 'H6',
                                        'div'  => 'div',
                                        'span'  => 'Span',
                                        'p'  => 'P'
                                    ),
                                    'value'         => 'h3',
                                ),                                                                 
                                array(
                                    'type' => 'text',
                                    'label' => esc_html__( 'Button URL', 'starterpro' ),
                                    'name' => 'btnurl',
                                    'description' => esc_html__( 'Enter text used as button url of the slide.', 'starterpro' ),
                                    'admin_label' => false,
                                ),                                                               
                                array(
                                    'type' => 'text',
                                    'label' => esc_html__( 'Button Text', 'starterpro' ),
                                    'name' => 'btntext',
                                    'description' => esc_html__( 'Enter text used as button text of the slide.', 'starterpro' ),
                                    'admin_label' => false,
                                ),                                
                                array(
                                    'type'          => 'attach_image',
                                    'label'         => esc_html__( 'Background image', 'starterpro' ),
                                    'name'          => 'bg_image',
                                    'description'   => esc_html__( 'Upload image used as background of the slide.', 'starterpro' ),
                                    'admin_label'   => false,
                                    'value'         => '',
                                ),                                
                                array(
                                    'type' => 'color_picker',
                                    'label' => esc_html__( 'Background Color', 'starterpro' ),
                                    'name' => 'bg_color',
                                    'description' => esc_html__( 'Enter color used as background of the slide.', 'starterpro' ),
                                ),
                                array(
                                    'name'          => 'slide_height',
                                    'type'          => 'number_slider',
                                    'label'         => esc_html__('Slide Height', 'starterpro'),
                                    'options'       => array(
                                        'min'           => 300,
                                        'max'           => 900,
                                        'unit'          => 'px',
                                        'show_input'    => true
                                    ),
                                    'value'         => '730px',
                                    'description'   => esc_html__('Choose slide height', 'starterpro'),
                                ),  
                            ),
                        ),
                        array(
                            'name'    => 'sliderpagination',
                            'label'   => esc_html__('Show Pagination', 'starterpro'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'starterpro'),  
                                'false'  => esc_html__('No', 'starterpro'),
                            ),
                            'value'         => 'true',
                        ),                         
                        array(
                            'name'    => 'sliderautoplay',
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
                            'label'         => esc_html__( 'Wrapper class name', 'starterpro' ),
                            'name'          => 'extra_class',
                            'description'   => esc_html__( 'Custom class for wrapper of the shortcode', 'starterpro' ),
                        )
                    ),//general
                    'styling'   => array(
                        array(
                            'name'      => 'css_custom',
                            'type'      => 'css',
                            'options'   => array(
                                array(
                                    "screens" => "any,1024,999,767,479",
                                    'Title' => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.classic-slider-title'),
                                    ),
                                    'Subtitle'  => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.classic-slider-subtitle'),
                                    ),                               
                                    'Button' => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'color', 'label' => esc_html__('Hover Color', 'starterpro'), 'selector' => '.classic-slider-btn:hover'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Hover Color', 'starterpro'), 'selector' => '.classic-slider-btn:hover'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'border', 'label' => esc_html__('Border', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'starterpro'), 'selector' => '.classic-slider-btn:hover'),
                                        array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.classic-slider-btn'),
                                    ),
                                )
                            )
                        )
                    ),//styling
                )//params
            ),//classic_slider

            )//array
        ); // End add map
    } // End if
}

function themeum_classic_slider_shortcode( $atts, $content = null ){
    $extra_class = $output = $sliderpagination = $sliderautoplay = '';
    extract( shortcode_atts( array(
        'classic_slider_opt'    => '',
        'sliderpagination'      => 'true',
        'sliderautoplay'        => 'true',
        'extra_class'           => '',
    ), $atts ));

    

    $class_title = array( 'classic_slider' );

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-classic-slider';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }
    if( isset( $classic_slider_opt ) ){
        $output .= '<div id="classic-slider" data-pagi="'.esc_attr($sliderpagination).'" data-aplay="'.esc_attr($sliderautoplay).'" class="classic-slider owl-carousel owl-theme '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        foreach( $classic_slider_opt as $option ){

            $bg = $data_subtitle = $data_title = $data_btn = $wrap = $align = $borderstyle = '';

            $title_border = !empty($option->title_border) ? $option->title_border : '1';
            $title = !empty($option->title) ? $option->title : '';
            $slide_align = !empty($option->slide_align) ? $option->slide_align : 'left';
            $headline = !empty($option->headline) ? $option->headline : 'h2';
            $subtitle = !empty($option->subtitle) ? $option->subtitle : '';
            $border_width = !empty($option->border_width) ? $option->border_width : '';
            $border_height = !empty($option->border_height) ? $option->border_height : '';
            $border_position = !empty($option->border_position) ? $option->border_position : 'bottom';
            $border_bg = !empty($option->border_bg) ? $option->border_bg : '';
            $subheadline = !empty($option->subheadline) ? $option->subheadline : 'h3';
            $btnurl = !empty($option->btnurl) ? $option->btnurl : '';
            $btntext = !empty($option->btntext) ? $option->btntext : '';
            $bg_image = !empty($option->bg_image) ? $option->bg_image : '';
            $bg_color = !empty($option->bg_color) ? $option->bg_color : '';
            $slide_height = !empty($option->slide_height) ? $option->slide_height : '730px';
            $wrap_class = 'themeum-classic-slider-' . $title_border;
            //border layout
            if( $slide_align ){ 
                if( $slide_align == 'left' ){ $align = 'text-left'; }
                if( $slide_align == 'right' ){ $align = 'text-right'; }
                if( $slide_align == 'center' ){ $align = 'text-center'; }
            }else{
                $align = 'text-left';
            }

            if( $slide_align ){ 
                if( $slide_align == 'center' ){
                    if( $border_width ){
                        $mar = (int)esc_attr($border_width)/2;
                        $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{width:'.esc_attr($border_width).';margin-left: -'.$mar.'px;left:50%}';
                    }   
                } elseif ($slide_align == 'right') {
                    if( $border_width ){
                        $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{width:'.esc_attr($border_width).';left:auto;right: 0;}';
                    }
                } else {
                    if( $border_width ){
                        $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{width:'.esc_attr($border_width).';left: 0;}';
                    } 
                }
            } else {
                if( $border_width ){
                    $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{width:'.esc_attr($border_width).';left: 0;}';
                }
            }
            if( $border_bg ){
                $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{ background:'.$border_bg.';}';
            } 
            if( $border_height ){
                $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{height:'.$border_height.'; }';
            }    
            if( $border_position == 'top' ){
                $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{top:top:0px;bottom:auto; }';
            } else {
                $borderstyle .= '.themeum-classic-slider-1 .classic-slider-title:after{bottom:0px;top:auto; }';
            }

            //title  
            if ( !empty( $title ) ) {
                $data_title .= '<'.$headline.' class="classic-slider-title">'.wp_kses_post($title).'</'.$headline.'>';
            }  
            //subtitle          
            if ( !empty( $subtitle ) ) {
                $data_subtitle .= '<'.$subheadline.' class="classic-slider-subtitle">'.wp_kses_post($subtitle).'</'.$subheadline.'>';
            }
            if ($btnurl) {
                $data_btn = '<a href="'.esc_url($btnurl).'" class="classic-slider-btn">'.esc_attr($btntext).'</a>';
            }


            if ( $bg_image > 0 ) {
                $img = wp_get_attachment_image_src( $bg_image, 'full' );
                $bg = 'style="background: url('.esc_url( $img[0] ).');background-size: cover;background-position: 50% 50%;height:'.(int)$slide_height.'px;"';
            } else {
                $bg = 'style="background-color:'.esc_attr($bg_color).';height:'.(int)$slide_height.'px;"'; 
            }

            $output .= '<div class="item '.$wrap_class.'" '.$bg.'>';
                if ( $title_border == '1' ) {
                   $output .= '<style>'.$borderstyle.'</style>';
                }
                $output .= '<div class="classic-slider-content">';
                    $output .= '<div class="classic-slider-content-in">';
                        $output .= '<div class="container">';
                            $output .= '<div class="'.$align.'">';
                                $output .= $data_title;
                                $output .= $data_subtitle;
                                $output .= $data_btn;
                            $output .= '</div>';//container
                        $output .= '</div>';//container
                    $output .= '</div>';//classic-slider-content-in
                $output .= '</div>';//classic-slider-content
            $output .= '</div>';//item
        }
        $output .= '</div>';//classic-slider
    }

    return $output;

}
add_shortcode('classic_slider', 'themeum_classic_slider_shortcode');



