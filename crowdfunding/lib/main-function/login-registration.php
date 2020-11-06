<?php 

add_action('after_switch_theme', 'themeum_login_registration_setup_options');
function themeum_login_registration_setup_options(){

    if( get_option('login_page_id') == "" ){
            $login_page = array(
              'post_title'    => 'Login',
              'post_content'  => '[custom_login]',
              'post_status'   => 'publish',
              'post_author'   => 1,
              'post_type'     => 'page'
            );
            $post_id = wp_insert_post( $login_page );
            add_option( 'login_page_id', $post_id );    
        }
}