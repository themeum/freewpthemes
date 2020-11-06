<?php 

function eventco_ajax_login_init(){

      wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
      wp_enqueue_script('ajax-login-script');
      add_action( 'wp_ajax_nopriv_ajaxlogin', 'eventco_ajax_login' );
  }

  # Execute the action only if the user isn't logged in
  if (!is_user_logged_in()) {
      add_action('init', 'eventco_ajax_login_init');
  }


  function eventco_ajax_login(){

      // First check the nonce, if it fails the function will break
      check_ajax_referer( 'ajax-login-nonce', 'security' );

      // Nonce is checked, get the POST data and sign user on
      $info = array();
      $info['user_login'] = esc_attr( $_POST['username'] );
      $info['user_password'] = esc_attr( $_POST['password'] );
      $info['remember'] = true;

      $user_signon = wp_signon( $info, false );
      if ( is_wp_error($user_signon) ){
          echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.','eventco')));
      } else {
          echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...','eventco')));
      }

      die();
  }