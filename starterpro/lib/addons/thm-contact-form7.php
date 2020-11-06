<?php
add_action('init', 'register_contact_form7_data', 99);
function register_contact_form7_data(){
    global $kc;
    if( function_exists('kc_add_map') ){

        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->ID ] = $cform->post_title;
            }
        } else {
            $contact_forms[ __( 'No contact forms found', 'starterpro' ) ] = 0;
        }

    $kc->add_map(array(
            'thm_contact_form7' => array(
                'name'        => 'Contact Form7',
                'description' => 'Contact Form7 shortcode of the theme',
                'icon'        => 'sl-envelope-open',
                'category'    => 'Starter',
                'css_box'     => true,
                'params'      => array(
                    'Title' => array(
                                                                                                                                  
                            array(
                                'name'          => 'contact_form7_id',
                                'type'          => 'dropdown',
                                'label'         => esc_html__('Title wrap align', 'starterpro'),
                                'options'       => $contact_forms,
                            ),                                                                                      
                            array(
                                'name'  => 'extra_class',
                                'label' => esc_html__('Extra class', 'starterpro'),
                                'description'   => esc_html__('Custom class for wrapper of the shortcode', 'starterpro'),
                                'type'  => 'text'
                            ),
                        ),
                    )
                )
        ));
    }
  }

// Register Hover Shortcode
function add_contact_form_7_shortcode($atts, $content = null){
    $output = $extra_class = $contact_form7_id = '';
    extract( shortcode_atts( array(
        'contact_form7_id'          => '',
        'extra_class'           => ''
    ), $atts ));
    

    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    $wrap_class[] = 'themeum-contact-form7-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

    $output .= '<div class="'.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="themeum-contact-form7">'.do_shortcode( '[contact-form-7 id="'.$contact_form7_id.'"]' ).'</div>';
    $output .= '</div>';

    return $output;
  }
add_shortcode('thm_contact_form7', 'add_contact_form_7_shortcode');
