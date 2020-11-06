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
    $layout = get_theme_mod( 'boxfull_en', 'boxwidth' );
    $headerlayout = get_theme_mod( 'head_style', 'solid' );
  ?> 
<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
  <?php
    if (get_theme_mod( 'topbar_en', true )) {
      get_template_part('lib/topbar');
    }
  ?>
  <header id="masthead" class="site-header header header-<?php echo esc_attr($headerlayout);?>">
    <div class="container">
        <div class="row">
            <div class="main-menu-wrap clearfix">
                <div class="col-md-3 col-xs-3 common-menu">
                  <div class="themeum-navbar-header">
                    <div class="logo-wrapper">
                          <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                                <?php
                                    $logoimg = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
                                    $logotext = get_theme_mod( 'logo_text', 'wptixon' );
                                    $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                                    switch ($logotype) {
                                      case 'logoimg':
                                          if( !empty($logoimg) ) {?>
                                              <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'wptixon' ); ?>" title="<?php  esc_html_e( 'Logo', 'wptixon' ); ?>">
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
                </div><!--/.col-sm-2-->

                <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
                  <div class="col-md-9 common-menu hidden-xs hidden-sm">
                <?php } else { ?>
                  <div class="col-md-9 common-menu">
                <?php } ?>
                  <?php if ( has_nav_menu( 'primary' ) ) { ?>
                    <div id="main-menu" class="common-menu-wrap">
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
                  <?php  } ?>   
                </div><!--/.col-sm-9--> 

                <?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
                  <button type="button" class="navbar-toggle col-sm-5 col-xs-5" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                  </button>   
                  <div id="mobile-menu" class="visible-xs visible-sm">
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
                <?php } ?>
            </div><!--/.main-menu-wrap-->     
        </div><!--/.row--> 
    </div><!--/.container--> 
  </header><!--/.header-->



    