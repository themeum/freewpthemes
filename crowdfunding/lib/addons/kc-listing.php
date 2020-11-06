<?php
add_action('init', 'king_crowdfunding_listing', 99);

function crowdfunding_product_cat_list(){
    $terms = get_terms( 'product_cat', array( 'hide_empty' => false ) );
    $data = array( '' => 'All' );
    if(is_array( $terms )){
        if(!empty( $terms )){
            foreach ($terms as $value) {
                $data[$value->slug] = $value->name;
            }
        }
    }
    return $data;
}

function king_crowdfunding_listing(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
          'crowdfunding_listing_cat'  => array(
              'name'         => 'Project Listing',
              'description'  => 'CC Image / Logo / Client Carousel',
              'icon'         => 'kc-icon-blog-posts',
              'category'     => 'Crowdfunding',
              'css_box'      => true,
              'params'       => array(
                                    array(
                                          'type'          => 'dropdown',
                                          'label'         => 'Category',
                                          'name'          => 'cat',
                                          'description'   => 'Select the Text Align',
                                          'options'       => crowdfunding_product_cat_list(),
                                          'admin_label'   => true,
                                          'value'         => ''
                                      ),
                                    array(
                                          'name'          => 'number',
                                          'label'         => 'Number of Items',
                                          'type'          => 'number_slider',
                                          'options'       => array(
                                                                'min'         => 0,
                                                                'max'         => 100,
                                                                'unit'        => '',
                                                                'show_input'  => true
                                                          ),
                                          'value'         => '3',
                                          'description'   => 'Chose number of items per page.'
                                    ),
                    )
              )
        ));
    }
}

// Register Hover Shortcode
function king_crowdfunding_listing_shortcodes($atts, $content = null){
    extract( shortcode_atts( array(
        'number'           => '3',
        'cat'              => ''
    ), $atts ));
    $output = $category = '';

    if( $cat!='' && $cat!='__empty__' ){ $category = 'cat="'.$cat.'"'; }

    $output = do_shortcode( '[wpcf_listing number="'.$number.'" '.$category.']' );

    return $output;
}
add_shortcode('crowdfunding_listing_cat', 'king_crowdfunding_listing_shortcodes');