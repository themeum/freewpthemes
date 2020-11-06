<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>  
    <?php 
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );

    $headerlayout = get_theme_mod( 'head_style', 'transparent' );
    $header_style = get_post_meta( get_the_ID(), "wpestate_header_style", true );
    if($header_style){
        if($header_style == 'transparent_header'){
            $headerlayout =  'transparent';
        }else{
            $headerlayout =  'solid';
        }
    }

    $sticky_class = '';
    if( get_theme_mod( 'header_fixed', false )){
        $sticky_class = ' enable-sticky ';
    }

    ?> 

<!-- Preloader Start --> 
<?php if(get_theme_mod('preloader_en', false)) {?>
<div id="overlayer"></div>
<span class="loader">
</span>
<?php }?>
<!-- Preloader End --> 


<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">

  <header id="masthead" class="site-header  header <?php echo esc_attr($sticky_class); ?> ">
  	<div class="container-fluid">
  			<div class="main-menu-wrap row no-gutters align-items-center clearfix">
          
            <div class="common-menu-responsive-logo col-md-2 col-lg-2">
      				  <div class="wpestate-navbar-header">
          					<div class="logo-wrapper">
            						  <a class="wpestate-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
              								<?php
              									$logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.svg' );
              									$logotext  = get_theme_mod( 'logo_text', 'wpestate' );
              									$logotype  = get_theme_mod( 'logo_style', 'logoimg' );

              									switch ($logotype) {
                                    case 'logoimg':
                										  if( !empty($logoimg) ) { ?>
                											    <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'wpestate' ); ?>" title="<?php  esc_html_e( 'Logo', 'wpestate' ); ?>">
                										  <?php } else { ?>
                											    <h1> <?php  echo esc_html(get_bloginfo('name'));?> </h1>
                										  <?php }
                										break;
                									  default:
                										if( $logotext ) { ?>
                											  <h1> <?php echo esc_html( $logotext ); ?> </h1>
                										<?php } else { ?>
                										    <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                										<?php }
                										break;
              									} ?>
            							 </a>
          					  </div>	 
      				  </div><!--/#wpestate-navbar-header-->   
    				</div><!--/.col-sm-2-->
         

             <?php 

             if( ! class_exists('wp_megamenu_initial_setup')) { ?>
              <div class="wpestate-menu">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
              </div>
              <div id="mobile-menu" class="thm-mobile-menu"> 
                <div class="collapse navbar-collapse">
                  <?php 
                  if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( 
                        array(
                            'theme_location'    => 'primary',
                            'container'      => false,
                            'menu_class'      => 'nav navbar-nav',
                            'fallback_cb'    => 'wp_page_menu',
                            'depth'        => 3,
                            'walker'        => new wp_bootstrap_mobile_navwalker()
                        )
                    ); 
                  } ?>
                </div>
              </div><!--/.#mobile-menu-->
           <?php } ?>

          <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
            <?php if(get_theme_mod('header_login_en', false)) { ?>
  				  <div class="common-menu-responsive normal-menu-wrap col-md-7 col-lg-7">
            <?php } else{?>
              <div class="common-menu-responsive normal-menu-wrap col-md-10">
            <?php } ?>
          <?php } else { ?>
            <div class="wp-megamenu-custom-wrap col-md-10 col-lg-7">
          <?php } ?>
            <?php if ( has_nav_menu( 'primary' ) ) { ?>
      					<div id="main-menu" class="common-menu-wrap wpestate-megamenu">
          					<?php 
            						wp_nav_menu(  
                            array(
              								'theme_location' => 'primary',
              								'container'	  => '', 
              								'menu_class'	 => 'nav',
              								'fallback_cb'	=> 'wp_page_menu',
              								'depth'		  => 4,
              								//'walker'		 => new Megamenu_Walker()
            								  )
            						); 
          					?>	
                  </div><!--/.col-sm-9--> 
  				  <?php  } ?>
            </div><!--/#main-menu-->

            <?php 
            $submit_page_id = get_theme_mod('property_submit_page', true);
            $page_url       = get_permalink($submit_page_id);
            
            $current_user_id = get_current_user_id();
            $user = get_user_by('ID', $current_user_id);

            ?>

            <?php if(get_theme_mod('header_login_en', false)) :?>
            <div class="col-md-9 col-lg-3 submit-property text-right">
              <div class="login-link text-right pr-4">
                <a class="mr-5 header-contact" href="tel:<?php echo get_theme_mod( 'header_top_phone', '(800)-398-7586' ); ?>">
                  <i class="fa fa-phone mr-2"></i>
                  <?php echo get_theme_mod( 'header_top_phone', '(800)-398-7586' ); ?>
                </a>
                <?php if(!is_user_logged_in()){?>
                <a class="login-link" href="#sign-in" <?php if(!is_user_logged_in()){ echo 'data-toggle="modal"';} ?> data-target="#sign-in">
                  <i class="fa fa-user mr-2"></i>
                  <span class="login-text-lg">
                    <?php echo esc_html__( 'Login / Register', 'wpestate' ); ?>
                  </span>
                </a>
                <?php } else{?>
                  <div class="d-inline-block after-login">
                    <i class="fa fa-user mr-1"></i>
                    <span class="login-text-lg">
                      <?php echo esc_html__('Hello, ', 'wpestate'); ?> 
                      <span><?php echo esc_attr($user->first_name); ?></span>
                    </span>

                    <div class="profile-page-list">
                    <?php
                      $dashboard_menus = apply_filters('wpestate_profile_menu_items', array());
                      $dashboard_page_id    = get_theme_mod('property_dashboard_page', true);
                      $pagelink        = get_permalink($dashboard_page_id);
                      ?>
                      <ul>
                        <li><a href="<?php echo esc_url($page_url); ?>">
                        <i class="fa fa-home"></i><?php echo esc_html__('Submit Property', 'wpestate') ?></a></li>
                        <?php
                          $profile = $favrite = $my_property = '';
                          foreach ($dashboard_menus as $menu_name => $menu_value){
                            $pagelink = add_query_arg( 'page_type', $menu_name , $pagelink );
                            if( $menu_value['tab'] == 'profile' ){ $profile = $pagelink; ?>
                              <li><a href="<?php echo esc_url($profile); ?>"><i class="fa fa-user"></i><?php echo esc_html__("Profile", "wpestate") ?></a></li>
                            <?php } if( $menu_value['tab'] == 'bookmark' ){ $favrite = $pagelink; ?>
                              <li><a href="<?php echo esc_url($favrite); ?>"><i class="fa fa-heart"></i><?php echo esc_html__("Favourite Properties", "wpestate") ?></a></li>
                            <?php } if( $menu_value['tab'] == 'dashboard' ){ $my_property = $pagelink; ?>
                              <li><a href="<?php echo esc_url($my_property); ?>"><i class="fa fa-list"></i><?php echo esc_html__('My Properties', 'wpestate') ?></a></li>
                            <?php }
                          }
                        ?>
                        <li><a href="<?php echo wp_logout_url( home_url() ); ?>"><i class="fa fa-power-off"></i><?php echo esc_html__('Log Out', 'wpestate') ?></a></li>
                      </ul>
                    </div>
                  </div>       
                <?php }?>
              </div>

            </div>
            <?php endif; ?>
  			</div><!--/.main-menu-wrap-->	 
  	</div><!--/.container--> 
  </header><!--/.header-->

<?php if ( !is_user_logged_in() ): ?>
    <!-- Login -->
    <div class="modal fade" id="sign-in" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="row">
                <div class="col-md-12">
                  <div class="modal-close" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                  </div>
                  <div class="modal-inner-content">
                  <?php
                if(in_array('wpestate-core/wpestate-core.php', apply_filters('active_plugins', get_option('active_plugins')))){ ?>
                    <h2 class="modal-form-title"><?php esc_html_e( 'Login / Register','wpestate' ); ?></h2>
                    <form id="login" action="login" method="post">
                        <div class="login-error alert alert-danger" role="alert"></div>
                        <input type="text"  id="usernamelogin" name="username" class="form-control" placeholder="Username">
                        <input type="password" id="passwordlogin" name="password" class="form-control" placeholder="Password">
                        <?php wp_nonce_field( 'ajax-login-nonce', 'securitylogin' ); ?>

                        <div class="row">
                          <div class="col-md-6 login-remember">
                            <input id="login-remember" class="form-control" type="checkbox">
                            <label for="login-remember"><?php esc_html_e('Remember Me', 'wpestate') ?></label>
                          </div>
                          <div class="col-md-6 text-right">
                            <a class="forgot-pass-link" target="_blank" href="<?php echo esc_url(wp_lostpassword_url()); ?>">
                              <?php esc_html_e( 'Forgot your password?','wpestate' ); ?>
                            </a>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <input type="submit" class="btn submit_button"  value="Log in" name="submit">
                            <p class="modal-text text-center mt-2">
                            <a data-toggle="modal" data-target="#registerlog" href="#" data-dismiss="modal" >
                              <?php esc_html_e( 'Create an account','wpestate' ); ?></a>
                            </p>
                          </div>
                        </div>
                    </form>
                    <?php } else{?>
                      <h3><?php echo esc_html__( 'Active wpestate Core Plugin First', 'wpestate' ); ?></h3>
                    <?php }?>
                  </div>
                </div>
              </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="registerlog" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="row">
                <div class="col-md-12">
                    <div class="modal-close" data-dismiss="modal">
                      <i class="fa fa-close"></i>
                    </div>
                    <div class="modal-inner-content">
                      <h2 class="modal-form-title"><?php esc_html_e( 'Register Account','wpestate' ); ?></h2>
                      <form id="register" action="login" method="post">
                          <div class="login-error alert alert-danger" role="alert"></div>
                          <input type="text" id="username" name="username" class="form-control" placeholder="<?php esc_html_e( 'Username','wpestate' ); ?>">
                          <input type="text" id="email" name="email" class="form-control" placeholder="<?php esc_html_e( 'Email','wpestate' ); ?>">
                          <input type="password" id="password" name="password" class="form-control" placeholder="<?php esc_html_e( 'Password','wpestate' ); ?>">
                          <input type="submit" class="btn submit_button"  value="Register" name="submit">
                          <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                          <p class="modal-text mt-2 text-center"><?php esc_html_e( 'Or, Already have a account?','wpestate' ); ?>
                            <a data-toggle="modal" data-target="#sign-in" href="#" data-dismiss="modal" >
                              <?php esc_html_e( 'Login','wpestate' ); ?></a>
                          </p>
                      </form>
                    </div>
                </div>
              </div>
                
            </div>
        </div>
    </div>
<?php endif; ?>
