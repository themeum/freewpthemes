<?php
add_action('init', 'themeum_woocommerce_data', 99);

function themeum_woocommerce_data(){
    global $kc;
    if (function_exists('kc_add_map'))
    {
        kc_add_map(
            array(

        'themeum_woocommerce' => array(
                'name'        => 'Products WooCommerce',
                'description' => esc_html__('Add themeum team', 'wptixon'),
                'icon'        => 'fa-shopping-cart',
                'category'    => 'Tixon',
                'params'        => array(

                'general'   => array(
                    array(
                        'name'    => 'types',
                        'label'   => esc_html__('Select Types', 'wptixon'),
                        'type'    => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'recent_products'       => esc_html__('Recent Products', 'wptixon'),
                            'featured_products'     => esc_html__('Featured Products', 'wptixon'),
                            'sale_products'         => esc_html__('Sale Products', 'wptixon'),
                            'best_selling_products' => esc_html__('Best Selling Products', 'wptixon'),
                            'related_products'      => esc_html__('Related Products', 'wptixon'),
                            'top_rated_products'    => esc_html__('Top Rated Products', 'wptixon'),
                            'product_category'      => esc_html__('Product Category', 'wptixon'),
                            'products'              => esc_html__('Products Using ID', 'wptixon'),
                        ),
                        'value'         => 'recent_products',
                    ),
                    array(
                        'name'    => 'listing_type',
                        'label'   => esc_html__('Listing Type', 'wptixon'),
                        'type'    => 'select',
                        'options' => array(
                              'listing'     => esc_html__( 'Listing', 'wptixon' ),
                              'carousel'    => esc_html__( 'Carousel', 'wptixon' ),
                        ),
                        'value'         => 'listing',
                    ),
                    array(
                        'name'    => 'columns',
                        'label'   => esc_html__('Show Columns', 'wptixon'),
                        'type'    => 'select',
                        'options' => array(
                              '1'     => esc_html__('One Column', 'wptixon'),
                              '2'     => esc_html__('Two Column', 'wptixon'),
                              '3'     => esc_html__('Three Column', 'wptixon'),
                              '4'     => esc_html__('Four Column', 'wptixon'),
                        ),
                        'value'         => '1',
                    ),
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Per Page', 'wptixon' ),
                        'name'          => 'per_page',
                        'description'   => esc_html__( 'Enter number of post per page', 'wptixon' ),
                        'value'         => '4',
                        'relation'      => array(
                                'parent'    => 'types',
                                'hide_when' => 'products',
                        ),
                    ),
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Category Slug', 'wptixon' ),
                        'name'          => 'category',
                        'description'   => esc_html__( 'Enter product category slug.', 'wptixon' ),
                        'relation'      => array(
                                'parent'    => 'types',
                                'show_when' => 'product_category',
                        ),
                    ),
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'ID Lists', 'wptixon' ),
                        'name'          => 'id_list',
                        'description'   => esc_html__( 'Enter product id using comma.', 'wptixon' ),
                        'relation'      => array(
                                'parent'    => 'types',
                                'show_when' => 'products',
                        ),
                    ),
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'wptixon' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'wptixon' )
                    ),

                )//params
            ),//themeum_team

          )
      )
    );
    } // End if
}

// Register Hover Shortcode
function themeum_woocommerce_data_shortcodes($atts, $content = null){
    $output = $types = $listing_type = $columns = $products = $per_page = $extra_class = $category = '';
    extract( shortcode_atts( array(
        'types'                 => 'recent_products',
        'listing_type'          => 'listing',
        'columns'               => '1',
        'per_page'              => '4',
        'category'              => '',
        'products'              => '',
        'extra_class'           => '',
    ), $atts ));


    if( $listing_type == 'carousel' ){
      $output .= '<div class="carousel-woocommerce" data-post-number="'.$columns.'"><div class="row">';
      $columns = 1;
    }

    switch ($types) {

      case 'recent_products':
          $output .= '[recent_products per_page="'. $per_page .'" columns="'.$columns.'"]';
          break;

      case 'featured_products':
          $output .= '[featured_products per_page="'. $per_page .'" columns="'.$columns.'"]';
          break;
      case 'sale_products':
          $output .= '[sale_products per_page="'. $per_page .'" columns="'.$columns.'"]';
          break;

      case 'best_selling_products':
          $output .= '[best_selling_products per_page="'. $per_page .'" columns="'.$columns.'"]';
          break;

      case 'related_products':
          $output .= '[related_products per_page="'. $per_page .'" columns="'.$columns.'"]';
          break;

      case 'top_rated_products':
          $output .= '[top_rated_products per_page="'. $per_page .'" columns="'.$columns.'"]';
          break;

      case 'product_category':
          $output .= '[product_category category="appliances" columns="'.$columns.'"]';
          break;

      case 'products':
          $output .= '[products ids="'.$products.'" columns="'.$columns.'"]';
          break;

      default:
        //$output .= '';
        break;
    }

    if( $listing_type == 'carousel' ){ $output .= '</div></div>'; }

    return do_shortcode( $output );
}
add_shortcode('themeum_woocommerce', 'themeum_woocommerce_data_shortcodes');
