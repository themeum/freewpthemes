
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