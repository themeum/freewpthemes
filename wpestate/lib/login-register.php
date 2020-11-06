<?php
/* ------------------------------------------ *
 *              Login Action
 * ------------------------------------------ */
add_action( 'wp_ajax_nopriv_ajaxlogin', 'themeum_ajax_login' );
function themeum_ajax_login(){
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $info = array();
    $info['user_login'] = sanitize_text_field( $_POST['username'] );
    $info['user_password'] = sanitize_text_field( $_POST['password'] );
    $info['remember'] = sanitize_text_field( $_POST['remember'] );

    $user_signon = wp_signon( $info, false );

    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.','wpestate')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...','wpestate')));
    }
    die();
}


/* ------------------------------------------ *
 *              Registration Action
 * ------------------------------------------ */
add_action( 'wp_ajax_nopriv_ajaxregister', 'themeum_ajax_register_new_user' );
function themeum_ajax_register_new_user(){
    check_ajax_referer( 'ajax-register-nonce', 'security' );
    if( !$_POST['username'] ){
        echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Username field is empty.', 'wpestate') ));
        die();
    }elseif( !$_POST['email'] ){
        echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Email field is empty.', 'wpestate') ));
        die();
    }elseif( !$_POST['password'] ){
        echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Password field is empty.', 'wpestate') ));
        die();
    }else{
        if( username_exists( $_POST['username'] ) ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Username already exits.', 'wpestate') ));
            die();
        }elseif( strlen($_POST['password']) <= 6 ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Password must 6 charecter or more.', 'wpestate') ));
            die();
        }elseif( !is_email($_POST['email']) ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Email address is not correct.', 'wpestate') ));
            die();
        }elseif( email_exists($_POST['email']) ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> __('Wrong!!! Email user already exits in this site.', 'wpestate') ));
            die();
        }else{
            $user_input = array(
                'user_login'    =>  $_POST['username'],
                'user_email'    =>  $_POST['email'],
                'user_pass'     =>  $_POST['password'],
                'role'          =>  'agent'
            );
            $user_id = wp_insert_user( $user_input );
            if ( ! is_wp_error( $user_id ) ) {
                echo json_encode(array( 'loggedin'=>true, 'message'=> __('Registration successful you can login now.', 'wpestate') ));
                die();
            }else{
                echo json_encode(array('loggedin'=>false, 'message'=> __('Wrong username or password.', 'wpestate')));
                die();
            }
        }
    }
}
