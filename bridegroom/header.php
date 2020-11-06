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


<body <?php body_class(); ?>>

    <?php
        $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
        $headerlayout = get_theme_mod( 'head_style', 'solid' );
    ?>

    <div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
        <header id="masthead" class="site-header header header-<?php echo esc_attr($headerlayout);?>">
            <?php echo ( !class_exists('wp_megamenu_initial_setup') ) ? '<div class="bridegroom-menu-wrap">' : '<div class="megamenu-main">'; ?>
            <div class="site-header-wrap container">
                <div class="row">
                    
                    <!-- Logo Section -->
                    <div class="col-xs-6 col-sm-12 col-lg-12">
                        <div class="themeum-navbar-header">
                            <div class="logo-wrapper">
                            <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                <?php
                                    $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                                    $logotext = get_theme_mod( 'logo_text', 'bridegroom' );
                                    $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                    switch ($logotype) {
                                    case 'logoimg':
                                        if( !empty($logoimg) ) {?>
                                            <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_attr_e( 'Logo', 'bridegroom' ); ?>" title="<?php  esc_attr_e( 'Logo', 'bridegroom' ); ?>">
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
                    

                    <!-- Menu Setup - Default menu or Megamenu -->
                    <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                    <?php } else { ?>
                        <div class="col-md-12 col-lg-12 common-menu common-main-menu">
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
                            </div><!--/#main-menu-->
                        <?php } ?>
                    </div>
                    <!-- End Menu -->

                    <!-- Mobile menu -->
                    <?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
                        <div class="col-6 col-sm-6 d-lg-none mobile-menu-wrap">
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




