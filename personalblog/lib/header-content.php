
<header id="masthead" class="site-header header">
    <div class="logo-wrapper">
        <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
            <?php
              $logoimg = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
              $logotext = get_theme_mod( 'logo_text', 'personalblog' );
              $logotype = get_theme_mod( 'logo_style', 'logoimg' );
              switch ($logotype) {
                case 'logoimg':
                    if( !empty($logoimg) ) {?>
                        <img class="theme-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'personalblog' ); ?>" title="<?php  esc_html_e( 'Logo', 'personalblog' ); ?>">
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
    <div class="menu-wrapper"> 
      <div class="mobile-toggle-button">
        <button type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <i class="fa fa-bars"></i>
          <span>Menu</span>
        </button>  
      </div> 

      <div class="hidden-xs hidden-sm">
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
          </div>
        <?php  } ?>   
      </div>
  
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
  </div> <!--/.#menu-wrapper-->

</header><!--/.header-->