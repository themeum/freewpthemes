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
    $header_style = get_post_meta( get_the_ID(), "themeum_header_style", true );
    if($header_style){
        if($header_style == 'transparent_header'){
            $headerlayout =  'transparent';
        }else{
            $headerlayout =  'borderimage';
        }
    }


    $search_class = '';
    $sticky_class = '';
    if(get_theme_mod('header_search', false)) {
        $search_class = ' search-enabled ';
    }

    if( get_theme_mod( 'header_fixed', false )){
        $sticky_class = ' enable-sticky ';
    }

    ?>


<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
  <header id="masthead" class="site-header  header header-<?php echo esc_attr($headerlayout); echo esc_attr($search_class); echo esc_attr($sticky_class); ?>  ">
  	<div class="container">
        <!-- Top bar -->
        <?php if ( get_theme_mod( 'topbar_en', false ) ) {
          get_template_part('lib/topbar');
        } ?>
      <!-- Top bar -->
  			<div class="main-menu-wrap row align-items-center clearfix">
                <div class="col-auto thm-logo-col">
  				    <div class="themeum-navbar-header">
      					<div class="logo-wrapper">
        				    <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
      						    <?php
                                $logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
									$logotype  = get_theme_mod( 'logo_style', 'logoimg' );
									$logotext  = get_theme_mod( 'logo_text', 'floox' );
                                if($logoimg && $logotype == 'logoimg'){ ?>
                                    <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'floox' ); ?>" title="<?php  esc_html_e( 'Logo', 'floox' ); ?>">
                                <?php }else{
                                     if($logotext) {
                                        echo $logotext;
                                    }else{
                                        echo esc_html(get_bloginfo('name'));
                                    }
                                } ?>
                            </a>
      					 </div>
      				</div><!--/#themeum-navbar-header-->
    			</div><!--/.col-sm-2-->
             <?php if(! class_exists('wp_megamenu_initial_setup')) : ?>
              <div class="col text-right d-lg-none">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
              </div>
              <div id="mobile-menu" class="d-lg-none thm-mobile-menu">
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
            <?php endif; ?>

            <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
    			<div class="col-12 common-menu d-none d-lg-flex jusitify-content-center">
            <?php } else { ?>
              <div class="col-12 common-menu d-flex jusitify-content-center">
            <?php } ?>

            <?php if ( has_nav_menu( 'primary' ) ) { ?>
  					<div id="main-menu" class="common-menu-wrap">
      					<?php
    						wp_nav_menu(
                                array(
      								'theme_location' => 'primary',
      								'container'	  => '',
      								'menu_class'	 => 'nav',
      								'fallback_cb'	=> 'wp_page_menu',
      								'depth'		  => 4,
      								'walker'		 => new Megamenu_Walker()
    							)
    						);
      					?>
                  </div><!--/.col-sm-9-->
  				  <?php  } ?>
            </div><!--/#main-menu-->
            <?php if(get_theme_mod('header_search', false)) : ?>
                <div class="col-auto thm-search-col">
                    <span class="thm-search-icon">
                        <i class="floox-icon floox-search"></i>
                    </span>
                </div>
            <?php endif; ?>
  		</div><!--/.main-menu-wrap-->
  	</div><!--/.container-->

    <div class="thm-fullscreen-search d-flex flex-wrap justify-content-center align-items-center">
        <div class="search-overlay"></div>
        <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
            <input class="main-font" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e('Search here...','floox'); ?>" autocomplete="off" />
            <input type="submit" value="submit" class="d-none" id="thm-search-submit">
            <label for="thm-search-submit"><i class="floox-icon floox-search"></i></label>
        </form>
    </div> <!--/ .full-screen-search -->



    <?php if ( !is_user_logged_in() ): ?>
        <!-- Login -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?php _e( 'Sign In','floox' ); ?></h4>
                        <p class="modal-text"><?php _e( 'Don’t worry, we won’t spam you <br> or sell your information.','floox' ); ?></p>
                    </div>
                    <div class="modal-body">
                        <form id="login" action="login" method="post">
                            <div class="login-error alert alert-danger" role="alert"></div>
                            <input type="text"  id="usernamelogin" name="username" class="form-control" placeholder="Username">
                            <input type="password" id="passwordlogin" name="password" class="form-control" placeholder="Password">
                            <input type="checkbox" id="rememberlogin" name="remember" ><label><?php _e( 'Remember me','floox' ); ?></label>
                            <input type="submit" class="btn btn-primary submit_button"  value="Log In" name="submit">

                            <?php wp_nonce_field( 'ajax-login-nonce', 'securitylogin' ); ?>
                        </form>
                    </div>
                    <div class="modal-footer clearfix d-block text-left">
                        <div class="d-inline-block">
                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php echo esc_html__( 'Forgot password?','floox' ); ?></a>
                        </div>
                        <div class="d-inline-block float-right">
                            <a data-toggle="modal" data-target="#registerlog" href="#" data-dismiss="modal" ><?php echo esc_html__( 'Sign Up','floox' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="registerlog" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?php _e( 'Sign Up','floox' ); ?></h4>
                        <p class="modal-text"><?php _e( 'By signing up you agree to all the Terms and conditions.','floox' ); ?></p>
                    </div>
                    <div class="modal-body">
                        <form id="register" action="login" method="post">
                            <div class="login-error alert alert-danger" role="alert"></div>
                            <input type="text" id="username" name="username" class="form-control" placeholder="<?php _e( 'Username','floox' ); ?>">
                            <input type="text" id="email" name="email" class="form-control" placeholder="<?php _e( 'Email','floox' ); ?>">
                            <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e( 'Password','floox' ); ?>">
                            <input type="submit" class="btn btn-primary submit_button"  value="Register" name="submit">
                            <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                        </form>
                    </div>
                    <div class="modal-footer clearfix d-block text-left">
                        <div class="d-inline-block">
                            <a data-toggle="modal" data-target="#myModal" href="#" data-dismiss="modal" ><?php _e( 'Sign In','floox' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


  </header><!--/.header-->
   
