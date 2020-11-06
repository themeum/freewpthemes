<?php
add_action('init', 'themeum_team_carousel', 99);

function themeum_team_carousel(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_team' => array(
                'name'        => 'Themeum team',
                'description' => esc_html__('Add themeum team', 'wptixon'),
                'icon'        => 'fa-user',
                'category'    => 'Tixon',
                'params'        => array(

                'general'   => array(
                    array(
                        'type'          => 'radio_image',
                        'label'         => esc_html__( 'Select layout', 'wptixon' ),
                        'name'          => 'layout',
                        'admin_label'   => true,
                        'options'       => array(
                            '1' => get_template_directory_uri()  . '/lib/addons/image/team/1.png',
                            '2' => get_template_directory_uri()  . '/lib/addons/image/team/2.png',
                            '3' => get_template_directory_uri()  . '/lib/addons/image/team/4.png',
                            '4' => get_template_directory_uri()  . '/lib/addons/image/team/3.png',
                        ),
                        'value'         => '1'
                    ),                    
                    array(
                        'name'  => 'image',
                        'label' => esc_html__( 'Team Image', 'wptixon' ),
                        'type'  => 'attach_image'
                    ),
                    array(
                        'type'          => 'text',
                        'name'          => 'title',
                        'label'         => esc_html__( 'Name', 'wptixon' ),
                        'value'         => 'Your Name',
                        'admin_label'   => true
                    ),
                    array(
                        'name'    => 'headline',
                        'label'   => esc_html__('Type', 'wptixon'),
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
                        'name'      => 'button_link',
                        'label'     => esc_html__( 'Link Button', 'wptixon' ),
                        'type'      => 'text',
                        'value'     => '',
                    ),
                    array(
                        'name'      => 'subtitle',
                        'label'     => esc_html__( 'Subtitle', 'wptixon' ),
                        'type'      => 'text',
                        'value'     => 'Manager'
                    ),
                    array(
                        'type'  => 'textarea',
                        'name'  => 'desc',
                        'label' => esc_html__( 'Description', 'wptixon' ),
                        'value' => '',
                    ), 
                    array(
                        'name'          => 'text_align',
                        'type'          => 'dropdown',
                        'label'         => esc_html__( 'Text Align', 'wptixon' ),
                        'description'   => esc_html__( 'Select the Text Align', 'wptixon' ),
                        'options'       => array(
                                            'left'      => 'Left',
                                            'center'    => 'Center',
                                            'right'     => 'Right',
                                        ),
                        'value'         => 'left',
                    ),                                        
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'wptixon' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'wptixon' )
                    )
                ),
                'socials'   => array(
                    array(
                        'name'          => 'facebook',
                        'label'         => esc_html__( 'Facebook Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link facebook. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'twitter',
                        'label'         => esc_html__( 'Twitter Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link twitter. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'google_plus',
                        'label'         => esc_html__( 'Google Plus Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '#',
                        'description'   => esc_html__( 'Insert link google plus. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'linkedin',
                        'label'         => esc_html__( 'Linkedin Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link linkedin. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'pinterest',
                        'label'         => esc_html__( 'Pinterest Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link pinterest. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'flickr',
                        'label'         => esc_html__( 'Flickr Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link flickr. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'instagram',
                        'label'         => esc_html__( 'Instagram Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link instagram. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'dribbble',
                        'label'         => esc_html__( 'Dribbble Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link dribbble. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'reddit',
                        'label'         => esc_html__( 'Reddit Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link reddit. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                    array(
                        'name'          => 'email',
                        'label'         => esc_html__( 'Email Link', 'wptixon' ),
                        'type'          => 'text',
                        'value'         => '',
                        'description'   => esc_html__( 'Insert link email. It hidden when field blank.', 'wptixon' ),
                        'relation'      => array(
                            'parent'    => 'show_icon',
                            'show_when' => 'yes'
                        )
                    ),
                ),
                'styling'   => array(
                    array(
                        'name'      => 'css_custom',
                        'type'      => 'css',
                        'options'   => array(
                            array(
                                "screens" => "any,1024,999,767,479",
                                'Title' => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.team-content-title,.team-content-title a'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'wptixon'), 'selector' => '.team-content-title a:hover'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.team-content-title'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.team-content-title'),
                                ),
                                'Subtitle'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.team-content-subtitle'),
                                ),
                                'Image' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'wptixon'), 'selector' => '.team-content-image img,.team-content-image'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'selector' => '.team-content-image img,.team-content-image'),
                                    array('property' => 'border-radius', 'label' => 'Border Radius', 'selector' => '.team-content-image img,.team-content-image'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.team-content-image img,.team-content-image'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.team-content-image img,.team-content-image'),
                                ),
                                'Desc'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.team-content-desc'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.team-content-desc'),
                                ),                                
                                'Social'    => array(
                                    array('property' => 'color', 'label' => esc_html__('Icon Color', 'wptixon'), 'selector' => '.team-content-socials a i'),
                                    array('property' => 'color', 'label' => esc_html__('Icon Hover Color', 'wptixon'), 'selector' => '.team-content-socials a:hover i'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.team-content-socials a'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.team-content-socials a'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.team-content-socials a'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.team-content-socials a'),
                                ),
                                'Box' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'wptixon'), 'selector' => '.team-content4'),
                                    array('property' => 'background-color', 'label' => esc_html__('Background Hover Color', 'wptixon'), 'selector' => '.themeum_team:hover .team-content4'),
                                    array('property' => 'color', 'label' => esc_html__('Content Hover Color', 'wptixon'), 'selector' => '.themeum_team:hover .team-content-title a,.themeum_team:hover .team-content-title,.themeum_team:hover .team-content-subtitle,.themeum_team:hover .team-content-desc,'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.team-content4'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.team-content4'),
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
            ),//themeum_team

            )//array
        ); // End add map

    } // End if
}

// Register Hover Shortcode
function themeum_team_data_shortcodes($atts, $content = null){
    $output = $image = $data_img = $headline = $extra_class = $align = $title_style = $style = $subtitle =  $data_socials = $data_title = $button_link = $data_subtitle = $desc =$data_desc = $text_align = $align = '';$layout = 1;
    extract( shortcode_atts( array(
        'layout'                => '1',
        'image'                 => '',
        'title'                 => '',
        'subtitle'              => '',
        'button_link'           => '',
        'headline'              => 'h3',
        'text_align'            => 'center',
        'desc'                  => '',
        'facebook'              => '',
        'twitter'               => '',
        'google_plus'           => '',
        'linkedin'              => '',
        'pinterest'             => '',
        'flickr'                => '',
        'instagram'             => '',
        'dribbble'              => '',
        'reddit'                => '',
        'email'                 => '',
        'extra_class'           => ''
    ), $atts ));

    if( empty( $headline ) ) {
        $headline = 'h3';
    }

    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    $class_title = array( 'themeum_team' );
    $wrap_class[] = 'themeum-team-wrap-' . esc_attr($layout);

    $wrap_class[] = 'themeum-team-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

    if( $text_align ){ 
        if( $text_align == 'left' ){ $align = 'text-left'; }
        if( $text_align == 'right' ){ $align = 'text-right'; }
        if( $text_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-left';
    }


    // team image
    if ( $image > 0 ) {
        $img_link = wp_get_attachment_image_src( $image, 'full' );
        $img_link = $img_link[0];

        $data_img .= '<div class="team-content-image">';
            $data_img .= '<img class="img-responsive" src="'. esc_url($img_link) .'" alt="">';
        $data_img .= '</div>';
    }

    //title
    if ( !empty( $title ) ) {
        if ( $button_link ) {
            $data_title .= '<'.esc_attr($headline).' class="team-content-title"><a href="'.esc_url($button_link).'">';
                $data_title .= wp_kses_post($title);
            $data_title .= '</a></'.esc_attr($headline).'>';
        } else {
            $data_title .= '<'.esc_attr($headline).' class="team-content-title">';
                $data_title .= wp_kses_post($title);
            $data_title .= '</'.esc_attr($headline).'>';
        }  
    }   

    //subtitle  
    if ( !empty( $subtitle ) ) {
        $data_subtitle .= '<div class="team-content-subtitle">';
            $data_subtitle .= wp_kses_post($subtitle);
        $data_subtitle .= '</div>';
    }

    //Description
    if ( !empty( $desc ) ) {
        $data_desc .= '<div class="team-content-desc">';
            $data_desc .= wp_kses_post($desc);
        $data_desc .= '</div>';
    }


    //social share
    $social_list = array(
        'facebook',
        'twitter',
        'google_plus',
        'linkedin',
        'pinterest',
        'flickr',
        'instagram',
        'dribbble',
        'reddit',
        'email',
    );

    foreach( $social_list as $acc ){
        if( !empty( $atts[$acc]) && $atts[$acc] != '__empty__' ){
            $icon = str_replace( array('_', 'email') , array( '-', 'envelope-o') , $acc);
            $data_socials .= '<a href="' . $atts[$acc] . '" target="_blank"><i class="fa-' . $icon . '"></i></a>';
        }
    }
    if( !empty( $data_socials) ){
        $data_socials = '<div class="team-content-socials">' . $data_socials . '</div>';
    }

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="item '.esc_attr( implode( ' ', $class_title ) ).'">';
            switch ( $layout ) {
                case '2':
                    $output .= '<div class="'.$align.'">';
                        $output .= $data_img;
                        $output .= '<div class="team-content2">';
                            $output .= $data_title;
                            $output .= $data_subtitle;
                            $output .= $data_desc;
                            $output .= $data_socials;
                        $output .= '</div>'; 
                    $output .= '</div>'; 
                break;

                case '3':
                    $output .= '<div class="'.$align.'">';
                        $output .= $data_img;
                        $output .= '<div class="team-content3">';
                            $output .= $data_title;
                            $output .= $data_subtitle;
                            $output .= $data_desc;
                            $output .= $data_socials;
                        $output .= '</div>'; 
                    $output .= '</div>'; 
                break;

                case '4':
                    $output .= '<div class="'.$align.'">';
                        $output .= '<div class="team-overlay">';
                            $output .= $data_img;
                            $output .= $data_socials;
                        $output .= '</div>';
                        $output .= '<div class="team-content4">';
                            $output .= $data_title;
                            $output .= $data_subtitle;
                            $output .= $data_desc;
                        $output .= '</div>';
                    $output .= '</div>';
                break;

                default:
                    $output .= '<div class="'.$align.'">';
                        $output .= '<div class="team-overlay">';
                            $output .= $data_img;
                            $output .= $data_socials;
                        $output .= '</div>';
                        $output .= $data_title;
                        $output .= $data_subtitle;
                        $output .= $data_desc;
                    $output .= '</div>';
                break;            
            }
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('themeum_team', 'themeum_team_data_shortcodes');



