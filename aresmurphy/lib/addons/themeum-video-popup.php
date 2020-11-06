<?php
add_action('init', 'themeum_video_popup_function', 99);

function themeum_video_popup_function(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_video_popup' => array(
                'name'        => 'Video Popup',
                'description' => esc_html__('Add Video Popup', 'aresmurphy'),
                'icon'        => 'sl-control-play',
                'category'    => 'Ares Murphy',
                'params'        => array(
                'general'   => array(     
                    array(
                        'type'          => 'text',
                        'name'          => 'video_url',
                        'label'         => esc_html__( 'Video URL:', 'aresmurphy' ),
                        'description'   => esc_html__( 'Youtube/Vimo video URL', 'aresmurphy' ),
                        'admin_label'   => true,
                    ),             
                    array(
                        'name'  => 'video_image',
                        'label' => esc_html__( 'Person Image', 'aresmurphy' ),
                        'type'  => 'attach_image'
                    ), 
                    array(
                        'name'          => 'text_align',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Title wrap align', 'aresmurphy'),
                        'options'       => array(
                                        'left'     => esc_html__('Left', 'aresmurphy'),
                                        'center'   => esc_html__('Center', 'aresmurphy'),
                                        'right'    => esc_html__('Right', 'aresmurphy'),
                                        ),
                        'value'         => 'center',
                    ), 
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Title 1', 'aresmurphy' ),
                        'name'          => 'title_1',
                        'description'   => esc_html__( 'Add Title 1', 'aresmurphy' ),
                    ),                    
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Title 2', 'aresmurphy' ),
                        'name'          => 'title_2',
                        'description'   => esc_html__( 'Add Title 2', 'aresmurphy' ),
                    ),                     
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Title 3', 'aresmurphy' ),
                        'name'          => 'title_3',
                        'description'   => esc_html__( 'Add Title 3', 'aresmurphy' ),
                    ),                     
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Title 4', 'aresmurphy' ),
                        'name'          => 'title_4',
                        'description'   => esc_html__( 'Add Title 4', 'aresmurphy' ),
                    ),                                                                          
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'aresmurphy' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'aresmurphy' ),
                    )
                ),
                'styling'   => array(
                    array(
                        'name'      => 'css_custom',
                        'type'      => 'css',
                        'options'   => array(
                            array(
                                "screens" => "any,1024,999,767,479",
                                'Popup Image'  => array(
                                    array('property' => 'width', 'label' => esc_html__('Width', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                    array('property' => 'border', 'label' => esc_html__('Border Hover', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.video-popup-in'),
                                ),  
                                'Popup Icon'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'aresmurphy'), 'selector' => '.video-popup-icon:hover'),
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'aresmurphy'), 'selector' => '.video-popup-icon:hover'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line height', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'width', 'label' => esc_html__('Width', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Border Hover', 'aresmurphy'), 'selector' => '.video-popup-icon:hover'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'aresmurphy'), 'selector' => '.video-popup-icon'),
                                ), 
                                'Title'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Title 1 Color', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'background-color', 'label' => esc_html__('Title 1 Background Color', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'font-size', 'label' => esc_html__('Title 1 Font Size', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'line-height', 'label' => esc_html__('Title 1 Line height', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Title 1 Font weight', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'margin', 'label' => esc_html__('Title 1 Margin', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'padding', 'label' => esc_html__('Title 1 Padding', 'aresmurphy'), 'selector' => '.video-title1'),
                                    array('property' => 'color', 'label' => esc_html__('Title 2 Color', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'background-color', 'label' => esc_html__('Title 2 Background Color', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'font-size', 'label' => esc_html__('Title 2 Font Size', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'line-height', 'label' => esc_html__('Title 2 Line height', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Title 2 Font weight', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'margin', 'label' => esc_html__('Title 2 Margin', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'padding', 'label' => esc_html__('Title 2 Padding', 'aresmurphy'), 'selector' => '.video-title2'),
                                    array('property' => 'color', 'label' => esc_html__('Title 3 Color', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'background-color', 'label' => esc_html__('Title 3 Background Color', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'font-size', 'label' => esc_html__('Title 3 Font Size', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'line-height', 'label' => esc_html__('Title 3 Line height', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Title 3 Font weight', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'margin', 'label' => esc_html__('Title 3 Margin', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'padding', 'label' => esc_html__('Title 3 Padding', 'aresmurphy'), 'selector' => '.video-title3'),
                                    array('property' => 'color', 'label' => esc_html__('Title 4 Color', 'aresmurphy'), 'selector' => '.video-title4'),
                                    array('property' => 'background-color', 'label' => esc_html__('Title 4 Background Color', 'aresmurphy'), 'selector' => '.video-title4'),
                                    array('property' => 'font-size', 'label' => esc_html__('Title 4 Font Size', 'aresmurphy'), 'selector' => '.video-title4'),
                                    array('property' => 'line-height', 'label' => esc_html__('Title 4 Line height', 'aresmurphy'), 'selector' => '.video-title4'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Title 4 Font weight', 'aresmurphy'), 'selector' => '.video-title4'),
                                    array('property' => 'margin', 'label' => esc_html__('Title 4 Margin', 'aresmurphy'), 'selector' => '.video-title4'),
                                    array('property' => 'padding', 'label' => esc_html__('Title 4 Padding', 'aresmurphy'), 'selector' => '.video-title4'),                  
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'aresmurphy'), 'selector' => '.video-title1,.video-title2,.video-title3,.video-title4'),
                                ),                             
                            )
                        )
                    )
                ),
                'animate' => array(
                    array(
                        'name'    => 'animate',
                        'type'    => 'animate'
                    )
                ),

                )//params
            ),//themeum_video_popup

            )//array
        ); // End add map

    } // End if
}

// Register Hover Shortcode
function themeum_shortcode_video_popup_function($atts, $content = null){
    $output = $video_image = $image_style = $video_url = $align = $title_1 = $title_2 = $title_3 = $title_4 = '';
    extract( shortcode_atts( array(
        'video_image'           => '',
        'title_1'               => '',
        'title_2'               => '',
        'title_3'               => '',
        'title_4'               => '',
        'image_sign'            => '',
        'text_align'            => 'center',
        'video_url'            => '',
        'extra_class'           => ''
    ), $atts ));

    $wrap_class  = apply_filters( 'kc-el-class', $atts );
    $wrap_class[] = 'themeum-video-popup-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

    if( $text_align ){ 
        if( $text_align == 'left' ){ $align = 'text-left'; }
        if( $text_align == 'right' ){ $align = 'text-right'; }
        if( $text_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-center';
    }

    if ( $video_image > 0 ) {
        $img_link = wp_get_attachment_image_src( $video_image, 'full' );
        $img_link = $img_link[0];
        $image_style = 'style = "background: url('.esc_url($img_link).') no-repeat;background-size:cover;"';
    }

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="video-container '.$align.'">';
            $output .= '<div class="video-popup-in" '.$image_style.'>';
                $output .= '<div class="video-popup-middle">';
                    $output .= '<div class="video-popup-middle-in">';
                        $output .= '<a href="'. esc_url($video_url) .'" class="video-popup-icon" style="display:inline-block"><i class="sl-control-play" style="margin-left:10px"></i></a>';
                    $output .= '</div>';
                $output .= '</div>';
                if ($title_1) {
                    $output .= '<h3 class="video-title1">'.wp_kses_post($title_1).'</h3>';
                }
                if ($title_2) {
                    $output .= '<h3 class="video-title2">'.wp_kses_post($title_2).'</h3>';
                }
                if ($title_3) {
                    $output .= '<h3 class="video-title3">'.wp_kses_post($title_3).'</h3>';
                }
                if ($title_4) {
                    $output .= '<h3 class="video-title4">'.wp_kses_post($title_4).'</h3>';
                }
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('themeum_video_popup', 'themeum_shortcode_video_popup_function');

