<?php
function flatpro_post_type_portfolio(){

    $labels = array(
            'name'                  => _x( 'Portfolios', 'Portfolios', 'flatpro' ),
            'singular_name'         => _x( 'Portfolio', 'Portfolio', 'flatpro' ),
            'menu_name'             => __( 'Portfolios', 'flatpro' ),
            'parent_item_colon'     => __( 'Parent Portfolio:', 'flatpro' ),
            'all_items'             => __( 'All Portfolio', 'flatpro' ),
            'view_item'             => __( 'View Portfolio', 'flatpro' ),
            'add_new_item'          => __( 'Add New Portfolio', 'flatpro' ),
            'add_new'               => __( 'New Portfolio', 'flatpro' ),
            'edit_item'             => __( 'Edit Portfolio', 'flatpro' ),
            'update_item'           => __( 'Update Portfolio', 'flatpro' ),
            'search_items'          => __( 'Search Portfolio', 'flatpro' ),
            'not_found'             => __( 'No article found', 'flatpro' ),
            'not_found_in_trash'    => __( 'No article found in Trash', 'flatpro' )
        );

    $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_in_menu'          => true,
            'show_in_admin_bar'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_icon'             => 'dashicons-portfolio',
            'menu_position'         => null,
            'supports'              => array( 'title','editor','thumbnail','comments')
        );

    register_post_type('portfolio',$args);
}
add_action('init','flatpro_post_type_portfolio');



/*--------------------------------------------------------------
 *          View Message When Updated portfolio
 *-------------------------------------------------------------*/
function flatpro_update_message_portfolio(){
    global $post, $post_ID;

    $message['portfolio'] = array(
        0   => '',
        1   => sprintf( __('Portfolio updated. <a href="%s">View Portfolio</a>', 'flatpro' ), esc_url( get_permalink($post_ID) ) ),
        2   => __('Custom field updated.', 'flatpro' ),
        3   => __('Custom field deleted.', 'flatpro' ),
        4   => __('Portfolio updated.', 'flatpro' ),
        5   => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s', 'flatpro' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6   => sprintf( __('Portfolio published. <a href="%s">View Portfolio</a>', 'flatpro' ), esc_url( get_permalink($post_ID) ) ),
        7   => __('Portfolio saved.', 'flatpro' ),
        8   => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview Portfolio</a>', 'flatpro' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9   => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>', 'flatpro' ), date_i18n( __( 'M j, Y @ G:i','flatpro'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10  => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview Portfolio</a>', 'flatpro' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );

return $message;
}
add_filter( 'post_updated_messages', 'flatpro_update_message_portfolio' );



/*--------------------------------------------------------------
 *          Register Custom Taxonomies
 *-------------------------------------------------------------*/
function flatpro_create_portfolio_taxonomy(){
    $labels = array(    'name'              => _x( 'Categories', 'taxonomy general name','flatpro'),
                        'singular_name'     => _x( 'Category', 'taxonomy singular name','flatpro' ),
                        'search_items'      => __( 'Search Category','flatpro'),
                        'all_items'         => __( 'All Category','flatpro'),
                        'parent_item'       => __( 'Parent Category','flatpro'),
                        'parent_item_colon' => __( 'Parent Category:','flatpro'),
                        'edit_item'         => __( 'Edit Category','flatpro'),
                        'update_item'       => __( 'Update Category','flatpro'),
                        'add_new_item'      => __( 'Add New Category','flatpro'),
                        'new_item_name'     => __( 'New Category Name','flatpro'),
                        'menu_name'         => __( 'Category','flatpro')
        );
    $args = array(  'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
        );
    register_taxonomy('portfolio-cat',array( 'portfolio' ),$args);
}

add_action('init','flatpro_create_portfolio_taxonomy');


/**
 * Register Portfolio Tag Taxonomies
 *
 * @return void
 */


function flatpro_register_portfolio_tag_taxonomy(){
    $labels = array(
        'name'                  => _x( 'Portfolio Tags', 'taxonomy general name', 'flatpro' ),
        'singular_name'         => _x( 'Portfolio Tag', 'taxonomy singular name', 'flatpro' ),
        'search_items'          => __( 'Search Portfolio Tag', 'flatpro' ),
        'all_items'             => __( 'All Portfolio Tag', 'flatpro' ),
        'parent_item'           => __( 'Portfolio Parent Tag', 'flatpro' ),
        'parent_item_colon'     => __( 'Portfolio Parent Tag:', 'flatpro' ),
        'edit_item'             => __( 'Edit Portfolio Tag', 'flatpro' ),
        'update_item'           => __( 'Update Portfolio Tag', 'flatpro' ),
        'add_new_item'          => __( 'Add New Portfolio Tag', 'flatpro' ),
        'new_item_name'         => __( 'New Portfolio Tag Name', 'flatpro' ),
        'menu_name'             => __( 'Portfolio Tag', 'flatpro' )
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true
    );
    register_taxonomy( 'portfolio-tag', array( 'portfolio' ), $args );
}
add_action('init','flatpro_register_portfolio_tag_taxonomy');











