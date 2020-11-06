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
    $body_class = '';
    if(get_post_meta( get_the_ID() , 'themeum_header_transparent', true)) {
        $body_class = 'header-transparent';
    }
    if( get_theme_mod( 'header_fixed', false )){
        $body_class .= ' enable-sticky';
    }
    ?>

<div id="page" class="site <?php echo esc_attr( get_theme_mod( 'boxfull_en', 'fullwidth' ) ); ?>">
  <header id="masthead" class="site-header  header <?php echo esc_attr($body_class); ?>">
  	<div class="container header-wrapper">
  		<div class="main-menu-wrap row align-items-center clearfix">
            <div class="col-lg-2 col-sm-4 col-5 thm-logo-col">
  				    <div class="themeum-navbar-header">
      					<div class="logo-wrapper">
        				    <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
      						    <?php
                                    $logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
        							$logotype  = get_theme_mod( 'logo_style', 'logoimg' );
                                    $logotext  = get_theme_mod( 'logo_text', 'melody' );
                                    if($logoimg && $logotype == 'logoimg'){ ?>
                                        <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'melody' ); ?>" title="<?php  esc_html_e( 'Logo', 'melody' ); ?>">
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
                            'theme_location'  => 'primary',
                            'container'       => false,
                            'menu_class'      => 'nav navbar-nav',
                            'fallback_cb'     => 'wp_page_menu',
                            'depth'           => 3,
                            'walker'          => new wp_bootstrap_mobile_navwalker()
                        )
                    );
                  } ?>
                </div>
              </div><!--/.#mobile-menu-->
            <?php endif; ?>

            <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
    			<div class="col-sm-12 col-12 common-menu d-none d-lg-flex jusitify-content-center">
            <?php } else { ?>
              <div class="col-sm-12 col-12 common-menu d-flex jusitify-content-center">
            <?php } ?>

            <?php if ( has_nav_menu( 'primary' ) ) { ?>
  					<div id="main-menu" class="common-menu-wrap">
      					<?php
    						wp_nav_menu(
                                array(
      								'theme_location'    => 'primary',
      								'container'	        => '',
      								'menu_class'	      => 'custom-nav',
      								'fallback_cb'	      => 'wp_page_menu',
      								'depth'		          => 4,
      								'walker'		        => new Megamenu_Walker()
    							)
    						);
      					?>
                  </div><!--/.col-sm-9-->
  				  <?php  } ?>
            </div><!--/#main-menu-->
  		</div><!--/.main-menu-wrap-->
  	</div><!--/.container-->
  </header><!--/.header-->

