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
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.','winkel')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...','winkel')));
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
        echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Username field is empty.' ));
        die();
    }elseif( !$_POST['email'] ){
        echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Email field is empty.' ));
        die();
    }elseif( !$_POST['password'] ){
        echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Password field is empty.' ));
        die();
    }else{
        if( username_exists( $_POST['username'] ) ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Username already exits.' ));
            die();
        }elseif( strlen($_POST['password']) <= 6 ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Password must 6 charecter or more.' ));
            die();
        }elseif( !is_email($_POST['email']) ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Email address is not correct.' ));
            die();
        }elseif( email_exists($_POST['email']) ){
            echo json_encode(array( 'loggedin'=>false, 'message'=> 'Wrong!!! Email user already exits in this site.' ));
            die();
        }else{
            $user_input = array(
                'user_login'    =>  $_POST['username'],
                'user_email'    =>  $_POST['email'],
                'user_pass'     =>  $_POST['password']
            );
            $user_id = wp_insert_user( $user_input );
            if ( ! is_wp_error( $user_id ) ) {
                echo json_encode(array( 'loggedin'=>true, 'message'=> 'Registration successful you can login now.' ));
                die();
            }else{
                echo json_encode(array('loggedin'=>false, 'message'=> 'Wrong username or password.'));
                die();
            }
        }
    }
}
