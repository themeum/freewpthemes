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
?> 

<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
  
  <header id="masthead" class="site-header header header-<?php echo esc_attr($headerlayout);?>">
  	<div class="container-fluid">
  			<div class="main-menu-wrap row clearfix">


               <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
                  <div class="col-md-8 col-lg-8 common-menu d-none">
                <?php } else { ?>
                  <div class="col-md-12 col-lg-8 common-menu d-block d-lg-none header-right-col">
                <?php } ?>
                  <?php if ( has_nav_menu( 'primary' ) ) { ?>
                      <div id="main-menu" class="common-menu-wrap">
                          <?php 
                              wp_nav_menu(  
                                  array(
                                    'theme_location' => 'primary',
                                    'container'   => '', 
                                    'menu_class'   => 'nav',
                                    'fallback_cb' => 'wp_page_menu',
                                    'depth'     => 4,
                                    'walker'     => new Megamenu_Walker()
                                    )
                              ); 
                          ?>  
                        </div><!--/.common-menu-wrap--> 
                  <?php  } ?>
                  
                    <div class="winkel-search-wrap">
                        <a href="#" class="winkel-search search-open-icon"><i class="winkel winkel-magnifying-glass"></i></a> 
                        <a href="#" class="winkel-search search-close-icon"><i class="winkel winkel-multiply"></i></a>
                        <div class="top-search-input-wrap">
                            <div class="top-search-overlay"></div>
                            <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                                <div class="search-wrap">
                                    <div class="search  pull-right canvas-top-search">
                                        <div class="sp_search_input">
                                            <input type="hidden" name="post_type" value="product" />
                                            <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control search-btn" placeholder="<?php esc_html_e('Search . . . . .','winkel'); ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="winek-users">
                        <?php if ( !is_user_logged_in() ){ ?>
                            <a class="winkel-users" data-toggle="modal" data-target="#myModal" href="#"><i class="winkel winkel-user"></i></a>
                        <?php }else{ ?>
                        <?php $dashboard_id = get_option( 'woocommerce_myaccount_page_id','' );
                        if($dashboard_id){ ?>
                            <a class="canvas-dashboard" href="<?php the_permalink( $dashboard_id ); ?>"><i class="winkel winkel-user"></i></a>
                        <?php } } ?>
                    </div>
                    <?php echo winkel_header_cart(); ?>
                    <?php //echo winkel_header_cart(); ?>
                  </div><!--/.common-menu-->

             <?php 
             if( ! class_exists('wp_megamenu_initial_setup')) { ?>
              <div class="col-sm-12 col-lg-12 d-lg-none header-right-col">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><?php esc_html_e('Menu','winkel') ?></button>
                    <div class="text-right">
                      <div class="winkel-search-wrap">
                        <a href="#" class="winkel-search search-open-icon"><i class="winkel winkel-magnifying-glass"></i></a> 
                        <a href="#" class="winkel-search search-close-icon"><i class="winkel winkel-multiply"></i></a>
                        <div class="top-search-input-wrap">
                            <div class="top-search-overlay"></div>
                            <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                                <div class="search-wrap">
                                    <div class="search  pull-right canvas-top-search">
                                        <div class="sp_search_input">
                                            <input type="hidden" name="post_type" value="product" />
                                            <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control search-btn" placeholder="<?php esc_html_e('Search . . . . .','winkel'); ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="winek-users">
                    <?php if ( !is_user_logged_in() ){ ?>
                          <a class="winkel-users" data-toggle="modal" data-target="#myModal" href="#"><i class="winkel winkel-user"></i></a>
                      <?php }else{ ?>
                      <?php $dashboard_id = get_option( 'woocommerce_myaccount_page_id','' );
                      if($dashboard_id){ ?>
                          <a class="canvas-dashboard" href="<?php the_permalink( $dashboard_id ); ?>"><i class="winkel winkel-user"></i></a>
                      <?php } } ?>
                    </div>
                    <?php echo winkel_header_cart(); ?>
                  </div>
              </div>

              <div id="mobile-menu" class="hidden-lg-up thm-mobile-menu"> 
                <div class="collapse navbar-collapse">
                  <?php 
                  if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( 
                        array(
                            'theme_location'    => 'primary',
                            'container'         => false,
                            'menu_class'        => 'nav navbar-nav',
                            'fallback_cb'       => 'wp_page_menu',
                            'depth'             => 3,
                            'walker'            => new wp_bootstrap_mobile_navwalker()
                        )
                    ); 
                  } ?>
                </div>
              </div><!--/.#mobile-menu-->
           <?php } ?>



            <div class="col-md-8 col-lg-4">
                <div class="themeum-navbar-header">
                  <?php
                    $offcanavs_enable = get_theme_mod( 'offcanavs_enable', false );
                    $offcanavs_src = get_theme_mod( 'offcanvas_bg' );
                    $style = '';
                    if ($offcanavs_src) {
                      $style = 'style="background-image: url('.esc_url( $offcanavs_src ).');    background-size: cover;background-repeat: no-repeat;"';
                    } else {
                      $style = 'style="background-color: #121212;"';
                    }
                  
                  //print_r($offcanavs_enable);
                  if ($offcanavs_enable == '1') { ?>
                    <div class="offcanvas-wrap">
                      <div class="main-menu-button">
                        <button id="open-button" class="menu-button">
                        <span class="winkel winkel-substract-1"></span>
                        <span class="winkel winkel-substract-1"></span>
                        <span class="winkel winkel-substract-1"></span>
                        </button>
                      </div> <!--/main-menu-button-->
                      <div id="offcanvas-menu-wrapper" class="offcanvas-menu-wrapper" <?php echo $style;?>>
                        <div id="offcanvas-menu-inner">
                          <div id="offcanvas-menu">
                              <?php get_template_part( 'lib/product-category' ); ?>
                          </div><!--/.#mobile-menu-->
                        </div><!--/#offcanvas-menu-inner-->
                      </div><!--/#offcanvas-menu-wrapper-->
                    </div><!--/.offcanvas-wrap-->
                  <?php } ?>

                 <div class="logo-wrapper">
                   <div class="logo-wrapper-in">
                      <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                          <?php
                            $logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
                            $logotext  = get_theme_mod( 'logo_text', 'winkel' );
                            $logotype  = get_theme_mod( 'logo_style', 'logoimg' );
                            switch ($logotype) {
                                case 'logoimg':
                                  if( !empty($logoimg) ) { ?>
                                      <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'winkel' ); ?>" title="<?php  esc_html_e( 'Logo', 'winkel' ); ?>">
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
                     </div><!--/.logo-wrapper-in-->

                     <?php if ( shortcode_exists( 'woocs' ) ) { ?>
                        <div class="currency-woocs">
                          <?php echo do_shortcode('[woocs show_flags=0 width="75px" txt_type="code"]');?>
                        </div>
                      <?php } ?> 
                </div> <!--/.logo-wrapper-->  
              </div><!--/#themeum-navbar-header-->   
            </div><!--/.col-sm-7-->


          <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
  				  <div class="col-lg-7 common-menu common-menu-col d-none d-md-none d-lg-block">
          <?php } else { ?>
            <div class="col-lg-7 common-menu common-menu-col d-none d-md-none d-lg-block">
          <?php } ?>
            <?php if ( has_nav_menu( 'primary' ) ) { ?>
      					<div  class="common-menu-wrap">
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
                  </div><!--/.common-menu-wrap--> 
  				  <?php  } ?>
            </div><!--/.common-menu-->
              <div class="col-lg-auto search-cart-login d-none d-md-none d-lg-block">
                <div class="winkel-search-wrap">
                    <a href="#" class="winkel-search search-open-icon"><i class="winkel winkel-magnifying-glass"></i></a> 
                    <a href="#" class="winkel-search search-close-icon"><i class="winkel winkel-multiply"></i></a>
                    <div class="top-search-input-wrap">
                        <div class="top-search-overlay"></div>
                        <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                            <div class="search-wrap">
                                <div class="search  pull-right canvas-top-search">
                                    <div class="sp_search_input">
                                        <input type="hidden" name="post_type" value="product" />
                                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control search-btn" placeholder="<?php esc_html_e('Search . . . . .','winkel'); ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="winek-users">
                    <?php if ( !is_user_logged_in() ){ ?>
                        <a class="winkel-users" data-toggle="modal" data-target="#myModal" href="#"><i class="winkel winkel-user"></i></a>
                    <?php }else{ ?>
                    <?php $dashboard_id = get_option( 'woocommerce_myaccount_page_id','' );
                    if($dashboard_id){ ?>
                        <a class="canvas-dashboard" href="<?php the_permalink( $dashboard_id ); ?>"><i class="winkel winkel-user"></i></a>
                    <?php } } ?>
                </div>
                <?php echo winkel_header_cart(); ?>
                <?php //echo winkel_header_cart(); ?>
              </div> <!--/.search-cart-login-->



  			</div><!--/.main-menu-wrap-->	 
  	</div><!--/.container-->
  </header><!--/.header-->




  <!-- #Login Register Popup -->
  <?php if ( !is_user_logged_in() ): ?>
      <div class="modal fade account-modal login" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="winkel winkel-multiply"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php _e( 'Login','winkel' ); ?></h4>
                </div>
                <div class="modal-body">
                    <form id="login" action="login" method="post">
                        <p class="login-info">The European languages are members of the same family. Their separate existence is a myth. </p>
                        <div class="login-error alert alert-danger" role="alert"></div>
                        <input type="text"  id="username" name="username" class="form-control" placeholder="Username">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="remember">
                        <input type="checkbox" id="remember" name="remember" ><label for="cbox2"><?php _e( 'Remember me','winkel' ); ?></label>
                        </div>
                        <input type="submit" class="btn btn-primary submit_button"  value="Log In" name="submit">
                        
                        <div class="account-modal-btm">
                            <div class="lost-pass">
                                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php echo esc_html__( 'Forgot password?','winkel' ); ?></a>
                            </div>
                            <div class="haveaccount">
                                <span><?php echo esc_html__( "Don't have an account?","winkel" ); ?></span>
                                <p><a data-toggle="modal" data-target="#register" href="#" data-dismiss="modal" ><?php echo esc_html__( 'Sign Up','winkel' ); ?></a></p>
                            </div>
                        </div>
                        
                        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                    </form>
                </div>
              </div>
          </div>
      </div>
      <div class="modal fade account-modal register" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="winkel winkel-multiply"></i></span></button>
                      <h4 class="modal-title" id="myModalLabel"><?php _e( 'Sign Up','winkel' ); ?></h4>
                  </div>
                  <div class="modal-body">
                      <form id="register" action="login" method="post">
                          <p class="condition login-info"><?php echo esc_html__( 'By signing up you agree to all the Terms and conditions.','winkel' ); ?></p>
                        <div class="login-error alert alert-danger" role="alert"></div>
                        <input type="text" id="username" name="username" class="form-control" placeholder="<?php _e( 'Username','winkel' ); ?>">
                        <input type="text" id="email" name="email" class="form-control" placeholder="<?php _e( 'Email','winkel' ); ?>">
                        <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e( 'Password','winkel' ); ?>">
                        <input type="submit" class="btn btn-primary register_button"  value="Register" name="submit">
                        <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                      </form>
                      <div class="haveaccount"><span><?php echo esc_html__( 'Already have an account?','winkel' ); ?></span>
                            <a data-toggle="modal" data-target="#myModal" href="#" data-dismiss="modal" ><?php _e( 'login','winkel' ); ?></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <?php endif; ?>