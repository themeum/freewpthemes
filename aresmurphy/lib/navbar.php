<?php if ( has_nav_menu( 'primary' ) ) { ?>
    <div id="main-menu" class="common-menu-wrap hidden-xs hidden-sm">
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
