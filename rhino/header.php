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
    $header_style = get_post_meta( get_the_ID(), "rhino_header_style", true );
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

<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">

  <header id="masthead" class="site-header  header header-<?php echo esc_attr($headerlayout); echo esc_attr($sticky_class); ?> ">
      
  	<div class="container">
  			<div class="main-menu-wrap row align-items-center clearfix">
          <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
            <div class="common-menu-responsive-logo col-auto">
      				  <div class="rhino-navbar-header">
          					<div class="logo-wrapper">
            						  <a class="rhino-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
              								<?php
              									$logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
              									$logotext  = get_theme_mod( 'logo_text', 'rhino' );
              									$logotype  = get_theme_mod( 'logo_style', 'logoimg' );

              									switch ($logotype) {
                                    case 'logoimg':
                										  if( !empty($logoimg) ) { ?>
                											    <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'rhino' ); ?>" title="<?php  esc_html_e( 'Logo', 'rhino' ); ?>">
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
      				  </div><!--/#rhino-navbar-header-->   
    				</div><!--/.col-sm-2-->
          <?php }?>

             <?php 

             if( ! class_exists('wp_megamenu_initial_setup')) { ?>
              <div class="rhino-menu">
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
                  <?php get_template_part('lib/social-link'); ?>
                </div>
              </div><!--/.#mobile-menu-->
           <?php } ?>

          <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
  				  <div class="common-menu-responsive col">
          <?php } else { ?>
            <div class="common-menu-responsive-main col">
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
              								//'walker'		 => new Megamenu_Walker()
            								  )
            						); 
          					?>	
                  </div><!--/.col-sm-9--> 
  				  <?php  } ?>
            </div><!--/#main-menu-->
            <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
            <div class="d-social-link col-auto">
              <?php get_template_part('lib/social-link'); ?>
            </div>
              <?php if (get_theme_mod( 'header_search', true )) { ?>
              <div class="header-search thm-search-icon col-auto">
                <span class="search-box"><i class="fa fa-search"></i></span>
              </div>
              <?php } ?>
            <?php }?>
  			</div><!--/.main-menu-wrap-->	 
  	</div><!--/.container--> 
  </header><!--/.header-->

  <!--Search Wrap-->
  <div class="thm-fullscreen-search d-flex flex-wrap justify-content-center align-items-center">
    <div class="search-overlay">
      <div class="container">
        <i class="fa fa-close"></i>

        <div class="search-box d-flex flex-wrap align-items-center">
          <form method="get">
              <input class="main-font" type="text" value="" name="s" placeholder="Search" autocomplete="off">
              <input type="submit" value="submit" class="d-none" id="thm-search-submit">
              <span class="float-right"> <?php echo esc_html( 'Hit enter to search or click close button for dismiss', 'rhino' ); ?></span>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Search End-->
