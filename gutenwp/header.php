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
<?php $layout = get_theme_mod( 'boxfull_en', 'fullwidth' ); $headerlayout = get_theme_mod( 'head_style', 'solid' ); ?>
    <div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
    
        <header id="masthead" class="site-header header header-<?php echo esc_attr($headerlayout);?>">
                
            <?php $header_style = get_theme_mod('header_style', false); ?>
            <?php echo ( !class_exists('wp_megamenu_initial_setup') ) ? '<div class="gutenwp-menu-wrap">' : '<div class="megamenu-main gutenwp-'.$header_style.'">'; ?>
                    
                <?php if ($header_style == 'regular_menu'){ ?>
                    <div class="site-header-wrap container regular-menu">
                        <div class="row">
                            <!-- Logo -->
                            <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                                <!-- Logo Section -->
                                <div class="col-xs-6 col-sm-3 col-lg-2">
                                    <div class="themeum-navbar-header">
                                        <div class="logo-wrapper regular">
                                            <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                                <?php
                                                $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                                                $logotext = get_theme_mod( 'logo_text', 'gutenwp' );
                                                $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                                switch ($logotype) {
                                                case 'logoimg':
                                                    if( !empty($logoimg) ) {?>
                                                        <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_attr_e( 'Logo', 'gutenwp' ); ?>" title="<?php  esc_attr_e( 'Logo', 'gutenwp' ); ?>">
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

                            
                            <!-- Menu Setup - Default menu or Megamenu -->
                            <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                            <div class="col-xs-12 col-sm-8 col-lg-8 d-none d-lg-block">
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

                            <div class="col-xs-12 col-sm-2 col-lg-2">
                                <!-- Login Registration section -->
                                <div class="header-search-wrap regular">
                                    <a href="#" class="gutenwp-search search-open-icon"><i class="fa fa-search"></i></a>
                                    <a href="#" class="gutenwp-search search-close-icon"><i class="fa fa-times"></i></a>
                                    <div class="top-search-input-wrap">
                                        <div class="top-search-overlay"></div>
                                        <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                                            <div class="search-wrap">
                                                <div class="search  pull-right gutenwp-top-search">
                                                    <div class="sp_search_input">
                                                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control" placeholder="<?php esc_html_e('Search...', 'gutenwp'); ?>" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile menu -->
                            <?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
                                <div class="col-7 col-sm-7 d-lg-none">
                                    <button type="button" class="navbar-toggle float-right" data-toggle="collapse" data-target=".navbar-collapse">
                                        <i class="fa fa-navicon"></i>
                                    </button>
                                </div>
                                <div class="col-12 d-lg-nones">
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
                        </div>
                    </div>
                <?php }elseif ($header_style == 'header_classic') { ?>
                    <div class="site-header-wrap container">
                        <div class="row">
                            <!-- Logo Section -->
                            <div class="col-xs-6 col-sm-4 col-lg-4 d-none d-lg-block header_classic_social">
                                <div class="header-social <?php echo $header_style; ?>">
                                    <?php get_template_part('lib/social-link')?>
                                </div><!--/#themeum-navbar-header-->
                            </div><!-- Logo End -->
                            
                            <!-- Logo Section -->
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="themeum-navbar-header <?php echo $header_style; ?>">
                                    <div class="logo-wrapper">
                                    <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                        <?php
                                            $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                                            $logotext = get_theme_mod( 'logo_text', 'gutenwp' );
                                            $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                            switch ($logotype) {
                                            case 'logoimg':
                                                if( !empty($logoimg) ) {?>
                                                    <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_attr_e( 'Logo', 'gutenwp' ); ?>" title="<?php  esc_attr_e( 'Logo', 'gutenwp' ); ?>">
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
                            
                            <!-- Search -->
                            <div class="col-xs-6 col-sm-4 col-lg-4 <?php echo $header_style; ?>">
                                <!-- Login Registration section -->
                                <div class="header-search-wrap">
                                    <a href="#" class="gutenwp-search search-open-icon"><i class="fa fa-search"></i></a> 
                                    <a href="#" class="gutenwp-search search-close-icon"><i class="fa fa-times"></i></a>
                                    <div class="top-search-input-wrap">
                                        <div class="top-search-overlay"></div>
                                        <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                                            <div class="search-wrap">
                                                <div class="search  pull-right gutenwp-top-search">
                                                    <div class="sp_search_input">
                                                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control" placeholder="<?php esc_html_e('Search...', 'gutenwp'); ?>" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- Search End -->

                            <!-- Menu Setup - Default menu or Megamenu -->
                            <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                            <?php } else { ?>
                            <div class="col-md-12 col-lg-12 common-menu common-main-menu header-classic-wrap">
                            <?php } ?>
                                <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                    <div id="main-menu" class="common-menu-wrap d-none d-lg-block <?php echo $header_style; ?>">
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
                                <div class="col-7 col-sm-6 d-lg-none">
                                    <button type="button" class="navbar-toggle float-right" data-toggle="collapse" data-target=".navbar-collapse">
                                        <i class="fa fa-navicon"></i>
                                    </button>
                                </div>
                                <div class="col-12 d-lg-nones">
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
                        </div>
                    </div>
                <?php }elseif($header_style == 'offcanvas_menu') { ?>
                    <div class="site-header-wrap container <?php echo $header_style; ?>">
                        <div class="row">
                            <!-- Search -->
                            <div class="col-xs-6 col-sm-4 col-lg-4 d-none d-lg-block">
                                <!-- Login Registration section -->
                                <div class="header-search-wrap <?php echo $header_style; ?>">
                                    <a href="#" class="gutenwp-search search-open-icon"><i class="fa fa-search"></i></a> 
                                    <a href="#" class="gutenwp-search search-close-icon"><i class="fa fa-times"></i></a>
                                    <div class="top-search-input-wrap">
                                        <div class="top-search-overlay"></div>
                                        <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                                            <div class="search-wrap">
                                                <div class="search  pull-right gutenwp-top-search">
                                                    <div class="sp_search_input">
                                                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control" placeholder="<?php esc_html_e('Search...', 'gutenwp'); ?>" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- Search End -->
                            
                            <!-- Logo Section -->
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="themeum-navbar-header <?php echo $header_style; ?>">
                                    <div class="logo-wrapper">
                                    <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                        <?php
                                            $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                                            $logotext = get_theme_mod( 'logo_text', 'gutenwp' );
                                            $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                            switch ($logotype) {
                                            case 'logoimg':
                                                if( !empty($logoimg) ) {?>
                                                    <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_attr_e( 'Logo', 'gutenwp' ); ?>" title="<?php  esc_attr_e( 'Logo', 'gutenwp' ); ?>">
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
                            
                            
                            <!-- col-xs-6 col-sm-4 col-lg-4 -->
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="menu-toggle"><span>Menu</span></div>
                            </div>
                            
                            <div class="gutenberg-offcanvas-menu">
                                <nav role="navigation">
                                    <div class="menu">
                                    <div class="container">
                                    <div class="row">
                                        <?php dynamic_sidebar('offcanvas_menu'); ?>
                                        <?php dynamic_sidebar('offcanvas_menu2'); ?>
                                    </div>
                                    </div>
                                    </div>
                                </nav>
                            </div>

                            <!-- Mobile menu -->
                            <?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
                                <div class="col-7 col-sm-6 d-lg-none">
                                    <button type="button" class="navbar-toggle float-right" data-toggle="collapse" data-target=".navbar-collapse">
                                        <i class="fa fa-navicon"></i>
                                    </button>
                                </div>
                                <div class="col-12 d-lg-nones">
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

                        </div> 
                    </div> 
                    <!-- row -->
                    <div class="regularmneu-full-section <?php echo $header_style; ?>">
                        <div class="container">
                            <div class="row">
                                <!-- Menu Setup - Default menu or Megamenu -->
                                <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                <?php } else { ?>
                                <div class="col-md-12 col-lg-12 common-menu common-main-menu">
                                <?php } ?>
                                    <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                        <div id="main-menu" class="common-menu-wrap d-none d-lg-block <?php echo $header_style; ?>">
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
                            </div>
                        </div>
                    </div>
                    <!-- End Menu -->
                <?php }else { ?>
                    <div class="site-header-wrap container">
                        <div class="row">
                            <!-- Search -->
                            <div class="col-xs-6 col-sm-4 col-lg-4 blog4">
                                <!-- Login Registration section -->
                                <div class="header-search-wrap <?php echo $header_style; ?>">
                                    <a href="#" class="gutenwp-search search-open-icon"><i class="fa fa-search"></i></a> 
                                    <a href="#" class="gutenwp-search search-close-icon"><i class="fa fa-times"></i></a>
                                    <div class="top-search-input-wrap">
                                        <div class="top-search-overlay"></div>
                                        <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                                            <div class="search-wrap">
                                                <div class="search  pull-right gutenwp-top-search">
                                                    <div class="sp_search_input">
                                                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control" placeholder="<?php esc_html_e('Search...', 'gutenwp'); ?>" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- Search End -->
                            
                            <!-- Logo Section -->
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="themeum-navbar-header logo-style4 <?php echo $header_style; ?>">
                                    <div class="logo-wrapper">
                                    <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                        <?php
                                            $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                                            $logotext = get_theme_mod( 'logo_text', 'gutenwp' );
                                            $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                            switch ($logotype) {
                                            case 'logoimg':
                                                if( !empty($logoimg) ) {?>
                                                    <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php esc_attr_e( 'Logo', 'gutenwp' ); ?>" title="<?php  esc_attr_e( 'Logo', 'gutenwp' ); ?>">
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
                            
                            <!-- col-xs-6 col-sm-4 col-lg-4 -->
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="menu-toggle menu-style4">
                                     <span>Menu</span>
                                    <button type="button" class="navbar-toggle float-right wpmm_mobile_menu_btn" data-toggle="collapse" data-target=".navbar-collapse"></button>
                                </div>
                            </div>
                            
                            <div class="gutenberg-offcanvas-menu full-offcanvas">
                                <nav role="navigation">
                                    <div class="menu">
                                        <div class="container">
                                            <div class="row">
                                                <!-- Menu Setup - Default menu or Megamenu -->
                                                <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                                <?php } else { ?>
                                                <div class="col-md-12 col-lg-12 common-menu common-main-menu header-classic-wrap">
                                                <?php } ?>
                                                    <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                                        <div id="main-menu" class="common-menu-wrap d-none d-lg-block <?php echo $header_style; ?>">
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
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>

                            <!-- Menu Setup - Default menu or Megamenu -->
                            <?php if( class_exists('wp_megamenu_initial_setup') ) { ?>
                                <div class="col-xs-12 col-sm-12 col-lg-12 d-none d-lg-block display-none">
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
                                        </div> <!--/#main-menu-->
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <!-- End Menu -->



                            <!-- Mobile menu -->
                            <?php if( !class_exists('wp_megamenu_initial_setup') ) { ?>
                            <div class="col-7 col-sm-6 d-lg-none">
                                <button type="button" class="navbar-toggle float-right" data-toggle="collapse" data-target=".navbar-collapse">
                                    <i class="fa fa-navicon"></i>
                                </button>
                            </div> 

                            <div class="col-12 d-lg-nones">
                                <div id="mobile-menu" class="mobile-menu-offcanvas">
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
                            <!-- End Mobile Menu -->
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>

            </div><!-- gutenwp-menu-wrap -->
        </header><!--/.header-->

