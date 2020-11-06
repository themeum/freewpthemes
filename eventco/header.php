<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $favicon_icon = get_theme_mod( 'favicon_logo', get_template_directory_uri().'/images/favicon.png' ); ?>
    <?php if ($favicon_icon): ?>
    <link rel="icon" href="<?php echo $favicon_icon; ?>">
    <?php endif ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>

    
</head>


<body <?php body_class(); 
$preloader = get_theme_mod( 'preloader_en', false );
?>>
<?php if($preloader ) {?>
    <!-- Preloader -->
    <div id="global">
        <div class="div-position">
            <div class="mask" id="top">
                <div class="plane"></div>
            </div>
            <div class="mask" id="middle-top">
                <div class="plane"></div>
            </div>
            <div class="mask" id="middle-down">
                <div class="plane"></div>
            </div>
            <div class="mask" id="bottom">
                <div class="plane"></div>
            </div>
        </div>
    </div>
    <!-- End Loader -->
<?php  } ?>

    <?php
        $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
        $headerlayout = get_theme_mod( 'head_style', 'solid' );
    ?>
    <div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
        <header id="masthead" class="site-header header header-<?php echo esc_attr($headerlayout);?>">
            <?php echo ( !class_exists('wp_megamenu_initial_setup') ) ? '<div class="eventco-menu-wrap">' : '<div class="megamenu-main">'; ?>
            <div class="site-header-wrap container">
                <div class="row">
                    <!-- Logo -->
                    <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                        <!-- Logo Section -->
                        <div class="col-xs-6 col-sm-3 col-lg-2">
                            <div class="themeum-navbar-header">
                                <div class="logo-wrapper">
                                <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                    <?php
                                        $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                                        $logotext = get_theme_mod( 'logo_text', 'eventco' );
                                        $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                        switch ($logotype) {
                                        case 'logoimg':
                                            if( !empty($logoimg) ) {?>
                                                <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_attr_e( 'Logo', 'eventco' ); ?>" title="<?php  esc_attr_e( 'Logo', 'eventco' ); ?>">
                                            <?php }else{?>
                                                <h1> <?php  echo esc_html(get_bloginfo('name'));?> </h1>
                                            <?php }
                                            break;

                                            case 'logotext':
                                            if( $logotext ) { ?>
                                                <h1> <?php echo esc_html( $logotext ); ?> </h1>
                                            <?php }
                                            else
                                            {?>
                                                <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                                            <?php }
                                            break;

                                        default:
                                            if( $logotext ) { ?>
                                                <h1> <?php echo esc_html( $logotext ); ?> </h1>
                                            <?php }
                                            else
                                            {?>
                                            <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                                            <?php }
                                            break;
                                        } ?>
                                    </a>
                                </div>
                            </div><!--/#themeum-navbar-header-->
                        </div><!-- Logo End -->
                    <?php } ?>

                    <?php $login_enable = get_theme_mod('login_enable', false); ?>

                    <!-- Menu Setup - Default menu or Megamenu -->
                    <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                    <div class="col-xs-12 col-sm-7 col-lg-10">
                    <?php } else { ?>

                        <?php if ($login_enable){ ?>
                            <div class="col-md-12 col-lg-12 common-menu common-main-menu with-login">
                        <?php }else { ?>
                            <div class="col-md-12 col-lg-12 common-menu common-main-menu">
                        <?php } ?>

                    <?php } ?>
                        <?php if ( has_nav_menu( 'primary' ) ) { ?>
                            <div id="main-menu" class="common-menu-wrap d-none d-lg-block">
                                <?php
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '',
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 4,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    );
                                ?>

                                <?php if ($login_enable == true) { ?>
                                    <ul class="eventco-login-wrapper">
                                        <li class=" menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children has-menu-child">
                                            <div class="top-align top-user-login">
                                                <?php if ( is_user_logged_in() ) { ?>
                                                    
                                                    <?php
                                                        $current_user = wp_get_current_user();
                                                        echo get_avatar( $current_user->user_email, 32 );

                                                        if( $current_user->display_name != '' ){
                                                            if( get_option('review_page_id') != '' ){ 
                                                                echo '<a class="review-page hidden-xs" href="'.get_permalink( get_option('review_page_id') ).'">';  
                                                            }
                                                            echo ' <span>'.$current_user->display_name.'</span>';
                                                            if( get_option('review_page_id') != '' ){ echo '</a>';  }
                                                        }else{
                                                            if( get_option('review_page_id') != '' ){ 
                                                                echo '<a class="review-page hidden-xs" href="'.get_permalink( get_option('review_page_id') ).'">';
                                                            }
                                                            echo ' '. esc_attr( $current_user->user_login );
                                                            if( get_option('review_page_id') != '' ){ echo '</a>';  }
                                                        }
                                                    ?>

                                                    <a href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>"><span><?php _e('Logout','eventco'); ?></span></a>
                                                <?php } else { ?>
                                                      <i class="themeum-eventcouser"></i> <a class="sign-in-id" href="#sign-in" data-toggle="modal" data-target="#sign-in"><?php _e('Login','eventco'); ?></a>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    </ul>
                                <?php } ?>

                            </div><!--/#main-menu-->
                        <?php } ?>
                    </div>
                    <!-- End Menu -->

                    <!-- Mobile menu -->
                    <?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
                        <div class="col-7 col-sm-6 d-lg-none">
                            <button type="button" class="navbar-toggle float-right" data-toggle="collapse" data-target=".navbar-collapse">
                                <i class="fa fa-navicon"></i>
                            </button>
                        </div>
                        <div class="col-12 d-lg-none">
                            <div id="mobile-menu">
                                <div class="collapse navbar-collapse">
                                    <?php
                                        if ( has_nav_menu( 'primary' ) ) {
                                            wp_nav_menu( array(
                                                'theme_location'      => 'primary',
                                                'container'           => false,
                                                'menu_class'          => 'nav navbar-nav',
                                                'fallback_cb'         => 'wp_page_menu',
                                                'depth'               => 3,
                                                'walker'              => new wp_bootstrap_mobile_navwalker()
                                                )
                                            );
                                        }
                                    ?>
                                </div>
                            </div><!--/.#mobile-menu-->
                        </div>
                    <?php } ?>
                    <!-- End Mobile Menu -->

                </div><!--Row-->
            </div><!--/.container-->
        </div><!--Empty Div-->
    </header><!--/.header-->


                    <!-- sign in form -->
                    <div id="sign-form">
                        <div id="sign-in" class="modal fade">
                            <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <i class="fa fa-close close" data-dismiss="modal"></i>
                                         <h1 class="title"><?php _e('Login','eventco'); ?></h1>
                                     </div>
                                     <div class="modal-body">
                                        <form id="login" action="login" method="post">
                                            <div class="login-error alert alert-info" role="alert"></div>
                                            <input type="text"  id="username" name="username" class="form-control" placeholder="<?php _e('User Name','eventco'); ?>">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e('Password','eventco'); ?>">
                                            <input type="submit" class="btn btn-success submit_button"  value="Login" name="submit">
                                            <a class="lost-pass" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><strong><?php _e('Forgot password?','eventco'); ?></strong></a>
                                            <p class="modal-footer"><?php _e('Not a member?','eventco'); ?> 
                                                <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><strong><?php _e('Join today','eventco'); ?></strong></a>
                                            </p>
                                            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                                        </form>
                                     </div>
                                 </div>
                             </div> 
                         </div>
                    </div> <!-- end sign-in form -->

