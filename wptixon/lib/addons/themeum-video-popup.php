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
                'description' => esc_html__('Add Video Popup', 'wptixon'),
                'icon'        => 'sl-control-play',
                'category'    => 'Tixon',
                'params'        => array(
                'general'   => array(     
                    array(
                        'type'          => 'text',
                        'name'          => 'video_url',
                        'label'         => esc_html__( 'Video URL:', 'wptixon' ),
                        'description'   => esc_html__( 'Youtube/Vimo video URL', 'wptixon' ),
                        'admin_label'   => true,
                    ),             
                    array(
                        'name'  => 'video_image',
                        'label' => esc_html__( 'Person Image', 'wptixon' ),
                        'type'  => 'attach_image'
                    ), 
                    array(
                        'name'          => 'text_align',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Title wrap align', 'wptixon'),
                        'options'       => array(
                                        'left'     => esc_html__('Left', 'wptixon'),
                                        'center'   => esc_html__('Center', 'wptixon'),
                                        'right'    => esc_html__('Right', 'wptixon'),
                                        ),
                        'value'         => 'center',
                    ),                                                                             
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'wptixon' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'wptixon' ),
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
                                    array('property' => 'width', 'label' => esc_html__('Width', 'wptixon'), 'selector' => '.video-popup-in'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'wptixon'), 'selector' => '.video-popup-in'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'wptixon'), 'selector' => '.video-popup-in'),
                                    array('property' => 'border', 'label' => esc_html__('Border Hover', 'wptixon'), 'selector' => '.video-popup-in'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.video-popup-in'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.video-popup-in'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.video-popup-in'),
                                ),  
                                'Popup Icon'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'wptixon'), 'selector' => '.video-popup-icon:hover'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line height', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'width', 'label' => esc_html__('Width', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Border Hover', 'wptixon'), 'selector' => '.video-popup-icon:hover'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.video-popup-icon'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'wptixon'), 'selector' => '.video-popup-icon'),
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
    $output = $video_image = $image_style = $video_url = $align = '';
    extract( shortcode_atts( array(
        'video_image'           => '',
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
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('themeum_video_popup', 'themeum_shortcode_video_popup_function');

