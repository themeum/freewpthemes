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
                'description' => esc_html__('Add themeum classic slider', 'aresmurphy'),
                'icon'        => 'kc-icon-icarousel',
                'category'    => 'Ares Murphy',
                'params'      => array(
                    
                    'general' => array(
                        array(
                            'type'          => 'radio_image',
                            'label'         => __( 'Select layout', 'aresmurphy' ),
                            'name'          => 'layout',
                            'admin_label'   => true,
                            'options'       => array(
                                '1' => get_template_directory_uri()  . '/lib/addons/image/testimonial/1.png',
                                '2' => get_template_directory_uri()  . '/lib/addons/image/testimonial/3.png',
                                '3' => get_template_directory_uri()  . '/lib/addons/image/testimonial/2.png',
                                '4' => get_template_directory_uri()  . '/lib/addons/image/testimonial/4.png',
                                '5' => get_template_directory_uri()  . '/lib/addons/image/testimonial/2.png',
                            ),
                            'value'         => '1'
                        ),  
                        array(
                            'type'          => 'group',
                            'label'         => esc_html__('Add slide', 'aresmurphy'),
                            'name'          => 'classic_slider_opt',
                            'description'   => esc_html__( 'Repeat this fields with each item created, Each item corresponding slide.', 'aresmurphy' ),
                            'options'       => array('add_text' => esc_html__('Add new slide', 'aresmurphy')),

                            'params' => array( 
                                array(
                                    'name'          => 'slide_align',
                                    'type'          => 'dropdown',
                                    'label'         => 'Slide align',
                                    'options'       => array(
                                        'left'     => esc_html__('Left', 'aresmurphy'),
                                        'center'   => esc_html__('Center', 'aresmurphy'),
                                        'right'    => esc_html__('Right', 'aresmurphy'),
                                      ),
                                    'value'         => 'left',
                                    'description'   => esc_html__('Select the slide align', 'aresmurphy'),

                                ),
                                //title
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Title', 'aresmurphy' ),
                                    'name' => 'title',
                                    'description' => esc_html__( 'Enter text used as title of the slide.', 'aresmurphy' ),
                                    'admin_label' => true,
                                ), 
                                array(
                                    'name'    => 'headline',
                                    'label'   => esc_html__('Title headline', 'aresmurphy'),
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
                                    'name'               => 'title_animation',
                                    'type'               => 'dropdown',
                                    'label'              => 'Title Animation',
                                    'options'            => array(
                                        'fadeIn'         => esc_html__('fadeIn', 'aresmurphy'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'aresmurphy'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'aresmurphy'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'aresmurphy'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'aresmurphy'),
                                        'flip'           => esc_html__('flip', 'aresmurphy'),
                                        'zoomIn'         => esc_html__('zoomIn', 'aresmurphy'),
                                        'slideInUp'      => esc_html__('slideInUp', 'aresmurphy'),
                                        'slideInDown'    => esc_html__('slideInDown', 'aresmurphy'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'aresmurphy'),
                                        'slideInRight'   => esc_html__('slideInRight', 'aresmurphy'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the title animation', 'aresmurphy'),

                                ),   
                                //subtitle                                                                                           
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Sub Title', 'aresmurphy' ),
                                    'name' => 'subtitle',
                                    'description' => esc_html__( 'Enter text used as sub title of the slide.', 'aresmurphy' ),
                                    'admin_label' => false,
                                ),  
                                array(
                                    'name'    => 'subheadline',
                                    'label'   => esc_html__('Sub title headline', 'aresmurphy'),
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
                                    'name'               => 'subtitle_animation',
                                    'type'               => 'dropdown',
                                    'label'              => 'Sub Title Animation',
                                    'options'            => array(
                                        'fadeIn'         => esc_html__('fadeIn', 'aresmurphy'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'aresmurphy'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'aresmurphy'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'aresmurphy'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'aresmurphy'),
                                        'flip'           => esc_html__('flip', 'aresmurphy'),
                                        'zoomIn'         => esc_html__('zoomIn', 'aresmurphy'),
                                        'slideInUp'      => esc_html__('slideInUp', 'aresmurphy'),
                                        'slideInDown'    => esc_html__('slideInDown', 'aresmurphy'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'aresmurphy'),
                                        'slideInRight'   => esc_html__('slideInRight', 'aresmurphy'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the sub title animation', 'aresmurphy'),

                                ),  
                                //subtitle                                                                                           
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Intro Text', 'aresmurphy' ),
                                    'name' => 'introtext',
                                    'description' => esc_html__( 'Enter text used as sub title of the slide.', 'aresmurphy' ),
                                    'admin_label' => false,
                                ),  
                                array(
                                    'name'               => 'intro_animation',
                                    'type'               => 'dropdown',
                                    'label'              => 'Intro Text Animation',
                                    'options'            => array(
                                        'fadeIn'         => esc_html__('fadeIn', 'aresmurphy'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'aresmurphy'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'aresmurphy'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'aresmurphy'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'aresmurphy'),
                                        'flip'           => esc_html__('flip', 'aresmurphy'),
                                        'zoomIn'         => esc_html__('zoomIn', 'aresmurphy'),
                                        'slideInUp'      => esc_html__('slideInUp', 'aresmurphy'),
                                        'slideInDown'    => esc_html__('slideInDown', 'aresmurphy'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'aresmurphy'),
                                        'slideInRight'   => esc_html__('slideInRight', 'aresmurphy'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the intro text animation', 'aresmurphy'),

                                ), 
                                //button                                                                
                                array(
                                    'type' => 'text',
                                    'label' => esc_html__( 'Button URL', 'aresmurphy' ),
                                    'name' => 'btnurl',
                                    'description' => esc_html__( 'Enter text used as button url of the slide.', 'aresmurphy' ),
                                    'admin_label' => false,
                                ),                                                               
                                array(
                                    'type' => 'text',
                                    'label' => esc_html__( 'Button Text', 'aresmurphy' ),
                                    'name' => 'btntext',
                                    'description' => esc_html__( 'Enter text used as button text of the slide.', 'aresmurphy' ),
                                    'admin_label' => false,
                                ), 
                                array(
                                    'name'               => 'button_animation',
                                    'type'               => 'dropdown',
                                    'label'              => 'Button Animation',
                                    'options'            => array(
                                        'fadeIn'         => esc_html__('fadeIn', 'aresmurphy'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'aresmurphy'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'aresmurphy'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'aresmurphy'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'aresmurphy'),
                                        'flip'           => esc_html__('flip', 'aresmurphy'),
                                        'zoomIn'         => esc_html__('zoomIn', 'aresmurphy'),
                                        'slideInUp'      => esc_html__('slideInUp', 'aresmurphy'),
                                        'slideInDown'    => esc_html__('slideInDown', 'aresmurphy'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'aresmurphy'),
                                        'slideInRight'   => esc_html__('slideInRight', 'aresmurphy'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the button animation', 'aresmurphy'),

                                ),                                 
                                array(
                                    'type'          => 'attach_image',
                                    'label'         => esc_html__( 'Background image', 'aresmurphy' ),
                                    'name'          => 'bg_image',
                                    'description'   => esc_html__( 'Upload image used as background of the slide.', 'aresmurphy' ),
                                    'admin_label'   => false,
                                    'value'         => '',
                                ),                                
                                array(
                                    'type' => 'color_picker',
                                    'label' => esc_html__( 'Background Color', 'aresmurphy' ),
                                    'name' => 'bg_color',
                                    'description' => esc_html__( 'Enter color used as background of the slide.', 'aresmurphy' ),
                                ),
                                array(
                                    'name'          => 'slide_height',
                                    'type'          => 'number_slider',
                                    'label'         => esc_html__('Slide Height', 'aresmurphy'),
                                    'options'       => array(
                                        'min'           => 300,
                                        'max'           => 900,
                                        'unit'          => 'px',
                                        'show_input'    => true
                                    ),
                                    'value'         => '570px',
                                    'description'   => esc_html__('Choose slide height', 'aresmurphy'),
                                ),  
                            ),
                        ),
                        array(
                            'name'    => 'sliderpaginav',
                            'label'   => esc_html__('Show Navigation', 'aresmurphy'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'aresmurphy'),  
                                'false'  => esc_html__('No', 'aresmurphy'),
                            ),
                            'value'         => 'true',
                        ),                          
                        array(
                            'name'    => 'sliderpagination',
                            'label'   => esc_html__('Show Pagination', 'aresmurphy'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'aresmurphy'),  
                                'false'  => esc_html__('No', 'aresmurphy'),
                            ),
                            'value'         => 'false',
                        ),                         
                        array(
                            'name'    => 'sliderautoplay',
                            'label'   => esc_html__('Auto play', 'aresmurphy'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'aresmurphy'),  
                                'false'  => esc_html__('No', 'aresmurphy'),
                            ),
                            'value'         => 'true',
                        ),

                        array(
                            'type'          => 'text',
                            'label'         => esc_html__( 'Wrapper class name', 'aresmurphy' ),
                            'name'          => 'extra_class',
                            'description'   => esc_html__( 'Custom class for wrapper of the shortcode', 'aresmurphy' ),
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
                                        array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.classic-slider-title'),
                                    ),
                                    'Subtitle'  => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.classic-slider-subtitle'),
                                    ),                                     
                                    'Intro text'  => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.classic-slider-introtext'),
                                    ),                               
                                    'Button' => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'color', 'label' => esc_html__('Hover Color', 'aresmurphy'), 'selector' => '.classic-slider-btn:hover'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Hover Color', 'aresmurphy'), 'selector' => '.classic-slider-btn:hover'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'border', 'label' => esc_html__('Border', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'aresmurphy'), 'selector' => '.classic-slider-btn:hover'),
                                        array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.classic-slider-btn'),
                                    ),
                                    'Box' => array(
                                        array('property' => 'background-color', 'label' => esc_html__('Background Color', 'aresmurphy'), 'selector' => '.classic-slider-content-in .container >div'),
                                        array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'aresmurphy'), 'selector' => '.classic-slider-content-in .container:hover >div'),
                                        array('property' => 'color', 'label' => esc_html__('Content Color', 'aresmurphy'), 'selector' => '.classic-slider-content-in .container >div'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.classic-slider-content-in .container >div'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.classic-slider-content-in .container >div'),
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
    $extra_class = $output = $sliderpagination = $sliderautoplay = $sliderpaginav = $layout = '';
    extract( shortcode_atts( array(
        'layout'                => '1',
        'classic_slider_opt'    => '',
        'sliderpagination'      => 'false',
        'sliderautoplay'        => 'true',
        'sliderpaginav'        => 'true',
        'extra_class'           => '',
    ), $atts ));

    

    $class_title = array( 'classic_slider' );

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-classic-slider';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }    
    if ( !empty( $layout ) ) {
        $wrap_class[] = esc_attr('layout'.$layout);
    }

    if( isset( $classic_slider_opt ) ){
        $output .= '<div id="classic-slider" data-nav="'.esc_attr($sliderpaginav).'" data-pagi="'.esc_attr($sliderpagination).'" data-aplay="'.esc_attr($sliderautoplay).'" class="classic-slider owl-carousel owl-theme '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        foreach( $classic_slider_opt as $option ){

            $bg = $data_subtitle = $data_title = $title_animation = $data_btn = $wrap = $align = $data_intro = '';

            $title = !empty($option->title) ? $option->title : '';
            $slide_align = !empty($option->slide_align) ? $option->slide_align : 'left';
            $headline = !empty($option->headline) ? $option->headline : 'h2';
            $title_animation = !empty($option->title_animation) ? $option->title_animation : 'fadeIn';
            $slide_align = !empty($option->slide_align) ? $option->slide_align : 'left';
            $subtitle = !empty($option->subtitle) ? $option->subtitle : '';
            $subheadline = !empty($option->subheadline) ? $option->subheadline : 'h3';
            $subtitle_animation = !empty($option->subtitle_animation) ? $option->subtitle_animation : 'fadeIn';
            $introtext = !empty($option->introtext) ? $option->introtext : '';
            $intro_animation = !empty($option->intro_animation) ? $option->intro_animation : 'fadeIn';
            $btnurl = !empty($option->btnurl) ? $option->btnurl : '';
            $btntext = !empty($option->btntext) ? $option->btntext : '';
            $button_animation = !empty($option->button_animation) ? $option->button_animation : 'fadeIn';
            $bg_image = !empty($option->bg_image) ? $option->bg_image : '';
            $bg_color = !empty($option->bg_color) ? $option->bg_color : '';
            $slide_height = !empty($option->slide_height) ? $option->slide_height : '730px';
            $wrap_class = 'themeum-classic-slider';

            if( $slide_align ){ 
                if( $slide_align == 'left' ){ $align = 'text-left'; }
                if( $slide_align == 'right' ){ $align = 'text-right'; }
                if( $slide_align == 'center' ){ $align = 'text-center'; }
            }else{
                $align = 'text-left';
            }

            //title  
            if ( !empty( $title ) ) {
                $data_title .= '<'.$headline.' class="classic-slider-title '.$title_animation.'">'.wp_kses_post($title).'</'.$headline.'>';
            }  
            //subtitle          
            if ( !empty( $subtitle ) ) {
                $data_subtitle .= '<'.$subheadline.' class="classic-slider-subtitle '.$subtitle_animation.'">'.wp_kses_post($subtitle).'</'.$subheadline.'>';
            }            
            //introtext          
            if ( !empty( $introtext ) ) {
                $data_intro .= '<div class="classic-slider-introtext '.$intro_animation.'">'.wp_kses_post($introtext).'</div>';
            }
            if ($btnurl) {
                $data_btn = '<a href="'.esc_url($btnurl).'" class="classic-slider-btn '.$button_animation.'">'.esc_attr($btntext).'</a>';
            }

            if ( $bg_image > 0 ) {
                $img = wp_get_attachment_image_src( $bg_image, 'full' );
                $bg = 'style="background: url('.esc_url( $img[0] ).');background-size: cover;background-position: 50% 50%;height:'.(int)$slide_height.'px;"';
            } else {
                $bg = 'style="background-color:'.esc_attr($bg_color).';height:'.(int)$slide_height.'px;"'; 
            }

            $output .= '<div class="item '.$wrap_class.'" '.$bg.'>';
                $output .= '<div class="classic-slider-content">';
                    $output .= '<div class="classic-slider-content-in">';
                        $output .= '<div class="container">';
                            $output .= '<div class="'.$align.'">';
                                $output .= $data_title;
                                $output .= $data_subtitle;
                                $output .= $data_intro;
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



