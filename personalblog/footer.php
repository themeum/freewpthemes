<!-- start footer -->
<footer id="footer" class="footer-wrap"> 
    <div class="container">
        <?php if( is_active_sidebar('bottom') ){ ?>
            <div class="bottom">
                <div class="row">
                    <div class="col-sm-12 text-center footer-wrapper">
                        <?php if (is_active_sidebar('bottom')) {?>
                            <div class="bottom-widget text-center">
                                <?php dynamic_sidebar('bottom'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ( get_theme_mod( 'copyright_en', true ) ) { ?>
            <div class="footer-copyright">

                <!-- Footer menu -->
                <div class="row">
                    <?php if ( has_nav_menu( 'footernav' ) ) { ?>
                        <div class="col-sm-12">
                            <?php    
                            $default = array( 
                                'theme_location'  => 'footernav',
                                'container'       => '', 
                                'menu_class'      => 'menu-footer-menu',
                                'menu_id'         => 'menu-footer-menu',
                                'fallback_cb'     => 'wp_page_menu',
                                'depth'           => 1
                            );
                            wp_nav_menu($default);
                            ?>
                        </div>
                    <?php } ?> 
                </div>
                <!-- Footer menu end -->

                <!-- Copyright -->
                <div class="row">
                    <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                        <div class="col-sm-12 copy-wrapper text-center">
                            <?php echo wp_kses_post(balanceTags( get_theme_mod( 'copyright_text', '© 2016 Your Company.  Designed By <a href="http://themeum.com/" target="_blank"> THEMEUM</a>') )); ?>
                        </div> <!-- copy-wrapper -->
                    <?php } ?>
                </div> <!-- Copyright end row -->

            </div> <!-- footer-copyright -->
        <?php } ?>
    </div> <!-- end container -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
