<?php
add_action('init', 'themeum_portfolio_slider', 99);

function themeum_portfolio_slider(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

            'portfolio_slider' => array(
                'name'        => 'Portfolio Slider',
                'description' => esc_html__('Add themeum classic slider', 'wptixon'),
                'icon'        => 'kc-icon-icarousel',
                'category'    => 'Tixon',
                'params'      => array(
                    
                    'general' => array(
 
                        array(
                            'type'          => 'group',
                            'label'         => esc_html__('Add slide', 'wptixon'),
                            'name'          => 'portfolio_slider_opt',
                            'description'   => esc_html__( 'Repeat this fields with each item created, Each item corresponding slide.', 'wptixon' ),
                            'options'       => array('add_text' => esc_html__('Add new slide', 'wptixon')),

                            'params' => array( 
                                array(
                                    'name'          => 'slide_align',
                                    'type'          => 'dropdown',
                                    'label'         => 'Slide align',
                                    'options'       => array(
                                        'left'     => esc_html__('Left', 'wptixon'),
                                        'center'   => esc_html__('Center', 'wptixon'),
                                        'right'    => esc_html__('Right', 'wptixon'),
                                      ),
                                    'value'         => 'left',
                                    'description'   => esc_html__('Select the slide align', 'wptixon'),

                                ),
                                //title
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Title', 'wptixon' ),
                                    'name' => 'title',
                                    'description' => esc_html__( 'Enter text used as title of the slide.', 'wptixon' ),
                                    'admin_label' => true,
                                ), 
                                array(
                                    'name'    => 'headline',
                                    'label'   => esc_html__('Title headline', 'wptixon'),
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
                                        'fadeIn'         => esc_html__('fadeIn', 'wptixon'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'wptixon'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'wptixon'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'wptixon'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'wptixon'),
                                        'flip'           => esc_html__('flip', 'wptixon'),
                                        'zoomIn'         => esc_html__('zoomIn', 'wptixon'),
                                        'slideInUp'      => esc_html__('slideInUp', 'wptixon'),
                                        'slideInDown'    => esc_html__('slideInDown', 'wptixon'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'wptixon'),
                                        'slideInRight'   => esc_html__('slideInRight', 'wptixon'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the title animation', 'wptixon'),

                                ),   
                                //subtitle                                                                                           
                                array(
                                    'type' => 'textarea',
                                    'label' => esc_html__( 'Sub Title', 'wptixon' ),
                                    'name' => 'subtitle',
                                    'description' => esc_html__( 'Enter text used as sub title of the slide.', 'wptixon' ),
                                    'admin_label' => false,
                                ),  
                                array(
                                    'name'    => 'subheadline',
                                    'label'   => esc_html__('Sub title headline', 'wptixon'),
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
                                        'fadeIn'         => esc_html__('fadeIn', 'wptixon'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'wptixon'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'wptixon'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'wptixon'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'wptixon'),
                                        'flip'           => esc_html__('flip', 'wptixon'),
                                        'zoomIn'         => esc_html__('zoomIn', 'wptixon'),
                                        'slideInUp'      => esc_html__('slideInUp', 'wptixon'),
                                        'slideInDown'    => esc_html__('slideInDown', 'wptixon'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'wptixon'),
                                        'slideInRight'   => esc_html__('slideInRight', 'wptixon'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the sub title animation', 'wptixon'),

                                ),  

                                //button                                                                
                                array(
                                    'type' => 'text',
                                    'label' => esc_html__( 'Button URL', 'wptixon' ),
                                    'name' => 'btnurl',
                                    'description' => esc_html__( 'Enter text used as button url of the slide.', 'wptixon' ),
                                    'admin_label' => false,
                                ),                                                               
                                array(
                                    'type' => 'text',
                                    'label' => esc_html__( 'Button Text', 'wptixon' ),
                                    'name' => 'btntext',
                                    'description' => esc_html__( 'Enter text used as button text of the slide.', 'wptixon' ),
                                    'admin_label' => false,
                                ), 
                                array(
                                    'name'               => 'button_animation',
                                    'type'               => 'dropdown',
                                    'label'              => 'Button Animation',
                                    'options'            => array(
                                        'fadeIn'         => esc_html__('fadeIn', 'wptixon'),
                                        'fadeInUp'       => esc_html__('fadeInUp', 'wptixon'),
                                        'fadeInDown'     => esc_html__('fadeInDown', 'wptixon'),
                                        'fadeInLeft'     => esc_html__('fadeInLeft', 'wptixon'),
                                        'fadeInRight'    => esc_html__('fadeInRight', 'wptixon'),
                                        'flip'           => esc_html__('flip', 'wptixon'),
                                        'zoomIn'         => esc_html__('zoomIn', 'wptixon'),
                                        'slideInUp'      => esc_html__('slideInUp', 'wptixon'),
                                        'slideInDown'    => esc_html__('slideInDown', 'wptixon'),
                                        'slideInLeft'    => esc_html__('slideInLeft', 'wptixon'),
                                        'slideInRight'   => esc_html__('slideInRight', 'wptixon'),
                                      ),
                                    'value'              => 'fadeIn',
                                    'description'        => esc_html__('Select the button animation', 'wptixon'),

                                ),                                 
                                array(
                                    'type'          => 'attach_image',
                                    'label'         => esc_html__( 'Background image', 'wptixon' ),
                                    'name'          => 'bg_image',
                                    'description'   => esc_html__( 'Upload image used as background of the slide.', 'wptixon' ),
                                    'admin_label'   => false,
                                    'value'         => '',
                                ),                                
                                array(
                                    'type' => 'color_picker',
                                    'label' => esc_html__( 'Background Color', 'wptixon' ),
                                    'name' => 'bg_color',
                                    'description' => esc_html__( 'Enter color used as background of the slide.', 'wptixon' ),
                                ),
                                array(
                                    'name'          => 'slide_height',
                                    'type'          => 'number_slider',
                                    'label'         => esc_html__('Slide Height', 'wptixon'),
                                    'options'       => array(
                                        'min'           => 300,
                                        'max'           => 900,
                                        'unit'          => 'px',
                                        'show_input'    => true
                                    ),
                                    'value'         => '570px',
                                    'description'   => esc_html__('Choose slide height', 'wptixon'),
                                ),  
                            ),
                        ),
                        array(
                            'name'    => 'sliderpaginav',
                            'label'   => esc_html__('Show Navigation', 'wptixon'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'wptixon'),  
                                'false'  => esc_html__('No', 'wptixon'),
                            ),
                            'value'         => 'true',
                        ),                          
                        array(
                            'name'    => 'sliderpagination',
                            'label'   => esc_html__('Show Pagination', 'wptixon'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'wptixon'),  
                                'false'  => esc_html__('No', 'wptixon'),
                            ),
                            'value'         => 'false',
                        ),                         
                        array(
                            'name'    => 'sliderautoplay',
                            'label'   => esc_html__('Auto play', 'wptixon'),
                            'type'    => 'select',
                            'options' => array(
                                'true'  => esc_html__('Yes', 'wptixon'),  
                                'false'  => esc_html__('No', 'wptixon'),
                            ),
                            'value'         => 'true',
                        ),

                        array(
                            'type'          => 'text',
                            'label'         => esc_html__( 'Wrapper class name', 'wptixon' ),
                            'name'          => 'extra_class',
                            'description'   => esc_html__( 'Custom class for wrapper of the shortcode', 'wptixon' ),
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
                                        array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-slider-title'),
                                    ),
                                    'Subtitle'  => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-slider-subtitle'),
                                    ),                                                                   
                                    'Button' => array(
                                        array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'color', 'label' => esc_html__('Hover Color', 'wptixon'), 'selector' => '.portfolio-slider-btn:hover'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Color', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'background-color', 'label' => esc_html__('BG Hover Color', 'wptixon'), 'selector' => '.portfolio-slider-btn:hover'),
                                        array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'wptixon'), 'selector' => '.portfolio-slider-btn:hover'),
                                        array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-slider-btn'),
                                    ),
                                    'Box' => array(
                                        array('property' => 'background-color', 'label' => esc_html__('Background Color', 'wptixon'), 'selector' => '.portfolio-slider-content-in .container >div'),
                                        array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'wptixon'), 'selector' => '.portfolio-slider-content-in .container:hover >div'),
                                        array('property' => 'color', 'label' => esc_html__('Content Color', 'wptixon'), 'selector' => '.portfolio-slider-content-in .container >div'),
                                        array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-slider-content-in .container >div'),
                                        array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-slider-content-in .container >div'),
                                    ),
                                )
                            )
                        )
                    ),//styling
                )//params
            ),//portfolio_slider

            )//array
        ); // End add map
    } // End if
}

function themeum_portfolio_slider_shortcode( $atts, $content = null ){
    $extra_class = $output = $sliderpagination = $sliderautoplay = $sliderpaginav = '';
    extract( shortcode_atts( array(
        'portfolio_slider_opt'    => '',
        'sliderpagination'      => 'false',
        'sliderautoplay'        => 'true',
        'sliderpaginav'        => 'true',
        'extra_class'           => '',
    ), $atts ));

    

    $class_title = array( 'portfolio_slider' );

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-portfolio-slider';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }    

    if( isset( $portfolio_slider_opt ) ){
        $output .= '<div id="portfolio-slider" data-nav="'.esc_attr($sliderpaginav).'" data-pagi="'.esc_attr($sliderpagination).'" data-aplay="'.esc_attr($sliderautoplay).'" class="portfolio-slider owl-carousel owl-theme '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        foreach( $portfolio_slider_opt as $option ){

            $bg = $data_subtitle = $data_title = $title_animation = $data_btn = $wrap = $align = $data_intro = '';

            $title = !empty($option->title) ? $option->title : '';
            $slide_align = !empty($option->slide_align) ? $option->slide_align : 'left';
            $headline = !empty($option->headline) ? $option->headline : 'h2';
            $title_animation = !empty($option->title_animation) ? $option->title_animation : 'fadeIn';
            $slide_align = !empty($option->slide_align) ? $option->slide_align : 'left';
            $subtitle = !empty($option->subtitle) ? $option->subtitle : '';
            $subheadline = !empty($option->subheadline) ? $option->subheadline : 'h3';
            $subtitle_animation = !empty($option->subtitle_animation) ? $option->subtitle_animation : 'fadeIn';
            $btnurl = !empty($option->btnurl) ? $option->btnurl : '';
            $btntext = !empty($option->btntext) ? $option->btntext : '';
            $button_animation = !empty($option->button_animation) ? $option->button_animation : 'fadeIn';
            $bg_image = !empty($option->bg_image) ? $option->bg_image : '';
            $bg_color = !empty($option->bg_color) ? $option->bg_color : '';
            $slide_height = !empty($option->slide_height) ? $option->slide_height : '730px';
            $wrap_class = 'themeum-portfolio-slider';

            if( $slide_align ){ 
                if( $slide_align == 'left' ){ $align = 'text-left'; }
                if( $slide_align == 'right' ){ $align = 'text-right'; }
                if( $slide_align == 'center' ){ $align = 'text-center'; }
            }else{
                $align = 'text-left';
            }

            //title  
            if ( !empty( $title ) ) {
                $data_title .= '<'.$headline.' class="portfolio-slider-title '.$title_animation.'">'.wp_kses_post($title).'</'.$headline.'>';
            }  
            //subtitle          
            if ( !empty( $subtitle ) ) {
                $data_subtitle .= '<'.$subheadline.' class="portfolio-slider-subtitle '.$subtitle_animation.'">'.wp_kses_post($subtitle).'</'.$subheadline.'>';
            }            
            if ($btnurl) {
                $data_btn = '<a href="'.esc_url($btnurl).'" class="portfolio-slider-btn '.$button_animation.'">'.esc_attr($btntext).'</a>';
            }

            if ( $bg_image > 0 ) {
                $img = wp_get_attachment_image_src( $bg_image, 'full' );
                $bg = 'style="background: url('.esc_url( $img[0] ).');background-size: cover;background-position: 50% 50%;height:'.(int)$slide_height.'px;"';
            } else {
                $bg = 'style="background-color:'.esc_attr($bg_color).';height:'.(int)$slide_height.'px;"'; 
            }

            $output .= '<div class="item '.$wrap_class.'" '.$bg.'>';
                $output .= '<div class="portfolio-slider-content">';
                    $output .= '<div class="portfolio-slider-content-in">';
                        $output .= '<div class="container">';
                            $output .= '<div class="'.$align.'">';
                                $output .= $data_title;
                                $output .= $data_subtitle;
                                $output .= $data_btn;
                            $output .= '</div>';//container
                        $output .= '</div>';//container
                    $output .= '</div>';//portfolio-slider-content-in
                $output .= '</div>';//portfolio-slider-content
            $output .= '</div>';//item
        }
        $output .= '</div>';//portfolio-slider
    }

    return $output;

}
add_shortcode('portfolio_slider', 'themeum_portfolio_slider_shortcode');



