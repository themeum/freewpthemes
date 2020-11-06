<?php

function crowdfunding_all_published_post(){
    $data = array();
    $args = array(
        'post_type'     => 'product',
        'post_status'   => 'publish',
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $data[ basename(get_permalink()) ] = get_the_title();
        }
        wp_reset_postdata();
    }
    return $data;
}


add_action('init', 'king_slider_data', 99);

function king_slider_data(){

    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
            'kings_slider'    => array(
                'name'        => 'Slider',
                'description' => __('Title shortcode of the theme.', 'KingComposer') ,
                'icon'        => 'kc-icon-icarousel',
                'category'    => 'Crowdfunding',
                'css_box'     => true,
                'params'      => array(
                                        array(
                                            'name'          => 'project_slug',
                                            'label'         => 'Field Label',
                                            'type'          => 'multiple',
                                            'options'       => crowdfunding_all_published_post(),
                                            'description'   => 'Field Description',
                                        ),
                                         array(
                                            'name'          => 'image',
                                            'label'         => 'Upload Image',
                                            'type'          => 'attach_images',
                                            'admin_label'   => true,
                                        ),
                                ),
                )
        ));
    }
}

// Register Hover Shortcode
function king_slider_shortcodes($atts, $content = null){

    extract( shortcode_atts( array(
        'image'        => '',
        'project_slug'  => ''
    ), $atts ));
    $output = '';

    $data = explode( ',', $project_slug );
    $image = explode( ',', $image );

    $output .= '<div class="products-slider owl-carousel" id="products-slider">';
    foreach ($data as $key => $value) {
        setup_postdata($value);
        $id = get_page_by_path( $value,'OBJECT','product' );
        if( isset($id->ID) ){
            if( $id->ID ){
                $id = $id->ID;
                $style = '';

                //$output .= ''.$id;

                if(isset( $image[$key] )){
                    $src = wp_get_attachment_image_src( $image[$key], 'full' );
                    $style = 'style="background: no-repeat center center url('.$src[0].');"';
                }

                $output .= '<div class="product" '.$style.'>';
                $output .= '<div class="container">';
                $output .= '<div class="row">';
                $output .= '<div class="col-sm-5">';
                $output .= '<div class="product-info">';
                $output .= '<h1 class="title">'.get_the_title( $id ).'</h1>';
                $post_content = get_post( $id );
                if(function_exists('crowdfunding_excerpt_max_charlength')){
                    $output .= '<p class="info">'.crowdfunding_excerpt_max_charlength( $post_content->post_excerpt, 150 ).'</p>';
                }
                $output .= '<div class="product-timeline">';
                $output .= '<ul>';
                $output .= '<li>';
                if(function_exists('wpcf_function')){
                    $output .= '<h3 class="amount">'.wpcf_function()->price(wpcf_function()->total_goal($id)).'</h3>';
                }
                $output .= '<p>'.__('Funding Goal','crowdfunding').'</p>';
                $output .= '</li>';
                $output .= '<li>';
                if(function_exists('wpcf_function')){
                    $output .= '<h3 class="amount">'.wpcf_function()->price(wpcf_function()->fund_raised($id)).'</h3>';
                }
                $output .= '<p>'.__('Fund Raised','crowdfunding').'</p>';
                $output .= '</li>';
                $output .= '<li>';

                $days_remaining = '';
                if( function_exists('wpcf_function') ){
                    $days_remaining = apply_filters('date_expired_msg', __('Date expired', 'crowdfunding'));
                    if (wpcf_function()->dateRemaining($id)){
                        $days_remaining = apply_filters('date_remaining_msg', __(wpcf_function()->dateRemaining($id), 'crowdfunding'));
                    }
                }

                $output .= '<h3 class="amount">'.$days_remaining.'</h3>';
                $output .= '<p>'.__('Days to go','crowdfunding').'</p>';
                $output .= '</li>';
                $output .= '</ul>';
                $output .= '</div>'; //.product-timeline

                if(function_exists('wpcf_function')){
                    $output .= '<div class="wpneo-raised-bar">';
                    $output .= '<div id="progressbar">';
                    $output .= '<div style="width:'.wpcf_function()->getFundRaisedPercent($id).'%"></div>';
                    $output .= '</div>';
                    $output .= '</div>';
                }

                $output .= '<a href="'.get_permalink( $id ).'" class="btn btn-default">'.__('View Project','crowdfunding').'</a>';
                $output .= '</div>'; //.product-info
                $output .= '</div>'; //.col-sm-5
                $output .= '</div>'; //.row
                $output .= '</div>'; //.container
                $output .= '</div>'; //.product
            }
            wp_reset_postdata();
        }
    }
    $output .= '</div>'; //products-slider


    return $output;

  }

add_shortcode('kings_slider', 'king_slider_shortcodes');

